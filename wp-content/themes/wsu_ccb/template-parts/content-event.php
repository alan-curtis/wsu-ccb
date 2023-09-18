<?php
/**
 * Template part for displaying resource page content in page--resources.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WSU_CCB
 */
$parent_terms = get_terms([
    'taxonomy' => 'tribe_events_cat',
    'hide_empty' => false,
    'parent' => 0, // Specify 0 to retrieve only parent categories
]);
$year = date("Y");

//dropdown month
$month = '<div class="month-sort">
    <b> Sort : </b> by Month
    <select id="sort-by-month" class="dropdown">
        <option ' . (("Jan" == date("M")) ? "selected" : "") . '
                data-month="' . date("Y") . '-01-01">JAN
        </option>
        <option ' . (('Feb' == date("M")) ? 'selected="selected"' : "") . '
                data-month="' . date("Y") . '-02-01">FEB
        </option>
        <option ' . (('Mar' == date("M")) ? 'selected="selected"' : "") . '
                data-month="' . date("Y") . '-03-01">MAR
        </option>
        <option ' . (('Apr' == date("M")) ? 'selected="selected"' : "") . '
                data-month="' . date("Y") . '-04-01">APR
        </option>
        <option ' . (('May' == date("M")) ? 'selected="selected"' : "") . '
                data-month="' . date("Y") . '-05-01">MAY
        </option>
        <option ' . (('Jun' == date("M")) ? 'selected="selected"' : "") . '
                data-month="' . date("Y") . '-06-01">JUN
        </option>
        <option ' . (('Jul' == date("M")) ? 'selected="selected"' : "") . '
                data-month="' . date("Y") . '-07-01">JUL
        </option>
        <option ' . (('Aug' == date("M")) ? 'selected="selected"' : "") . '
                data-month="' . date("Y") . '-08-01">AUG
        </option>
        <option ' . (('Sep' == date("M")) ? 'selected="selected"' : "") . '
                data-month="' . date("Y") . '-09-01">SEP
        </option>
        <option ' . (('Oct' == date("M")) ? 'selected="selected"' : "") . '
                data-month="' . date("Y") . '-10-01">OCT
        </option>
        <option ' . (('Nov' == date("M")) ? 'selected="selected"' : "") . '
                data-month="' . date("Y") . '-11-01">NOV
        </option>
        <option ' . (('Dec' == date("M")) ? 'selected="selected"' : "") . '
                data-month="' . date("Y") . '-12-01">DEC
        </option>
    </select>
</div>';

//calender \
$calendar = '<div class="common-cal">' . do_shortcode("[tribe_events view='month' filter-bar='yes' exclude-category='tier-1,tier-2,tier-3,tier-4,crimson-pathway-1,crimson-pathway-2,amplifier-events']") . '</div>'
    . '<div class="amplify-cal" style="display:none">' . do_shortcode("[tribe_events category='tier-1,tier-2,tier-3,tier-4,crimson-pathway-1,crimson-pathway-2,amplifier-events' filter-bar='yes']") . '</div>';

