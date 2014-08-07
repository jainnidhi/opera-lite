<?php
/**
 * The template for displaying posts in the Quote post format
 *
 * @package Opera
 * @since Opera 1.0
 */
?>
<div class="post-image">
                    <?php if (has_post_thumbnail() && !is_search() ) { ?>
                            <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( the_title_attribute( 'echo=0' ) ) ); ?>">
                                    <?php the_post_thumbnail( 'post_feature_full_width' ); ?>
                            </a>
                    <?php } ?>
            </div>
<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
     
       <div class="post-content-wrap clearfix">
        <div class="post-content">
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
	
	<div class="entry-content">
		<?php the_content(); ?>
				
                <?php wp_link_pages(); ?>
	</div> <!-- /.entry-content -->

	<footer class="entry-meta">
		<?php if ( is_singular() ) {
			// Only show the tags on the Single Post page
			opera_entry_meta();
		} ?>
		
	</footer> <!-- /.entry-meta -->
       </div><!-- /.post-content -->
   </div><!-- /.post-content-wrap-->
</article> <!-- /#post -->
