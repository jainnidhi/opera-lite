<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Opera
 * @since Opera 1.0
 */
?>
<?php if(is_active_sidebar('sidebar-main')) { ?>
	<div class="sidebar-block">

		<div id="secondary" class="sidebar" role="complementary">
			<?php
			do_action( 'before_sidebar' );
                       
			if ( is_active_sidebar( 'sidebar-main' ) ) {
				dynamic_sidebar( 'sidebar-main' );
			}
			?>

		</div> <!-- /#secondary.widget-area -->

	</div> <!-- /.col.grid_4_of_12 -->
<?php } ?>
