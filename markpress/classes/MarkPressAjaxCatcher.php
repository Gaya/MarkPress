<?php

class MarkPressAjaxCatcher {
	function __construct() {
		add_action('init', array($this, 'catchRequest'));
	}

	function catchRequest() {
		if (isset($_POST["wp-note-submit"])) {
			$saved = false;
            $post_id = "";

			if (isset($_POST['wp-note-id']) && is_numeric($_POST['wp-note-id'])) {
				//let's update a post!
				$id = $_POST['wp-note-id'];
                $post_id = $id;
				$title = $_POST["wp-note-title"];
				$content = $_POST["wp-note-content"];
				$tags = $_POST["wp-note-tags"];

				$post = new MarkPressNote();
				$post->id = $id;
				$post->setTitle($title);
				$post->setTags($tags);
				$post->setContent($content);
				$post->savePost();

				$saved = true;
			} else if (isset($_POST['wp-note-id']) && strlen($_POST['wp-note-id']) == 0) {
				$title = $_POST["wp-note-title"];
				$content = $_POST["wp-note-content"];
				$tags = $_POST["wp-note-tags"];

				$post = new MarkPressNote();
				$post->setTitle($title);
				$post->setTags($tags);
				$post->setContent($content);
                $post_id = $post->savePost();

				$saved = true;
			}

			echo json_encode(array("saved" => $saved, "post_id" => $post_id));
			die();
		}
	}
}