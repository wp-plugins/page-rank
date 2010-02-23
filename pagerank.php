<?php
/**
Plugin Name: PageRank
Plugin URI: http://www.statistx.com/widget/wordpress/pagerank
Description: statistX PageRank displays the Google (TM) PageRank of your WordPress blog. The widget is automatic and can be configured to display different button styles. Visit <a href="http://pr.statistx.com/pagerank-display.php" target="_blank">Free pagerank Display</a> for details.
Version: 1.0.0
Author: Yatko
Author URI: http://www.yatko.com

 * statistX PageRank Widget is free software. This version may have been modified pursuant
 * to the GNU General Public License.
 * 
 * the statistX PageRank Widget is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation.
 * 
 * statistX PageRank Widget is distributed as is, without any warranty.
 * See the GNU General Public License for more details.
 * 
 * See <http://www.gnu.org/licenses/> for the GNU General Public License.


/**
 * Add function to widgets_init to load the widget.
 * @since 1.0.0
 */
add_action( 'widgets_init', 'pagerank_load_widgets' );

/**
 * Register the PageRank_Widget widget.
 * @since 1.0.0
 */
function pagerank_load_widgets() {
	register_widget( 'PageRank_Widget' );
}

/**
 * pagerank Widget class, handles the settings, form, display, and update.
 * @since 1.0.0
 */
class pagerank_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function pagerank_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'pagerank', 'description' => __('Displays the Google (TM) PageRank of your WordPress blog.', 'pagerank') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'pagerank-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'pagerank-widget', __('PageRank Widget', 'pagerank'), $widget_ops, $control_ops );
	}

	/**
	 * Display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* The variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$pagerankSTYLE = $instance['pagerank_STYLE'];
		$pagerankAlign = $instance['pagerank_Align'];
		$pagerankBGColor = $instance['pagerank_BGColor'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		
		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

?>
<div style="text-align: <?php echo $pagerankAlign; ?>; background-color: <?php echo $pagerankBGColor; ?>;">
<a href="http://pr.statistx.com/pagerank-display.php" target="_blank"><img src="http://pr.statistx.com/pagerank-display.php?a=getCode&s=<?php echo $pagerankSTYLE; ?>" title="Free pagerank Checker" border="0px" alt="pagerank" /></a>
</div>
<?php		

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['pagerank_STYLE'] = strip_tags( $new_instance['pagerank_STYLE'] );
		$instance['pagerank_Align'] = strip_tags( $new_instance['pagerank_Align'] );
		$instance['pagerank_BGColor'] = strip_tags( $new_instance['pagerank_BGColor'] );

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 */
	function form( $instance ) {

		/* Set up default widget settings. */
		$defaults = array( 'title' => __('PageRank', 'pagerank'), 'pagerank_STYLE' => __('0', 'pagerank'), 'pagerank_Align' => __('center', 'pagerank'), 'pagerank_BGColor' => __('transparent', 'pagerank'));
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<!-- pagerank STYLE: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'pagerank_STYLE' ); ?>"><?php _e('Style:', 'Blog'); ?></label>
			<select id="<?php echo $this->get_field_id( 'pagerank_STYLE' ); ?>" name="<?php echo $this->get_field_name( 'pagerank_STYLE' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'Blog' == $instance['format'] ) echo 'selected="selected"'; ?>>Blog</option>
				<option <?php if ( 'Google' == $instance['format'] ) echo 'selected="selected"'; ?>>Google</option>
				<option <?php if ( 'Gray' == $instance['format'] ) echo 'selected="selected"'; ?>>Gray</option>
				<option <?php if ( '3D-silver' == $instance['format'] ) echo 'selected="selected"'; ?>>3D-silver</option>
				<option <?php if ( 'transparent' == $instance['format'] ) echo 'selected="selected"'; ?>>transparent</option>
				<option <?php if ( 'PR-Blue' == $instance['format'] ) echo 'selected="selected"'; ?>>PR-Blue</option>
				<option <?php if ( 'Animated' == $instance['format'] ) echo 'selected="selected"'; ?>>Animated</option>
				<option <?php if ( 'Fancy' == $instance['format'] ) echo 'selected="selected"'; ?>>Fancy</option>
				<option <?php if ( 'PR-Green' == $instance['format'] ) echo 'selected="selected"'; ?>>PR-Green</option>
				<option <?php if ( 'statistX' == $instance['format'] ) echo 'selected="selected"'; ?>>statistX</option>
				<option <?php if ( 'Blue' == $instance['format'] ) echo 'selected="selected"'; ?>>Blue</option>
				<option <?php if ( 'standard' == $instance['format'] ) echo 'selected="selected"'; ?>>standard</option>
				<option <?php if ( 'PageRank' == $instance['format'] ) echo 'selected="selected"'; ?>>PageRank</option>
				<option <?php if ( 'Minimal' == $instance['format'] ) echo 'selected="selected"'; ?>>Minimal</option>
				<option <?php if ( 'Blogger' == $instance['format'] ) echo 'selected="selected"'; ?>>Blogger</option>
				<option <?php if ( 'Cool' == $instance['format'] ) echo 'selected="selected"'; ?>>Cool</option>
				<option <?php if ( '3D-blue' == $instance['format'] ) echo 'selected="selected"'; ?>>3D-blue</option>
			</select>
		</p>
		
		<!-- Align: Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id( 'pagerank_Align' ); ?>"><?php _e('Align:', 'center'); ?></label>
			<select id="<?php echo $this->get_field_id( 'pagerank_Align' ); ?>" name="<?php echo $this->get_field_name( 'pagerank_Align' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'center' == $instance['format'] ) echo 'selected="selected"'; ?>>center</option>
				<option <?php if ( 'left' == $instance['format'] ) echo 'selected="selected"'; ?>>left</option>
				<option <?php if ( 'right' == $instance['format'] ) echo 'selected="selected"'; ?>>right</option>
			</select>
		</p>

		<!-- BG Color: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'pagerank_BGColor' ); ?>"><?php _e('BG Color:', 'transparent'); ?></label> 
			<input id="<?php echo $this->get_field_id( 'pagerank_BGColor' ); ?>" name="<?php echo $this->get_field_name( 'pagerank_BGColor' ); ?>" value="<?php echo $instance['pagerank_BGColor']; ?>" style="width:100%;" />
		</p>

	<?php
	}
}

?>