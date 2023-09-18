<?php
/**
 * WSU_CCB functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WSU_CCB
 */

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wsu_ccb_setup()
{
    /*
        * Make theme available for translation.
        * Translations can be filed in the /languages/ directory.
        * If you're building a theme based on WSU_CCB, use a find and replace
        * to change 'wsu_ccb' to the name of your theme in all the template files.
        */
    load_theme_textdomain('wsu_ccb', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
        * Let WordPress manage the document title.
        * By adding theme support, we declare that this theme does not use a
        * hard-coded <title> tag in the document head, and expect WordPress to
        * provide it for us.
        */
    add_theme_support('title-tag');

    /*
        * Enable support for Post Thumbnails on posts and pages.
        *
        * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
        */
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'menu-1' => esc_html__('Primary', 'wsu_ccb'),
            'menu-2' => esc_html__('Top Nav', 'wsu_ccb'),
            'menu-3' => esc_html__('Footer Top Nav', 'wsu_ccb'),
            'menu-4' => esc_html__('Footer Menu 1', 'wsu_ccb'),
            'menu-5' => esc_html__('Footer Menu 2', 'wsu_ccb'),
            'menu-6' => esc_html__('Footer Menu 3', 'wsu_ccb'),
            'menu-7' => esc_html__('Footer Menu 4', 'wsu_ccb'),
            'menu-8' => esc_html__('Footer Menu 5', 'wsu_ccb'),
            'menu-9' => esc_html__('Footer Menu 6', 'wsu_ccb'),
            'menu-10' => esc_html__('Footer Menu 7', 'wsu_ccb'),
            'menu-11' => esc_html__('Sidebar navigation', 'wsu_ccb'),
        )
    );

    /*
        * Switch default core markup for search form, comment form, and comments
        * to output valid HTML5.
        */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'wsu_ccb_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        )
    );
}

