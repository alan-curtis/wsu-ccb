/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function () {
    const siteNavigation = document.getElementById('site-navigation');

    // Return early if the navigation doesn't exist.
    if (!siteNavigation) {
        return;
    }

    const button = siteNavigation.getElementsByTagName('button')[0];

    // Return early if the button doesn't exist.
    if ('undefined' === typeof button) {
        return;
    }

    const menu = siteNavigation.getElementsByTagName('ul')[0];

    // Hide menu toggle button if menu is empty and return early.
    if ('undefined' === typeof menu) {
        button.style.display = 'none';
        return;
    }

    if (!menu.classList.contains('nav-menu')) {
        menu.classList.add('nav-menu');
    }

    // Toggle the .toggled class and the aria-expanded value each time the button is clicked.
    button.addEventListener('click', function () {
        siteNavigation.classList.toggle('toggled');

        if (button.getAttribute('aria-expanded') === 'true') {
            button.setAttribute('aria-expanded', 'false');
        } else {
            button.setAttribute('aria-expanded', 'true');
        }
    });

    // Remove the .toggled class and set aria-expanded to false when the user clicks outside the navigation.
    document.addEventListener('click', function (event) {
        const isClickInside = siteNavigation.contains(event.target);

        if (!isClickInside) {
            siteNavigation.classList.remove('toggled');
            button.setAttribute('aria-expanded', 'false');
        }
    });

    // Get all the link elements within the menu.
    const links = menu.getElementsByTagName('a');

    // Get all the link elements with children within the menu.
    const linksWithChildren = menu.querySelectorAll('.menu-item-has-children > a, .page_item_has_children > a');

    // Toggle focus each time a menu link is focused or blurred.
    for (const link of links) {
        link.addEventListener('focus', toggleFocus, true);
        link.addEventListener('blur', toggleFocus, true);
    }

    // Toggle focus each time a menu link with children receive a touch event.
    for (const link of linksWithChildren) {
        link.addEventListener('touchstart', toggleFocus, false);
    }

    /**
     * Sets or removes .focus class on an element.
     */
    function toggleFocus() {
        if (event.type === 'focus' || event.type === 'blur') {
            let self = this;
            // Move up through the ancestors of the current link until we hit .nav-menu.
            while (!self.classList.contains('nav-menu')) {
                // On li elements toggle the class .focus.
                if ('li' === self.tagName.toLowerCase()) {
                    self.classList.toggle('focus');
                }
                self = self.parentNode;
            }
        }

        if (event.type === 'touchstart') {
            const menuItem = this.parentNode;
            event.preventDefault();
            for (const link of menuItem.parentNode.children) {
                if (menuItem !== link) {
                    link.classList.remove('focus');
                }
            }
            menuItem.classList.toggle('focus');
        }
    }
}());
//event page js
//Search Functionlity
jQuery(document).on("keyup", ".the-calendar-events-page .search_input", function (e) {
    e.preventDefault();
    date = jQuery("#sort-by-month").find('option:selected').attr('data-month');
    search = jQuery(this).val();

    if (jQuery(".filter-button").is(":checked")) {
        category = jQuery(".filter-button").data("amp_cat");
        data = {
            action: "get_event_list",
            date: date,
            cat: category,
            search: search,
            filter: true
        }
    } else {
        category = jQuery(".the-calendar-events-page").data("applied_cat");
        data = {
            action: "get_event_list",
            date: date,
            cat: category,
            search: search
        }
    }

    jQuery.ajax({
        type: "POST",
        dataType: "json",
        url: "/wp-admin/admin-ajax.php",
        data: data,
        success: function (response) {
            jQuery("#calender-output").html(response.data);
        }
    });
    jQuery(".tribe-common-form-control-text__input.tribe-events-c-search__input").val("");
    jQuery(".tribe-common-form-control-text__input.tribe-events-c-search__input").val(search);
    jQuery(".tribe-common-c-btn.tribe-events-c-search__button").click();
})


jQuery(document).on("click", ".the-calendar-events-page .filter-button", function () {
    category = jQuery(this).data("amp_cat");
    date = jQuery("#sort-by-month").find('option:selected').attr('data-month');

    var dateObj = new Date(jQuery("#sort-by-month").find('option:selected').attr('data-month'));
    var month = (dateObj.getMonth() + 1).toString().padStart(2, '0');
    var year = dateObj.getUTCFullYear();

    if (jQuery(this).is(":checked")) {
        jQuery.ajax({
            type: "POST",
            dataType: "json",
            url: "/wp-admin/admin-ajax.php",
            data: {
                action: "get_event_list",
                date: date,
                cat: category,
                filter: true
            },
            success: function (response) {
                jQuery("#calender-output").html(response.data);
            }
        });
        jQuery(".common-cal").hide();
        jQuery(".amplify-cal").show();

        filter_url = document.location.origin + "/e/month/" + year + "-" + month + "/?shortcode=fbf8a5fd";
        jQuery(".amplify-cal a.tribe-events-c-nav__prev.tribe-common-b2").attr("href", filter_url).trigger("click");

    } else {
        jQuery.ajax({
            type: "POST",
            dataType: "json",
            url: "/wp-admin/admin-ajax.php",
            data: {
                action: "get_event_list",
                date: date,
                cat: category
            },
            success: function (response) {
                jQuery("#calender-output").html(response.data);
            }
        });
        jQuery(".common-cal").show();
        jQuery(".amplify-cal").hide();
        filter_url = document.location.origin + "/e/month/" + year + "-" + month + "/?shortcode=4593b6b5";
        jQuery(".common-cal a.tribe-events-c-nav__prev.tribe-common-b2").attr("href", filter_url).trigger("click");
    }
})


