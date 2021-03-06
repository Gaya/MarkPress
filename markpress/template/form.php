<?php the_post(); ?>

<form class="markpress-editor__content" action="" method="post">
	<input type="hidden" id="wp-note-id" name="wp-note-id" value="<?php echo get_the_ID(); ?>"/>

	<article class="markpress-editor__content__title">
		<input name="wp-note-title" id="wp-title" class="markpress-editor__content__title__input" type="text" placeholder="Place title" value="<?php echo sanitize_text_field(get_the_title()); ?>" />
	</article>

	<article class="markpress-editor__content__tags">
		<input name="wp-note-tags" id="wp-note-tags" class="markpress-editor__content__tags__input" type="text" placeholder="Place tags, comma separated" value="<?php
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

	<textarea name="wp-note-content" class="markpress-editor__content__editor" id="markpress-editor"><?php echo get_the_content(); ?></textarea>
</form>