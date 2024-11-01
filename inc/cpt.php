<?php 
function quote_post_type() {
    $labels = array(
      'name'               => __( ' All Quotes'),
      'singular_name'      => __('Quote' ),
      'add_new'            => __( 'Add New Quote'),
      'add_new_item'       => __( 'Add New Quote' ),
      'edit_item'          => __( 'Edit Quote' ),
      'new_item'           => __( 'New Quote' ),
      'all_items'          => __( 'All Quote' ),
      'view_item'          => __( 'View Quote' ),
      'search_items'       => __( 'Search Quote' ),
      'not_found'          => __( 'No Quote found' ),
      'not_found_in_trash' => __( 'No Quote found in the Trash' ), 
      'menu_name'          => ' Quote'
    );
    $args = array(
      'labels'        => $labels,
      'public'        => true,
      'show_in_menu' => 'manage-quotes',
      'supports'      => array( 'title' ),
      'publicly_queryable'  => false,
      'query_var'           => false,
      'exclude_from_search' => true,
    );
    register_post_type( 'wpaq_quotes', $args ); 
  }
  add_action( 'init', 'quote_post_type' );

?>