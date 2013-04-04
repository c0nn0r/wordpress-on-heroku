<?php


function gp_saved()
{
    echo '<div id="message" class="updated fade">Settings Saved</div>';
}


function gp_dashboard()
{
    echo '<div class="wrap">';
    echo '<div id="icon-plugins" class="icon32"><br /></div>';
    echo '<div class="tool-box"><h2>GP Settings</h2>';
    
    if (isset($_POST['submit'])) {
    // update plugin options
    
        if (empty($_POST['gp_id']))
            echo '<div class="error" style="padding:5px;"><b>Error,Your <code>Google Plus ID</code> is Empty</b></div>';
        update_option('gp_id', $_POST['gp_id']);   
           
        if (empty($_POST['gp_client_id']))
            echo '<div class="error" style="padding:5px;"><b>Error,Your <code>Client ID</code> is Empty</b></div>';
        update_option('gp_client_id', $_POST['gp_client_id']);
            
        if (empty($_POST['gp_client_secret']))
            echo '<div class="error" style="padding:5px;"><b>Error,Your <code>Client secret</code> is Empty</b></div>';
        update_option('gp_client_secret', $_POST['gp_client_secret']);
                    
        if (empty($_POST['gp_redirect_uri']))
            echo '<div class="error" style="padding:5px;"><b>Error,Your <code>Redirect URI</code> is Empty</b></div>';
        update_option('gp_redirect_uri', $_POST['gp_redirect_uri']);

        if (empty($_POST['gp_api_key']))
            echo '<div class="error" style="padding:5px;"><b>Error,Your <code>Api Key</code> is Empty</b></div>';
        update_option('gp_api_key', $_POST['gp_api_key']);                 
        
    }
?>

<div class="tool-box">

<form method="post">						
<p>Start using the Google APIs console to manage your API usage</p>

<ol>

<li>Point your browser to <a target="blank" href="https://code.google.com/apis/console/">https://code.google.com/apis/console/</a> and it will take you to the login page of the API Console.<br /> Once you logged in with your email and password, following will appear. Click on the <strong>Create Project</strong>.</li>
<li>In the list of services find the <strong>Google+ API</strong> and Click on <code>'off'</code> to turn it <code>on</code>.</li>
<li>In the next screen chek <strong>I Agree..</strong> and click on <strong>Accept</strong>. You will see that the button next to Google+ API has changed to following</li>
<li>Now click on the <code>API Access</code> on the left sidebar and it will ask you to <code>Create an OAuth 2.0 client id...</code></li>
<li>Then click the <code>Create an OAuth 2.0 client id</code> button.</li>
<li>Fill a product name, upload an image as logo of your project, and click <code>Next</code>.</li>
<li>In the next screen choose a <code>Web application</code> and insert <strong>your domain/site</strong>.</li>
<li>Click <strong>Create client ID</strong>
<li>Copy the settings here</li>
</ol>
<hr />
<table class="form-table">
<tr valign="top"><th scope="row"><label>Client ID:</label></th>
<td><input name="gp_client_id" type="text" id="gp_client_id" value="<?php
    
    if (get_option('gp_client_id') && (strlen('gp_client_id')) > 1) {
        echo get_option('gp_client_id');
    }
    
?>" class="regular-text code" />
</td></tr>

<tr valign="top"><th scope="row"><label>Client secret:</label></th>
<td><input name="gp_client_secret" type="text" id="gp_client_secret" value="<?php
    
    if (get_option('gp_client_secret') && (strlen('gp_client_secret')) > 1) {
        echo get_option('gp_client_secret');
    }
    
?>" class="regular-text code" />
</td></tr>

<tr valign="top"><th scope="row"><label>Redirect URIs:</label></th>
<td><input name="gp_redirect_uri" type="text" id="gp_redirect_uri" value="<?php
    
    if (get_option('gp_redirect_uri') && (strlen('gp_redirect_uri')) > 1) {
        echo get_option('gp_redirect_uri');
    }
    
?>" class="regular-text code" />
</td></tr>

<tr valign="top"><th scope="row"><label>Api Key:</label></th>
<td><input name="gp_api_key" type="text" id="gp_api_key" value="<?php
    
    if (get_option('gp_api_key') && (strlen('gp_api_key')) > 1) {
        echo get_option('gp_api_key');
    }
    
?>" class="regular-text code" />
</td></tr>



<tr valign="top"><th scope="row"><label for="upload_path">Google+ ID:</label></th>
<td><input name="gp_id" type="text" id="gp_id" value="<?php
    
    if (get_option('gp_id') && (strlen('gp_id')) > 1) {
        echo get_option('gp_id');
    }
    
?>" class="regular-text code" />

</td>



</tr>
</table>

<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save"  /></p>
					
</form>
</div>

<?php
    
    echo '</div><!-- wrap -->';
}


