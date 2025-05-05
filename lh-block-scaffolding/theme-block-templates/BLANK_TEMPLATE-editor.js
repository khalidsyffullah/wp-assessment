(function ($) {
    const initialize_block = function ($block) {
        // code goes here
    };

    $(function () {
        $('.lh-acf-block.lh-acf-block-{{block-slug}}').each(function () {
            initialize_block($(this));
        });
    });

    // Initialize dynamic block preview (editor).
    if (window.acf) {
        window.acf.addAction(
            'render_block_preview/type=lh/{{block-slug}}',
            initialize_block
        );
    }
})(jQuery);
