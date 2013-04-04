<?php

//gp_profile_widget
class gp_profile_widget extends WP_Widget
{
    function gp_profile_widget()
    {
        $widget_ops = array(
            'classname' => 'gp_profile_widget',
            'description' => 'Display Google Plus Profile Widget, Gplus ID:required'
        );
        $this->WP_Widget('gp_profile_widget', 'GP Profile', $widget_ops);
    }
    
    function widget($args, $instance)
    {
        global $gp; if(!$gp) return; 

        echo '<div class="gp"><div class="gp_logo"><img src="' . GP_URL . '/img/logo.png" width="58" height="18" alt="Google Plus Logo - Profile" /> profile </div><!-- .gp_logo -->';
        echo '<div class="gp_profile"><img class="gp_profile_image" alt="' . $gp->get('displayName') . ' Profile Image" src="' . $gp->get('image') . '?sz=60" width="60" height="60" />';
        echo '<a rel="me" href="' . $gp->get('url') . '" class="gp_profile_name" target="_blank">' . $gp->get('displayName') . '</a>';
        echo '<div class="gp_circle"><a rel="nofollow" href="' . $gp->get('url') . '" target="_blank" class="gp_circle">Add to circles</a></div><!-- .gp_circle -->';
        echo '</div><!-- .gp_profile -->';
        
       // echo '<div class="gpf">(' . $gp->get('circlers_count') . ') Circler\'s | ';
        
       // echo '(' . $gp->get('circles_count') . ') Circles';
        
       // echo '</div><!-- .gpf -->';
        
        echo '</div><!-- .gp -->';
        
    }
}

//gp_circles_widget
class gp_circles_widget extends WP_Widget
{
    function gp_circles_widget()
    {
        $widget_ops = array(
            'classname' => 'gp_circles_widget',
            'description' => 'Display Google Plus Circles Widget'
        );
        $this->WP_Widget('gp_circles_widget', 'GP Circles', $widget_ops);
    }
    
    function widget($args, $instance)
    {
        global $gp; if(!$gp) return; 
        $circles = $gp->get('circles');
        
        if (!empty($circles) && is_array($circles)) {
            echo '<div class="gp">';
            
            echo '<div class="gp_logo"><img src="' . GP_URL . '/img/logo.png" width="58" height="18" alt="Google Plus Logo - Circles" /> circles </div><!-- .gp_logo -->';
            
            echo '<div class="gpc gp_center">';
            
            foreach ($circles as $circle) {
                echo '<a title="' . $circle[3] . '" rel="nofollow" target="blank" href="https://plus.google.com/' . $circle[0] . '"><img class="gpc_circle" src="' . $circle[2] . '?sz=60" width="60" height="60" /></a>';
                
            }
            echo '</div><!-- .gpc -->';
            echo "<div class=\"gpf\">In " . $gp->get('firstname') . "'s circles";
            echo ' (' . $gp->get('circles_count') . ')</div><!-- .gpf -->';
            
            
            
            echo '</div><!-- .gp -->';
            echo $after_widget;
            
        }
    }
    
}

//gp_circlers_widget
class gp_circlers_widget extends WP_Widget
{
    function gp_circlers_widget()
    {
        $widget_ops = array(
            'classname' => 'gp_circlers_widget',
            'description' => "Display Google Plus Circler's Widget'"
        );
        $this->WP_Widget('gp_circlers_widget', "GP Circler's", $widget_ops);
    }
    
    function widget($args, $instance)
    {
        global $gp; if(!$gp) return; 
        $circlers = $gp->get('circlers');
        
        if (!empty($circlers) && is_array($circlers)) {
            echo '<div class="gp">';
            
            echo '<div class="gp_logo"><img src="' . GP_URL . '/img/logo.png" width="58" height="18" alt="Google Plus Logo - Circlers" />';
            echo " circler's </div><!-- .gp_logo -->";
            
            echo '<div class="gpc gp_center">';
            
            foreach ($circlers as $circle) {
                echo '<a title="' . $circle[3] . '" rel="nofollow" target="blank" href="https://plus.google.com/' . $circle[0] . '"><img class="gpc_circle" src="' . $circle[2] . '?sz=60" width="60" height="60" /></a>';
                
            }
            
            echo '</div><!-- .gpc -->';
            
            echo '<div class="gpf">Have ' . $gp->get('firstname') . ' in circles (' . $gp->get('circlers_count') . ')</div><!-- .gpcf -->';
            
            
            
            echo '</div><!-- .gp -->';
            echo $after_widget;
            
        }
    }
    
}

//gp_stream_widget
class gp_stream_widget extends WP_Widget
{
    function gp_stream_widget()
    {
        $widget_ops = array(
            'classname' => 'gp_stream_widget',
            'description' => 'Display Google Plus stream Widget'
        );
        $this->WP_Widget('gp_stream_widget', 'GP stream', $widget_ops);
    }
    
    function widget($args, $instance)
    {
        global $gp;  if(!$gp) return; 
        $stream = $gp->activities();
        
        if (!empty($stream) && is_array($stream)) {
            echo '<div class="gp">';
            
            echo '<div class="gp_logo"><img src="' . GP_URL . '/img/logo.png" width="58" height="18" alt="Google Plus Logo - stream" /> stream </div><!-- .gp_logo -->';
            
            echo '<div class="gp_stream"><ul>';
            foreach ($stream as $activity) {
                if (!empty($activity['url']))
                    echo '<li><a rel="nofollow" target="_blank" href="' . $activity['url'] . '">' . $gp->limit($activity['title']) . '</a></li>';
            }
            echo '</ul></div><!-- .gp_stream -->';
            
            
            echo '<div class="gpf"><a rel="nofollow" href="' . $gp->get('url') . '/posts" target="_blank">View All &raquo;</a></div><!-- .gpf -->';
            
            echo '</div><!-- .gp -->';
        }
    }
    
}

?>