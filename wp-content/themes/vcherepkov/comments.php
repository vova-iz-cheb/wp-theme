<div class="comments">
	<h2 class="comments__header">
		<?php 
		if( comments_open() ) {
			if( have_comments() ) {
				echo 'Присоединяйтесь к беседе';
			} else {
				echo 'Оставьте комментарий';
			}
		} else {
			$com_num = get_comments_number( get_the_ID() );
			if( $com_num > 20 AND $com_num % 10 == 1 ) {
				$several_comments = "комментарий";
			} elseif( ($com_num > 20 AND $com_num % 10 > 1 AND $com_num % 10 < 5) OR ($com_num > 1 AND $com_num < 5) ) {
				$several_comments = "комментария";
			} else {
				$several_comments = "комментариев";
			}

			if( '1' == $discussion->responses ) {
				echo 'Один комментарий в теме "' . get_the_title() . '"';
			} else {
				echo "$com_num $several_comments в теме \"" . get_the_title() . '"';
			}
		}
		?>
	</h2>
	<?php if ( have_comments() ) { ?>
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