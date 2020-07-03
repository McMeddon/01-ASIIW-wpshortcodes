<?php 

//---------------------------------------------------------------------------------
//------------Type 1 - pagetitle insert for standort pages-------------------------
function pagetitle( ){    return get_the_title(); }
add_shortcode( 'page_title', 'pagetitle' );

//---------------------------------------------------------------------------------
//------------Type 2 - tax_marke Taxonomy shortcode--------------------------------
 add_shortcode( 'tax_marke', 'taxmarke' );
 function taxmarke($atts){     global $post;
     $html  = '';
     $taxonomy = 'marke';
     $terms = get_the_terms( $post, $taxonomy );
 
     if ( !empty( $terms ) ) {
         foreach ($terms as $term) {
             $html = '<span class="taxcolor" >' . $term->name . '</span>';
         }     }      return $html; }

//---------------------------------------------------------------------------------
 //------------Type 3 - tax_karosserie_variante Taxonomy shortcode-----------------
 add_shortcode( 'tax_karosserie_variante', 'taxkarosserie_variante' );
 function taxkarosserie_variante($atts){     global $post;
     $tag_string ='';
     $html  = '';
     $taxonomy = 'karosserie_variante';
     $terms = get_the_terms( $post, $taxonomy );
     $args = array(
        'number'                    => 5, 
        'smallest'                  => 1, 
        'largest'                   => 1, 
        'fields'                    => 'all',
        'separator'                 => ", ",
        'unit'                      => 'em', 
        'echo'                      => true
    ); 
 
     if ( !empty( $terms ) ) {
         foreach ($terms as $term) {
             $html = '<span class="taxcolor" >' . $term->name . '</span>';
             $tag_string = wp_generate_tag_cloud( $terms, $args );
         }     }     return $tag_string; }

?>
