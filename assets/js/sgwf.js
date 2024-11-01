jQuery(document).ready(function($) {
    // Initialize Masonry only if the grid is present
    var masonryGrid = $('.c2twsg_mesonry_grid');
    if (masonryGrid.length) {
        masonryGrid.masonry({
            itemSelector: '.c2twsg_mesonry_item',
            columnWidth: '.c2twsg_mesonry_item',
            percentPosition: true
        });
    }

    $('.sgwf_filter ul li a').click(function() {
        $(this).parents('.sgwf_come2theweb').find('.loading').show();
        $(this).parents('.sgwf_come2theweb').find('.sgwf_filter ul li a').removeClass('active');
        $(this).addClass('active');

        var tabclass = $(this).attr('data');

        // Check if Masonry is initialized before destroying it
        if (masonryGrid.data('masonry')) {
            masonryGrid.masonry('destroy');
        }

        $(this).parents('.sgwf_come2theweb').find('.sgwf_c2tw_item').hide();
        $('.' + tabclass).show();

        // Reinitialize Masonry only if the grid is present
        if (masonryGrid.length) {
            masonryGrid.masonry({
                itemSelector: '.c2twsg_mesonry_item',
                columnWidth: '.c2twsg_mesonry_item',
                percentPosition: true
            });
        }

        setTimeout(function() {
            $('.loading').fadeOut(400);
        }, 200);
    });
});

new SimpleLightbox({elements: '.sgwf_c2tw_iteminr a'});

