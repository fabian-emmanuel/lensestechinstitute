<section class="pt-4 pb-1 author-section">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <div class="author">
            <div class="title-holder text-center other-title">
                <h3><span><?php echo esc_html(get_theme_mod('voice_blog_single_page_author_title',__('Author','isha'))); ?></span></h3>
            </div>
            <div class="media">
                <?php if (absint(get_theme_mod('isha_single_page_post_taxonomy_Avatar','1'))==1) : ?>
                <div class="img-holder mr-1">
                <?php echo get_avatar( get_the_author_meta('ID'), 100); ?>
                </div>
                <?php endif ; ?>
                <div class="media-body">
                    <header class="entry-header">
                        <div class="title-share">
                            <div class= "font-italic float-left">
                                <?php isha_posted_by(); ?> 
                            </div>
                            
                            <?php if (absint(get_theme_mod('isha_single_page_post_taxonomy_Email','1'))==1) : ?>
                            <div  class="float-right font-italic">
                                <?php the_author_meta('user_email');?>
                            </div>
                            <?php endif ; ?>
                        </div>
                    </header>
                    <div class="clearfix"></div>
                    <?php if (absint(get_theme_mod('isha_single_page_post_taxonomy_Description','1'))==1) : ?>
                        <div class="author-description">
                            <?php the_author_meta('description'); ?>
                        </div>
                    <?php endif ; 
                    /* translators: 1: comment count number, 2: title. */
                    ?> <div class="font-italic">
                        <?php 
                        if (absint(get_theme_mod('isha_single_page_post_taxonomy_'.__('Total post','isha'),'1'))==1) :
                            /* translators: total number of post by author */
                            printf( __( 'Total post: %s', 'isha' ), count_user_posts( get_the_author_meta('ID') ) );
                        endif ; ?>    
                    </div>
                    
                </div>
            </div>
        </div>
    </article>
</section>