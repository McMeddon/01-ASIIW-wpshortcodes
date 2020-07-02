<?php 

//add child theme
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() { wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' ); }

//removing emojs
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

//-------------------------------------------------------------------------------------------------------------------------------------------
//pagetitle insert for standort pages
function pagetitle( ){    return get_the_title(); }
 add_shortcode( 'page_title', 'pagetitle' );

 //-------------------------------------------------------------------------------------------------------------------------------------------
//[tags] insert for autoglas page as list
//function tags( ){$tags = get_tags(array('hide_empty' => false  ));  echo '<ul>';  foreach ($tags as $tag) {    echo '<li>' . $tag->name . '</li>';  }  echo '</ul>';}
//add_shortcode('tags', 'tags'); 

//-------------------------------------------------------------------------------------------------------------------------------------------
//[togs] insert for autoglas page as linked tag cloud
function togs( ){$tags = get_tags();
    $html = '<div class="post_tags">';
    foreach ( $tags as $tag ) {
        $tag_link = get_tag_link( $tag->term_id );
    
        $html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
        $html .= "{$tag->name} / </a>";
    }
    $html .= '</div>';
    echo $html;}
add_shortcode('togs', 'togs') ;

//-------------------------------------------------------------------------------------------------------------------------------------------
//[togs] insert for autoglas page as linked tag cloud
function wpb_tag_cloud() { 
    $tags = get_tags();
    $args = array(
        'smallest'                  => 16, 
        'largest'                   => 52,
        'unit'                      => 'px', 
        'number'                    => 50,  
        'format'                    => 'flat',
        'separator'                 => " ",
        'orderby'                   => 'count', 
        'order'                     => 'ASC',
        'show_count'                => 2,
        'echo'                      => false
    ); 
     
    $tag_string = wp_generate_tag_cloud( $tags, $args );
     
    return $tag_string; 
     
    } 
    // Add a shortcode so that we can use it in widgets, posts, and pages
    add_shortcode('wpb_popular_tags', 'wpb_tag_cloud'); 
     
    // Enable shortcode execution in text widget
    add_filter ('widget_text', 'do_shortcode');


//-------------------------------------------------------------------------------------------------------------------------------------------
/*[cookie exporation
    function mind_set_cookie_expire( $time ) {

   
        return time() + 86400;  // 1 day 
        // Some other examples:
        // 1 Minute would be:   
        // return time() + 60; 
        // return 0; to set the cookie to expire at the end of the session. 
      
      }
      
      add_filter( 'post_password_expires', 'mind_set_cookie_expire' );
*/

//-------------------------------------------------------------------------------------------------------------------------------------------
// Bei passwortgeschützten Seiten das  „Protected:“, respektive das „Geschützt:“ entfernen
// "privat" & "geschützt" aus dem Beitragstitel entfernen 
function kb_remove_pw_pr_info ( $title_with_info ) {
    $title_with_info = str_replace( 'Gesch&uuml;tzt: ', 'Gesch&uuml;tzter Bereich f&uuml;r ', $title_with_info );
    $title_with_info = str_replace( 'Geschützt: ', 'Gesch&uuml;tzter Bereich f&uuml;r ', $title_with_info );
    $title_with_info = str_replace( 'Privat:', '', $title_with_info );
    return $title_with_info;
    }
    add_filter('the_title', 'kb_remove_pw_pr_info');
//


?>
