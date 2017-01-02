<?php
// Creating the widget 
class demure_popular_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of demure popular widget
        'demure_popular_widget', 

        // Widget name will appear in UI
        esc_html__('Demure Popular Widget', 'demure'), 

        // Widget description
        array( 'description' => __( 'Your site’s most recent Posts with thumbnails.', 'demure' ), ) 
        );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {
        $out = '';
        $title = apply_filters( 'widget_title', $instance['title'] );
        $orderby = $instance['orderby'];
        $order = $instance['order'];
        $numberposts = $instance['numberposts'];
        
        $posts_args = array(
            'orderby' => $orderby, 
            'order' => $order,
            'numberposts' => $numberposts,
        );
        
        $posts = get_posts( $posts_args );
        
        
        // before and after widget arguments are defined by themes
        $out .= $args['before_widget'];
        if ( ! empty( $title ) )
        $out .= $args['before_title'] . $title . $args['after_title'];

        // This is where you run the code and display the output
        if ( ! empty( $posts ) ) {
            foreach ( $posts as $key => $post ) {
                $id_ = $post->ID;
                $out .= '<a href="'.get_the_permalink( $id_ ).'" class="demure-popular-item">';
                    $out .= '<div class="image-block">';
                        
                        $attah_id = get_post_thumbnail_id( $id_ );
                        $attah_url = wp_get_attachment_image_url( $attah_id, 'demure-popular-widget-thumb' );
                        $out .= '<img data-src="holder.js/100x80" class="holder" src="'.$attah_url.'" />';
                        
                    $out .= '</div>';
                    $out .= '<div class="title-section">';
                        $out .= get_the_title( $id_ );
                    $out .= '</div>';
                $out .= '</a>';
            }
        }
        
        $out .= $args['after_widget'];
        echo $out;
    }
    		
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        } else {
            $title = esc_html__( 'Popular posts', 'demure' );
        }
        $orderby = $instance[ 'orderby' ];
        $order = $instance[ 'order' ];
        $numberposts = $instance['numberposts'];
        
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'demure' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'numberposts' ); ?>"><?php esc_html_e( 'Numberposts:', 'demure' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'numberposts' ); ?>" name="<?php echo $this->get_field_name( 'numberposts' ); ?>" type="number" value="<?php echo esc_attr( $numberposts ); ?>" />
        </p>
        <p><label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php esc_html_e( 'Order by:', 'demure' ); ?></label>
		<select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat">
			<option<?php if ( $orderby == 'none' ) echo ' selected="selected"'?> value="none"><?php esc_html_e( 'None', 'demure' ); ?></option>
			<option<?php if ( $orderby == 'ID' ) echo ' selected="selected"'?> value="ID"><?php esc_html_e( 'ID', 'demure' ); ?></option>
			<option<?php if ( $orderby == 'author' ) echo ' selected="selected"'?> value="author"><?php esc_html_e( 'Author', 'demure' ); ?></option>
			<option<?php if ( $orderby == 'title' ) echo ' selected="selected"'?> value="title"><?php esc_html_e( 'Title', 'demure' ); ?></option>
            <option<?php if ( $orderby == 'date' ) echo ' selected="selected"'?> value="date"><?php esc_html_e( 'Date', 'demure' ); ?></option>
            <option<?php if ( $orderby == 'modified' ) echo ' selected="selected"'?> value="modified"><?php esc_html_e( 'Modified', 'demure' ); ?></option>
            <option<?php if ( $orderby == 'rand' ) echo ' selected="selected"'?> value="rand"><?php esc_html_e( 'Random', 'demure' ); ?></option>
		</select>
		</p>
        <p><label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php esc_html_e( 'Order:', 'demure' ); ?></label>
		<select id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>" class="widefat">
			<option<?php if ( $order == 'DESC' ) echo ' selected="selected"'?> value="DESC"><?php esc_html_e( 'DESC', 'demure' ); ?></option>
			<option<?php if ( $order == 'ASC' ) echo ' selected="selected"'?> value="ASC"><?php esc_html_e( 'ASC', 'demure' ); ?></option>
		</select>
		</p>
        <?php 
    }
    	
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['orderby'] = $new_instance['orderby'];
        $instance['order'] = $new_instance['order'];
        $instance['numberposts'] = $new_instance['numberposts'];
        return $instance;
    }
} // Class wpb_widget ends here