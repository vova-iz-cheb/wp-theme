</div>
<footer class="footer">
	<div class="container">
		<div class="row mb-3 justify-content-around">
			<div class="col-12 col-sm-auto">
				<h3 class="footer__h3">Категории:</h3>
				<ul>
				<?php wp_list_categories( array(
					'title_li' 		   => '',
					'hide_empty' 	   => true,
					'show_oprion_none' => 'Категорий нет',
					'number' 		   => 10,
				) ) ?>
				</ul>
			</div>
			<div class="col-12 col-sm-auto">
				<h3 class="footer__h3">Последние посты:</h3>
				<ul>
				<?php 
					$args = array(
						'numberposts' => 10,
						'post_status' => 'publish',
					); 

					$result = wp_get_recent_posts($args);

					foreach( $result as $p ){ 
				?>
					<li><a href="<?php echo get_permalink($p['ID']) ?>">
					<?php echo $p['post_title'] ?></a></li>    
				<?php 
					} 
				?>
				</ul>
			</div>
			<div class="col-12 col-sm-auto">
				<h3 class="footer__h3">Последние Коментарии:</h3>
				<ul>
				<?php
				$args = array(
					'number'  => 10,
					'orderby' => 'comment_date',
					'order'   => 'DESC',
					'status'  => 'approve',
					'type'    => 'comment', // только комментарии, без пингов и т.д...
				);

				if( $comments = get_comments( $args ) ){
					foreach( $comments as $comment ){
						$comm_link = get_comment_link( $comment->comment_ID ); // может быть тяжелый запрос ...
						$comm_short_txt = mb_substr( strip_tags( $comment->comment_content ), 0, 50 ) .'...';

						echo '<li>'. $comment->comment_author .': <a rel="nofollow" href="'. $comm_link .'">'. $comm_short_txt .'</a></li>';
					}
				}
				?>
				</ul>
			</div>
			<div class="col-12">
				<form action="" class="form-search" method="get" >
					<input type="text" class="form-search__input" placeholder="Search..." name="s">
					<input type="submit" class="form-search__submit" value="Search">
				</form>
			</div>
		</div>
	</div>
	<div class="footer__copy">
			<div class="container">
				<div class="row">
					<div class="col-auto my-3">&copy; 2019 Cherepkov V.P.</div>
				</div>
			</div>
		</div>
</footer>
<?php wp_footer() ?>
</body>
</html>