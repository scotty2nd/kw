<?php
/*
	==========================================
	 Include scripts
	==========================================
*/
function awesome_script_enqueue() {
	//css
	wp_enqueue_style('css', get_template_directory_uri() . '/css/main.min.css', array(), '1.0.0', 'all');
	//js
	wp_enqueue_script('jquery');
    wp_enqueue_script('slick', get_template_directory_uri() . '/js/vendor/slick.min.js', array(), '1.8.1', true);
    wp_enqueue_script('magnific-popup', get_template_directory_uri() . '/js/vendor/jquery.magnific-popup.min.js', array(), '1.1.0', true);
	wp_enqueue_script('js', get_template_directory_uri() . '/js/main.min.js', array(), '1.0.0', true);
}

add_action( 'wp_enqueue_scripts', 'awesome_script_enqueue');

/*
	==========================================
	 Activate menus
	==========================================
*/
function kw_theme_setup() {
	add_theme_support('menus');

	register_nav_menu('primary', 'Primary Header Navigation');
	register_nav_menu('secondary', 'Footer Navigation');
}

add_action('init', 'kw_theme_setup');

/*
	==========================================
	 Theme support function
	==========================================
*/
add_theme_support('post-thumbnails');
add_theme_support('post-formats',array('aside','image','video'));

/*
	==========================================
	 Portfolio function
	==========================================
*/

function kw_custom_post_type (){

	$labels = array(
		'name' => utf8_encode('Produkte'),
		'singular_name' => 'Produkt',
		'add_new' => 'Neu erstellen',
		'all_items' => 'Alle Produkte',
		'add_new_item' => 'Neues Produkt erstellen',
		'edit_item' => 'Produkt bearbeiten',
		'new_item' => 'Neues Produkt',
		'view_item' => 'Zeige Produkt',
		'search_item' => 'Produkte durchsuchen',
		'not_found' => 'Keine Produkte gefunden',
		'not_found_in_trash' => 'Keine Produkte im Papierkorb gefunden',
		'parent_item_colon' => 'Parent Item'
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => false,
		'publicly_queryable' => false,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array(
			'title',
			'revisions',
			'custom-fields'
		),
		'menu_position' => 4,
        'menu_icon' => 'dashicons-smiley',
		'exclude_from_search' => false
	);
	register_post_type('produkte', $args);
}
add_action('init', 'kw_custom_post_type');

/*
	==========================================
	 Custom Taxonomy
	==========================================
*/
function kw_custom_taxonomies(){
    $labels = array(
        'name' => 'Kollektionen',
        'singular_name' => 'Kollektion',
        'seach_items' => 'Kollektionen durchsuchen',
        'all_items' => 'Alle Kollektionen',
        'parent_item' => '&Uuml;bergeordnete Kollektion',
        'parent_item_colon' => 'Hauptkollektion',
        'edit_item' => 'Kollektion bearbeiten',
        'update_item' => 'Kollektion aktualisieren',
        'add_new_item' => 'Kollektion hinzuf&uuml;gen',
        'new_item' => 'Neue Kollektion',
        'new_item_name' => 'Neue Kollektion anlegen',
        'menu_name' => 'Kollektionen',
        'not_found' => 'Keine Kollektionen gefunden',
        'add_new' => 'Neue Kollektion erstellen'
    );

    $args = array(
        'hierarchical' => false,
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'sort' => true,
        'rewrite' => array('slug' => 'kollektion')
    );

    register_taxonomy('kollektion', array('produkte'), $args);
}

add_action('init', 'kw_custom_taxonomies');

/*
	==========================================
	 Custom Admin Styles
	==========================================
*/

function kw_admin_style() {
    wp_enqueue_style('admin-styles', get_template_directory_uri().'/style-admin.css');
}

add_action('admin_enqueue_scripts', 'kw_admin_style');


/*
	==========================================
	 Custom Term function
	==========================================
*/

function kw_get_terms($postID, $term, $onlyname){

	$terms_list = wp_get_post_terms($postID, $term);
	$output = '';

	$i = 0;

	if($onlyname != ""){

		foreach( $terms_list as $term ){
			$i++;

			if( $i > 1){ $output .= ', '; }

			$output .= $term->name;
		}

	}else {

		foreach( $terms_list as $term ){
			$i++;

			if( $i > 1){ $output .= ', '; }

			$output .= '<a href="' . get_term_link( $term ) . '">' . $term->name . '</a>';
		}

	}

	return $output;
}

/*
	==========================================
	 Remove Post Menu Item in Backend
	==========================================
*/

function post_remove () {
   remove_menu_page('edit.php');
}
add_action('admin_menu', 'post_remove');

/*
	==========================================
	 Remove Dashboard Menu Item in Backend
	==========================================
*/

function dashboard_remove () {
    remove_menu_page('index.php');
}
add_action('admin_menu', 'dashboard_remove');

/*
	==========================================
	 Remove Comments Menu Item in Backend
	==========================================
*/

function comments_remove () {
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'comments_remove');

// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});

// Remove comments from top admin bar
function my_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'my_admin_bar_render' );

add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;

    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});


//Also remove the new post and other links from the adminbar
function remove_wp_nodes() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_node( 'new-post' );
    $wp_admin_bar->remove_node( 'new-link' );
    $wp_admin_bar->remove_node( 'new-media' );
}
add_action( 'admin_bar_menu', 'remove_wp_nodes', 999 );

/*
	==========================================
	 Redirect after Login
	==========================================
*/

function admin_default_page() {
    return 'wp-admin/edit.php?post_type=produkte';
}

add_filter('login_redirect', 'admin_default_page');

/*
	==========================================
	 Disable REST Api
	==========================================
*/
/*
add_filter( 'rest_authentication_errors', function( $result ) {
    if ( ! empty( $result ) ) {
        return $result;
    }

    if ( true === true ) {
        return new WP_Error( 'json_disabled', 'The JSON Api is disabled', array( 'status' => 401 ) );
    }
    return $result;
});*/

/*
	==========================================
	 Remove Editor on Startpage
	==========================================
*/

function remove_editor() {
    if (isset($_GET['post'])) {
        $id = $_GET['post'];
        $template = get_post_meta($id, '_wp_page_template', true);
        switch ($template) {
            case 'home.php':
                remove_post_type_support('page', 'editor');
                break;
            default :
                break;
        }
    }
}
add_action('init', 'remove_editor');