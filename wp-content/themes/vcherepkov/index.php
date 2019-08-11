<?php get_header() ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<article class="post">
		<h2 class="post__header"><a href="<?php the_permalink() ?>" class="post__link"><?php the_title() ?></a></h2>
		<div class="post__content"><?php the_content() ?></div>
		<footer class="post__footer">
			<span><i class="far fa-user"></i> Vladimir</span>
			<span><i class="far fa-clock"></i> <?php the_date() ?></span>
			<span><i class="far fa-folder"></i> Рубрика</span>
			<span><i class="fas fa-tag"></i> <?php the_tags() ?></span>
			<span><i class="far fa-comments"></i> Коммент</span>
		</footer>
	</article>
<?php endwhile; else : ?>
	<h3 class="post__info">К сожалению ничего не найдено.</h3>
<?php endif; ?>

<?php get_footer() ?>

