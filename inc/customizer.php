<?php
/**
 * Opera Theme Customizer support
 *
 * @package WordPress
 * @subpackage Opera
 * @since Opera 1.0
 */

/**
 * Implement Theme Customizer additions and adjustments.
 *
 * @since Opera 1.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function opera_customize_register($wp_customize) {
    
    $wp_customize->get_control( 'background_color'  )->section   = 'background_image';
    $wp_customize->get_section( 'background_image'  )->title     = __('Background Settings','opera');
    $wp_customize->get_section( 'background_image' )->description = __('Please note that background color and image settings work only for Boxed Layout','opera'); 
    
    $wp_customize->get_section('header_image')->priority = 27;
    $wp_customize->get_section('static_front_page')->priority = 28;
    $wp_customize->get_section('nav')->priority = 29;
    $wp_customize->get_section( 'background_image' )->priority  = 30;

    /** ===============
     * Extends CONTROLS class to add textarea
     */
    class opera_customize_textarea_control extends WP_Customize_Control {

        public $type = 'textarea';

        public function render_content() {
            ?>

            <label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <textarea rows="5" style="width:98%;" <?php $this->link(); ?>><?php echo esc_textarea($this->value()); ?></textarea>
            </label>

            <?php
        }

    }

    // Displays a list of categories in dropdown
    class WP_Customize_Dropdown_Categories_Control extends WP_Customize_Control {

        public $type = 'dropdown-categories';

        public function render_content() {
            $dropdown = wp_dropdown_categories(
                    array(
                        'name' => '_customize-dropdown-categories-' . $this->id,
                        'echo' => 0,
                        'hide_empty' => false,
                        'show_option_none' => '&mdash; ' . __('Select', 'opera') . ' &mdash;',
                        'hide_if_empty' => false,
                        'selected' => $this->value(),
                    )
            );

            $dropdown = str_replace('<select', '<select ' . $this->get_link(), $dropdown);

            printf(
                    '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>', $this->label, $dropdown
            );
        }

    }

    // Add new section for custom favicon settings
    $wp_customize->add_section('opera_custom_favicon_setting', array(
        'title' => __('Custom Favicon', 'opera'),
        'priority' => 77,
    ));


    $wp_customize->add_setting('custom_favicon');

    $wp_customize->add_control(
            new WP_Customize_Image_Control(
            $wp_customize, 'custom_favicon', array(
        'label' => 'Custom Favicon',
        'section' => 'opera_custom_favicon_setting',
        'settings' => 'custom_favicon',
        'priority' => 1,
            )
            )
    );

    // Add new section for custom favicon settings
    $wp_customize->add_section('opera_tracking_code_setting', array(
        'title' => __('Tracking Code', 'opera'),
        'priority' => 76,
    ));

    $wp_customize->add_setting('tracking_code', array('default' => '',
        'sanitize_js_callback' => 'opera_sanitize_escaping',
    ));

    $wp_customize->add_control(new opera_customize_textarea_control($wp_customize, 'tracking_code', array(
        'label' => __('Tracking Code', 'opera'),
        'section' => 'opera_tracking_code_setting',
        'settings' => 'tracking_code',
        'priority' => 2,
    )));
    
    $wp_customize->add_setting('opera_gravatar_image_check', array(
        'default' => 0,
        'sanitize_callback' => 'opera_sanitize_checkbox',
    ));
    $wp_customize->add_control('opera_gravatar_image_check', array(
        'label' => __('Enable gravatar image', 'opera'),
        'section' => 'header_image',
        'priority' => 1,
        'type' => 'checkbox',
    ));
    
    $wp_customize->add_setting('opera_gravatar_email', array('default' => __('', 'opera'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('opera_gravatar_email', array(
        'label' => __('Gravatar Email', 'opera'),
        'section' => 'header_image',
        'settings' => 'opera_gravatar_email',
        'priority' => 2,
    ));
    
    

    // Add new section for Social Icons
    $wp_customize->add_section('social_icon_setting', array(
        'title' => __('Social Icons', 'opera'),
        'priority' => 35,
    ));
    
    $wp_customize->add_setting('social_links_title', array('default' => __('', 'opera'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('social_links_title', array(
        'label' => __('Title', 'opera'),
        'section' => 'social_icon_setting',
        'settings' => 'social_links_title',
        'priority' => 1,
    ));

    // link url
    $wp_customize->add_setting('facebook_link_url', array('default' => __('', 'opera'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('facebook_link_url', array(
        'label' => __('Facebook URL', 'opera'),
        'section' => 'social_icon_setting',
        'settings' => 'facebook_link_url',
        'priority' => 2,
    ));

    // link url
    $wp_customize->add_setting('twitter_link_url', array('default' => __('', 'opera'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('twitter_link_url', array(
        'label' => __('Twitter URL', 'opera'),
        'section' => 'social_icon_setting',
        'settings' => 'twitter_link_url',
        'priority' => 3,
    ));

    // link url
    $wp_customize->add_setting('googleplus_link_url', array('default' => __('', 'opera'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('googleplus_link_url', array(
        'label' => __('Google Plus URL', 'opera'),
        'section' => 'social_icon_setting',
        'settings' => 'googleplus_link_url',
        'priority' => 4,
    ));

    // link url
    $wp_customize->add_setting('pinterest_link_url', array('default' => __('', 'opera'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('pinterest_link_url', array(
        'label' => __('Pinterest URL', 'opera'),
        'section' => 'social_icon_setting',
        'settings' => 'pinterest_link_url',
        'priority' => 5,
    ));

    // link url
    $wp_customize->add_setting('github_link_url', array('default' => __('', 'opera'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('github_link_url', array(
        'label' => __('Github URL', 'opera'),
        'section' => 'social_icon_setting',
        'settings' => 'github_link_url',
        'priority' => 6,
    ));

    // link url
    $wp_customize->add_setting('youtube_link_url', array('default' => __('', 'opera'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('youtube_link_url', array(
        'label' => __('Youtube URL', 'opera'),
        'section' => 'social_icon_setting',
        'settings' => 'youtube_link_url',
        'priority' => 7,
    ));
    
    $wp_customize->add_setting('dribbble_link_url', array('default' => __('', 'opera'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('dribbble_link_url', array(
        'label' => __('Dribble URL', 'opera'),
        'section' => 'social_icon_setting',
        'settings' => 'dribbble_link_url',
        'priority' => 8,
    ));
    
    $wp_customize->add_setting('tumblr_link_url', array('default' => __('', 'opera'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('tumblr_link_url', array(
        'label' => __('Tumblr URL', 'opera'),
        'section' => 'social_icon_setting',
        'settings' => 'tumblr_link_url',
        'priority' => 9,
    ));
    
    $wp_customize->add_setting('flickr_link_url', array('default' => __('', 'opera'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('flickr_link_url', array(
        'label' => __('Flickr URL', 'opera'),
        'section' => 'social_icon_setting',
        'settings' => 'flickr_link_url',
        'priority' => 10,
    ));
    
    $wp_customize->add_setting('vimeo_link_url', array('default' => __('', 'opera'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('vimeo_link_url', array(
        'label' => __('Vimeo URL', 'opera'),
        'section' => 'social_icon_setting',
        'settings' => 'vimeo_link_url',
        'priority' => 11,
    ));
    
    $wp_customize->add_setting('linkedin_link_url', array('default' => __('', 'opera'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('linkedin_link_url', array(
        'label' => __('Linkedin URL', 'opera'),
        'section' => 'social_icon_setting',
        'settings' => 'linkedin_link_url',
        'priority' => 12,
    ));

    // Add footer text section
    $wp_customize->add_section('opera_footer', array(
        'title' => 'Footer Text', // The title of section
        'priority' => 75,
    ));

    $wp_customize->add_setting('opera_footer_footer_text', array(
        'default' => null,
        'sanitize_js_callback' => 'opera_sanitize_escaping',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new opera_customize_textarea_control($wp_customize, 'opera_footer_footer_text', array(
        'section' => 'opera_footer', // id of section to which the setting belongs
        'settings' => 'opera_footer_footer_text',
    )));


    // Add custom CSS section
    $wp_customize->add_section('opera_custom_css', array(
        'title' => 'Custom CSS', // The title of section
        'priority' => 80,
    ));

    $wp_customize->add_setting('opera_custom_css', array(
        'default' => '',
        'sanitize_callback' => 'opera_sanitize_custom_css',
        'sanitize_js_callback' => 'opera_sanitize_escaping',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new opera_customize_textarea_control($wp_customize, 'opera_custom_css', array(
        'section' => 'opera_custom_css', // id of section to which the setting belongs
        'settings' => 'opera_custom_css',
    )));


    //remove default customizer sections
    $wp_customize->remove_section('colors');

    // add post message for various customizer settings 
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
}

add_action('customize_register', 'opera_customize_register');



/*
 * Sanitize numeric values 
 * 
 * @since Opera 1.0
 */

function opera_sanitize_integer($input) {
    if (is_numeric($input)) {
        return intval($input);
    }
}

/*
 * Escaping for input values
 * 
 * @since Opera 1.0
 */

function opera_sanitize_escaping($input) {
    $input = esc_attr($input);
    return $input;
}

/*
 * Sanitize Custom CSS 
 * 
 * @since Opera 1.0
 */

function opera_sanitize_custom_css($input) {
    $input = wp_kses_stripslashes($input);
    return $input;
}

/*
 * Sanitize Checkbox input values
 * 
 * @since Opera 1.0
 */

function opera_sanitize_checkbox($input) {
    if ($input) {
        $output = '1';
    } else {
        $output = false;
    }
    return $output;
}


/*
 * Sanitize background color scheme options 
 * 
 * @since Opera 1.0
 */

function opera_sanitize_bg_color_scheme_option($bg_colorscheme_option) {
    if (!in_array($bg_colorscheme_option, array('light', 'dark'))) {
        $bg_colorscheme_option = 'light';
    }

    return $bg_colorscheme_option;
}

/**
 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Opera 1.0
 */
function opera_customize_preview_js() {
    wp_enqueue_script('opera_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), '20131205', true);
}

add_action('customize_preview_init', 'opera_customize_preview_js');

function opera_header_output() {
    ?>
    <!--Customizer CSS--> 
    <style type="text/css">
    <?php echo esc_attr(get_theme_mod('opera_custom_css')); ?>
    </style> 
    <!--/Customizer CSS-->
    <?php
}

// Output custom CSS to live site
add_action('wp_head', 'opera_header_output');

function opera_footer_tracking_code() {
    echo get_theme_mod('tracking_code');
}

add_action('wp_footer', 'opera_footer_tracking_code');
