<ul>
	<?php
	$entries = get_posts(array(
		'posts_per_page'   => 50,
		'orderby'          => 'post_date',
		'order'            => 'DESC',
		'post_type'        => 'mp-note'
	));
	?>

	<?php foreach ($entries as $entry) : ?>
		<li>
			<a href="<?php echo get_permalink($entry->ID); ?>"><?php echo $entry->post_title; ?></a>
		</li>
	<?php endforeach; ?>
</ul>