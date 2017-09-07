<?php
    /**
     * Demure Theme options
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }
    
    function removeDemoModeLink() { // Be sure to rename this function to something more unique
        if ( class_exists('ReduxFrameworkPlugin') ) {
            remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
        }
        if ( class_exists('ReduxFrameworkPlugin') ) {
            remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
        }
    }
    add_action('init', 'removeDemoModeLink');


    // This is your option name where all the Redux data is stored.
    $opt_name = "demure_config";

    // Background Patterns Reader
    $sample_patterns_path = get_template_directory_uri() . '/inc/admin/patterns/';
    $sample_patterns_url  = get_template_directory_uri() . '/inc/admin/patterns/';
    $sample_patterns      = array();
    
    $demure_img_path = get_template_directory_uri() . '/inc/theme/assets/img/';
    
    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Demure Options', 'demure' ),
        'page_title'           => esc_html__( 'Demure Options', 'demure' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
        'show_options_object'  => false,
    );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */
     
     // -> START General section
     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'General', 'demure' ),
         'id'               => 'general',
         'customizer_width' => '400px',
         'icon'             => 'el el-cogs',
         'fields'           => array(
             array(
                 'id'       => 'preloader',
                 'type'     => 'switch',
                 'title'    => esc_html__( 'Smooth transition between pages', 'demure' ),
                 'on'       => esc_html__( 'Enable', 'demure' ),
                 'off'      => esc_html__( 'Disable', 'demure' ),
                 'default'  => false
             ),
         )
     ) );
     
    // -> START Header section
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header', 'demure' ),
        'id'               => 'header',
        'customizer_width' => '400px',
        'icon'             => 'el el-hand-up',
        'fields'           => array(
            array(
                'id'                    => 'header-background',
                'type'                  => 'background',
                'title'                 => esc_html__('Header Background', 'demure'),
                'output'                => '#masthead',
                'background-image'      => false,
                'background-repeat'     => false,
                'background-attachment' => false,
                'background-position'   => false,
                'background-size'       => false,
                'transparent'           => true,
                'preview'               => false,
                'default'               => array(
                    'background-color' => '#3c5267',
                )
            ),
            array(
                'id'            => 'header-opacity',
                'type'          => 'slider',
                'title'         => esc_html__('Transparency for header items', 'demure'),
                'subtitle'      => esc_html__('Set the opacity for the text logotype and menu items', 'demure'),
                'default'       => .9,
                'min'           => 0,
                'step'          => .1,
                'max'           => 1,
                'resolution'    => 0.1,
                'display_value' => 'label'
            ),
        )
    ) );
    
    // -> START Footer section
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Footer', 'demure' ),
        'id'               => 'footer',
        'customizer_width' => '400px',
        'icon'             => 'el el-hand-down',
        'fields'           => array(
            array(
                'id'               => 'footer-text',
                'type'             => 'editor',
                'title'            => esc_html__('Footer Text', 'demure'), 
                'subtitle'         => esc_html__('Enter footer text.', 'demure'),
                'default'          => 'Powered by Vitaliy Konurin.',
                'args'   => array(
                    'teeny'            => true,
                    'textarea_rows'    => 10
                )
            ),
            array(
                'id'       => 'footer-columns',
                'type'     => 'select',
                'title'    => esc_html__( 'Footer columns', 'demure' ),
                'options'  => array(
                    '1' => esc_html__( 'One column', 'demure' ),
                    '2' => esc_html__( 'Two columns', 'demure' ),
                    '3' => esc_html__( 'Three columns', 'demure' ),
                    '4' => esc_html__( 'Four columns', 'demure' ),
                    '6' => esc_html__( 'Six columns', 'demure' ),
                ),
                'std' => '1',
                'default' => '4'
            ),
            array(
                'id'       => 'footer-background',
                'type'     => 'color',
                'title'    => esc_html__('Footer background', 'demure'), 
                'subtitle' => esc_html__('Pick a background color for footer (default: #333).', 'demure'),
                'default'  => '#333',
                'validate' => 'color',
            ),
            array(
                'id'       => 'site-info-background',
                'type'     => 'color',
                'title'    => esc_html__('Site info background', 'demure'), 
                'subtitle' => esc_html__('Pick a background color for site info background (default: #222).', 'demure'),
                'default'  => '#222',
                'validate' => 'color',
            ),
            array(
                'id'       => 'site-info-color',
                'type'     => 'color',
                'title'    => esc_html__('Site info text color', 'demure'), 
                'subtitle' => esc_html__('Pick a background color for site info text (default: #fff).', 'demure'),
                'default'  => '#fff',
                'validate' => 'color',
                'transparent' => false
            ),
        )
    ) );
    
    // -> START Social section
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Social', 'demure' ),
        'id'               => 'social',
        'customizer_width' => '400px',
        'icon'             => 'el el-bullhorn',
        'fields'           => array(
            array(
                'id'       => 'social-links-color',
                'type'     => 'link_color',
                'output'   => '.social-links-wrapper .demure-icon i',
                'title'    => esc_html__('Social Links Color', 'demure'), 
                'subtitle' => esc_html__('Pick a social links color for the theme (default: #fff).', 'demure'),
                'active'   => false,
                'default'  => array(
                    'regular'  => '#fff',
                    'hover' => '#aaaaaa'
                )
            ),
            array(
                'id'       => 'facebook',
                'type'     => 'text',
                'title'    => esc_html__( 'Facebook', 'demure' ),
            ),
            array(
                'id'       => 'twitter',
                'type'     => 'text',
                'title'    => esc_html__( 'Twitter', 'demure' ),
            ),
            array(
                'id'       => 'vkontakte',
                'type'     => 'text',
                'title'    => esc_html__( 'Vkontakte', 'demure' ),
            ),
            array(
                'id'       => 'linkedin',
                'type'     => 'text',
                'title'    => esc_html__( 'LinkedIn', 'demure' ),
            ),
            array(
                'id'       => 'pinterest',
                'type'     => 'text',
                'title'    => esc_html__( 'Pinterest', 'demure' ),
            ),
            array(
                'id'       => 'youtube',
                'type'     => 'text',
                'title'    => esc_html__( 'YouTube', 'demure' ),
            ),
            array(
                'id'       => 'instagram',
                'type'     => 'text',
                'title'    => esc_html__( 'Instagram', 'demure' ),
            ),
            array(
                'id'       => 'googleplus',
                'type'     => 'text',
                'title'    => esc_html__( 'Google+', 'demure' ),
            ),
            array(
                'id'       => 'behance',
                'type'     => 'text',
                'title'    => esc_html__( 'Behance', 'demure' ),
            ),
            array(
                'id'       => 'flickr',
                'type'     => 'text',
                'title'    => esc_html__( 'Flickr', 'demure' ),
            ),
            array(
                'id'       => 'skype',
                'type'     => 'text',
                'title'    => esc_html__( 'Skype', 'demure' ),
            ),
            array(
                'id'       => 'email',
                'type'     => 'text',
                'title'    => esc_html__( 'E-mail', 'demure' ),
            ),
            array(
                'id'       => 'dribble',
                'type'     => 'text',
                'title'    => esc_html__( 'Dribbble', 'demure' ),
            ),
            
        )
    ) );

    // -> START Menu section
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Menu', 'demure' ),
        'id'               => 'header-menu',
        'customizer_width' => '400px',
        'icon'             => 'el el-lines',
        'fields'           => array(
             array(
                'id'                => 'menu-typography',
                'type'              => 'typography', 
                'title'             => esc_html__('Font style for main menu', 'demure'),
                'google'            => true, 
                'subsets'           => false,
                'font-backup'       => false,
                'line-height'       => false, 
                'text-align'        => false,
                'color'             => false,
                'text-transform'    => true,
                'output'            => array('.main-navigation ul > li > a'),
                'units'             =>'em',
                'subsets'           => true,
                'default'           => array(
                                        'font-weight'  => '600', 
                                        'font-family' => 'Open Sans', 
                                        'google'      => true,
                                        'font-size'   => '0.95em',
                                        'text-transform' => 'uppercase',
                                    ),
                'preview' => array('text' => 'Menu item')             
            ),
            array(
                'id'       => 'menu_item_link',
                'type'     => 'link_color',
                'title'    => esc_html__('Font color for menu', 'demure'),
                'active'   => false,
                'output'   => array('.main-navigation ul:first-child > li > a'),
                'default'  => array(
                    'regular'  => '#fff',
                    'hover' => '#fff'
                )
            ),
            array(
                'id'       => 'submenu_menu_item_link',
                'type'     => 'link_color',
                'title'    => esc_html__('Font color for submenu items', 'demure'),
                'active'   => false,
                'output'   => array('.main-navigation ul:not(:first-child) > li a'),
                'default'  => array(
                    'regular'  => '#fff',
                    'hover' => '#fff'
                )
            ),
            array(
                'id'                    => 'main-menu-background',
                'type'                  => 'background',
                'title'                 => esc_html__('Menu background', 'demure'),
                'output'                => '#masthead .menu-right-block',
                'background-image'      => false,
                'background-repeat'     => false,
                'background-attachment' => false,
                'background-position'   => false,
                'background-size'       => false,
                'transparent'           => true,
                'preview'               => false,
                'default'               => array(
                    'background-color' => '#333333',
                )
            ),
            array(
                'id'                    => 'main-menu-sub-item-background',
                'type'                  => 'background',
                'title'                 => esc_html__('Menu sub item background', 'demure'),
                'output'                => '.main-navigation ul.sub-menu, .main-navigation ul.children',
                'background-image'      => false,
                'background-repeat'     => false,
                'background-attachment' => false,
                'background-position'   => false,
                'background-size'       => false,
                'transparent'           => true,
                'preview'               => false,
                'default'               => array(
                    'background-color' => '#2b2b2b',
                )
            ),
            array(
                'id'                    => 'submenu-item-background',
                'type'                  => 'background',
                'title'                 => esc_html__('Menu sub item hover background', 'demure'),
                'output'                => '.main-navigation ul.sub-menu li:hover, .main-navigation ul.children li:hover',
                'background-image'      => false,
                'background-repeat'     => false,
                'background-attachment' => false,
                'background-position'   => false,
                'background-size'       => false,
                'transparent'           => true,
                'preview'               => false,
                'default'               => array(
                    'background-color' => '#328CC1',
                )
            ),
            array(
                'id'       => 'submenu-item-color',
                'type'     => 'link_color',
                'title'    => esc_html__('Font color for submenu', 'demure'),
                'active'   => false,
                'regular'  => false,
                'output'   => array('.main-navigation ul.sub-menu, .main-navigation ul.children li:hover'),
                'default'  => array(
                    'hover' => '#328CC1'
                )
            ),
            array(
                'id'       => 'sumenu-block',
                'type'     => 'dimensions',
                'units'    => array('px'),
                'height'    => false,
                'output'   => '.main-navigation ul.sub-menu, .main-navigation ul.children',
                'title'    => esc_html__('Submenu width', 'demure'),
                'subtitle' => esc_html__('Set widht for submenu block items (max width 300px)', 'demure'),
                'default'  => array(
                    'width'   => '200',
                ),
            ),
        )
    ) );
    
    // -> START Blog section
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Blog options', 'demure' ),
        'id'               => 'blog',
        'customizer_width' => '400px',
        'icon'             => 'el el-pencil',
        'fields'           => array(
            array(
                'id'       => 'post_navigation',
                'type'     => 'select',
                'title'    => esc_html__( 'Post navigation', 'demure' ),
                'options'  => array(
                    '1' => esc_html__( 'Default', 'demure' ),
                    '2' => esc_html__( 'Load More button', 'demure' ),
                    '3' => esc_html__( 'Infinite Scroll', 'demure' )
                ),
                'std' => '1',
                'default' => '1'
            ),
            array(
                'id'      => 'display_author',
                'type'    => 'checkbox',
                'title'   => esc_html__( 'Display author for posts', 'demure' ),
                'default' => '1',
                'std'     => '1'
            ),
            array(
                'id'      => 'display_date',
                'type'    => 'checkbox',
                'title'   => esc_html__( 'Display date for posts', 'demure' ),
                'default' => '1',
                'std'     => '1'
            ),
            array(
                'id'      => 'display_categories',
                'type'    => 'checkbox',
                'title'   => esc_html__( 'Display categories for posts', 'demure' ),
                'default' => '1',
                'std'     => '1'
            ),
            array(
                'id'      => 'display_tags',
                'type'    => 'checkbox',
                'title'   => esc_html__( 'Display tags for posts', 'demure' ),
                'default' => '1',
                'std'     => '1'
            ),
            array(
                'id'        => 'display-comments',
                'type'      => 'select',
                'title'     => esc_html__( 'Show comments for', 'demure' ),
                'options'  => array(
                    '1' => esc_html__( 'Hide', 'demure' ),
                    '2' => esc_html__( 'Posts', 'demure' ),
                    '3' => esc_html__( 'Pages', 'demure' ),
                    '4' => esc_html__( 'Post and Pages', 'demure' )
                ),
                'std' => '4',
                'default' => '4'
            ),
            array(         
                'id'                    => 'article-background',
                'type'                  => 'background',
                'title'                 => esc_html__( 'Post container background', 'demure' ),
                'output'                => array( '.blog article, .single-post article, .archive article' ),
                'subtitle'              => esc_html__( 'Set custom background color for post container', 'demure' ),
                'background-image'      => false,
                'background-repeat'     => false,
                'background-attachment' => false,
                'background-position'   => false,
                'background-size'       => false,
                'transparent'           => true,
                'preview'               => false,
                'default'  => array(
                    'background-color' => '#f9f9f9',
                )
            )
        )
    ) );
    
    // -> START Style section
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Style', 'demure' ),
        'id'               => 'style',
        'customizer_width' => '400px',
        'icon'             => 'el el-brush',
        'fields'           => array(
            array(
                'id'                    => 'body-background',
                'type'                  => 'background',
                'title'                 => esc_html__('Body Background', 'demure'),
                'output'                => 'body',
                'transparent'           => false,
                'default'               => array(
                    'background-color' => '#edeef0',
                )
            ),
            array(
                'id'       => 'accent_color',
                'type'     => 'link_color',
                'title'    => esc_html__('Accent color', 'demure'),
                'active'   => false,
                'default'  => array(
                    'regular'  => '#3c5267',
                    'hover' => '#328CC1'
                )
            ),
            array(
                'id'       => 'link-color',
                'type'     => 'link_color',
                'title'    => esc_html__('Links Color Option', 'demure'),
                'subtitle' => esc_html__('Only color validation can be done on this field type', 'demure'),
                'desc'     => esc_html__('This is the description field, again good for additional info.', 'demure'),
                'output'      => 'a',
                'default'  => array(
                    'regular'  => '#3c5267',
                    'hover'    => '#005f98',
                    'active'   => '#8224e3',
                    'visited'  => '#8224e3',
                )
            ),
            array(         
                'id'                    => 'sidebar-block-background',
                'type'                  => 'background',
                'title'                 => esc_html__( 'Sidebar widgets container background', 'demure' ),
                'output'                => array( '.sidebar > section' ),
                'subtitle'              => esc_html__( 'Set custom background color for widgets container', 'demure' ),
                'background-image'      => false,
                'background-repeat'     => false,
                'background-attachment' => false,
                'background-position'   => false,
                'background-size'       => false,
                'transparent'           => true,
                'preview'               => false,
                'default'  => array(
                    'background-color' => '#f9f9f9',
                )
            )
        )
    ) );

    // -> START Default pages section
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Pages layout', 'demure' ),
        'id'               => 'default_pages',
        'customizer_width' => '400px',
        'icon'             => 'el el-book',
        'fields'           => array(
            array(
                'id'       => 'main_layout',
                'type'     => 'image_select',
                'title'    => esc_html__('Main Layout', 'demure'), 
                'subtitle' => esc_html__('Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.', 'demure'),
                'options'  => array(
                    '1'      => array(
                        'alt'   => '1 Column', 
                        'img'   => ReduxFramework::$_url.'assets/img/1col.png'
                    ),
                    '2'      => array(
                        'alt'   => '2 Column Left', 
                        'img'   => ReduxFramework::$_url.'assets/img/2cl.png'
                    ),
                    '3'      => array(
                        'alt'   => '2 Column Right', 
                        'img'  => ReduxFramework::$_url.'assets/img/2cr.png'
                    ),
                    '4'      => array(
                        'alt'   => '3 Column Middle', 
                        'img'   => ReduxFramework::$_url.'assets/img/3cm.png'
                    ),
                    '5'      => array(
                        'alt'   => '3 Column Left', 
                        'img'   => ReduxFramework::$_url.'assets/img/3cl.png'
                    ),
                    '6'      => array(
                        'alt'  => '3 Column Right', 
                        'img'  => ReduxFramework::$_url.'assets/img/3cr.png'
                    )
                ),
                'default' => '3'
            ),
            array(
                'id'       => 'blog_layout',
                'type'     => 'image_select',
                'title'    => esc_html__('Blog posts layout', 'demure'), 
                'subtitle' => esc_html__('Select main content and sidebar alignment for blog posts page.', 'demure'),
                'options'  => array(
                    '1'      => array(
                        'alt'   => '1 Column', 
                        'img'   => ReduxFramework::$_url.'assets/img/1col.png'
                    ),
                    '2'      => array(
                        'alt'   => '2 Column Left', 
                        'img'   => ReduxFramework::$_url.'assets/img/2cl.png'
                    ),
                    '3'      => array(
                        'alt'   => '2 Column Right', 
                        'img'  => ReduxFramework::$_url.'assets/img/2cr.png'
                    ),
                    '4'      => array(
                        'alt'   => '3 Column Middle', 
                        'img'   => ReduxFramework::$_url.'assets/img/3cm.png'
                    ),
                    '5'      => array(
                        'alt'   => '3 Column Left', 
                        'img'   => ReduxFramework::$_url.'assets/img/3cl.png'
                    ),
                    '6'      => array(
                        'alt'  => '3 Column Right', 
                        'img'  => ReduxFramework::$_url.'assets/img/3cr.png'
                    )
                ),
                'default' => '3'
            ),
            array(
                'id'       => 'single_blog_layout',
                'type'     => 'image_select',
                'title'    => esc_html__('Single Blog Layout', 'demure'), 
                'subtitle' => esc_html__('Select main content and sidebar alignment for single blog post.', 'demure'),
                'options'  => array(
                    '1'      => array(
                        'alt'   => '1 Column', 
                        'img'   => ReduxFramework::$_url.'assets/img/1col.png'
                    ),
                    '2'      => array(
                        'alt'   => '2 Column Left', 
                        'img'   => ReduxFramework::$_url.'assets/img/2cl.png'
                    ),
                    '3'      => array(
                        'alt'   => '2 Column Right', 
                        'img'  => ReduxFramework::$_url.'assets/img/2cr.png'
                    ),
                    '4'      => array(
                        'alt'   => '3 Column Middle', 
                        'img'   => ReduxFramework::$_url.'assets/img/3cm.png'
                    ),
                    '5'      => array(
                        'alt'   => '3 Column Left', 
                        'img'   => ReduxFramework::$_url.'assets/img/3cl.png'
                    ),
                    '6'      => array(
                        'alt'  => '3 Column Right', 
                        'img'  => ReduxFramework::$_url.'assets/img/3cr.png'
                    )
                ),
                'default' => '3'
            ),
            array(         
                'id'                    => 'page-article-background',
                'type'                  => 'background',
                'title'                 => esc_html__( 'Page container background', 'demure' ),
                'output'                => array( '.page article' ),
                'subtitle'              => esc_html__( 'Set custom background color for page container', 'demure' ),
                'background-image'      => false,
                'background-repeat'     => false,
                'background-attachment' => false,
                'background-position'   => false,
                'background-size'       => false,
                'transparent'           => true,
                'preview'               => false,
                'default'  => array(
                    'background-color' => '#f9f9f9',
                )
            )
        ),
    ) );

     // -> START Slider section
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Slider', 'demure' ),
        'id'               => 'slider',
        'customizer_width' => '400px',
        'icon'             => 'el el-photo',
        'fields'           => array(
            array(
                'id'       => 'switch_slider',
                'type'     => 'switch',
                'title'    => esc_html__( 'Slider on front page', 'demure' ),
                'subtitle' => esc_html__( 'Use slider on front page', 'demure' ),
                'default'  => false
            ),
            array(
                'id'          => 'home_slider',
                'type'        => 'slides',
                'title'       => esc_html__('Slides Options', 'demure'),
                'subtitle'    => esc_html__('Unlimited slides with drag and drop sortings.', 'demure'),
                'desc'        => esc_html__('This field will store all slides values into a multidimensional array to use into a foreach loop.', 'demure'),
                'placeholder' => array(
                    'title'           => esc_html__('This is a title', 'demure'),
                    'description'     => esc_html__('Description Here', 'demure'),
                    'url'             => esc_html__('Give us a link!', 'demure'),
                ),
                'required' => array( 'switch_slider', '=', true )
            ),
            array(
                'id'          => 'slider-heading-typography',
                'type'        => 'typography', 
                'title'       => esc_html__('Font Style for heading slider', 'demure'),
                'google'      => true, 
                'subsets'     => false,
                'font-backup' => false,
                'line-height' => false, 
                'text-align'  => false, 
                'output'      => array('.homepage-slider .slide .slide-information h3'),
                'units'       =>'em',
                'subsets'       => true,
                'subtitle'    => esc_html__('Select typography for slider heading.', 'demure'),
                'default'     => array(
                                        'color'       => '#fff', 
                                        'font-weight' => '800',
                                        'font-family' => 'Open Sans', 
                                        'google'      => true,
                                        'font-size'   => '1.8'
                                ),
                'preview' => array('text' => 'Slider heading'),
                'required' => array( 'switch_slider', '=', true )             
            ),
            array(
                'id'          => 'slider-sub-heading-typography',
                'type'        => 'typography', 
                'title'       => esc_html__('Font Style for subheading slider', 'demure'),
                'google'      => true, 
                'subsets'     => false,
                'font-backup' => false,
                'line-height' => false, 
                'text-align'  => false, 
                'output'      => array('.homepage-slider .slide .slide-information .description'),
                'units'       =>'em',
                'subsets'       => true,
                'subtitle'    => esc_html__('Select typography for slider subheading.', 'demure'),
                'default'     => array(
                                        'color'       => '#fff', 
                                        'font-weight' => '400',
                                        'font-family' => 'Open Sans', 
                                        'google'      => true,
                                        'font-size'   => '1.2'
                                ),
                'preview' => array('text' => 'Slider subheading'),
                'required' => array( 'switch_slider', '=', true )        
            ),
            array(
                'id'                    => 'slider-info-background',
                'type'                  => 'background',
                'title'                 => esc_html__('Slider info background', 'demure'),
                'output'                => array('.homepage-slider .slide .slide-information, .homepage-slider .owl-buttons .owl-prev, .homepage-slider .owl-buttons .owl-next'),
                'background-image'      => false,
                'background-repeat'     => false,
                'background-attachment' => false,
                'background-position'   => false,
                'background-size'       => false,
                'transparent'           => true,
                'preview'               => false,
                'default'               => array(
                    'background-color' => '#2b2b2b',
                ),
                'required' => array( 'switch_slider', '=', true )
            ),
        )
    ) );

    // -> START Slider section
    Redux::setSection( $opt_name, array (
        'title'            => esc_html__( 'Font styles', 'demure' ),
        'id'               => 'typography',
        'customizer_width' => '400px',
        'icon'             => 'el el-fontsize',
        'fields' => array (
            array(
                'id'          => 'main-typography',
                'type'        => 'typography', 
                'title'       => esc_html__('General Text Font Style', 'demure'),
                'google'      => true, 
                'subsets'     => false,
                'font-backup' => false,
                'line-height' => false, 
                'text-align'  => false, 
                'output'      => array('body'),
                'units'       =>'em',
                'subsets'       => true,
                'subtitle'    => esc_html__('Select typography for main text.', 'demure'),
                'default'     => array(
                                        'color'       => '#333', 
                                        'font-weight'  => '400', 
                                        'font-family' => 'Open Sans', 
                                        'google'      => true,
                                        'font-size'   => '1em'
                                ),
                'preview' => array('text' => 'sample text')             
             ),
            
            array(
                'id'          => 'hone',
                'type'        => 'typography', 
                'title'       => esc_html__('H1 Font Style.', 'demure'),
                'google'      => true, 
                'subsets'     => false,
                'font-backup' => false,
                'line-height' => false, 
                'text-align'  => false, 
                'text-transform' => true,
                'output'      => array('h1'),
                'subsets'       => true,
                'units'       =>'em',
                'subtitle'    => esc_html__('Select the typography you want for header H1.', 'demure'),
                'default'     => array(
                                        'color'       => '#444', 
                                        'font-weight'  => '800', 
                                        'font-family' => 'Open Sans', 
                                        'google'      => true,
                                        'font-size'   => '1.9',
                                        'text-transform' => 'none'
                                ),
                'preview' => array('text' => 'sample text')                             
             ),
            array(
                'id'          => 'htwo',
                'type'        => 'typography', 
                'title'       => esc_html__('H2 Font Style.', 'demure'),
                'google'      => true, 
                'subsets'     => false,
                'font-backup' => false,
                'line-height' => false, 
                'text-align'  => false, 
                'text-transform' => true,
                'subsets'       => true,
                'output'      => array('h2'),
                'units'       =>'em',
                'subtitle'    => esc_html__('Select the typography you want for header H2.', 'demure'),
                'default'     => array(
                                        'color'       => '#444', 
                                        'font-weight'  => '800', 
                                        'font-family' => 'Open Sans', 
                                        'google'      => true,
                                        'font-size'   => '1.8',
                                        'text-transform' => 'none'
                                ),
                'preview' => array('text' => 'sample text'),                
             ), 
             array(
                'id'          => 'hthree',
                'type'        => 'typography', 
                'title'       => esc_html__('H3 Font Style.', 'demure'),
                'google'      => true, 
                'subsets'     => false,
                'font-backup' => false,
                'line-height' => false, 
                'text-align'  => false, 
                'text-transform' => true,
                'subsets'       => true,
                'output'      => array('h3'),
                'units'       =>'em',
                'subtitle'    => esc_html__('Select the typography you want for header H3.', 'demure'),
                'default'     => array(
                                        'color'       => '#444', 
                                        'font-weight'  => '800', 
                                        'font-family' => 'Open Sans', 
                                        'google'      => true,
                                        'font-size'   => '1.7', 
                                        'text-transform' => 'none'
                                ),
                'preview' => array('text' => 'sample text'),                
             ), 
             
             array(
                'id'          => 'hfour',
                'type'        => 'typography', 
                'title'       => esc_html__('H4 Font Style.', 'demure'),
                'google'      => true, 
                'subsets'     => false,
                'font-backup' => false,
                'line-height' => false, 
                'text-align'  => false, 
                'text-transform' => true,
                'subsets'       => true,
                'output'      => array('h4'),
                'units'       =>'em',
                'subtitle'    => esc_html__('Select the typography you want for header H4.', 'demure'),
                'default'     => array(
                                        'color'       => '#444', 
                                        'font-weight'  => '800', 
                                        'font-family' => 'Open Sans', 
                                        'google'      => true,
                                        'font-size'   => '1.6',
                                        'text-transform' => 'none'
                                ),
                'preview' => array('text' => 'sample text'),                
             ), 
             array(
                'id'          => 'hfive',
                'type'        => 'typography', 
                'title'       => esc_html__('H5 Font Style.', 'demure'),
                'google'      => true, 
                'subsets'     => false,
                'font-backup' => false,
                'line-height' => false, 
                'text-align'  => false, 
                'text-transform' => true,
                'subsets'       => true,
                'output'      => array('h5'),
                'units'       =>'em',
                'subtitle'    => esc_html__('Select the typography you want for header H5.', 'demure'),
                'default'     => array(
                                        'color'       => '#444', 
                                        'font-weight'  => '800', 
                                        'font-family' => 'Open Sans', 
                                        'google'      => true,
                                        'font-size'   => '1.5',
                                        'text-transform' => 'none'
                                ),
                'preview' => array('text' => 'sample text'),                
             ), 
             
             array(
                'id'          => 'hsix',
                'type'        => 'typography', 
                'title'       => esc_html__('H6 Font Style.', 'demure'),
                'google'      => true, 
                'subsets'     => false,
                'font-backup' => false,
                'line-height' => false, 
                'text-align'  => false, 
                'text-transform' => true,
                'subsets'       => true,
                'output'      => array('h6'),
                'units'       =>'px',
                'subtitle'    => esc_html__('Select the typography you want for header H6.', 'demure'),
                'default'     => array(
                                        'color'       => '#444', 
                                        'font-weight'  => '800', 
                                        'font-family' => 'Open Sans', 
                                        'google'      => true,
                                        'font-size'   => '1.4',
                                        'text-transform' => 'none'
                                ),
                'preview' => array('text' => 'sample text'),                
             ), 
             
             array(
                'id'          => 'p-style',
                'type'        => 'typography', 
                'title'       => esc_html__('"p" Font Style.', 'demure'),
                'google'      => true, 
                'subsets'     => false,
                'font-backup' => false,
                'line-height' => true,  
                'text-align'  => true,  
                'subsets'       => true,
                'output'      => array('p'),
                'units'       =>'em',
                'subtitle'    => esc_html__('Select the typography you want for tag "p".', 'demure'),
                'default'     => array(
                                        'color'       => '#444', 
                                        'font-weight'  => '400', 
                                        'font-family' => 'Open Sans', 
                                        'google'      => true,
                                        'font-size'   => '1',
                                        'line-height' => '1.5',
                                        'text-align'  => 'inherit'
                                        
                                ),
                'preview' => array('text' => 'sample text'),                
             ), 
             
            )
    
    ) );
    

    if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
        $section = array(
            'icon'   => 'el el-list-alt',
            'title'  => esc_html__( 'Documentation', 'demure' ),
            'fields' => array(
                array(
                    'id'       => '17',
                    'type'     => 'raw',
                    'markdown' => true,
                    'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please
                    //'content' => 'Raw content here',
                ),
            ),
        );
        Redux::setSection( $opt_name, $section );
    }
    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $field['msg']    = 'your custom error message';
                $return['error'] = $field;
            }

            if ( $warning == true ) {
                $field['msg']      = 'your custom warning message';
                $return['warning'] = $field;
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => esc_html__( 'Section via hook', 'demure' ),
                'desc'   => esc_html__( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'demure' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }

