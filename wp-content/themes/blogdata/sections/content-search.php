<?php
/**
 * The template for displaying the Search Result.
 * @package Blogdata
 */
?>
<div class="col-lg-<?php echo ( !is_active_sidebar( 'sidebar-1' ) ? '12' :'8' ); ?>">
    <div id="list" <?php post_class('align_cls d-grid'); ?>>
    <?php if ( have_posts() ) : /* Start the Loop */
            while ( have_posts() ) : the_post(); ?>
            <div class="bs-blog-post list-blog">
                <?php blogdata_post_image_display_type($post); ?>
                <article class="small">
                    <?php blogdata_post_categories(); ?>
                    <h4 class="entry-title title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                        <!-- Show meta for posts and other types, hide for pages in search results -->
                        <?php if ( is_search() && get_post_type() === 'page' ) {}
                        else {
                            blogdata_post_meta();
                        } ?>
                    <p><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
                </article> 
            </div> 
        <?php endwhile; 
            blogdata_post_pagination();
            else : ?> 
        <h2><?php esc_html_e( "Nothing Found", 'blogdata' ); ?></h2>
        <div class="">
            <p>
                <?php esc_html_e( "Sorry, but nothing matched your search criteria. Please try again with some different keywords.", 'blogdata' ); ?>
            </p>
            <?php get_search_form(); ?>
        </div><!-- .blog_con_mn -->
    <?php endif; ?>
    </div>
</div>