(function ($) {
    const initialize_block = function ($block) {
        const $load_more_container = $block.find('.lh-more-posts-container');

        if (
            $load_more_container.length &&
            window &&
            window.waktools &&
            window.waktools.plugins &&
            window.waktools.plugins.Lh_Ajax
        ) {
            // set up ajax
            const lh_ajax_args = {
                block: $block,
                post_container: '.lh-post-listing',
                pagination_container: '.lh-pagination-container',
            };

            const lh_ajax = new window.waktools.plugins.Lh_Ajax(lh_ajax_args);

            // set up event listeners and some interactions
            const $category_buttons = $block.find('.lh-category-button');
            const $pagination_container = $block.find('.lh-pagination-container');
            const load_more_class = '.lh-more-posts';
            const pagination_link_class = '.lh-pagination-numeric-link';

            // Category button event listener
            $category_buttons.on('click', e => {
                e.preventDefault();

                if (!$block.hasClass(lh_ajax.buttons_active_style)) {
                    return false;
                }

                const current_filter_id = $block.data('postsCategory');
                const selected_filter_id = $(e.target).data('categorySlug');

                if (selected_filter_id !== current_filter_id) {
                    lh_ajax.update_posts_by_filter(selected_filter_id);

                    // Button styles at click level not in Lh_Ajax
                    $category_buttons.removeClass('active');
                    $(e.target).addClass('active');
                }

                return false;
            });

            $pagination_container.on('click', pagination_link_class, e => {
                e.preventDefault();

                if (!$block.hasClass(lh_ajax.buttons_active_style)) {
                    return false;
                }

                const page_number = $(e.target).data('page');
                const current_filter_id = $block.data('postsCategory');

                lh_ajax.update_posts_by_pagination(page_number, current_filter_id);

                return false;
            });

            // load more link/button

            $load_more_container.on('click', load_more_class, (e) => {
                e.preventDefault();

                if (!$block.hasClass(lh_ajax.buttons_active_style)) {
                    return false;
                }

                const $element = $(e.target);
                const current_filter_id = $block.data('postsCategory');
                const page_number = $element.data('page');

                lh_ajax.update_posts_by_more(page_number, current_filter_id, $element);
            });
        }
    };

    $(function () {
        $('.lh-acf-block.lh-acf-block-post-listing').each(function () {
            initialize_block($(this));
        });
    });

    // Initialize dynamic block preview (editor).
    if (window.acf) {
        window.acf.addAction('render_block_preview/type=wak/post-listing', initialize_block);
    }
})(jQuery);
