<?php the_post(); ?>

<form class="markpress-editor__content" action="" method="post">
	<input type="hidden" name="wp-note-id" value="<?php echo get_the_ID(); ?>"/>

	<article class="markpress-editor__content__title">
		<input name="wp-note-title" type="text" placeholder="Place title" value="<?php echo sanitize_text_field(get_the_title()); ?>" />
	</article>

	<article class="markpress-editor__content__tags">
		<input name="wp-note-tags" type="text" placeholder="Place tags, comma separated" value="<?php
		$tags = wp_get_post_tags(get_the_ID());

		foreach ($tags as $tag) {
			echo $tag->name;

			if ($tag !== end($tags)) {
				echo ", ";
			}

		}
		?>" />
	</article>

	<input name="wp-note-submit" class="markpress-editor__content__save" type="submit" value="save" />

	<textarea name="wp-note-content" id="markpress-editor"><?php echo get_the_content(); ?></textarea>
</form>