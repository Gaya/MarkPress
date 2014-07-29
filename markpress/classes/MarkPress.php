<?php
class MarkPress {
	private $plugin_dir = '';

	function __construct($plugin_dir) {
		$this->plugin_dir = $plugin_dir;

		$this->killTheTheme();
	}

	function killTheTheme() {
		add_filter('template_include', array($this, 'catchThemeInclude'), 99);
		add_filter('template_directory', array($this, 'catchTemplateFolder'), 99);
		add_filter('stylesheet_directory', array($this, 'catchTemplateFolder'), 99);
	}

	function catchTemplateFolder() {
		$template_dir = $this->plugin_dir . "template";

		return $template_dir;
	}

	function catchThemeInclude() {
		$template = $this->plugin_dir . "template/index.php";

		return $template;
	}
}