add_action('after_setup_theme', 'wsu_ccb_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wsu_ccb_content_width()
{
    $GLOBALS['content_width'] = apply_filters('wsu_ccb_content_width', 640);
}

add_action('after_setup_theme', 'wsu_ccb_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wsu_ccb_widgets_init()
{
    register_sidebar(
        array(
            'name' => esc_html__('Sidebar', 'wsu_ccb'),
            'id' => 'sidebar-1',
            'description' => esc_html__('Add widgets here.', 'wsu_ccb'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
    register_sidebar(
        array(
            'name' => esc_html__('Footer column 1', 'wsu_ccb'),
            'id' => 'footer-column-1',
            'description' => esc_html__('Add widgets here.', 'wsu_ccb'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
    register_sidebar(
        array(
            'name' => esc_html__('Footer Column 2', 'wsu_ccb'),
            'id' => 'footer-column-2',
            'description' => esc_html__('Add widgets here.', 'wsu_ccb'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
    register_sidebar(
        array(
            'name' => esc_html__('Footer Column 3', 'wsu_ccb'),
            'id' => 'footer-column-3',
            'description' => esc_html__('Add widgets here.', 'wsu_ccb'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
    register_sidebar(
        array(
            'name' => esc_html__('Footer Column 4', 'wsu_ccb'),
            'id' => 'footer-column-4',
            'description' => esc_html__('Add widgets here.', 'wsu_ccb'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name' => esc_html__('WSU CCB Sidebar Menu', 'wsu_ccb'),
            'id' => 'wsu-ccb-sidebar-menu',
            'description' => esc_html__('Add widgets here.', 'wsu_ccb'),
            'before_widget' => '<section class="widget-content">',
            'after_widget' => "</section>",
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );

}

add_action('widgets_init', 'wsu_ccb_widgets_init');

// Define a filter callback function
function my_widget_title_filter($title, $instance, $id_base)
{

    if ($id_base == "nav_menu") {
        $string_arr = explode(' ', $title);

        if (count($string_arr) == 2) {
            return '<div class="title">' . $string_arr[0] . '<span>' . $string_arr[1] . '</span></div>';
        } else {
            return $title;
        }
    } else {
        return $title;
    }
}

// Add the filter to the widget_title hook
add_filter('widget_title', 'my_widget_title_filter', 10, 3);


/**
 * Enqueue scripts and styles.
 */
function owl_scripts()
{
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/inc/owl-carousel/js/owl.carousel.min.js', array('jquery'), '', true);
    wp_enqueue_style('owl-style-min', get_stylesheet_directory_uri() . '/inc/owl-carousel/css/owl.carousel.min.css');
    wp_enqueue_style('owl-style-def', get_stylesheet_directory_uri() . '/inc/owl-carousel/css/owl.theme.default.min.css');
}

add_action('wp_enqueue_scripts', 'owl_scripts');

function flex_scripts()
{
    wp_enqueue_script('flexslider', get_template_directory_uri() . '/inc/flexslider/js/jquery.flexslider-min.js', array('jquery'), '', true);
    wp_enqueue_style('flexslider-css', get_stylesheet_directory_uri() . '/inc/flexslider/css/flexslider.css');
}

add_action('wp_enqueue_scripts', 'flex_scripts');

function swiper_scripts()
{
    wp_enqueue_script('swiper-js', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/9.2.0/swiper-bundle.min.js');
    wp_enqueue_style('swiper-css', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/9.2.0/swiper-bundle.min.css');
}

add_action('wp_enqueue_scripts', 'swiper_scripts');

function autocomplete_scripts()
{
    wp_enqueue_script('autocomplete-js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.9/jquery.autocomplete.min.js');
}

add_action('wp_enqueue_scripts', 'autocomplete_scripts');

function wsu_ccb_scripts()
{
    wp_enqueue_style('wsu_ccb-style', get_stylesheet_uri(), array(), _S_VERSION);
    wp_style_add_data('wsu_ccb-style', 'rtl', 'replace');

    wp_enqueue_script('wsu_ccb-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    $compiled_css = get_template_directory() . '/assets/css/styles.css';
    if (file_exists($compiled_css)) {
        wp_enqueue_style('wsu_ccb_custom-theme', get_template_directory_uri() . '/assets/css/styles.css');
        wp_enqueue_style('sb-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css', array());
        wp_enqueue_script('wsu_ccb_custom-theme-js', get_template_directory_uri() . '/assets/js/all.min.js', array(), '1.0.0', true);
        wp_localize_script('wsu_ccb_custom-theme-js', 'theme',
            array(
                'ajaxurl' => admin_url('admin-ajax.php'),
            )
        );
    }


}

add_action('wp_enqueue_scripts', 'wsu_ccb_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

//get domain by passing url
function getDomain($url)
{
    $pieces = parse_url($url);
    $domain = isset($pieces['host']) ? $pieces['host'] : '';
    if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
        return $regs['domain'];
    }
    return FALSE;
}

add_filter('acf/settings/save_json', 'my_acf_json_save_point');

function my_acf_json_save_point($path)
{

    // update path
    $path = get_stylesheet_directory() . '/inc/acf-json';


    // return
    return $path;

}

add_filter('acf/settings/load_json', 'my_acf_json_load_point');

function my_acf_json_load_point($paths)
{

    // remove original path (optional)
    unset($paths[0]);


    // append path
    $paths[] = get_stylesheet_directory() . '/inc/acf-json';


    // return
    return $paths;

}

/**
 * ACF block type registration
 */

acf_register_block_type(array(
    'name' => 'hero',
    'title' => __('Hero'),
    'description' => __('A custom hero block for the homepage.'),
    'render_template' => 'template-parts/blocks/hero.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
acf_register_block_type(array(
    'name' => 'cta-image',
    'title' => __('CTA w/ Image'),
    'description' => __('A custom call to action with an image.'),
    'render_template' => 'template-parts/blocks/cta-image.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
acf_register_block_type(array(
    'name' => 'stats-section',
    'title' => __('Stats Section'),
    'description' => __('a stats section for the home page w/ mobile accordions.'),
    'render_template' => 'template-parts/blocks/stats-section.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
acf_register_block_type(array(
    'name' => 'news-events-section',
    'title' => __('News & Events Section'),
    'description' => __('A News & Events section for the Homepage'),
    'render_template' => 'template-parts/blocks/news-events.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
acf_register_block_type(array(
    'name' => 'masonry-grid-homepage',
    'title' => __('Masonry Grid Homepage'),
    'description' => __('A Masonry grid for the Homepage, includes social sharing'),
    'render_template' => 'template-parts/blocks/masonry-grid.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
acf_register_block_type(array(
    'name' => 'featured-testimonial',
    'title' => __('Featured Testimonial'),
    'description' => __('A featured testimonial'),
    'render_template' => 'template-parts/blocks/featured-testimonial.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
acf_register_block_type(array(
    'name' => 'cta-card',
    'title' => __('CTA Card'),
    'description' => __('CTA card with no image'),
    'render_template' => 'template-parts/blocks/cta-card.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
acf_register_block_type(array(
    'name' => 'cta-card-img',
    'title' => __('CTA Card w/ Image'),
    'description' => __('CTA card with image'),
    'render_template' => 'template-parts/blocks/cta-card-img.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
acf_register_block_type(array(
    'name' => 'list-block-image',
    'title' => __('List Block with Image'),
    'description' => __('List Block with Image'),
    'render_template' => 'template-parts/blocks/list-block-img.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
acf_register_block_type(array(
    'name' => 'fullwidth-list-block',
    'title' => __('full width list block'),
    'description' => __('a full width list block'),
    'render_template' => 'template-parts/blocks/fullwidth-list-block.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
acf_register_block_type(array(
    'name' => 'banner-cta',
    'title' => __('Banner w/ CTA'),
    'description' => __('A banner with a CTA block center/left align'),
    'render_template' => 'template-parts/blocks/banner-cta.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
acf_register_block_type(array(
    'name' => 'facts-ranks',
    'title' => __('Facts and Ranks'),
    'description' => __('A Facts and Ranks section'),
    'render_template' => 'template-parts/blocks/facts-ranks.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
acf_register_block_type(array(
    'name' => 'featured-media',
    'title' => __('Featured Media'),
    'description' => __('featured media for videos, supports vimeo and youtube'),
    'render_template' => 'template-parts/blocks/featured-media.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
acf_register_block_type(array(
    'name' => 'featured-media-fullwidth',
    'title' => __('Featured Media Full Width'),
    'description' => __('full width featured media for videos, supports vimeo and youtube'),
    'render_template' => 'template-parts/blocks/featured-media-fullwidth.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',
));
acf_register_block_type(array(
    'name' => 'slider',
    'title' => __('slider'),
    'description' => __('slider with thumbnails'),
    'render_template' => 'template-parts/blocks/slider.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
acf_register_block_type(array(
    'name' => 'accordion',
    'title' => __('accordion'),
    'description' => __('an accordion'),
    'render_template' => 'template-parts/blocks/accordion.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
acf_register_block_type(array(
    'name' => 'contact',
    'title' => __('contact'),
    'description' => __('an accordion'),
    'render_template' => 'template-parts/blocks/contact.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
acf_register_block_type(array(
    'name' => 'list-block',
    'title' => __('List Block'),
    'description' => __('a list block with an image'),
    'render_template' => 'template-parts/blocks/list-block.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
acf_register_block_type(array(
    'name' => 'cta-icon-block',
    'title' => __('CTA Icon Block'),
    'description' => __('a CTA icon block for quicklinks'),
    'render_template' => 'template-parts/blocks/cta-icon-block.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
acf_register_block_type(array(
    'name' => 'cta-list-icon',
    'title' => __('CTA List with Icons'),
    'description' => __('a CTA List section with icons'),
    'render_template' => 'template-parts/blocks/cta-list-icon.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
acf_register_block_type(array(
    'name' => 'video-modal',
    'title' => __('Numbered Section w/ video modal'),
    'description' => __('Get Started with Video Button, section contains numbered sections and video button with modal window'),
    'render_template' => 'template-parts/blocks/video-modal.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
acf_register_block_type(array(
    'name' => 'logo-block',
    'title' => __('Logo Block'),
    'description' => __('logo block for department page'),
    'render_template' => 'template-parts/blocks/logo-block.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
acf_register_block_type(array(
    'name' => 'featured-faculty',
    'title' => __('Featured Faculty'),
    'description' => __('Featured faculty with department head and staff'),
    'render_template' => 'template-parts/blocks/featured-faculty.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
acf_register_block_type(array(
    'name' => 'accordion-repeater',
    'title' => __('Accordion repeater with CTA sidebar'),
    'description' => __('An accordion repeater for the Department Page with CTA sidebar'),
    'render_template' => 'template-parts/blocks/accordion-repeater.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
acf_register_block_type(array(
    'name' => 'careers-block',
    'title' => __('Careers Block'),
    'description' => __('Careers Block for Department pages, pulls in data from o*net'),
    'render_template' => 'template-parts/blocks/careers-block.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
acf_register_block_type(array(
    'name' => 'wysiwyg',
    'title' => __('Wysiwyg'),
    'description' => __('wysiwyg'),
    'render_template' => 'template-parts/blocks/wysiwyg.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
acf_register_block_type(array(
    'name' => 'featured-news',
    'title' => __('Featured News With Image'),
    'description' => __('featured news with image'),
    'render_template' => 'template-parts/news/featured-news.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
acf_register_block_type(array(
    'name' => 'featured-news-cta',
    'title' => __('Featured News CTA'),
    'description' => __('featured news cta with background banner'),
    'render_template' => 'template-parts/news/featured-cta.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
acf_register_block_type(array(
    'name' => 'more-news',
    'title' => __('More News'),
    'description' => __('Featured News block with load more pagination 3 column, with image'),
    'render_template' => 'template-parts/news/more-news.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
acf_register_block_type(array(
    'name' => 'featured-stories',
    'title' => __('Featured Stories'),
    'description' => __('Featured stories with load more pagination, 4 column, no image'),
    'render_template' => 'template-parts/news/featured-stories.php',
    'category' => 'formatting',
    'icon' => '',
    'align' => 'full',

));
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Theme Options',
        'icon_url' => 'dashicons-art',
    ));
}

add_filter('acf/load_field/name=menu_select', 'wsu_nav_menus_load');
function wsu_nav_menus_load($field)
{

    $menus = wp_get_nav_menus();

    if (!empty($menus)) {

        foreach ($menus as $menu) {
            $field['choices'][$menu->slug] = $menu->name;
        }

    }

    return $field;

}

add_filter('acf/load_field/name=category_select', 'wsu_category_select');
function wsu_category_select($field)
{

    $menus = get_categories();

    if (!empty($menus)) {

        foreach ($menus as $menu) {
            $field['choices'][$menu->slug] = $menu->name;
        }

    }

    return $field;

}


function load_more_posts()
{
    $offset = $_POST['offset'];
    $category = $_POST['category'];

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'category_name' => $category,
        'order' => 'desc',
        'offset' => $offset,
    );

    $posts = new WP_Query($args);

    ob_start();

    if ($posts->have_posts()):
        while ($posts->have_posts()):
            $posts->the_post();
            $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'post-thumbnail'); ?>

            <div class="col-md-4 rows-column">
                <div class="img-wrap">
                    <img src="<?= $featured_image; ?>" alt="<?php the_title(); ?>"/>
                </div>
                <div class="post-date">
                    <?php the_date('F j, Y'); ?>
                </div>
                <div class="post-title"><a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></div>
            </div>

        <?php endwhile;
    endif;

    wp_reset_postdata();
    $response['html'] = ob_get_clean();

    if ($posts->post_count > 0) {
        wp_send_json_success($response);
    } else {
        wp_send_json_error();
    }
}

add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');


function load_more_stories()
{
    $offset = $_POST['offset'];
    $category = $_POST['category'];

    $args = [
        'post_type' => 'post',
        'posts_per_page' => 4,
        'category_name' => $category,
        'order' => 'desc',
        'offset' => $offset
    ];
    $_posts = new WP_Query($args);

    ob_start();

    if ($_posts->have_posts()):
        ?>
        <?php while ($_posts->have_posts()):
        $_posts->the_post(); ?>
        <div class="col-lg-3 col-6 rows-col">
            <div class="card-wrapper">
                <div class="card-title">
                    <h3>
                        <?php the_title(); ?>
                    </h3>
                </div>
                <div class="card-desc">
                    <p><?php echo wp_trim_words(get_the_excerpt(), 10); ?></p>
                </div>
                <div class="card-actions">
                    <a href="<?php the_permalink(); ?>" target="" class="upper-btn">Read More</a>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
    <?php endif;
    wp_reset_postdata();
    $response['html'] = ob_get_clean();

    if ($_posts->post_count > 0) {
        wp_send_json_success($response);
    } else {
        wp_send_json_error();
    }
}


add_action('wp_ajax_load_more_stories', 'load_more_stories');
add_action('wp_ajax_nopriv_load_more_stories', 'load_more_stories');

function get_event_list() {
    //print_r($_POST);
    //Date Range for Specific Month
    $date = $_POST['date'];
    $category = $_POST['cat'];
    $time = strtotime($date );
    $start_date = date('Y-m-d H:i',$time);
    $nextMonthDate = date('Y-m-d', strtotime('+1 month', strtotime($start_date)));
    $lastMonthDate = date('Y-m-d', strtotime('-1 day', strtotime($nextMonthDate)));
    $lastMonthDate = date('Y-m-d H:i
', strtotime($lastMonthDate . ' +23 hours +59 minutes'));
    $end_date = date('Y-m-d H:i',strtotime($lastMonthDate));

    $cat_arr = explode(",",$category);

    //Amplify Filter
    $amplify_event = false;
    if(isset($_POST["filter"])){
        $op = "IN";
        $amplify_event = True;
    }else{
        $op = "NOT IN";
    }

    if( isset($_POST["search"]) ) {
        $events = tribe_get_events( [
            'posts_per_page' => -1,
            'start_date'   => $start_date,
            'end_date'     => $end_date,
            's' => $_POST['search'],
            'tax_query' => array(
                array(
                    'taxonomy' => 'tribe_events_cat',
                    'field' => 'slug',
                    'terms' => $cat_arr,
                    'operator' => $op
                ),
            ),
        ] );

    }else{
        $events = tribe_get_events( [
            'posts_per_page' => -1,
            'start_date'   => $start_date,
            'end_date'     => $end_date,
            'tax_query' => array(
                array(
                    'taxonomy' => 'tribe_events_cat',
                    'field' => 'slug',
                    'terms' => $cat_arr,
                    'operator' => $op
                ),
            ),
        ] );
    }

    $html = "";
    $nextMonthDate = date('Y-m-d', strtotime('+1 month', strtotime($start_date)));
    $html .=  '<div class="top-date">';
    $html .=  '<div class="month">' . $month = date("M" , $time) . '</div>';
    $html .= '<div class="year">' . $year  = date("Y" ,$time) . '</div>';
    $html .= '</div>';
    if( empty($events) ){
        $html .= '<div class="tribe-events">
                            <div class="tribe-events-c-messages__message" role="alert">
                                <ul class="tribe-events-c-messages__message-list">
                                    <li data-key="0">
                                        There are no upcoming events.
                                    </li>
                                </ul>
                            </div>
                        </div>';
    }
    foreach ($events as $event) {
        $event_tm = strtotime($event->event_date);
        $venue = tribe_get_venue_details($event->ID);
        $html .= '<div class="event-details-data" data-event_id="'.$event->ID.'">'; // Main div for the event details
        $html .= '<div class="event-details-date">';
        // Left section (daynum, month, and weekday)
        $html .= '<div class="date">' . $date = date("j", $event_tm) . '</div>';
        $html .= '<div class="month">' . $month = date("M", $event_tm) . '</div>';
        $html .= '<div class="weekday">' . $day = date('D', $event_tm) . '</div>';
        $html .= '</div>';
        // Right section (event title, content, and time)
        $html .= '<div class="event-details-post">';
        $html .= '<h4>' . $event->post_title . '</h4>';
        $html .=  '<div class="detail">';
        if ($venue) {
            $html .= '<p>Location: ' . $venue['linked_name'] . ' |</p>';
        }
        $html .= "<p>Time: " . date('h:iA', $event_tm).'</p>';
        $html .= '</div>';
        $event_cats = get_the_terms($event->ID, 'tribe_events_cat');
        if (!$amplify_event) {
            $html .= '<div class="event-category">';
            $colors = array('red', 'blue', 'yellow', 'orange');
            $color_index = 0;
            foreach ($event_cats as $cat) {
                $color = $colors[$color_index % count($colors)];
                $html .= '<div class="event-cat">';
                $html .= '<div class="circle ' . $color . '"></div>';
                $html .= '<div class="category">' . $cat->name . '</div>';
                $html .= '</div>';
                $color_index++;
            }
            $html .= '</div>';
        }
        $html .= '<p class="post-content">' . strip_tags($event->post_content) . '</p>';
        $html .= '</div>'; // Close the right section
        $html .= '</div>'; // Close the main div for the event details
    }
    $response['html'] = ob_get_clean();
    wp_send_json_success($html);

}
add_action('wp_ajax_get_event_list', 'get_event_list');
add_action('wp_ajax_nopriv_get_event_list', 'get_event_list');
set_time_limit(100);