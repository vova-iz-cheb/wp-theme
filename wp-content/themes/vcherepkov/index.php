<?php get_header() ?>

<main class="main">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<article class="post">
		<h2 class="post__header"><a href="<?php the_permalink() ?>" class="post__link"><?php the_title() ?></a></h2>
		<div class="post__content"><?php the_content() ?></div>
		<footer class="post__footer">
			<span><i class="far fa-user"></i>
				<?php printf(
						'<a href="%s">%s</a>',
						esc_url( get_author_posts_url( get_the_author_meta('ID') ) ),
						esc_html( get_the_author() )
					) ?>
			</span>
			<span><i class="far fa-clock"></i>
				<?php printf(
						'<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_permalink() ),
						esc_attr( get_the_date( DATE_W3C ) ),
						esc_html( get_the_date() )
					) ?>
			</span>
			<?php 
				$cats_list = get_the_category_list(', ');
				if( $cats_list ) { // если есть хотя бы одна рубрика
					printf(
						'<span><i class="far fa-folder"></i> %s</span>',
						$cats_list
					);
				}

				$tags_list = get_the_tag_list('', ', ');
				if( $tags_list ) { // если есть хотя бы один тэг
					printf(
						'<span><i class="fas fa-tag"></i> %1$s</span>',
						$tags_list
					);
				}

				if( ! is_singular() ) { // не единичный пост
					if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
						echo "<span><i class='far fa-comments'></i> ";

						$com_num = get_comments_number( get_the_ID() );

						if( $com_num > 20 AND $com_num % 10 == 1 ) {
							$several_comments = "%  комментарий";
						} elseif( ($com_num > 20 AND $com_num % 10 > 1 AND $com_num % 10 < 5) OR ($com_num > 1 AND $com_num < 5) ) {
							$several_comments = "%  комментария";
						} else {
							$several_comments = "%  комментариев";
						}

						comments_popup_link("Нет комментарией", "1 комментарий", $several_comments);
						echo "</span>";
					}

					// если есть права редактировать пост
					edit_post_link('Редактировать', "<span><i class='far fa-edit'></i> ", "</span>");
				}
			?>
		</footer>
	</article>
<?php endwhile; else : ?>
	<h3 class="post__info">К сожалению пост отсутствует.</h3>
<?php endif; ?>

</main>

<?php get_footer() ?>