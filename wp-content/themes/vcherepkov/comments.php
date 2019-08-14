<?php
	$discussion = get_comments(
		array(
			'post_id' => get_the_ID(),
			'orderby' => 'comment_date_gmt',
			'order'   => get_option( 'comment_order', 'asc' ),
			'status'  => 'approve',
			'number'  => 20,
		)
	); 

	$authors = array();
	foreach ( $comments as $comment ) {
		$authors[] = ( (int) $comment->user_id > 0 ) ? (int) $comment->user_id : $comment->comment_author_email;
	}

	$authors    = array_unique( $authors );
	$discussion = (object) array(
		'authors'   => array_slice( $authors, 0, 6 ),           /* Six unique authors commenting on the post. */
		'responses' => get_comments_number( $current_post_id ), /* Number of responses. */
	);
?>

<div class="comments">
	<h2>
		<?php 
		if( comments_open() ) {
			if( have_comments() ) {
				echo 'Присоединяйтесь к беседе';
			} else {
				echo 'Оставьте комментарий';
			}
		} else {
			$com_num = (int) $discussion->responses;
			if( $com_num > 20 AND $com_num % 10 == 1 ) {
				$several_comments = "комментарий";
			} elseif( ($com_num > 20 AND $com_num % 10 > 1 AND $com_num % 10 < 5) OR ($com_num > 1 AND $com_num < 5) ) {
				$several_comments = "комментария";
			} else {
				$several_comments = "комментариев";
			}

			if( '1' == $discussion->responses ) {
				echo "Один комментарий в " . get_the_title();
			} else {
				echo "$com_num $several_comments в " . get_the_title();
			}
		}
		?>
	</h2>
	<?php if ( have_comments() && comments_open() ) { ?>
		<ol class="comment-list">
			<?php
				wp_list_comments(
					array(
						'avatar_size' => 60,
						'short_ping'  => true,
						'style'       => 'ol',
					)
				);
			?>
		</ol>
	<?php }
		if ( comments_open() ) {
			comment_form(
				array(
					'logged_in_as' => null,
					'title_reply'  => null,
				)
			);
		}
	?>
</div>