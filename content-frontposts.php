<?php
/**
 * The template for displaying featured posts on Front Page 
 *
 * @package Opera
 * @since Opera 1.0
 */
?>

<?php
// Start a new query for displaying featured posts on Front Page

if (get_theme_mod('opera_front_featured_posts_check') && !is_paged()) {
    $featured_count = intval(get_theme_mod('opera_front_featured_posts_count'));
    $var = get_theme_mod('opera_front_featured_posts_cat');

    // if no category is selected then return 0 
    $featured_cat_id = max((int) $var, 0);

    $featured_post_args = array(
        'post_type' => 'post',
        'posts_per_page' => $featured_count,
        'cat' => $featured_cat_id,
        'post__not_in' => get_option('sticky_posts'),
    );
    $featuredposts = new WP_Query($featured_post_args);
    ?>

   
    <div id="front-featured-posts">

        <div id="featured-posts-container" class="row">

            <div id="featured-posts" class="flexslider">
                
                <ul class="slides">
                    
                <?php if ($featuredposts->have_posts()) : $i = 1; ?>

                    <?php while ($featuredposts->have_posts()) : $featuredposts->the_post(); ?>
                    
                    <li>
                        <div class="home-featured-post">

                            <div class="featured-post-content">

                                <a href="<?php the_permalink(); ?>">

                                    <?php the_post_thumbnail('post_slider_thumb'); ?>

                                </a>

                            </div> <!--end .featured-post-content -->
                          <div class="featured-header">
                            <a href="<?php the_permalink(); ?>">

                                <h3 class="home-featured-post-title"><?php the_title(); ?></h3>

                            </a>
                                
                              <?php the_excerpt(); ?>
                          </div><!-- /.featured-header -->

                        </div><!--end .home-featured-post-->
                    </li>

                        <?php $i+=1; ?>

                    <?php endwhile; ?>

                <?php else : ?>

                    <h2 class="center"><?php esc_html_e('Not Found', 'opera'); ?></h2>
                    <p class="center"><?php esc_html_e('Sorry, but you are looking for something that is not here', 'opera'); ?></p>
                    <?php get_search_form(); ?>
                <?php endif; ?>
                </ul>

            </div> <!-- /#featured-posts -->

        </div> <!-- /#featured-posts-container -->

    </div> <!-- /#front-featured-posts -->

<?php
} // end Featured post query ?>