//taxonomy terms
$taxonomy_html = '<div class="taxonomy">';
if (!empty($parent_terms) && !is_wp_error($parent_terms)) {
    // Loop through the parent categories
    foreach ($parent_terms as $parent_term) {
        // Display the parent category name as H2
        $taxonomy_html .= '<h2><a class="cat_cc_filter" data-cat_id="' . $parent_term->term_id . '">' . $parent_term->name . '</a></h2>';

        // Get the child categories for the current parent category
        $child_terms = get_terms([
            'taxonomy' => 'tribe_events_cat',
            'hide_empty' => false,
            'parent' => $parent_term->term_id, // Use the parent category ID to get child categories
        ]);
        // Check if child categories (terms) were found
        if (!empty($child_terms) && !is_wp_error($child_terms)) {
            // Display the child categories as UL/LI under the parent category
            $taxonomy_html .= '<ul>';

            foreach ($child_terms as $child_term) {
                $subchild_terms = get_terms([
                    'taxonomy' => 'tribe_events_cat',
                    'hide_empty' => false,
                    'parent' => $child_term->term_id, // Use the child category ID to get subchild categories
                ]);

                // Display the child category name as H2 if it has subchild categories
                $taxonomy_html .= '<li><a class="cat_cc_filter ' . $child_term->name . '" data-cat_slug = "' . $child_term->slug . '" data-cat_id="' . $child_term->term_id . '">' . $child_term->name . '</a></li>';
            }

            $taxonomy_html .= '</ul>';

            foreach ($child_terms as $child_term) {
                // Check if child category has subchild categories
                $p_id = $child_term->term_id;
                $subchild_terms = get_terms([
                    'taxonomy' => 'tribe_events_cat',
                    'hide_empty' => false,
                    'parent' => $child_term->term_id, // Use the child category ID to get subchild categories
                ]);
                $taxonomy_html .= '<div class="sub-child"  data-cat_id="' . $child_term->term_id . '" style="display:none">';
                if (!empty($subchild_terms) && !is_wp_error($subchild_terms)) {
                    $taxonomy_html .= '<h2><a class="cat_cc_filter" >' . $child_term->name . '</a></h2>';
                }
                $taxonomy_html .= '<div class ="subchild" data-subchildid="' . $p_id . '">';
                // Check if subchild categories (terms) were found
                if (!empty($subchild_terms) && !is_wp_error($subchild_terms)) {
                    // Display the subchild categories as UL/LI under the child category
                    $taxonomy_html .= '<ul>';
                    foreach ($subchild_terms as $subchild_term) {
                        $taxonomy_html .= '<li><a class="cat_cc_filter" data-cat_id="' . $subchild_term->term_id . '">' . $subchild_term->name . '</a></li>';
                    }
                    $taxonomy_html .= '</ul>';
                }
                $taxonomy_html .= '</div></div>';

            }

        }
    }
}
$taxonomy_html .= '<div class="reset">';
$taxonomy_html .= '<button class="reset-filter "> Clear all filter </button>';
$taxonomy_html .= '</div></div>';
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="the-calendar-events-page" data-applied_cat="">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 left-content ">
                <div class="main-div">
                    <div class="amplify-btn">
                        <label class="switch">
                            <input type="checkbox" placeholder="Amplifier" class="filter-button"
                                   data-amp_cat='tier-1,tier-2,tier-3,tier-4,crimson-pathway-1,crimson-pathway-2,amplifier-events'>
                            <span class="slider round">Amplifier</span>
                        </label>
                    </div>
                    <div class="filter-btn main ">
                        <button class="btn"><i class="fa  fa-filter "></i> Filter</button>
                    </div>
                    <?php echo $month; ?>
                </div>
                <div class="popup-container d-lg-none">
                    <div class="filter-mob">
                        <div class="filter-button mob">
                            <button class="btn"><i class="fa  fa-filter "></i> Filter</button>
                        </div>
                        <div class="reset-btn mob">
                            <button class="reset-filter"> Reset filter</button>
                        </div>
                        <div class="cross cross-btn" id="cross"><img
                                    src="/wp-content/themes/wsu_ccb/assets/images/cross.png"
                                    alt="Accordion Background"></div>
                    </div>
                    <?php echo $taxonomy_html; ?>
                    <div id="calendar-data-div" class="calender">
                        <div class="calender-header">
                            <div class="previous button-event" id="prev"><img
                                        src="/wp-content/themes/wsu_ccb/assets/images/chevron-left.png"
                                        alt="Accordion Background"></div>
                            <div class="month-date"><span class="cc_Cal_month"><?php echo date("M"); ?></span><span
                                        class="cc_Cal_years"><?php echo $year; ?></span></div>
                            <div class="next button-event" id="next"><img
                                        src="/wp-content/themes/wsu_ccb/assets/images/chevron-right.png"
                                        alt="Accordion Background"></div>
                        </div>
                        <?php echo $calendar; ?>
                    </div>
                </div>
                <div class="search-box-mobile">
                    <form class="submit_search">
                        <label>Search</label>
                        <input type="text" name="search" class="search_input">
                    </form>
                </div>
                <div class="monthsort-mobile">
                    <?php echo $month; ?>
                </div>
                <div class="calender-data-div" id="calender-output">
                    <?php
                    global $post;
                    $start_data = date('Y') . "-" . date('m') . "-01 00:01";
                    $end_date = date('Y') . "-" . date('m') . "-31 23:59";
                    $events = tribe_get_events([
                        'posts_per_page' => -1,
                        'start_date' => $start_data,
                        'end_date' => $end_date,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'tribe_events_cat',
                                'field' => 'slug',
                                'terms' => array('tier-1', 'tier-2', 'tier-3', 'tier-4', 'crimson-pathway-1', 'crimson-pathway-2', 'amplifier-events'),
                                'operator' => 'NOT IN'
                            ),
                        ),
                    ]);
                    // Loop through the events, displaying the title and content for each
                    ?>

                    <?php
                    echo '<div class="top-date">';
                    echo '<div class="month">' . $month = date("M") . '</div>';
                    echo '<div class="year">' . $year = date("Y") . '</div>';
                    echo '</div>';
                    if (empty($events)) {
                        ?>
                        <div class="tribe-events">
                            <div class="tribe-events-c-messages__message" role="alert">
                                <ul class="tribe-events-c-messages__message-list">
                                    <li data-key="0">
                                        There are no upcoming events.
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php
                    }
                    foreach ($events as $event) {
                        $event_tm = strtotime($event->event_date);
                        $url = $event->guid;
                        $venue = tribe_get_venue_details($event->ID);
                        echo '<div class="event-details-data" data-event_id="' . $event->ID . '">'; // Main div for the event details
                        echo '<div class="event-details-date">';
                        // Left section (daynum, month, and weekday)
                        echo '<div class="date">' . $date = date("j", $event_tm) . '</div>';
                        echo '<div class="month">' . $month = date("M", $event_tm) . '</div>';
                        echo '<div class="weekday">' . $day = date('D', $event_tm) . '</div>';
                        echo '</div>';
                        // Right section (event title, content, and time)
                        echo '<div class="event-details-post">';
                        echo '<h4> <a href="' . $url . '">' . $event->post_title . '</a></h4>';
                        // echo wpautop($event->post_content);
                        echo '<div class="detail">';
                        if ($venue) {
                            echo '<p>Location: ' . $venue['linked_name'] . ' |</p>';
                        }
                        echo "<p>Time: " . date('h:iA', $event_tm) . '</p>';
                        echo '</div>';
                        $event_cats = "";
                        $event_cats = get_the_terms($event->ID, 'tribe_events_cat');
                        echo '<div class="event-category">';
                        $colors = array('red', 'blue', 'yellow', 'orange');
                        $color_index = 0;
                        foreach ($event_cats as $cat) {
                            $color = $colors[$color_index % count($colors)];
                            echo '<div class="event-cat">';
                            echo '<div class="circle ' . $color . '"></div>';
                            echo '<div class="category">' . $cat->name . '</div>';
                            echo '</div>';
                            $color_index++;
                        }
                        echo '</div>';
                        echo '<p class="post-content">' . strip_tags($event->post_content) . '</p>';
                        echo '</div>'; // Close the right section
                        echo '</div>'; // Close the main div for the event details
                    }
                    ?>
                </div>
                <div class="button">
                    <button class="previous button-event " id="prev"> Previous month</button>
                    <button class="next button-event" id="next"> Next month</button>
                </div>
            </div>
            <div class="offset-xl-1 col-lg-5 col-xl-4 right-content d-none d-lg-block">
                <div class="search-box">
                    <form class="submit_search">
                        <label>Search</label>
                        <input type="text" name="search" class="search_input">
                    </form>
                </div>
                <?php echo $taxonomy_html; ?>
                <div id="calendar-data-div" class="calender">
                    <div class="calender-header">
                        <div class="previous button-event" id="prev"><img
                                    src="/wp-content/themes/wsu_ccb/assets/images/chevron-left.png"
                                    alt="Accordion Background"></div>
                        <div class="month-date"><span class="cc_Cal_month"><?php echo date("M"); ?></span><span
                                    class="cc_Cal_years"><?php echo $year; ?></span>
                            <div class="next button-event" id="next"><img
                                        src="/wp-content/themes/wsu_ccb/assets/images/chevron-right.png"
                                        alt="Accordion Background"></div>
                        </div>
                        <?php echo $calendar; ?>
                    </div>
                </div>
            </div>
        </div>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="entry-content">
                <?php
                //    the_content();
                wp_link_pages(
                    array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'wsu_ccb'),
                        'after' => '</div>',
                    )
                );
                ?>
            </div><!-- .entry-content -->
        </article><!-- #post-<?php the_ID(); ?> -->
    </div>