<?php
/*
    Plugin Name: wp-swiss Badge Widget
    Plugin URI: http://wp-swiss.com
    Description: Darstellen des wp-swiss Badge
    Author: AFB
    Version: 1.0
    Author URI: http://wp-swiss.com
 */

//
//  WPSwissBadge Class
//
class WPSwissBadge extends WP_Widget {
    //
    //  constructor
    //
    public function WPSwissBadge() {
        $widget_ops = array( 'classname' => 'widget_wpswiss_badge', 'description' => __( "wp-swiss Badge als Widget in einem Sidebar anzeigen" ));
        $this->WP_Widget( 'badge', __( 'wp-swiss Badge', 'wpswiss_badge_widget' ), $widget_ops );
    }

    //
    //  @see WP_Widget::widget
    //
    public function widget($args, $instance) {
        extract( $args );
        $id = $args['widget_id'];
        $wpswiss_url = 'http://wp-swiss.com/';
        $wpswiss_badge_img = 'http://wp-swiss.com/wp-content/uploads/2015/04/wp-swiss-badge.jpg';
		
		
	    echo $before_widget;
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
		if (!empty($title))
		echo $before_title . $title . $after_title;

        print( "\n\t<div id='inner-" . $id . "' class='wp-swiss-badge' " );
		print( ">\n" );
        print( "\t\t<!-- " . $title . " -->\n" );
        print( "\t\t<div onclick=\"location.href='" . $wpswiss_url . "';\" style='cursor: pointer;'>\n" );
		print( "\t\t\t<img alt='wp-swiss.com - Das Schweizer WordPress-Verzeichnis - Der Badge'" );
        print( "src=' " . $wpswiss_badge_img . " ' />\n" );
		print( "\t\t</div>\n" );
        print( "\t\t<!-- /" . $title . " -->\n" );
     }
    //
    //  @see WP_Widget::update
    //
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        return $instance;
    }
    //
    //  @see WP_Widget::form
    //
    public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => 'wp-swiss' ) );
        $title = esc_attr( $instance['title'] );
        print( "\t<p>\n\t\t<label for='" . $this->get_field_id("title") . "'>" ); _e( "Titel:" );
        print( "\n\t\t\t<input class='widefat' id='" . $this->get_field_id("title") . "' name='" . $this->get_field_name("title") . "' type='text' value='" . $title . "' />\n\t\t</label>\n\t\t<em>Wenn hier leer ist, steht einfach wp-swiss</em>\n\t</p>\n" );
    }
}
//
// register WPSwissBadge widget
//
add_action('widgets_init', create_function('', 'return register_widget( "WPSwissBadge" );'));
