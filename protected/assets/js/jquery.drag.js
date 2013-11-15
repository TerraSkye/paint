$(document).ready(function () {
    function fixHelper(e, ui) {

        var $ctr = $(this);

        ui.helper
            .addClass('mx-state-moving ui-corner-all')
            .outerWidth($ctr.outerWidth())
            .find('.mx-content-hover')
            .removeClass('mx-content-hover')
            .end();
    }

    function toggleHover(e) {

        if (e.type == 'mouseenter')
            $(this).addClass('mx-content-hover');
        else
            $(this).removeClass('mx-content-hover');

    }

    sdCfg = {
        cursor: 'move',
        zIndex: 200,
        opacity: 0.75,
        handle: '.drag-handle',
        scroll: false,
        containment: 'window',
        appendTo: document.body,
        helper: 'clone',
        start: fixHelper

    };

    $('.drag-container')
        .find('.item-wrapper').draggable({

            cursor: 'move',
            zIndex: 200,
            opacity: 0.75,
            scroll: false,
            containment: 'window',
            appendTo: document.body,
            helper: 'clone',
            connectToSortable: '.sort-container',
            start: fixHelper

        }).hover(toggleHover);

    $('.sort-container')
        .sortable({

            containment: 'parent',
            handle: '.item-container',
            tolerance: 'pointer',
            helper: 'clone',
            start: fixHelper,
            axis: 'x',
            update: function (e, ui) {

                if (ui.item.find('.drag-handle').length == 0) {
                    ui.item
                        .find('.item-container')
                        .before($('<div class="drag-handle">'))
                        .parent()
                        .draggable(sdCfg)
                        .hover(toggleHover)
                        .find('.drag-handle')
                        .hoverIntent(toggleHover);

                    $(this).sortable('option', 'containment', 'parent');
                }

            }

        }).find('.item-wrapper')
        .draggable(sdCfg)
        .hover(toggleHover)
        .find('.drag-handle')
        .hoverIntent(toggleHover);
});
