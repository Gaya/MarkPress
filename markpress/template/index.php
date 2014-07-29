<?php
get_header(); ?>

	<aside id="entries">
		<h3>Previous entries</h3>

		<ul>
		<?php
		$entries = get_posts(array(
			'posts_per_page'   => 50,
			'orderby'          => 'post_date',
			'order'            => 'DESC'
		));
		?>

		<?php foreach ($entries as $entry) : ?>
			<li>
				<a href="<?php echo get_permalink($entry->ID); ?>"><?php echo $entry->post_title; ?></a>
			</li>
		<?php endforeach; ?>
		</ul>

	</aside>

	<div id="primary" class="site-content">
		<?php the_post(); ?>

		<section class="markpress-editor__content">
			<article class="markpress-editor__content__title">
				<input type="text" placeholder="Place title" value="<?php the_title(); ?>" />
			</article>

			<article class="markpress-editor__content__tags">
				<input type="text" placeholder="Place tags, comma separated" value="<?php
					$tags = get_tags();

					foreach ($tags as $tag) {
						echo $tag->name;

						if ($tag !== end($tags)) {
							echo ", ";
						}

					}
				?>" />
			</article>

			<textarea id="markpress-editor"><?php
				$content = get_the_content();
				echo strip_tags($content);
			?></textarea>
		</section>

		<section class="markpress-editor__preview">
			<div id="markpress-preview"></div>
		</section>
	</div><!-- #primary -->

<?php get_footer(); ?>