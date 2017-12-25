<div class="wrap">
    <h2 class="wpmp-title"><?php echo get_admin_page_title(); ?></h2>

    <?php if (!empty($_POST)) { ?>
        <div class="updated settings-error" id="setting-error-settings_updated"> 
            <p><strong><?php _e('設定を保存しました ', 'wp-maintenance-page'); ?></strong></p>
        </div>
    <?php } ?>

    <div class="wpmp-wrapper">
        <div id="content" class="wrapper-cell">
            <div class="nav-tab-wrapper">
                <a class="nav-tab nav-tab-active" href="#general"><?php _e('一般', 'wp-maintenance-page'); ?></a>
                <a class="nav-tab" href="#design"><?php _e('設計', 'wp-maintenance-page'); ?></a>
                <a class="nav-tab" href="#modules"><?php _e('モジュール', 'wp-maintenance-page'); ?></a>
            </div>

            <div class="tabs-content">
                <div id="tab-general" class="">
                    <form method="post">
                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row"><label for="options[general][status]"><?php _e('メンテナンス', 'wp-maintenance-page'); ?></label></th>
                                    <td>	
                                        <label><input type="radio" value="1" name="options[general][status]" <?php checked($this->plugin_settings['general']['status'], 1); ?>> <?php _e('有効化', 'wp-maintenance-page'); ?></label> <br />
                                        <label><input type="radio" value="0" name="options[general][status]" <?php checked($this->plugin_settings['general']['status'], 0); ?>> <?php _e('無効化', 'wp-maintenance-page'); ?></label> 
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[general][bypass_bots]"><?php _e('検索ボットのバイパス', 'wp-maintenance-page'); ?></label></th>
                                    <td>	
                                        <select name="options[general][bypass_bots]">
                                            <option value="1" <?php selected($this->plugin_settings['general']['bypass_bots'], 1); ?>><?php _e('はい', 'wp-maintenance-page'); ?></option>
                                            <option value="0" <?php selected($this->plugin_settings['general']['bypass_bots'], 0); ?>><?php _e('いいえ', 'wp-maintenance-page'); ?></option>
                                        </select>
                                        <p class="description"><?php _e('検索ボットがメンテナンスモードをバイパスできるようにしますか？', 'wp-maintenance-page'); ?></p>
                                    </td>
                                </tr> 
                                <tr valign="top">
                                    <th scope="row"><label for="options[general][backend_role][]"><?php _e('バックエンドの役割 ', 'wp-maintenance-page'); ?></label></th>
                                    <td>	
                                        <select name="options[general][backend_role][]" multiple="multiple" class="chosen-select" data-placeholder="<?php _e('役割を選択する', 'wp-maintenance-page'); ?>">
                                            <?php
                                            foreach ($wp_roles->roles as $role => $details) {
                                                if ($role == 'administrator') {
                                                    continue;
                                                }
                                                ?>
                                                <option value="<?php echo esc_attr($role); ?>" <?php echo wpmp_multiselect((array) $this->plugin_settings['general']['backend_role'], $role); ?>><?php echo $details['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <p class="description"><?php _e('このブログのバックエンドにアクセスできるユーザーの役割は何ですか？管理者は常にアクセス権を持ちます。', 'wp-maintenance-page'); ?></p>
                                    </td>
                                </tr>    
                                <tr valign="top">
                                    <th scope="row"><label for="options[general][frontend_role][]"><?php _e('フロントエンドの役割', $this->plugin_slug); ?></label></th>
                                    <td>	
                                        <select name="options[general][frontend_role][]" multiple="multiple" class="chosen-select" data-placeholder="<?php _e('役割を選択する', 'wp-maintenance-page'); ?>">
                                            <?php
                                            foreach ($wp_roles->roles as $role => $details) {
                                                if ($role == 'administrator') {
                                                    continue;
                                                }
                                                ?>
                                                <option value="<?php echo esc_attr($role); ?>" <?php echo wpmp_multiselect((array) $this->plugin_settings['general']['frontend_role'], $role); ?>><?php echo $details['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <p class="description"><?php _e('このブログのフロントエンドにはどのユーザーの役割にアクセスできますか？管理者は常にアクセス権を持ちます。', 'wp-maintenance-page'); ?></p>
                                    </td>
                                </tr>   
                                <tr valign="top">
                                    <th scope="row"><label for="options[general][meta_robots]"><?php _e('ロボットのメタタグ', 'wp-maintenance-page'); ?></label></th>
                                    <td>	
                                        <select name="options[general][meta_robots]">
                                            <option value="1" <?php selected($this->plugin_settings['general']['meta_robots'], 1); ?>>noindex, nofollow</option>
                                            <option value="0" <?php selected($this->plugin_settings['general']['meta_robots'], 0); ?>>index, follow</option>
                                        </select>
                                        <p class="description"><?php _e('robotsメタタグを使用すると 個別のページ固有のアプローチを使用して 個々のページのインデックスを作成し 検索結果でユーザーに提供する方法を制御できます', 'wp-maintenance-page'); ?></p>
                                    </td>
                                </tr>   
                                <tr valign="top">
                                    <th scope="row"><label for="options[general][redirection]"><?php _e('リダイレクション', 'wp-maintenance-page'); ?></label></th>
                                    <td>	
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['general']['redirection'])); ?>" name="options[general][redirection]" />
                                        <p class="description"><?php _e('ログイン後にユーザー（Dashboard / Backendにアクセスできない）をURL（WordPress Dashboard URLとは異なる）にリダイレクトする場合は、URL（http：//を含む）を定義する', 'wp-maintenance-page'); ?></p>
                                    </td>
                                </tr>                                
                                <tr valign="top">
                                    <th scope="row"><label for="options[general][exclude]"><?php _e('除外', 'wp-maintenance-page'); ?></label></th>
                                    <td>	
                                        <textarea rows="7" name="options[general][exclude]" style="width: 625px;"><?php
                                            if (!empty($this->plugin_settings['general']['exclude']) && is_array($this->plugin_settings['general']['exclude'])) {
                                                echo implode("\n", stripslashes_deep($this->plugin_settings['general']['exclude']));
                                            }
                                            ?></textarea>
                                        <p class="description"><?php _e('フィード、ページ、アーカイブまたはIPをメンテナンスモードから除外します。 1行に1つのスラッグ/ IPを追加！', 'wp-maintenance-page'); ?></p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[general][notice]"><?php _e('通知', 'wp-maintenance-page'); ?></label></th>
                                    <td>	
                                        <select name="options[general][notice]">
                                            <option value="1" <?php selected($this->plugin_settings['general']['notice'], 1); ?>><?php _e('はい', 'wp-maintenance-page'); ?></option>
                                            <option value="0" <?php selected($this->plugin_settings['general']['notice'], 0); ?>><?php _e('いいえ', 'wp-maintenance-page'); ?></option>
                                        </select>
                                        <p class="description"><?php _e('メンテナンスモードが有効になっているときに通知を表示しますか？', 'wp-maintenance-page'); ?></p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[general][admin_link]"><?php _e('ダッシュボードリンク', 'wp-maintenance-page'); ?></label></th>
                                    <td>	
                                        <select name="options[general][admin_link]">
                                            <option value="1" <?php selected($this->plugin_settings['general']['admin_link'], 1); ?>><?php _e('はい', 'wp-maintenance-page'); ?></option>
                                            <option value="0" <?php selected($this->plugin_settings['general']['admin_link'], 0); ?>><?php _e('いいえ', 'wp-maintenance-page'); ?></option>
                                        </select>
                                        <p class="description"><?php _e('メンテナンスモードのページでダッシュボードへのリンクを追加しますか？', 'wp-maintenance-page'); ?></p>
                                    </td>
                                </tr>                                 
                            </tbody>
                        </table>

                        <?php wp_nonce_field('tab-general'); ?>
                        <input type="hidden" value="general" name="tab" />
                        <input type="submit" value="<?php _e('設定を保存', 'wp-maintenance-page'); ?>" class="button button-primary" name="submit" />
                         		<table class="table3" border=1>
 <th><h1>
		<?php _e('プラグイン開発支援', 'wp-maintenance-page'); ?>
	</h1>
	<p>
		<?php _e('プラグイン開発の支援をお願いします。', 'wp-maintenance-page'); ?>
	</p><a href='https://mcpenano.net/donation/'><?php _e('支援ページへいく', 'wp-maintenance-page'); ?></a></th>
</table>
                    </form>
                </div>
                <div id="tab-design" class="hidden">
                    <form method="post">
                        <h3>&raquo; <?php _e('コンテンツ', 'wp-maintenance-page'); ?></h3>

                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row"><label for="options[design][title]"><?php _e('タイトル（HTMLタグ）', 'wp-maintenance-page'); ?></label></th>
                                    <td>	
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['design']['title'])); ?>" name="options[design][title]" />
                                    </td>
                                </tr>     
                                <tr valign="top">
                                    <th scope="row"><label for="options[design][heading]"><?php _e('見出し', 'wp-maintenance-page'); ?></label></th>
                                    <td>	
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['design']['heading'])); ?>" name="options[design][heading]" />
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['design']['heading_color'])); ?>" name="options[design][heading_color]" data-default-color="<?php echo esc_attr(stripslashes($this->plugin_settings['design']['heading_color'])); ?>" class="color_picker_trigger"/>
                                    </td>
                                </tr>      
                                <tr valign="top">
                                    <th scope="row"><label for="options[design][text]"><?php _e('本文', 'wp-maintenance-page'); ?></label></th>
                                    <td>	
                                        <?php
                                        wp_editor(stripslashes($this->plugin_settings['design']['text']), 'options_design_text', array(
                                            'textarea_name' => 'options[design][text]',
                                            'textarea_rows' => 8,
                                            'editor_class' => 'large-text',
                                            'media_buttons' => false,
                                            'wpautop' => false,
                                            'default_editor' => 'tinymce',
                                            'teeny' => true
                                        ));
                                        ?>
                                        <br />
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['design']['text_color'])); ?>" data-default-color="<?php echo esc_attr(stripslashes($this->plugin_settings['design']['text_color'])); ?>" name="options[design][text_color]" class="color_picker_trigger" />
                                    </td>
                                </tr>                                 
                            </tbody>
                        </table>

                        <h3>&raquo; <?php _e('バックグラウンド', 'wp-maintenance-page'); ?></h3>

                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row"><label for="options[design][bg_type]"><?php _e('タイプを選択', 'wp-maintenance-page'); ?></label></th>
                                    <td>	
                                        <select name="options[design][bg_type]" id="design_bg_type">
                                            <option value="color" <?php selected($this->plugin_settings['design']['bg_type'], 'color'); ?>><?php _e('カスタムカラー', 'wp-maintenance-page'); ?></option>
                                            <option value="custom" <?php selected($this->plugin_settings['design']['bg_type'], 'custom'); ?>><?php _e('アップロードされた背景', 'wp-maintenance-page'); ?></option>
                                            <option value="predefined" <?php selected($this->plugin_settings['design']['bg_type'], 'predefined'); ?>><?php _e('設定済みの背景', 'wp-maintenance-page'); ?></option>
                                        </select>
                                    </td>
                                </tr>     
                                <tr valign="top" class="design_bg_types <?php echo $this->plugin_settings['design']['bg_type'] != 'color' ? 'hidden' : ''; ?>" id="show_color">
                                    <th scope="row"><label for="options[design][bg_color]"><?php _e('色を選択', 'wp-maintenance-page'); ?></label></th>
                                    <td>	
                                        <input type="text" value="<?php echo $this->plugin_settings['design']['bg_color']; ?>" data-default-color="<?php echo $this->plugin_settings['design']['bg_color']; ?>" name="options[design][bg_color]" class="color_picker_trigger"/>
                                    </td>
                                </tr>   
                                <tr valign="top" class="design_bg_types <?php echo $this->plugin_settings['design']['bg_type'] != 'custom' ? 'hidden' : ''; ?>" id="show_custom">
                                    <th scope="row"><label for="options[design][bg_custom]"><?php _e('背景をアップロード', 'wp-maintenance-page'); ?></label></th>
                                    <td>	
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['design']['bg_custom'])); ?>" name="options[design][bg_custom]" class="upload_image_url" />
                                        <input type="button" value="アップロード" class="button" id="upload_image_trigger" />
                                        <p class="description"><?php _e('背景には1920x1280ピクセルのサイズが必要です。', 'wp-maintenance-page'); ?></p>
                                    </td>
                                </tr>   
                                <tr valign="top" class="design_bg_types <?php echo $this->plugin_settings['design']['bg_type'] != 'predefined' ? 'hidden' : ''; ?>" id="show_predefined">
                                    <th scope="row">
                                        <label for="options[design][bg_predefined]"><?php _e('背景を選択', 'wp-maintenance-page'); ?></label>
                            <p class="description">
                                * <?php echo sprintf(__('', $this->plugin_slug), 'http://designmodo.com/free-photos/' . WPMP_AUTHOR_UTM); ?>
                            </p>
                            </th>
                            <td>	
                                <ul class="bg_list">
                                    <?php
                                    foreach (glob(WPMP_PATH . 'assets/images/backgrounds/*_thumb.jpg') as $filename) {
                                        $file_thumb = basename($filename);
                                        $file = str_replace('_thumb', '', $file_thumb);
                                        ?>
                                        <li class="<?php echo $this->plugin_settings['design']['bg_predefined'] == $file ? 'active' : ''; ?>">
                                            <label>
                                                <input type="radio" value="<?php echo esc_attr($file); ?>" name="options[design][bg_predefined]" <?php checked($this->plugin_settings['design']['bg_predefined'], $file); ?>>
                                                <img src="<?php echo WPMP_URL . 'assets/images/backgrounds/' . $file_thumb; ?>" width="200" height="150" />
                                            </label>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </td>
                            </tr>                                  
                            </tbody>
                        </table>                        

                        <?php wp_nonce_field('tab-design'); ?>
                        <input type="hidden" value="design" name="tab" />
                        <input type="submit" value="<?php _e('設定を保存', 'wp-maintenance-page'); ?>" class="button button-primary" name="submit">
                        		<table class="table3" border=1>
 <th><h1>
		<?php _e('プラグイン開発支援', 'wp-maintenance-page'); ?>
	</h1>
	<p>
		<?php _e('プラグイン開発の支援をお願いします。', 'wp-maintenance-page'); ?>
	</p><a href='https://mcpenano.net/donation/'><?php _e('支援ページに行く', 'wp-maintenance-page'); ?></a></th>
</table>
                    </form>
                </div>
                <div id="tab-modules" class="hidden">
                    <form method="post">
                        <h3>&raquo; <?php _e('カウントダウン', 'wp-maintenance-page'); ?></h3>

                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][countdown_status]"><?php _e('カウントダウンを表示しますか？', 'wp-maintenance-page'); ?></label></th>
                                    <td>	
                                        <select name="options[modules][countdown_status]">
                                            <option value="1" <?php selected($this->plugin_settings['modules']['countdown_status'], 1); ?>><?php _e('はい', 'wp-maintenance-page'); ?></option>
                                            <option value="0" <?php selected($this->plugin_settings['modules']['countdown_status'], 0); ?>><?php _e('いいえ', 'wp-maintenance-page'); ?></option>
                                        </select>
                                    </td>
                                </tr>   
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][countdown_start]"><?php _e('開始日', 'wp-maintenance-page'); ?></label></th>
                                    <td>	
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['modules']['countdown_start'])); ?>" name="options[modules][countdown_start]" class="countdown_start" />
                                    </td>
                                </tr>                                  
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][countdown_details]"><?php _e('カウントダウン（残り時間）', 'wp-maintenance-page'); ?></label></th>
                                    <td class="countdown_details">	
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['modules']['countdown_details']['days'])); ?>" name="options[modules][countdown_details][days]" /> <?php _e('日', $this->plugin_slug); ?>
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['modules']['countdown_details']['hours'])); ?>" name="options[modules][countdown_details][hours]" class="margin_left"/> <?php _e('時間', $this->plugin_slug); ?>
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['modules']['countdown_details']['minutes'])); ?>" name="options[modules][countdown_details][minutes]" class="margin_left" /> <?php _e('分', $this->plugin_slug); ?>
                                    </td>
                                </tr>     
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][countdown_color]"><?php _e('色', 'wp-maintenance-page'); ?></label></th>
                                    <td>
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['modules']['countdown_color'])); ?>" name="options[modules][countdown_color]" data-default-color="<?php echo esc_attr(stripslashes($this->plugin_settings['modules']['countdown_color'])); ?>" class="color_picker_trigger"/>
                                    </td>
                                </tr>                                 
                            </tbody>
                        </table>

                        <h3>&raquo; <?php _e('購読', $this->plugin_slug); ?></h3>

                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][subscribe_status]"><?php _e('購読を表示しますか？', 'wp-maintenance-page'); ?></label></th>
                                    <td>	
                                        <select name="options[modules][subscribe_status]">
                                            <option value="1" <?php selected($this->plugin_settings['modules']['subscribe_status'], 1); ?>><?php _e('はい', 'wp-maintenance-page'); ?></option>
                                            <option value="0" <?php selected($this->plugin_settings['modules']['subscribe_status'], 0); ?>><?php _e('いいえ', 'wp-maintenance-page'); ?></option>
                                        </select>
                                    </td>
                                </tr>   
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][subscribe_text]"><?php _e('テキスト', 'wp-maintenance-page'); ?></label></th>
                                    <td>	
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['modules']['subscribe_text'])); ?>" name="options[modules][subscribe_text]" />
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['modules']['subscribe_text_color'])); ?>" name="options[modules][subscribe_text_color]" data-default-color="<?php echo esc_attr(stripslashes($this->plugin_settings['modules']['subscribe_text_color'])); ?>" class="color_picker_trigger"/>
                                    </td>
                                </tr> 
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][stats]"><?php _e('統計', 'wp-maintenance-page'); ?></label></th>
                                    <td id="subscribers_wrap">	
                                        <?php
                                        $subscribers_no = wpmp_count_where('wpmp_subscribers', 'id_subscriber');
                                        echo sprintf(__('%d個の加入者があります','wp-maintenance-page' ), $subscribers_no);

                                        if ($subscribers_no > 0) {
                                            ?>
                                            <br />
                                            <a class="button button-primary" id="subscribers-export" href="javascript:void(0);"><?php _e('CSVとしてエクスポート', 'wp-maintenance-page'); ?></a>
                                            <a class="button button-secondary" id="subscribers-empty-list" href="javascript:void(0);"><?php _e('空の加入者リスト', 'wp-maintenance-page'); ?></a>
                                        <?php } ?>
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>                        

                        <h3>&raquo; <?php _e('ソーシャルネットワーク', 'wp-maintenance-page'); ?></h3>

                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][social_status]"><?php _e('ソーシャルネットワークを表示しますか？', 'wp-maintenance-page'); ?></label></th>
                                    <td>	
                                        <select name="options[modules][social_status]">
                                            <option value="1" <?php selected($this->plugin_settings['modules']['social_status'], 1); ?>><?php _e('はい', 'wp-maintenance-page'); ?></option>
                                            <option value="0" <?php selected($this->plugin_settings['modules']['social_status'], 0); ?>><?php _e('いいえ', 'wp-maintenance-page'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][social_target]"><?php _e('リンク先は？', 'wp-maintenance-page'); ?></label></th>
                                    <td>	
                                        <select name="options[modules][social_target]">
                                            <option value="1" <?php selected($this->plugin_settings['modules']['social_target'], 1); ?>><?php _e('新しいページ', 'wp-maintenance-page'); ?></option>
                                            <option value="0" <?php selected($this->plugin_settings['modules']['social_target'], 0); ?>><?php _e('同じページ', 'wp-maintenance-page'); ?></option>
                                        </select>
                                        <p class="description"><?php _e('リンクの開き方を選択します。', 'wp-maintenance-page'); ?></p>
                                    </td>
                                </tr>                                
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][social_github]">Github</label></th>
                                    <td>	
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['modules']['social_github'])); ?>" name="options[modules][social_github]" />
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][social_dribbble]">Dribbble</label></th>
                                    <td>	
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['modules']['social_dribbble'])); ?>" name="options[modules][social_dribbble]" />
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][social_twitter]">Twitter</label></th>
                                    <td>	
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['modules']['social_twitter'])); ?>" name="options[modules][social_twitter]" />
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][social_facebook]">Facebook</label></th>
                                    <td>	
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['modules']['social_facebook'])); ?>" name="options[modules][social_facebook]" />
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][social_pinterest]">Pinterest</label></th>
                                    <td>	
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['modules']['social_pinterest'])); ?>" name="options[modules][social_pinterest]" />
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][social_google+]">Google+</label></th>
                                    <td>	
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['modules']['social_google+'])); ?>" name="options[modules][social_google+]" />
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][social_linkedin]">Linkedin</label></th>
                                    <td>	
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['modules']['social_linkedin'])); ?>" name="options[modules][social_linkedin]" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>   

                        <h3>&raquo; <?php _e('Contact', $this->plugin_slug); ?></h3>

                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][contact_status]"><?php _e('連絡先を表示しますか？', 'wp-maintenance-page'); ?></label></th>
                                    <td>	
                                        <select name="options[modules][contact_status]">
                                            <option value="1" <?php selected($this->plugin_settings['modules']['contact_status'], 1); ?>><?php _e('はい', 'wp-maintenance-page'); ?></option>
                                            <option value="0" <?php selected($this->plugin_settings['modules']['contact_status'], 0); ?>><?php _e('いいえ', 'wp-maintenance-page'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][contact_email]"><?php _e('Eメールアドレス', 'wp-maintenance-page'); ?></label></th>
                                    <td>	
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['modules']['contact_email'])); ?>" name="options[modules][contact_email]" />
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][contact_effects]"><?php _e('エフェクト', 'wp-maintenance-page'); ?></label></th>
                                    <td>	
                                        <select name="options[modules][contact_effects]">
                                            <option value="move_top|move_bottom" <?php selected($this->plugin_settings['modules']['contact_effects'], 'move_top|move_bottom'); ?>><?php _e('上に移動 - 下に移動', 'wp-maintenance-page'); ?></option>
                                            <option value="zoom|zoomed" <?php selected($this->plugin_settings['modules']['contact_effects'], 'zoom|zoomed'); ?>><?php _e('ズーム - ズーム', 'wp-maintenance-page'); ?></option>
                                            <option value="fold|unfold" <?php selected($this->plugin_settings['modules']['contact_effects'], 'fold|unfold'); ?>><?php _e('折りたたみ - 展開', 'wp-maintenance-page'); ?></option>
                                        </select>
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>   

                        <h3>&raquo; <?php _e('Google Analytics', 'wp-maintenance-page'); ?></h3>

                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][ga_status]"><?php _e('Google Analyticsを使用しますか？', 'wp-maintenance-page'); ?></label></th>
                                    <td>	
                                        <select name="options[modules][ga_status]">
                                            <option value="1" <?php selected($this->plugin_settings['modules']['ga_status'], 1); ?>><?php _e('はい', 'wp-maintenance-page'); ?></option>
                                            <option value="0" <?php selected($this->plugin_settings['modules']['ga_status'], 0); ?>><?php _e('いいえ', 'wp-maintenance-page'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][ga_code]"><?php _e('トラッキングコード', 'wp-maintenance-page'); ?></label></th>
                                    <td>	
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['modules']['ga_code'])); ?>" name="options[modules][ga_code]" />
                                        <p class="description"><?php _e('使用できるフォーマット： UA-XXXXXXXX, UA-XXXXXXXX-XXXX. 例：UA-12345678-1などが有効です', 'wp-maintenance-page'); ?></p>
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>                         

                        <?php wp_nonce_field('tab-modules'); ?>
                        <input type="hidden" value="modules" name="tab" />
                        <input type="submit" value="<?php _e('設定を保存', 'wp-maintenance-page'); ?>" class="button button-primary" name="submit">
                        	<style type="text/css">
.table3 {
  border-collapse: collapse;
}
.table3 th {
  background-color: #cccccc;
}
</style>
<table class="table3" border=1>
 <th><h1>
		<?php _e('プラグイン開発支援', 'wp-maintenance-page'); ?>
	</h1>
	<p>
		<?php _e('プラグイン開発の支援をお願いします。', 'wp-maintenance-page'); ?>
	</p><a href='https://mcpenano.net/donation/'><?php _e('支援ページへいく', 'wp-maintenance-page'); ?></a></th>
</table>
                    </form>
                </div>
            </div>
        </div>

        <?php include_once('sidebar.php'); ?>
    </div>
</div>
