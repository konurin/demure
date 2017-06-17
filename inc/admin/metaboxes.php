<?php 
add_filter( 'rwmb_meta_boxes', 'demure_meta_boxes' );
function demure_meta_boxes( $meta_boxes ) {
    $meta_boxes['page_options'] = array(
        'id'         => 'demure-page-metaboxes',
        'title'      => esc_html__( 'Page options', 'demure' ),
        'post_types' => 'page',
        'fields'     => array(
            array(
                'id'      => 'page_title',
                'name'    => esc_html__( 'Show title', 'demure' ),
                'type'    => 'radio',
                'options' => array(
                    'on'  => esc_html__( 'Yes', 'demure' ),
                    'off' => esc_html__( 'No', 'demure' ),
                ),
                'std' => 'on'
            ),
            array(
                'id'        => 'page_layout',
                'name'      => esc_html__( 'Page layout', 'demure' ),
                'type'      => 'image_select',
                'class'     => 'select-admin-container',
                'options'   => array(
                    '1'     => get_template_directory_uri() . '/inc/admin/img/1col.png',
                    '2'     => get_template_directory_uri() . '/inc/admin/img/2cl.png',
                    '3'     => get_template_directory_uri() . '/inc/admin/img/2cr.png',
                    '4'     => get_template_directory_uri() . '/inc/admin/img/3cm.png',
                    '5'     => get_template_directory_uri() . '/inc/admin/img/3cl.png',
                    '6'     => get_template_directory_uri() . '/inc/admin/img/3cr.png',
                ),
                'std' => 'default'
            ),
            array(
                'id'        => 'margin_top',
                'name'      => esc_html__( 'Margin top (px)', 'demure' ),
                'desc'      => esc_html__( 'Default: 30', 'demure' ),
                'type'      => 'number',
                'default'   => '30',
                'std'       => '30'
            ),
            array(
                'id'        => 'margin_bottom',
                'name'      => esc_html__( 'Margin bottom (px)', 'demure' ),
                'desc'      => esc_html__( 'Default: 30', 'demure' ),
                'type'      => 'number',
                'default'   => '30',
                'std'       => '30'
            ),
            array(
                'id'        => 'full_width',
                'name'      => esc_html__( 'Full width', 'demure' ),
                'type'    => 'radio',
                'options' => array(
                    'on'  => esc_html__( 'Yes', 'demure' ),
                    'off' => esc_html__( 'No', 'demure' ),
                ),
                'std' => 'off'
            ),
            array(
                'id'        => 'container_transparent',
                'name'      => esc_html__( 'Transparent background', 'demure' ),
                'type'      => 'checkbox',
                'default'   => 0,
                'std' => 0
            ),
            array(
                'id'        => 'no_paddings',
                'name'      => esc_html__( 'Disable paddings', 'demure' ),
                'type'      => 'checkbox',
                'default'   => 0,
                'std' => 0
            )
        ),
    );
    return $meta_boxes;
}