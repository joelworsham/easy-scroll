// Launch some functions
jQuery(window).scroll(function () {
    easy_scroll();
    easy_scroll_show_hide_footer();
});

jQuery(window).resize(function () {
    easy_scroll_show_hide_footer();
});

/**
 * The main EasyScroll function.
 *
 * This function launches on scroll and will perform the ajax call necessary
 * to bring new posts onto the page.
 *
 * @since 0.1
 */
function easy_scroll() {
    // If not scrolled to bottom (or preset), bail
    if (jQuery(window).scrollTop() + jQuery(window).height() + parseInt(easy_scroll_data.window_offset) < jQuery(document).height())
        return;

    // If already loading, bail
    if (jQuery('#easy-scroll-loading-posts').length || jQuery('#easy-scroll-no-more-posts').length)
        return;

    // Output loading icon
    jQuery('#' + easy_scroll_data.inject_location).append('<div id="easy-scroll-loading-posts"><img src="' + easy_scroll_data.easy_scroll_dir + '/img/loaders/' + easy_scroll_data.loader + '.gif" style="max-width: ' + easy_scroll_data.loader_width + 'px; max-height: ' + easy_scroll_data.loader_height + 'px; opacity: ' + easy_scroll_data.loader_opacity + ';" /></div>');

    // Get our posts number so we offset what post we start at
    var post_offset = jQuery('.' + easy_scroll_data.post_container).length;

    var data = {
        action: 'easy_scroll',
        post_offset: post_offset,
        post_count: easy_scroll_data.post_count
    };

    jQuery.ajax({
        url: easy_scroll_data.ajax_url,
        type: 'GET',
        data: data,
        success: function (data) {
            easy_scroll_output(data);
        }
    });
    return false;
}

/**
 * Outputs the HTML from the AJAX call.
 *
 * @since 0.1
 *
 * @param data Data returned from the AJAX call.
 */
function easy_scroll_output(data) {
    // If no more posts, change things up!
    if (data == 'false') {
        jQuery('#easy-scroll-loading-posts').animate({
            opacity: 0
        }, {
            duration: 1000,
            complete: function () {
                jQuery(this).remove();
                jQuery('#' + easy_scroll_data.inject_location).append('<div id="easy-scroll-no-more-posts" style="height: ' + easy_scroll_data.loader_height + 'px;"><img src="' + easy_scroll_data.easy_scroll_dir + '/img/empty.png" /><br/>No More Posts</div>');
                jQuery('#easy-scroll-no-more-posts').animate({opacity: 1}, 300);

                // Hide footer
                jQuery('#easy-scroll-footer').addClass('hide');
            }
        });

        return;
    }

    // Remove loading image
    jQuery('#easy-scroll-loading-posts').remove();

    // Hide footer
    jQuery('#easy-scroll-footer').removeClass('show');

    // Output post(s)
    jQuery('#' + easy_scroll_data.inject_location).append(data);
}

/**
 * Shows or hides the footer based on scroll position.
 *
 * @since 0.1
 */
function easy_scroll_show_hide_footer() {
    if (jQuery(window).scrollTop() + jQuery(window).height() + parseInt(easy_scroll_data.window_offset) >= jQuery(document).height() - 300) {
        jQuery('#easy-scroll-footer').addClass('show');
    } else {
        jQuery('#easy-scroll-footer').removeClass('show');
    }
}