var cat_slugs = [];
jQuery(document).on("click", ".cat_cc_filter", function (e) {
    e.preventDefault();
    let slug = jQuery(this).data("cat_slug");
    if (cat_slugs.includes(slug)) {
        cat_slugs.splice(cat_slugs.indexOf(slug), 1); // Remove item from array
    } else {
        cat_slugs.push(slug); // Insert item into array
    }

    console.log(cat_slugs);

    categories = cat_slugs.toString();

    if (categories != '') {
        data = {
            action: "get_event_list",
            date: jQuery("#sort-by-month").find('option:selected').attr('data-month'),
            cat: categories,
            filter: true
        }
    } else {
        data = {
            action: "get_event_list",
            date: jQuery("#sort-by-month").find('option:selected').attr('data-month'),
            cat: categories
        }
    }

    jQuery.ajax({
        type: "POST",
        dataType: "json",
        url: "/wp-admin/admin-ajax.php",
        data: data,
        success: function (response) {
            jQuery("#calender-output").html(response.data);
        },
        complete: function() {
            // The AJAX request is complete; execute the code
            let scrollToElement = jQuery("#calender-output");
            var targetDiv = $("#calender-output");
            var targetPosition = targetDiv.offset().top;

            if (scrollToElement.length > 0) {
                let offsetTop = scrollToElement.offset().top;
                console.log(offsetTop);
                jQuery('html, body ').animate({scrollTop: targetPosition}, 5000);
            }
        }
    });

    //Filteration in all calendar triggeres
    let cat_id = jQuery(this).data("cat_id");
    if (jQuery("#common").hasClass('active')) {
        jQuery('#common [name="tribe_eventcategory[]"]').val(cat_id).trigger('change');
        //jQuery('#amplify [name="tribe_eventcategory[]"]').val(cat_id).trigger('change');

        setTimeout(() => {
            //alert("Here");
            jQuery('.common-cal [name="tribe_eventcategory[]"]').val(cat_id).trigger('change');
        }, 3000);
    } else {
        jQuery('.amplify [name="tribe_eventcategory[]"]').val(cat_id).trigger('change');
        setTimeout(() => {
            jQuery('.amplify-cal [name="tribe_eventcategory[]"]').val(cat_id).trigger('change');
        }, 3000);
    }

    let catId = jQuery(this).data("cat_id");
    let parentElement = jQuery(this).parent();

    // Add the class "show" to the parent element conditionally
    if ([35, 36, 37, 38, 39, 40].includes(catId)) {
        parentElement.toggleClass("show show-" + catId);
    } else {
        parentElement.toggleClass("active");
    }
    // Add CSS background red to parent elements with class "show"
    // Show/hide elements with class "sub-child" based on the "show" class
    jQuery('.sub-child').each(function () {
        // Get the value of the data-cat_id attribute of each element with class "sub-child"
        let subChildCatId = jQuery(this).data("cat_id");
        // Check if the parent of the clicked element has the class "show"
        let isParentShown = parentElement.hasClass("show");
        if (isParentShown && subChildCatId === catId) {
            jQuery(this).show();
        } else {
            jQuery(this).hide();
        }
    });

})
jQuery(document).ready(function () {
    // Handle click event on the .btn-filter button
    jQuery('.filter-btn').click(function () {
        // Toggle the visibility of the #popup-container with the sliding effect
        jQuery('.popup-container').slideToggle();
        jQuery('.popup-container').css('display', 'block');
        jQuery('.filter-btn.main').css('display', 'none');
    });
});
jQuery(document).ready(function () {
    // Handle click event on the .btn-filter button
    jQuery('.cross-btn').click(function () {

        jQuery('.popup-container').css('display', 'none');
        jQuery('.filter-btn.main').css('display', 'block');
    });
});


