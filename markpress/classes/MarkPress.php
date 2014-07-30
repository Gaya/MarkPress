<?php
class MarkPress {
	private $plugin_dir = '';

	function __construct($plugin_dir) {
		$this->plugin_dir = $plugin_dir;

		$this->postTypeActions();

		if ( ! is_admin() ) {
			$this->killTheTheme();
			$this->loadAssets();
			$this->loginIfNotLoggedIn();
		}
	}

	function killTheTheme() {
		add_filter('template_include', array($this, 'catchThemeInclude'), 99);
		add_filter('template_directory', array($this, 'catchTemplateFolder'), 99);
		add_filter('stylesheet_directory', array($this, 'catchTemplateFolder'), 99);
		add_filter('template_directory_uri', array($this, 'catchThemeURI'), 99);
	}

	function catchTemplateFolder() {
		$template_dir = $this->plugin_dir . "template";

		return $template_dir;
	}

	function catchThemeInclude() {
		$template = $this->plugin_dir . "template/index.php";

		return $template;
	}

	function catchThemeURI() {
		return plugins_url('markpress', $this->plugin_dir);
	}

	function loadAssets() {
		wp_enqueue_script("MarkPress", plugins_url('markpress/assets/js/markpress.js', $this->plugin_dir), array(), 1, true );
		wp_enqueue_style("MarkPress", plugins_url('markpress/assets/css/style.css', $this->plugin_dir), array(), 1);
	}

	static function assetsDir() {
		return plugins_url("/markpress/assets");
	}

	function loginIfNotLoggedIn() {
		add_action('parse_request', array($this, 'redirectToLogin'), 1);
	}

	function redirectToLogin() {
		is_user_logged_in() || auth_redirect();
	}

	function postTypeActions() {
		add_action('init', array($this, 'registerNotesType'), 0);
		add_action('pre_get_posts', array($this, 'onlyMarkPressNotes'));
	}

	function registerNotesType() {
		$labels = array(
			'name'                => _x( 'MarkPress Notes', 'MarkPress Notes', 'text_domain' ),
			'singular_name'       => _x( 'MarkPress Note', 'MarkPress Note', 'text_domain' ),
			'menu_name'           => __( 'MarkPress Notes', 'text_domain' ),
			'parent_item_colon'   => __( 'MarkPress Parent Note:', 'text_domain' ),
			'all_items'           => __( 'All Notes', 'text_domain' ),
			'view_item'           => __( 'View Note', 'text_domain' ),
			'add_new_item'        => __( 'Add New Note', 'text_domain' ),
			'add_new'             => __( 'Add New', 'text_domain' ),
			'edit_item'           => __( 'Edit Note', 'text_domain' ),
			'update_item'         => __( 'Update Note', 'text_domain' ),
			'search_items'        => __( 'Search Note', 'text_domain' ),
			'not_found'           => __( 'Not found', 'text_domain' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
		);
		$args = array(
			'label'               => __( 'MarkPress Note', 'text_domain' ),
			'description'         => __( 'MarkPress note with MarkDown content', 'text_domain' ),
			'labels'              => $labels,
			'supports'            => array( ),
			'taxonomies'          => array( 'post_tag' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'rewrite'             => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		);
		register_post_type( 'mp-note', $args );
	}

	function onlyMarkPressNotes($query) {
		if (is_home() && $query->is_main_query()) {
			$query->set('post_type', array('mp-note'));
		}
		return $query;
	}
}