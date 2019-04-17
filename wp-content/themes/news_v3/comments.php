<?php
	if ( post_password_required() ) : ?>
	<p><?php _e('输入密码以查看评论'); ?></p>
<?php return; endif; ?>
<div id="post_comment"><?php comments_number(__('没有评论'), __('1条评论'), __('%条评论')); ?><?php if ( comments_open() ) : ?><small><a href="#postcomment" title="<?php _e("发表评论"); ?>"></a></small><?php endif; ?></div>
<?php if ( $comments ) : ?>
	<ol class="comment_list">
		<?php wp_list_comments( array ('avatar_size'=>48,'type'=>'comment'));?>
	</ol>
	<div class="navigation">
        <span class="alignleft"><?php previous_comments_link('&laquo; 上一页') ?></span>
        <span class="alignright"><?php next_comments_link('下一页 &raquo;') ?></span>
    </div>
	<?php else : // If there are no comments yet ?>
<?php endif; ?>
<?php if ( comments_open() ) : ?>
	<div id="respond">
		<div id="post_comment"><div id="cancel_comment_reply"><?php cancel_comment_reply_link() ?></div><?php comment_form_title( '发表评论', '回复 %s' ); ?></div>
		<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
			<p><?php printf(__('你需要先 <a href="%s">登录</a> 才能回复'), get_option('siteurl')."/wp-login.php?redirect_to=".urlencode(get_permalink()));?></p>
		<?php else : ?>
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" name="commentform">
			<textarea name="comment" id="comment" rows="5" tabindex="4"></textarea>
			<div class="clear"></div>
			<?php if ( $user_ID ) : ?>
				<p><?php printf(__('当前登录帐号为 %s.'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>'); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('退出') ?>"><?php _e('退出 &raquo;'); ?></a></p>
			<?php else : ?>

			<p>
			<label for="author"><?php _e('昵称'); ?> <?php if ($req) _e('(required)'); ?></label>
			<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="10" tabindex="1" />
			</p>
			<p>
			<label for="email"><?php _e('邮箱');?> <?php if ($req) _e('(required)'); ?></label>
			<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="20" tabindex="2" />
			</p>
			<p>
			<label for="url"><?php _e('网址'); ?></label>
			<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="20" tabindex="3" />
			</p>
			<?php endif; ?>
			<p><input type="submit" id="submit" tabindex="5" value="<?php echo attribute_escape(__('发表')); ?>" /></p>
<div class="clear"></div>
			<?php comment_id_fields(); ?>
			<?php do_action('comment_form', $post->ID); ?>
		</form>

		<?php endif; // If registration required and not logged in ?>
		<script type="text/javascript">
			<!--//--><![CDATA[//><!--
			var commenttextarea = document.getElementById('comment');
			commenttextarea.onkeydown = function quickSubmit(e) {
			if (!e) var e = window.event;
			if (e.ctrlKey && e.keyCode == 13){
			document.getElementById('submit').click();
			}
			};
			//--><!]]>
		</script>

	</div>

	<?php else : // Comments are closed ?>
	<p><?php _e('抱歉，评论被关闭'); ?></p>
<?php endif; ?>