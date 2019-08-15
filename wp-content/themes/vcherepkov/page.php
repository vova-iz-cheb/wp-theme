<?php get_header() ?>
<main class="main">

<?php while ( have_posts() ) : the_post(); ?>
  <article class="post">
    <h1 class="post__header"><a href="<?php the_permalink() ?>" class="post__link"><?php the_title() ?></a>
    </h1>
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
        // если есть права редактировать пост/
        edit_post_link('Редактировать', "<span><i class='far fa-edit'></i> ", "</span>");
      ?>
    </footer>
  </article>

  <?php 
    if ( comments_open() || get_comments_number() ) {
      comments_template();
    }

  endwhile;
  ?>

</main>
<?php get_footer() ?>