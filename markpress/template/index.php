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

		<textarea id="markpress-editor"><?php
			the_post();

			$content = get_the_content();
			echo strip_tags($content);
			?></textarea>
		<div id="markpress-preview"></div>

	</div><!-- #primary -->

<?php get_footer(); ?>