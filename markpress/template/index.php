<?php get_header(); ?>

	<section class="markpress-container">
		<section class="markpress-actions">
			<button class="markpress-actions__button--entries">notes</button>
			<button class="markpress-actions__button--new">+</button>
			<button class="markpress-actions__button--mode" data-text-off="edit mode" data-text-on="view mode">view mode</button>
			<button class="markpress-actions__button--save">save</button>
		</section>

		<aside class="markpress-entries">
			<?php get_template_part('aside', 'side-bar'); ?>
		</aside>

		<div class="markpress-primary">
			<?php get_template_part('form', 'input-form'); ?>

			<section class="markpress-editor__preview">
				<div class="markpress-editor__preview__container"></div>
			</section>
		</div>
	</section>
<?php get_footer(); ?>