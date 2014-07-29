<?php
class MarkPress {
	private $plugin_dir = '';

	function __construct($plugin_dir) {
		$this->plugin_dir = $plugin_dir;

		$this->killTheTheme();
		$this->loadPageDown();
		$this->loadAssets();
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

	function loadPageDown() {
		wp_enqueue_script("PageDown", plugins_url('markpress/assets/js/Markdown.Converter.js', $this->plugin_dir), array("jquery"), 2.2, false );
	}

	function loadAssets() {
		wp_enqueue_script("MarkPress", plugins_url('markpress/assets/js/markpress.js', $this->plugin_dir), array("jquery"), 1, false );
		wp_enqueue_style("PageDown", plugins_url('markpress/assets/css/style.css', $this->plugin_dir), array(), 1);
	}

	static function assetsDir() {
		return plugins_url("/markpress/assets");
	}
}