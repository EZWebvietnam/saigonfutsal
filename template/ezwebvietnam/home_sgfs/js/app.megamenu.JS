app.megamenu = {
    initialised: false,
    init: function () {
        var me = app.megamenu;
        me.load();
        me.bindTouchEvents();
        app.device.addSizeChangeEvent(me.load);
    },
    load: function () {
        if (app.device.sizeIs('small') || app.megamenu.initialised !== false) {
            return;
        }
        
    },
    bindTouchEvents: function () {
        $('nav > ul > li > a').on('touchstart', function (e) {
            if ($(this).attr('id') == 'morelink') {
                return;
            }
            e.preventDefault();
            e.stopPropagation();
            if ($(this).text() == 'Home') {
                window.location.href = $(this).attr('href');
                return;
            }
            $('nav > ul > li.open').each(function () {
                $(this).find('a').trigger('mouseout');
            });
            if ($(this).data('touched')) {
                window.location.href = $(this).attr('href');
            } else {
                $('nav > ul > li > a').data('touched', false);
                $(this).data('touched', true);
                $(this).trigger('mouseenter');
            }
        });
        $(document).on('touchstart', function (e) {
            var $target = $(e.target);
            if ($target.parents('div.mega-nav').length) {
                return true;
            }
            $('nav > ul > li.open > a').data('touched', false).trigger('mouseout');
        });
    }
}
$(app.megamenu.init);