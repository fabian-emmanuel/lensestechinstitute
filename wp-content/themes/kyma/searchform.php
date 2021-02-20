<div class="search_block">
    <form action="<?php echo esc_url(home_url('/')); ?>" autocomplete="off" role="search" method="get"
          class="widget_search">
        <input type="search" value="<?php echo get_search_query(); ?>" placeholder="<?php _e('Start Searching...', 'kyma'); ?>" name="s"
               class="serch_input">
        <button class="search_btn" type="submit">
            <i class="fa fa-search"></i>
        </button>
        <div class="clear"></div>
    </form>
</div>