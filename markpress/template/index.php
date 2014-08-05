<?php get_header(); ?>

	<section id="markpress-container">
		<section id="actions">
			<button class="entries">entries</button>
			<button class="new">+</button>
			<button class="save">save</button>
		</section>

		<aside id="entries">
			<?php get_template_part('aside', 'side-bar'); ?>
		</aside>

		<div id="primary" class="site-content">
			<?php get_template_part('form', 'input-form'); ?>

			<section class="markpress-editor__preview">
				<div id="markpress-preview"></div>
			</section>
		</div>
	</section>
<?php get_footer(); ?>