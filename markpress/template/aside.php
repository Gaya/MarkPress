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