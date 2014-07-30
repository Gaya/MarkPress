<?php
class MarkPress {
	private $plugin_dir = '';

	function __construct($plugin_dir) {
		$this->plugin_dir = $plugin_dir;

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

	function catchThemeURI($dir) {
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
}