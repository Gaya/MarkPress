<?php the_post(); ?>

<section class="markpress-editor__content">
	<article class="markpress-editor__content__title">
		<input type="text" placeholder="Place title" value="<?php the_title(); ?>" />
	</article>

	<article class="markpress-editor__content__tags">
		<input type="text" placeholder="Place tags, comma separated" value="<?php
		$tags = wp_get_post_tags(get_the_ID());

		foreach ($tags as $tag) {
			echo $tag->name;

			if ($tag !== end($tags)) {
				echo ", ";
			}

		}
		?>" />
	</article>

	<textarea id="markpress-editor"><?php $content = get_the_content(); echo strip_tags($content); ?></textarea>
</section>