jQuery(document).on('change', "#sort-by-month", function () {
    var dateObj = new Date(jQuery(this).find('option:selected').attr('data-month'));
    var month = (dateObj.getMonth() + 1).toString().padStart(2, '0');
    var year = dateObj.getUTCFullYear();

    filter_url = document.location.origin + "/e/month/" + year + "-" + month + "/?shortcode=4593b6b5";

    console.log(filter_url);

    jQuery.ajax({
        type: "POST",
        dataType: "json",
        url: "/wp-admin/admin-ajax.php",
        data: {
            action: "get_event_list",
            date: jQuery(this).find('option:selected').attr('data-month'),
            cat: $(".filter-button").data("amp_cat")
        },
        success: function (response) {
            jQuery("#calender-output").html(response.data);
        }
    });

    if (jQuery(".the-calendar-events-page .filter-button").is(":checked")) {
        jQuery(".amplify-cal a.tribe-events-c-nav__prev.tribe-common-b2").attr("href", filter_url).trigger("click");
    } else {
        jQuery(".common-cal a.tribe-events-c-nav__prev.tribe-common-b2").attr("href", filter_url).trigger("click");
    }
    setTimeout(() => {
        jQuery(".cc_Cal_month").text(jQuery(".top-date .month").text())
        jQuery(".cc_Cal_years").text(jQuery(".top-date .year").text())
    }, 3000);

})


jQuery(document).on("click", ".the-calendar-events-page .button-event", function () {
    var dateObj = new Date(jQuery("#sort-by-month").find('option:selected').attr('data-month'));
    var year = dateObj.getUTCFullYear();
    date = jQuery("#sort-by-month").find('option:selected').attr('data-month');
    mon = date.split("-")[1];

    next = mon + 1;

    if (jQuery(this).hasClass("previous")) {
        if (mon > 1) {
            pre = parseInt(mon) - 1;
        } else {
            pre = mon;
        }
        var month = (pre).toString().padStart(2, '0');
    } else {
        if (mon < 12) {
            next = parseInt(mon) + 1;
        } else {
            next = mon;
        }
        var month = (next).toString().padStart(2, '0');

    }

    console.log(month);

    var pass_date = year + "-" + month + "-" + "01";

    $("#sort-by-month option").removeAttr("selected", true);
    $("#sort-by-month option[data-month='" + pass_date + "']").attr("selected", true);

    filter_url = document.location.origin + "/e/month/" + year + "-" + month + "/?shortcode=4593b6b5";

    console.log(filter_url);

    if (jQuery(".filter-button").is(":checked")) {
        data = {
            action: "get_event_list",
            date: pass_date,
            cat: $(".filter-button").data("amp_cat"),
            filter: true
        }
    } else {
        data = {
            action: "get_event_list",
            date: pass_date,
            cat: $(".filter-button").data("amp_cat")
        }
    }

    jQuery.ajax({
        type: "POST",
        dataType: "json",
        url: "/wp-admin/admin-ajax.php",
        data: data,
        success: function (response) {
            jQuery("#calender-output").html(response.data);
        }
    });

    if (jQuery(".the-calendar-events-page .filter-button").is(":checked")) {
        jQuery(".amplify-cal a.tribe-events-c-nav__prev.tribe-common-b2").attr("href", filter_url).trigger("click");
    } else {
        jQuery(".common-cal a.tribe-events-c-nav__prev.tribe-common-b2").attr("href", filter_url).trigger("click");
    }
    setTimeout(() => {
        jQuery(".cc_Cal_month").text(jQuery(".top-date .month").text())
        jQuery(".cc_Cal_years").text(jQuery(".top-date .year").text())
    }, 3000);
})

jQuery(document).on("click", "button.tribe-events-calendar-month__day-cell.tribe-events-calendar-month__day-cell--mobile", function () {
    data = jQuery(this).parent(".tribe-events-calendar-month__day").find(".tribe-events-calendar-month__events").html();
    post_id = jQuery(data).find(".tribe-events-calendar-month__calendar-event-tooltip").attr('id');
    post_id = post_id.split("tribe-events-tooltip-content-")[1];
    jQuery(".event-details-data").removeClass("active_event");
    jQuery(".event-details-data[data-event_id='" + post_id + "']").addClass("active_event");
})

jQuery(document).on("click", ".the-calendar-events-page .reset-filter", function (e) {
    e.preventDefault();
    // Reset selected categories by emptying the "cat_slugs" array
    cat_slugs = [];
    jQuery(".cat_cc_filter").parent("li").removeClass("active");
    jQuery(".cat_cc_filter").parent("li").removeClass("show");
    // Remove the class "show" from parent elements and hide subchild categories
    jQuery(".taxonomy h2").removeClass("show");
    jQuery(".taxonomy .sub-child").hide();
    jQuery(".cat_cc_filter.active").removeClass("active");
    var dateObj = new Date(jQuery("#sort-by-month").find('option:selected').attr('data-month'));
    var month = (dateObj.getMonth() + 1).toString().padStart(2, '0');
    var year = dateObj.getUTCFullYear();

    filter_url = document.location.origin + "/e/month/" + year + "-" + month + "/?shortcode=4593b6b5";

    console.log(filter_url);

    jQuery.ajax({
        type: "POST",
        dataType: "json",
        url: "/wp-admin/admin-ajax.php",
        data: {
            action: "get_event_list",
            date: jQuery("#sort-by-month").find('option:selected').attr('data-month'),
            cat: $(".filter-button").data("amp_cat")
        },
        success: function (response) {
            jQuery("#calender-output").html(response.data);
        }
    });
});