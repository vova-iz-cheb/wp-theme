<?php get_header() ?>
<main class="main">

<?php while ( have_posts() ) : the_post(); ?>
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

        // если есть права редактировать пост
        edit_post_link('Редактировать', "<span><i class='far fa-edit'></i> ", "</span>");

      endwhile;
      ?>
    </footer>
  </article>

  <div class="posts-nav">
    <?php
      previous_post_link('<span class="posts-nav__left">%link</span>', '<i class="fas fa-arrow-circle-left"></i> %title');
      next_post_link('<span class="posts-nav__right">%link</span>', '%title <i class="fas fa-arrow-circle-right"></i>');
    ?>
  </div>

  <?php 
    if ( comments_open() || get_comments_number() ) {
      comments_template();
    }
  ?>

</main>
<?php get_footer() ?>