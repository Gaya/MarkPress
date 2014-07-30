<?php
get_header(); ?>

	<aside id="entries">
		<?php get_template_part('aside', 'side-bar'); ?>
	</aside>

	<div id="primary" class="site-content">
		<?php get_template_part('form', 'input-form'); ?>

		<section class="markpress-editor__preview">
			<div id="markpress-preview"></div>
		</section>
	</div><!-- #primary -->

<?php get_footer(); ?>