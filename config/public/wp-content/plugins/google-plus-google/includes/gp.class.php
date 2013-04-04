<?php

//require_once 'google-api-php-client/src/apiClient.php';
//require_once 'google-api-php-client/src/contrib/apiPlusService.php';

/**
 * This class can be used to retrieve data from a Google+ profile with PHP.
 * It is rather a proof of concept than something for productive use.
 *
 * The technique used is called “web scraping”
 * (see http://en.wikipedia.org/wiki/Web_scraping for details). That means:
 */
class GPException extends Exception
{
}
class GP
{
    // Google+ JSON.
    private $content = NULL;
    
    // Fetching successful?
    public $ready = false;
    
    // cURL cookie file.
    private $cookie = NULL;
    
    // Define what to return if something is not found.
    public $na = 'n/a';
    
    // ID
    private $id = NULL;
    
    /**
     * GP constructor.
     *
     * @param string $id of the Google+ profile.
     */
    public function __construct($id)
    {
        // This script requires cURL.
        if (!function_exists('curl_init')) {
            throw new GPException('cURL not installed. See http://php.net/manual/en/book.curl.php for details.');
        }
        
require_once 'google-api-php-client/src/apiClient.php';
require_once 'google-api-php-client/src/contrib/apiPlusService.php';
        
$client = new apiClient();

$client->setApplicationName("GP");

$client->setClientId(get_option('gp_client_id'));

$client->setClientSecret(get_option('gp_client_secret'));

$client->setRedirectUri(get_option('gp_redirect_uri'));

$client->setDeveloperKey(get_option('gp_api_key'));

$client->setScopes(array('https://www.googleapis.com/auth/plus.me'));

$this->plus = new apiPlusService($client);
        
$this->id = $id;
        
        
    }
    
    /**
     * Fetch the HTML of the Google+ profile.
     *
     * @param string $url The url of the Google+ profile
     */
    
    private function fetch($id)
    {
      
        
        
        // Simple cache handling.
        $cache = GP_DIR.'/cache/' . $id;
        
        if (file_exists($cache)) {
            $Diff  = time() - filemtime($cache);
            $Cache = 300; // 5 minutes
            if ($Cache >= $Diff) {
                $this->content = file_get_contents($cache);
                if ($this->content) {
                    $this->ready = true;
                    return true;
                }
            }
        }
        
        // Set the URL.
        $url = 'https://plus.google.com/' . $id . '/posts';
        
        // Cookie path.
        if (function_exists('sys_get_temp_dir')) {
            $this->cookie = tempnam(sys_get_temp_dir(), 'gpCookie');
        }
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:2.0.1) Gecko/20100101 Firefox/4.0.1");
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_REFERER, get_bloginfo('url') . '/');
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie);
        
        $content = curl_exec($ch);
        
        $iError = curl_errno($ch);
        $sError = curl_error($ch);
        
        curl_close($ch);
        
        // Remove cookie.
        if ($this->cookie) {
            unlink($this->cookie);
        }
        
        if ($CurlErr > 0) {
            throw new GPException('cURL error (' . $iError . '):' . $sError);
        }
        
        
        // Remove line breaks.
        $content = preg_replace('~(\r|\n|\r\n)~', '', $content);
        
        $start = strpos($content, 'var OZ_initData = ');
        $end   = strpos($content, ";window.jstiming.load.tick('idp');</script>", $start);
        $json  = substr($content, ($start + 18), -(strlen($content) - $end));
        
        // This paves the way to coding hell.
        $json = preg_replace('~(,){2,}~', ',', $json);
        $json = str_replace('[,', '[', $json);
        
        $contents = json_decode($json, true);
        
        if (!is_array($contents))
            return false;
        
        $this->content = $this->serial($contents);
        $this->ready   = true;
        
        file_put_contents($cache, $this->content);
        
        return true;
        
    }
    
    public function get($parameter)
    {
        $people = $this->plus->people->get($this->id);
        
        if($parameter == 'image'){
        
        $img = $people['image'];
        return str_replace('?sz=50','',$img['url']);
        }
        return $people[$parameter];
   
    }
    
    public function activities()
    {
		
		$stream =  $this->plus->activities->listActivities($this->id, 'public', array('maxResults' => 100)); return $stream['items'];
    }    
    
    /**
     * Returns a shortened text.
     *
     * @param string $Text The text to shorten.
     * @param integer $Length The new length of the text.
     */
    static function limit($Text, $MaxLength = 100, $bolDots = true)
    {
        $Return = trim(strip_tags($Text)) . ' ';
        $Return = trim(preg_replace('/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/', '', $Return));
        if (strlen($Return) <= $MaxLength) {
            return $Return;
        }
        $Return = substr($Return, 0, $MaxLength);
        $Return = trim(substr($Return, 0, strrpos($Return, ' ')));
        if ($bolDots && (strlen($Return) <= ($MaxLength - 1))) {
            return $Return . '…';
        }
        return $Return;
    }
    
    public function serial($obj)
    {
        return base64_encode(gzcompress(serialize($obj)));
    }
    
    public function unserial($txt)
    {
        return unserialize(gzuncompress(base64_decode($txt)));
    }
    
}
?>