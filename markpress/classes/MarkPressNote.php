<?php
class MarkPressNote {
	public $id;
	private $title;
	private $content;
	private $tags;

	function savePost() {
		$post = array(
			'post_title' => $this->title,
			'post_content' => $this->content,
			'post_status' => "publish",
			'tags_input' => $this->tags,
			'post_type' => "mp-note"
		);

		if (is_numeric($this->id)) {
			$post['ID'] = $this->id;
		}

		return wp_insert_post( $post );
	}

	function setTitle($title) {
		$this->title = sanitize_text_field($title);
	}

	function setTags($tags) {
		$this->tags = sanitize_text_field($tags);
	}

	function setContent($content) {
		$this->content = sanitize_post_field('post_content', $content, $this->id, 'db');
	}
}