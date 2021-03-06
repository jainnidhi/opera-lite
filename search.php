<?php
/**
 * The template for displaying Search Results.
 *
 * @package Opera
 * @since Opera 1.0
 */

get_header(); ?>

<div id="maincontentcontainer">

	<div id="primary" class="site-content row" role="main">


		<div class="col grid_8_of_12">

                    <div class="main-content">
                        

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( esc_html_e( 'Search Results for: %s', 'opera' ), '<span>&ldquo;' . get_search_query() . '&rdquo;</span>' ); ?></h1>
				</header>

				<?php // Start the Loop ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php endwhile; ?>

				<?php opera_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results' ); // Include the template that displays a message that posts cannot be found ?>

			<?php endif; // end have_posts() check ?>
                        
                    </div> <!-- /.main-content -->

		</div> <!-- /.col.grid_8_of_12 -->
		<?php get_sidebar(); ?>

	</div> <!-- /#primary.site-content.row -->

</div> <!-- /#maincontentcontainer -->

<?php get_footer(); ?>
