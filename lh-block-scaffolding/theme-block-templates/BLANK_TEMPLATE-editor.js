(function ($) {
    const initialize_block = function ($block) {
        // code goes here
    };

    $(function () {
        $('.wak-acf-block.wak-acf-block-{{block-slug}}').each(function () {
            initialize_block($(this));
        });
    });

    // Initialize dynamic block preview (editor).
    if (window.acf) {
        window.acf.addAction(
            'render_block_preview/type=wak/{{block-slug}}',
            initialize_block
        );
    }
})(jQuery);
