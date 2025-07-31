<?php
/**
 * Template Name: Full Width Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @package blogdata
 */
get_header(); ?>
<main id="content" class="fullwidth-class content">
  <div class="container">
    <!--==================== breadcrumb section ====================-->
    <?php do_action('blogdata_action_archive_page_title'); ?>
    <div class="row">
      <div class="col-lg-12">
        <div class="bs-card-box wd-back">
          <?php while ( have_posts() ) : the_post();
            if(has_post_thumbnail()) {
                echo '<figure class="post-thumbnail">';
                    the_post_thumbnail( '', array( 'class'=>'img-responsive img-fluid' ) );
                echo '</figure>';
            }
          the_content(); 
          blogdata_edit_link(); 
          // If comments are open or we have at least one comment, load up the comment template.
          if ( comments_open() || get_comments_number() ) :
            comments_template();
          endif;
          endwhile; // End of the loop. ?>
        </div>
      </div>
    </div>
  </div>
</main>
<?php get_footer();