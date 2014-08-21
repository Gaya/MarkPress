<?php get_header(); ?>

	<section class="markpress-container">
		<section class="markpress-actions">
			<button class="markpress-actions__button--entries">notes</button>
			<button class="markpress-actions__button--new">+</button>
			<button class="markpress-actions__button--mode" data-text-off="edit mode" data-text-on="view mode">view mode</button>
			<button class="markpress-actions__button--save">save</button>
		</section>

		<aside class="markpress-entries">
			<ul class="markpress-entries__list">
				<?php
				$entries = get_posts(array(
					'posts_per_page'   => 50,
					'orderby'          => 'post_date',
					'order'            => 'DESC',
					'post_type'        => 'mp-note'
				));
				?>

				<?php foreach ($entries as $entry) : ?>
					<li class="markpress-entries__list__item">
						<a class="markpress-entries__list__item__anchor" href="<?php echo get_permalink($entry->ID); ?>"><?php echo $entry->post_title; ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
		</aside>

		<div class="markpress-primary">
			<?php get_template_part('form', 'input-form'); ?>

			<section class="markpress-editor__preview">
				<div class="markpress-editor__preview__container"></div>
			</section>
		</div>
	</section>
<?php get_footer(); ?>