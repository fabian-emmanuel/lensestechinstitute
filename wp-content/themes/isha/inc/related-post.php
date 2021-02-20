<section class="pb-5 related-post">
    <?php $orig_post = $post;
    $categories = get_the_category($post->ID);
    if ($categories) {
    $category_ids = array();
    foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
    $args=array(
    'category__in' => $category_ids,
    'orderby' => 'date',
    'post__not_in' => array($post->ID),
    'posts_per_page'=> 6,
    'ignore_sticky_posts'=>1
    );

    $my_query = new wp_query( $args );
    if( $my_query->have_posts() ) { ?> 
    <div >
        <div class="mb-4 text-center">
            <h3><span><?php echo esc_html(get_theme_mod('isha_related_post_title',__('More related stories','isha'))); ?></span></h3>
        </div>
       
        <div class="row related-post-scroll">
            <?php while( $my_query->have_posts() ) {
                $my_query->the_post();?>
                <div class="p-1">
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="news-head">
                        <?php   if ( has_post_thumbnail() ) {
                            the_post_thumbnail('isha-blog-thumb');
                            } else if ( ! has_post_thumbnail() ) { ?>
                                <img src = "<?php echo esc_url( get_template_directory_uri() ); ?>/inc/images/395_263.jpg " >
                            <?php } ?>
                        </div>
                        <div class="contents pt-2 pb-2">
                        <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                        </div>
                    </article>
                </div>
            <?php } 
            wp_reset_postdata(); ?>
        </div>
        
    </div>
    <?php }
    }
    $post = $orig_post;
    ?></section>