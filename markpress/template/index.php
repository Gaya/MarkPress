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
		<?php get_template_part('form', 'input-form'); ?>

		<section class="markpress-editor__preview">
			<div id="markpress-preview"></div>
		</section>
	</div><!-- #primary -->

<?php get_footer(); ?>