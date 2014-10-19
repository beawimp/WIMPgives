<div id="comments-list">
	<?php

	if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
		die( 'Please do not load this page directly. Thanks!' );
	}

	if ( post_password_required() ) {
		?>
		This post is password protected. Enter the password to view comments.
		<?php
		return;
	}
	?>

	<?php if (have_comments()) : ?>

	<h2 id="comments"><?php comments_number( 'No Responses', 'One Response', '% Responses' ); ?></h2>

	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link(); ?></div>
		<div class="prev-posts"><?php next_comments_link(); ?></div>
	</div>

	<ol class="commentlist">
		<?php wp_list_comments( 'callback=fw_list_comments' ); ?>
	</ol>

	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link(); ?></div>
		<div class="prev-posts"><?php next_comments_link(); ?></div>
	</div>
</div><!--[END #comments-list]-->
<hr />
<?php else : // this is displayed if there are no comments so far {?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	<?php else : // comments are closed {?>
		<p>Comments are closed.</p>

		<?php } endif; ?>
	</div><!--[END #comments-list]-->
	<?php }
endif; ?>


<?php if ( comments_open() ) : ?>

	<div id="respond">
		<h2><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h2>

		<div class="cancel-comment-reply">
			<?php cancel_comment_reply_link(); ?>
		</div>
		<?php if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ) : ?>
			<p>You must be
				<a href="<?php echo esc_url( wp_login_url( get_permalink() ) ); ?>">logged in</a> to post a comment.
			</p>
		<?php else : ?>

			<form action="<?php echo esc_url( home_url( '/' ) . '/wp-comments-post.php' ); ?>" method="post" id="commentform">

				<?php if ( is_user_logged_in() ) : ?>

					<p>Logged in as
						<a href="<?php echo esc_url( home_url( '/' ) . '/wp-admin/profile.php' ); ?>"><?php echo esc_html( $user_identity ); ?></a>.
						<a href="<?php echo esc_url( wp_logout_url( get_permalink() ) ); ?>" title="Log out of this account">Log out &raquo;</a>
					</p>

				<?php else : ?>

					<div>
						<label for="author">Name <?php if ( $req ) {
								echo "(required)";
							} ?></label>
						<input type="text" name="author" id="author" value="<?php echo esc_attr( $comment_author ); ?>" placeholder="Name" size="22" tabindex="1" <?php if ( $req ) {
							echo "aria-required='true'";
						} ?> />
					</div>

					<div>
						<label for="email">Email (will not be published) <?php if ( $req ) {
								echo "(required)";
							} ?></label>
						<input type="text" name="email" id="email" value="<?php echo esc_attr( sanitize_email( $comment_author_email ) ); ?>" placeholder="Email" size="22" tabindex="2" <?php if ( $req ) {
							echo "aria-required='true'";
						} ?> />
					</div>

					<div>
						<label for="url">Website</label>
						<input type="text" name="url" id="url" value="<?php echo esc_attr( esc_url( $comment_author_url ) ); ?>" placeholder="Website" size="22" tabindex="3" />
					</div>

				<?php endif; ?>

				<div>
					<textarea name="comment" id="comment" cols="58" rows="10" tabindex="4" paceholder="Comments"></textarea>
				</div>

				<div>
					<input name="submit" type="submit" id="submit" class="button" tabindex="5" value="Submit Comment" />
					<?php comment_id_fields(); ?>
				</div>

				<?php do_action( 'comment_form', $post->ID ); ?>

			</form>

		<?php endif; // If registration required and not logged in ?>

	</div>

<?php endif; ?>