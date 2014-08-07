<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package Opera
 * @since Opera 1.0
 */
?>
 <?php if (get_the_post_thumbnail() && !is_search() ) { ?>
 <div class="post-image">
                <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( the_title_attribute( 'echo=0' ) ) ); ?>">
                        <?php the_post_thumbnail( 'post_feature_full_width' ); ?>
                </a>
 </div>
<?php } ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
            
            
       <div class="post-content-wrap clearfix">
          
               <div class="post-content col grid_12_of_12">
          
            <header class="entry-header clearfix">
              
                <div class="post-title">
                    
                     <p class="post-date">
                            <span><?php the_time(esc_html('j M, Y','opera')); ?></span>
                        </p>
                    <?php if ( is_single() ) { ?>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php }
			else { ?>
                        <h2 class="entry-title">
                                <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>" rel="bookmark"><?php echo the_title(); ?></a>
                        </h2>
                        <?php } ?>
                              
                </div>
            
            </header> <!-- /.entry-header -->
		 
	
		<?php if ( is_search() || is_home() || is_archive()) { // Only display Excerpts for Search ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div> <!-- /.entry-summary -->
		<?php }
		else { ?>
			<div class="entry-content">
				<?php the_content(); ?>
				
                                <?php wp_link_pages(); ?>
			</div> <!-- /.entry-content -->
		<?php } ?>

		<footer class="entry-meta">
			<?php if ( is_singular() ) {
				// Only show the tags on the Single Post page
				opera_entry_meta();
			} ?>
			
			<?php if ( is_singular() && get_the_author_meta( 'description' )) {
				// If a user has filled out their description and this is a multi-author blog, show their bio
				get_template_part( 'author-bio' );
			} ?>
		</footer> <!-- /.entry-meta -->
        </div><!-- /.post-content -->
        
       </div><!-- /.post-content-wrap-->
	</article> <!-- /#post -->
