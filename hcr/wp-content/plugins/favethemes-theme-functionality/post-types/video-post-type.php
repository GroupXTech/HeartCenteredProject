<?php
/* Video Custom Post Type */
/* Register Custom Taxonomies */

//// FUNCTION TO CREATE IT
function favethemes_video_register() {  

	global $nt_option;
	
	//// LABELS
	$labels = array(
		'name' => __('Videos', 'magzilla'),
			'singular_name' => __('Video', 'magzilla'),
			'add_new' => __('Add New', 'magzilla'),
			'add_new_item' => __('Add New Video', 'magzilla'),
			'edit_item' => __('Edit Video', 'magzilla'),
			'new_item' => __('New Video', 'magzilla'),
			'all_items' => __('All Videos', 'magzilla'),
			'view_item' =>__('View Video', 'magzilla'),
			'search_items' => __('Search Videos', 'magzilla'),
			'not_found' =>  __('No Videos Found', 'magzilla'),
			'not_found_in_trash' => __('No Videos found in trash.', 'magzilla'),
			'parent_item_colon' => '',
			'menu_name' => 'Videos'
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
		register_post_type('video', $args);
}  
// Adds Custom Post Type*/
add_action('init', 'favethemes_video_register'); 

// Taxonomy Categories
function favethemes_video_categories(){
	register_taxonomy(  
	'video-categories', 'video',  
	array(  
		'hierarchical' => true,  
		'labels' => array(
			'name' => __( 'Video Categories', 'magzilla' ),
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
add_action( 'init', 'favethemes_video_categories' );

function unpress_videocategory() {
	global $post;
	global $wp_query;
	$terms_as_text = strip_tags( get_the_term_list( $wp_query->post->ID, 'video-categories', '', ', ', '' ) );
	echo $terms_as_text;
}
// Taxonomy Tags
function favethemes_video_tags(){ 
	register_taxonomy(  
	'video-tags', 'video',  
	array(  
		'hierarchical' => false,  
		'labels' => array(
			'name' => __( 'Video Tags', 'magzilla' ),
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
add_action( 'init', 'favethemes_video_tags' );


function favethemes_videotags() {
	global $post;
	global $wp_query;
	$terms_as_text = strip_tags( get_the_term_list( $wp_query->post->ID, 'video-tags', '', ', ', '' ) );
	echo $terms_as_text;
}



// start Video columns

// Change the columns for the edit CPT screen
function favethemes_video_change_columns( $cols ) {
	$cols = array(
			"cb" => '<input type="checkbox" />',
			"title" => __( "Video Title", "magzilla" ),
			"video_category" => __( "Category", "magzilla" ),
			"video_image" => __( "Picture", "magzilla" ),
			"date" => __( "Last Updated", "magzilla" ),
		);
	return $cols;
}
add_filter( "manage_video_posts_columns", "favethemes_video_change_columns" );

function favethemes_video_custom_columns( $column, $post_id ) {
	global $ft_option;
	
	switch ( $column ) {
		case "video_category":
			$video_category = wp_get_post_terms($post_id, 'video-categories', array("fields" => "all"));
			$array_category = array();
			foreach($video_category as $cat):
				$term_link = get_term_link( $cat, 'video-categories' );
				$array_category[] = '<a href="'.esc_url( $term_link ).'">'.$cat->name.'</a>';
			endforeach;
			$res_category = implode(", ",$array_category);
			echo $res_category;
		break;
		case "video_image":
			the_post_thumbnail(array( 150,150));
		break;
		
	}
}
add_action( "manage_posts_custom_column", "favethemes_video_custom_columns", 10, 2 );

// end Video columns



/*===========================================
  Filters  
==============================================*/

// Categories
function favethemes_restrict_video_by_category() {
	global $typenow;
	$post_type = 'video'; 
	$taxonomy = 'video-categories'; 
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
add_action('restrict_manage_posts', 'favethemes_restrict_video_by_category');

function favethemes_convert_video_id_to_term_in_query($query) {
	global $pagenow;
	$post_type = 'video'; 
	$taxonomy = 'video-categories'; 
	$q_vars = &$query->query_vars;
	if ($pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0) {
		$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		$q_vars[$taxonomy] = $term->slug;
	}
}
add_filter('parse_query', 'favethemes_convert_video_id_to_term_in_query');
?>