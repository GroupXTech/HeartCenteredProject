<?php
/* Gallery Custom Post Type */
/* Register Custom Taxonomies */

//// FUNCTION TO CREATE IT
function favethemes_gallery_register() {  

	global $nt_option;
	
	//// LABELS
	$labels = array(
		'name' => __('Galleries', 'magzilla'),
			'singular_name' => __('Gallery', 'magzilla'),
			'add_new' => __('Add New', 'magzilla'),
			'add_new_item' => __('Add New Gallery', 'magzilla'),
			'edit_item' => __('Edit Gallery', 'magzilla'),
			'new_item' => __('New Gallery', 'magzilla'),
			'all_items' => __('All Galleries', 'magzilla'),
			'view_item' =>__('View Gallery', 'magzilla'),
			'search_items' => __('Search Galleries', 'magzilla'),
			'not_found' =>  __('No Galleries Found', 'magzilla'),
			'not_found_in_trash' => __('No Galleries found in trash.', 'magzilla'),
			'parent_item_colon' => '',
			'menu_name' => 'Galleries'
	);
	
    //// ARGUMENTS
		$args = array(
		
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'show_in_menu' => true, 
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'has_archive' => true, 
			'hierarchical' => false,
			'menu_position' => 9,
			'menu_icon' => '',
			'supports' => array('title', 'editor', 'thumbnail','comments','revisions','author')
		  
		);  
  
    	//// REGISTERS IT
		register_post_type('gallery', $args);
}  
// Adds Custom Post Type*/
add_action('init', 'favethemes_gallery_register'); 

// Taxonomy Categories
function favethemes_gallery_categories(){
	register_taxonomy(  
	'gallery-categories', 'gallery',  
	array(  
		'hierarchical' => true,  
		'labels' => array(
			'name' => __( 'Gallery Categories', 'magzilla' ),
			'singular_name' => __( 'Category', 'magzilla' ),
			'search_items' => __( 'Search Categories', 'magzilla' ),
			'popular_items' => __( 'Popular Categories', 'magzilla' ),
			'all_items' => __( 'All Categories', 'magzilla' ),
			'edit_item' => __( 'Edit Category', 'magzilla' ),
			'update_item' => __( 'Update Category', 'magzilla' ),
			'add_new_item' => __( 'Add New Category', 'magzilla' ),
			'new_item_name' => __( 'New Category Name', 'magzilla' ),
			'separate_items_with_commas' => __( 'Separate Categories With Commas', 'magzilla' ),
			'add_or_remove_items' => __( 'Add or Remove Category', 'magzilla' ),
			'choose_from_most_used' => __( 'Choose From Most Used Categories', 'magzilla' ),
			'parent' => __( 'Parent Category', 'magzilla' )
			),
		'query_var' => true,  
		'rewrite' => true  
		)  
	);
}
add_action( 'init', 'favethemes_gallery_categories' );

function unpress_gallery_category() {
	global $post;
	global $wp_query;
	$terms_as_text = strip_tags( get_the_term_list( $wp_query->post->ID, 'gallery-categories', '', ', ', '' ) );
	echo $terms_as_text;
}
// Taxonomy Tags
function favethemes_gallery_tags(){ 
	register_taxonomy(  
	'gallery-tags', 'gallery',  
	array(  
		'hierarchical' => false,  
		'labels' => array(
			'name' => __( 'Gallery Tags', 'magzilla' ),
			'singular_name' => __( 'Tag', 'magzilla' ),
			'search_items' => __( 'Search Tags', 'magzilla' ),
			'popular_items' => __( 'Popular Tags', 'magzilla' ),
			'all_items' => __( 'All Tags', 'magzilla' ),
			'edit_item' => __( 'Edit Tag', 'magzilla' ),
			'update_item' => __( 'Update Tag', 'magzilla' ),
			'add_new_item' => __( 'Add New Tag', 'magzilla' ),
			'new_item_name' => __( 'New Tag Name', 'magzilla' ),
			'separate_items_with_commas' => __( 'Separate Tags With Commas', 'magzilla' ),
			'add_or_remove_items' => __( 'Add or Remove Tag', 'magzilla' ),
			'choose_from_most_used' => __( 'Choose From Most Used Tags', 'magzilla' ),
			'parent' => __( 'Parent Tag', 'magzilla' )
			),
		'query_var' => true,  
		'rewrite' => true  
		)  
	);
}
add_action( 'init', 'favethemes_gallery_tags' );


function favethemes_gallerytags() {
	global $post;
	global $wp_query;
	$terms_as_text = strip_tags( get_the_term_list( $wp_query->post->ID, 'gallery-tags', '', ', ', '' ) );
	echo $terms_as_text;
}



// start Video columns

// Change the columns for the edit CPT screen
function favethemes_gallery_change_columns( $cols ) {
	$cols = array(
			"cb" => '<input type="checkbox" />',
			"title" => __( "Gallery Title", "magzilla" ),
			"gallery_category" => __( "Category", "magzilla" ),
			"video_image" => __( "Picture", "magzilla" ),
			"date" => __( "Last Updated", "magzilla" ),
		);
	return $cols;
}
add_filter( "manage_gallery_posts_columns", "favethemes_gallery_change_columns" );

function favethemes_gallery_custom_columns( $column, $post_id ) {
	global $ft_option;
	
	switch ( $column ) {
		case "gallery_category":
			$video_category = wp_get_post_terms($post_id, 'gallery-categories', array("fields" => "all"));
			$array_category = array();
			foreach($video_category as $cat):
				$term_link = get_term_link( $cat, 'gallery-categories' );
				$array_category[] = '<a href="'.esc_url( $term_link ).'">'.$cat->name.'</a>';
			endforeach;
			$res_category = implode(", ",$array_category);
			echo $res_category;
		break;
		case "gallery_image":
			the_post_thumbnail(array( 150,150));
		break;
		
	}
}
add_action( "manage_posts_custom_column", "favethemes_gallery_custom_columns", 10, 2 );

// end Video columns



/*===========================================
  Filters  
==============================================*/

// Categories
function favethemes_restrict_gallery_by_category() {
	global $typenow;
	$post_type = 'gallery'; 
	$taxonomy = 'gallery-categories'; 
	if ($typenow == $post_type) {
		$selected = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
		$info_taxonomy = get_taxonomy($taxonomy);
		wp_dropdown_categories(array(
			'show_option_all' => __("All Categories", 'magzilla'),
			'taxonomy' => $taxonomy,
			'name' => $taxonomy,
			'orderby' => 'name',
			'selected' => $selected,
			'show_count' => true,
			'hide_empty' => true,
		));
	};
}
add_action('restrict_manage_posts', 'favethemes_restrict_gallery_by_category');

function favethemes_convert_gallery_id_to_term_in_query($query) {
	global $pagenow;
	$post_type = 'gallery'; 
	$taxonomy = 'gallery-categories'; 
	$q_vars = &$query->query_vars;
	if ($pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0) {
		$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		$q_vars[$taxonomy] = $term->slug;
	}
}
add_filter('parse_query', 'favethemes_convert_gallery_id_to_term_in_query');
?>