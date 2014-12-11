/**
 * Shows or hides the meta value input based on the orderby input.
 *
 * @since 0.1
 *
 * @param e obj The orderby input object.
 */
function easy_scroll_meta_value(e) {

    if (jQuery(e).val() == 'meta_value' || jQuery(e).val() == 'meta_value_num')
        jQuery('#easy-scroll-meta-value').addClass('show');
    else
        jQuery('#easy-scroll-meta-value').removeClass('show');
}

/**
 * Changes the loader image based on the loader image input.
 *
 * @since 0.1
 *
 * @param e obj The loader input object.
 */
function easy_scroll_loader_image(e) {

    var value = jQuery(e).val();

    jQuery('#easy-scroll-loader').attr('src', easy_scroll_data.easy_scroll_dir + '/img/loaders/' + value + '.gif');
}

/**
 * Changes the styles of the loader based on the loader style attributes input.
 *
 * @since 0.1
 */
function easy_scroll_loader_styles() {

    var width = jQuery('#easy_scroll_loader_width').val(),
        height = jQuery('#easy_scroll_loader_height').val(),
        opacity = jQuery('#easy_scroll_loader_opacity').val();

    jQuery('#easy-scroll-loader').css({
        maxWidth: width + 'px',
        maxHeight: height + 'px',
        opacity: opacity
    })
}