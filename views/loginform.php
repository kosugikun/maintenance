<form name="loginform" class="login_form" action="<?php echo esc_url(site_url('wp-login.php', 'login_post')); ?>" method="post">
    <input type="text" placeholder="<?php _e('ユーザー名', 'wp-maintenance-page'); ?>" name="log" />
    <input type="password" placeholder="<?php _e('パスワード', 'wp-maintenance-page'); ?>" name="pwd" />

    <?php if (!empty($redirect)) { ?>
        <input type="hidden" name="redirect_to" value="<?php echo $redirect; ?>" />
    <?php } ?>
    <input type="submit" value="<?php _e('ログイン', 'wp-maintenance-page'); ?>" />
</form>
