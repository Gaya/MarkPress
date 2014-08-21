<?php

class MarkPressAjaxCatcher {
	function __construct() {
		add_action('init', array($this, 'catchRequest'));
	}

	function catchRequest() {
		if (isset($_POST["mp-note-submit"])) {
			$saved = false;
            $post_id = "";

			if (isset($_POST['mp-note-id']) && is_numeric($_POST['mp-note-id'])) {
				//let's update a post!
				$id = $_POST['mp-note-id'];
                $post_id = $id;
				$title = $_POST["mp-note-title"];
				$content = $_POST["mp-note-content"];
				$tags = $_POST["mp-note-tags"];

				$post = new MarkPressNote();
				$post->id = $id;
				$post->setTitle($title);
				$post->setTags($tags);
				$post->setContent($content);
				$post->savePost();

				$saved = true;
			} else if (isset($_POST['mp-note-id']) && strlen($_POST['mp-note-id']) == 0) {
				$title = $_POST["mp-note-title"];
				$content = $_POST["mp-note-content"];
				$tags = $_POST["mp-note-tags"];

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

		if (isset($_POST["mp-action"])) {
			switch ($_POST["mp-action"]) {
				case "get_notes":
					$last_posts = get_posts(array(
						'posts_per_page'   => 50,
						'orderby'          => 'post_date',
						'order'            => 'DESC',
						'post_type'        => 'mp-note'
					));
					$resp = array();

					foreach ($last_posts as $post) {
						$tags = wp_get_post_tags($post->ID);
						$tag_str = "";

						foreach ($tags as $tag) {
							$tag_str .= $tag->name;

							if ($tag !== end($tags)) {
								$tag_str .= ", ";
							}

						}

						$data = array();
						$data["id"] = $post->ID;
						$data["title"] = $post->post_title;
						$data["content"] = $post->post_content;
						$data["tags"] = $tag_str;

						array_push($resp, $data);
					}

					echo json_encode($resp);
					die();
				break;
			}
		}
	}
}