<div id="sidebar" class="wrapper-cell">
    <div class="sidebar_box info_box">
        <h2><?php _e('Plugin Info', $this->plugin_slug); ?></h2>
        <div class="inside">
			<?php $plugin_data = wpmm_plugin_info($this->plugin_slug); ?>
            <ul>
                <li><?php _e('Name', $this->plugin_slug); ?>: 
					<?php
					echo!empty($plugin_data['Name']) ? $plugin_data['Name'] : '';
					echo!empty($plugin_data['Version']) ? ' v' . $plugin_data['Version'] : '';
					?>
                </li>
                <li><?php _e('Author', $this->plugin_slug); ?>: <?php echo!empty($plugin_data['AuthorName']) ? $plugin_data['AuthorName'] : ''; ?></li>
                <li><?php _e('Website', $this->plugin_slug); ?>: <?php echo!empty($plugin_data['AuthorURI']) ? '<a href="' . $plugin_data['AuthorURI'] . WPMM_AUTHOR_UTM . '" target="_blank">' . $plugin_data['AuthorName'] . '</a>' : ''; ?></li>
                <li><?php _e('Twitter', $this->plugin_slug); ?>: <?php echo!empty($plugin_data['Twitter']) ? '<a href="http://twitter.com/' . $plugin_data['Twitter'] . '" target="_blank">@' . $plugin_data['Twitter'] . '</a>' : ''; ?></li>
                <li><?php _e('GitHub', $this->plugin_slug); ?>: <?php echo!empty($plugin_data['GitHub Plugin URI']) ? '<a href="' . $plugin_data['GitHub Plugin URI'] . '" target="_blank">' . basename($plugin_data['GitHub Plugin URI']) . '</a>' : ''; ?></li>
            </ul>
        </div>
    </div>
</div>