function gp_one_settings()
{
    if ($_POST) {
        // update plugin options
        update_option('gp_one', GP::serial($_POST));
        gp_saved();
        
    }
    
    if (GP_ONE)
        extract(GP::unserial(get_option('gp_one')));
    
    echo '<div class="wrap">';
    echo '<div id="icon-options-general" class="icon32"><br /></div>';
    echo '<div class="tool-box"><h2>GP One Settings</h2>';
?>
<style>

.gp_bb{
border-bottom:#dfdfdf 1px solid;
}

.gp_size{
float:left; padding: 10px
}

</style>

	<form name="gp_one" id="gp_one" method="post">
	    <table>  <tr><td>


	<h3 class="gp_bb">Size</h3>
	<div class="gp_size">
		<input type="radio" name="size" value="standard" <?php
    if (($size == 'standard') || (!$size))
        echo ' checked';
?>></input>
		<label>Standard</label>
		<?php
    gp_one('http://ajitae.com/');
?>
	</div>
	<div class="gp_size">
		<input type="radio" name="size" value="small" <?php
    if ($size == 'small')
        echo ' checked';
?>></input>
		<label>Small</label>
		<?php
    gp_one('http://ajitae.com/', 'small');
?>
	</div>
	<div class="gp_size">
		<input type="radio" name="size" value="medium" <?php
    if ($size == 'medium')
        echo ' checked';
?>></input>
		<label>Medium</label>
		<?php
    gp_one('http://ajitae.com/', 'medium');
?>
	</div>
	<div class="gp_size">
		<input type="radio" name="size" value="tall" <?php
    if ($size == 'tall')
        echo ' checked';
?>></input>
		<label>Tall</label>
		<?php
    gp_one('http://ajitae.com/', 'tall');
?>
	</div>


            </td>
        </tr>

        <tr>

            <td><h3 class="gp_bb">Position</h3>

                <input type="radio" name="position" value="" <?php
    if (!$position)
        echo 'checked="checked"';
?> />
                <label><span style="color:red;">None</span></label><br />

                <input type="radio" name="position" value="before" <?php
    if ($position == 'before')
        echo 'checked="checked"';
?> />
                <label>Before content</label><br />

                <input type="radio" name="position" value="after" <?php
    if ($position == 'after')
        echo 'checked="checked"';
?> />
                <label>After content</label><br />

                <input type="radio" name="position" value="both" <?php
    if ($position == 'both')
        echo 'checked="checked"';
?> />
                <label>Both before and after content</label><br />
            </td>
        </tr>

  <tr><td>
	<h3 class="gp_bb">Counter</h3>
	
		<input type="checkbox" name="counter" value="true"<?php
    if ($counter == true)
        echo ' checked';
?>>
		<label>Display the counter with the button</label>
	
            </td>
        </tr>

        <tr>

            <td><h3 class="gp_bb">Visibility</h3>
                <input type="checkbox" value="1" <?php
    if ($home == '1')
        echo 'checked="checked"';
?> name="home" />
                <label>Display the button on home page</label>
                    <br />
                <input type="checkbox" value="1" <?php
    if ($page == '1')
        echo 'checked="checked"';
?> name="page" />
                <label>Display the button on pages</label>
                    <br />
                <input type="checkbox" value="1" <?php
    if ($post == '1')
        echo 'checked="checked"';
?> name="post" />
                <label>Display the button on posts</label>

                    <br />
                <input type="checkbox" value="1" <?php
    if ($attachment == '1')
        echo 'checked="checked"';
?> name="attachment" />
                <label for="display_post">Display the button on attachments</label>

            </td>
        </tr>

        <tr>

            <td>

		<input type="submit" value="Save Settings" class="button-primary" />
	
            </td>
        </tr>

</table>

	
	</form>
</div>
	


	
<?php
}

?>