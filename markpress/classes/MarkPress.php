<?php
class MarkPress {
	private $plugin_dir = '';

	function __construct($plugin_dir) {
		$this->plugin_dir = $plugin_dir;

		add_filter('template_include', array($this, 'killTheme'), 99);
	}

	function killTheme($template) {
		$template = $this->plugin_dir . "/template/yo.php";

		return $template;
	}
}