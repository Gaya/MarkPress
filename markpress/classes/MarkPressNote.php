<?php
class MarkPressNote {
	public $id;
	private $title;
	private $content;
	private $tags;

	function savePost() {
		$post = array(
			'ID' => $this->id,
			'post_title' => $this->title,
			'post_content' => $this->content,
			'tags_input' => $this->tags
		);

		wp_update_post( $post );
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