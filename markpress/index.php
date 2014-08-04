<?php
	/**
	 * Plugin Name: MarkPress
	 * Plugin URI: https://github.com/Gaya/MarkPress
	 * Description: Write journal notes with MarkDown.
	 * Version: 0.1.1
	 * Author: Gaya Kessler
	 * Author URI: http://gaya.ninja
	 * License: GPL2
	 */

	include "classes/MarkPress.php";

	new MarkPress(plugin_dir_path( __FILE__ ));

?>