<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Opera
 * @since Opera 1.0
 */

get_header(); ?>

<div id="maincontentcontainer">

	<div id="primary" class="site-content row" role="main">

			<div class="col grid_12_of_12">

                            <div class="main-content">
                                
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>
                                            
                                        <?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) {
						comments_template( '', true );
					}
					?>
                               <div class="previous-next-link"> 
                                <div class="previous-post-title">
                                    <span class="prev-post"> <?php $prev_post = get_previous_post(); ?><a href="<?php echo get_permalink( $prev_post->ID ); ?>">Previous Post</a></span>
                                        <?php
                                            $prev_post = get_previous_post();
                                            if (!empty( $prev_post )): ?>
                                              <a href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php echo $prev_post->post_title; ?></a>
                                            <?php endif; ?>
                                </div>
                                <div class="next-post-title">
                                    <div class="next-post-title-wrap">
                                        <span class="next-post"><?php $next_post = get_next_post(); ?> <a href="<?php echo get_permalink( $next_post->ID ); ?>">Next Post</a>
                                                <?php ?></span>
                                        <?php
                                            $next_post = get_next_post();
                                            if (!empty( $next_post )): ?>
                                            <a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo $next_post->post_title; ?></a>
                                    </div> <!-- /.next-post-title-wrap -->     
                                                <?php $nextthumbnail = get_the_post_thumbnail($next_post->ID, array(1500,300) ); 
                                             echo $nextthumbnail; ?>
                                        <?php endif; ?> 
                                 </div>
                               </div><!-- /.previous-next-link -->
				<?php endwhile; // end of the loop. ?>
                                
                            </div> <!-- /.main-content -->

			</div> <!-- /.col.grid_8_of_12 -->
			

	</div> <!-- /#primary.site-content.row -->

</div> <!-- /#maincontentcontainer -->

<?php get_footer(); ?>
