(function ($) {
    $.fn.styledForm = function () {
        var $sf = $.styledForm,
            config = $sf.config,
            $container = $(this),
            inputQuery = '',
            selectQuery;
        if (config.styledClass) {
            inputQuery = 'input.' + config.styledClass + '[type="checkbox"], input.' + config.styledClass + '[type="radio"]';
            selectQuery = 'select.' + config.styledClass;
        } else {
            inputQuery = 'input[type="checkbox"], input[type="radio"]';
            selectQuery = 'select';
        }
        var $inputs = $container.find(inputQuery);
        $.each($inputs, function (i, input) {
            var $span = $('<span>').addClass($(input).attr('type'));
            if ($(input).prop('checked')) {
                var height;
                if ($(input).attr('type') == 'checkbox') {
                    height = config.checkboxHeight;
                } else {
                    height = config.radioHeight;
                }
                $span.css('background-position', '0 -' + (height * 2) + 'px').attr('data-checked', 1);
            }
            if ($(input).attr('type') == 'radio') {
                $span.attr('data-field-name', $(input).attr('name'));
            }
            $(input).before($span);
            if ($(input).attr('disabled')) {
                $span.addClass('disabled');
            }
            $(input).css('display', 'none');
            $sf.addElement($span);
        });
        var $selects = $container.find(selectQuery);
        $.each($selects, function (i, select) {
            var $option = $(select).find('option:selected');
            var attributeName = $sf._canonicalize($(select).attr('name'));
            var $span = $('<span>', {
                "class": "select",
                "id": "styled-select-" + attributeName
            });
            var selectWidth = $(select).width() + config.selectArrowWidth;
            $span.append($option.text());
            $span.css('width', selectWidth);
            var $arrowSpan = $('<span>', {
                "class": "select-arrow"
            });
            $span.append($arrowSpan);
            $(select).before($span);
            $(select).css('width', selectWidth);
            var $p = $(select).parent();
            if (!$p.is('form')) {
                $p.css('width', selectWidth);
            }
            if ($(select).attr('disabled')) {
                $(select).prev().addClass('disabled');
            }
            $sf.addElement($span);
        });
        $container.on('change', $sf.change);
        $container.on('mousedown', $sf.beforeClick);
        $container.on('mouseup', $sf.afterClick);
        if (config.pollFrequency !== false) {
            setInterval($sf.poll, config.pollFrequency);
        }
    };
    $.styledForm = {
        config: {
            checkboxHeight: 22,
            radioHeight: 22,
            selectArrowWidth: 30,
            styledClass: '',
            pollFrequency: 1000
        },
        _elements: [],
        addElement: function ($el) {
            if (!$el instanceof jQuery) {
                $el = $($el);
            }
            this._elements.push($el);
        },
        poll: function () {
            var s = $.styledForm;
            $.each(s._elements, function (i, el) {
                var $el = $(el),
                    $input;
                if ($el.hasClass('select')) {
                    $input = $el.next('select');
                } else {
                    $input = $el.next('input');
                }
                if ($input.attr('disabled') && !$el.hasClass('disabled')) {
                    $el.addClass('disabled');
                } else if (!$input.attr('disabled') && $el.hasClass('disabled')) {
                    $el.removeClass('disabled');
                }
                if ($input.is('input[type="checkbox"]') || $input.is('input[type="radio"]')) {
                    var height = ($input.attr('type') == 'checkbox') ? s.config.checkboxHeight : s.config.radioHeight;
                    if ($input.prop('checked') && !$el.attr('data-checked')) {
                        $el.css('background-position', '0 -' + (height * 2) + 'px').attr('data-checked', 1);
                    } else if (!$input.prop('checked') && $el.attr('data-checked')) {
                        $el.css('background-position', '0 0').removeAttr('data-checked');
                    }
                }
            });
        },
        beforeClick: function (e) {
            if (e.which && e.which == 3) {
                return;
            }
            var config = $.styledForm.config;
            var $target = $(e.target);
            var $element = $target.next();
            if ($target.attr('for')) {
                $element = $('#' + $target.attr('for'));
                $target = $element.prev('span');
            }
            var type = $target.attr('class');
            if ($element.attr('disabled') || !$.styledForm._isStyledElement($element)) {
                return;
            }
            if ($.inArray(type, ['checkbox', 'radio']) !== -1) {
                var backgroundString = '0 -';
                var heightVar = (type == 'checkbox') ? config.checkboxHeight : config.radioHeight;
                var height = heightVar;
                if ($target.prop('checked')) {
                    height = heightVar * 3;
                }
                backgroundString += height + 'px';
                $target.css('background-position', backgroundString);
            }
        },
        afterClick: function (e) {
            if (e.which && e.which == 3) {
                return;
            }
            var config = $.styledForm.config;
            var $target = $(e.target);
            var $input = $target.next('input');
            if ($target.attr('for')) {
                $input = $('#' + $target.attr('for'));
                $target = $input.prev('span');
            }
            var type = $input.attr('type');
            if ($input.attr('disabled') || !$.styledForm._isStyledElement($input)) {
                return;
            }
            if (type == 'radio') {
                var $radios = $(this).find('input[type="radio"][name="' + $input.attr('name') + '"]');
                $.each($radios, function (i, radio) {
                    if (radio != $input.get().nextSibling && $(radio).prev()) {
                        $(radio).prev().css('background-position', '0 0').removeAttr('data-checked', 0);
                        $(radio).removeAttr('checked');
                    }
                });
                $target.css('background-position', '0 -' + (config.radioHeight * 2) + 'px');
                $target.attr('data-checked', 1);
                $input.prop('checked', true);
            } else if (type == 'checkbox') {
                if ($input.prop('checked')) {
                    $target.css('background-position', '0 0').removeAttr('data-checked');
                    $input.removeAttr('checked');
                } else {
                    $target.css('background-position', '0 -' + (config.checkboxHeight * 2) + 'px').attr('data-checked', 1);
                    $input.prop('checked', true);
                }
            }
        },
        change: function (e) {
            var config = $.styledForm.config;
            var $element = $(e.target);
            var type = $element.attr('type');
            if (!$.styledForm._isStyledElement($element)) {
                return;
            }
            var attributeName = $.styledForm._canonicalize($element.attr('name'));
            if (type == 'checkbox') {
                var $target = $element.parent().find('.checkbox');
                if ($element.prop('checked')) {
                    $target.css('background-position', '0 -' + (config.checkboxHeight * 2) + 'px').removeAttr('data-checked');
                    $element.removeAttr('checked');
                } else {
                    $target.css('background-position', '0 0').attr('data-checked', 1);
                    $element.prop('checked', true);
                }
            } else if (type != 'radio') {
                var $selectedOption = $element.find('option:selected');
                $(this).find('#styled-select-' + attributeName).html($selectedOption.text() + '<span class="select-arrow"></span>');
            }
        },
        _isStyledElement: function ($element) {
            var styledClass = $.styledForm.config.styledClass;
            if (styledClass) {
                return $element.hasClass(styledClass);
            }
            return true;
        },
        _canonicalize: function (string) {
            if (!string) {
                return '';
            }
            return $.trim(string.replace('[', '').replace(']', '-'));
        }
    };
})(jQuery);;
/*! http://mths.be/placeholder v2.0.7 by @mathias */
;
(function (f, h, $) {
    var a = 'placeholder' in h.createElement('input'),
        d = 'placeholder' in h.createElement('textarea'),
        i = $.fn,
        c = $.valHooks,
        k, j;
    if (a && d) {
        j = i.placeholder = function () {
            return this
        };
        j.input = j.textarea = true
    } else {
        j = i.placeholder = function () {
            var l = this;
            l.filter((a ? 'textarea' : ':input') + '[placeholder]').not('.placeholder').bind({
                'focus.placeholder': b,
                'blur.placeholder': e
            }).data('placeholder-enabled', true).trigger('blur.placeholder');
            return l
        };
        j.input = a;
        j.textarea = d;
        k = {
            get: function (m) {
                var l = $(m);
                return l.data('placeholder-enabled') && l.hasClass('placeholder') ? '' : m.value
            },
            set: function (m, n) {
                var l = $(m);
                if (!l.data('placeholder-enabled')) {
                    return m.value = n
                }
                if (n == '') {
                    m.value = n;
                    if (m != h.activeElement) {
                        e.call(m)
                    }
                } else {
                    if (l.hasClass('placeholder')) {
                        b.call(m, true, n) || (m.value = n)
                    } else {
                        m.value = n
                    }
                }
                return l
            }
        };
        a || (c.input = k);
        d || (c.textarea = k);
        $(function () {
            $(h).delegate('form', 'submit.placeholder', function () {
                var l = $('.placeholder', this).each(b);
                setTimeout(function () {
                    l.each(e)
                }, 10)
            })
        });
        $(f).bind('beforeunload.placeholder', function () {
            $('.placeholder').each(function () {
                this.value = ''
            })
        })
    }

    function g(m) {
        var l = {},
            n = /^jQuery\d+$/;
        $.each(m.attributes, function (p, o) {
            if (o.specified && !n.test(o.name)) {
                l[o.name] = o.value
            }
        });
        return l
    }

    function b(m, n) {
        var l = this,
            o = $(l);
        if (l.value == o.attr('placeholder') && o.hasClass('placeholder')) {
            if (o.data('placeholder-password')) {
                o = o.hide().next().show().attr('id', o.removeAttr('id').data('placeholder-id'));
                if (m === true) {
                    return o[0].value = n
                }
                o.focus()
            } else {
                l.value = '';
                o.removeClass('placeholder');
                l == h.activeElement && l.select()
            }
        }
    }

    function e() {
        var q, l = this,
            p = $(l),
            m = p,
            o = this.id;
        if (l.value == '') {
            if (l.type == 'password') {
                if (!p.data('placeholder-textinput')) {
                    try {
                        q = p.clone().attr({
                            type: 'text'
                        })
                    } catch (n) {
                        q = $('<input>').attr($.extend(g(this), {
                            type: 'text'
                        }))
                    }
                    q.removeAttr('name').data({
                        'placeholder-password': true,
                        'placeholder-id': o
                    }).bind('focus.placeholder', b);
                    p.data({
                        'placeholder-textinput': q,
                        'placeholder-id': o
                    }).before(q)
                }
                p = p.removeAttr('id').hide().prev().attr('id', o).show()
            }
            p.addClass('placeholder');
            p[0].value = p.attr('placeholder')
        } else {
            p.removeClass('placeholder')
        }
    }
}(this, document, jQuery));;
/*!
 * jQuery Cookie Plugin v1.3
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2011, Klaus Hartl
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.opensource.org/licenses/GPL-2.0
 */
(function ($, document, undefined) {
    var pluses = /\+/g;

    function raw(s) {
        return s;
    }

    function decoded(s) {
        return decodeURIComponent(s.replace(pluses, ' '));
    }
    var config = $.cookie = function (key, value, options) {
        if (value !== undefined) {
            options = $.extend({}, config.defaults, options);
            if (value === null) {
                options.expires = -1;
            }
            if (typeof options.expires === 'number') {
                var days = options.expires,
                    t = options.expires = new Date();
                t.setDate(t.getDate() + days);
            }
            value = config.json ? JSON.stringify(value) : String(value);
            return (document.cookie = [encodeURIComponent(key), '=', config.raw ? value : encodeURIComponent(value), options.expires ? '; expires=' + options.expires.toUTCString() : '', options.path ? '; path=' + options.path : '', options.domain ? '; domain=' + options.domain : '', options.secure ? '; secure' : ''].join(''));
        }
        var decode = config.raw ? raw : decoded;
        var cookies = document.cookie.split('; ');
        for (var i = 0, l = cookies.length; i < l; i++) {
            var parts = cookies[i].split('=');
            if (decode(parts.shift()) === key) {
                var cookie = decode(parts.join('='));
                return config.json ? JSON.parse(cookie) : cookie;
            }
        }
        return null;
    };
    config.defaults = {};
    $.removeCookie = function (key, options) {
        if ($.cookie(key) !== null) {
            $.cookie(key, null, options);
            return true;
        }
        return false;
    };
})(jQuery, document);;
if (!jQuery.support.cors && jQuery.ajaxTransport && window.XDomainRequest) {
    var httpRegEx = /^https?:\/\//i;
    var getOrPostRegEx = /^get|post$/i;
    var sameSchemeRegEx = new RegExp('^' + location.protocol, 'i');
    var htmlRegEx = /text\/html/i;
    var jsonRegEx = /\/json/i;
    var xmlRegEx = /\/xml/i;
    jQuery.ajaxTransport('text html xml json', function (options, userOptions, jqXHR) {
        if (options.crossDomain && options.async && getOrPostRegEx.test(options.type) && httpRegEx.test(options.url) && sameSchemeRegEx.test(options.url)) {
            var xdr = null;
            var userType = (userOptions.dataType || '').toLowerCase();
            return {
                send: function (headers, complete) {
                    xdr = new XDomainRequest();
                    if (/^\d+$/.test(userOptions.timeout)) {
                        xdr.timeout = userOptions.timeout;
                    }
                    xdr.ontimeout = function () {
                        complete(500, 'timeout');
                    };
                    xdr.onload = function () {
                        var allResponseHeaders = 'Content-Length: ' + xdr.responseText.length + '\r\nContent-Type: ' + xdr.contentType;
                        var status = {
                            code: 200,
                            message: 'success'
                        };
                        var responses = {
                            text: xdr.responseText
                        };
                        try {
                            if (userType === 'html' || htmlRegEx.test(xdr.contentType)) {
                                responses.html = xdr.responseText;
                            } else if (userType === 'json' || (userType !== 'text' && jsonRegEx.test(xdr.contentType))) {
                                try {
                                    responses.json = jQuery.parseJSON(xdr.responseText);
                                } catch (e) {
                                    status.code = 500;
                                    status.message = 'parseerror';
                                }
                            } else if (userType === 'xml' || (userType !== 'text' && xmlRegEx.test(xdr.contentType))) {
                                var doc = new ActiveXObject('Microsoft.XMLDOM');
                                doc.async = false;
                                try {
                                    doc.loadXML(xdr.responseText);
                                } catch (e) {
                                    doc = undefined;
                                }
                                if (!doc || !doc.documentElement || doc.getElementsByTagName('parsererror').length) {
                                    status.code = 500;
                                    status.message = 'parseerror';
                                    throw 'Invalid XML: ' + xdr.responseText;
                                }
                                responses.xml = doc;
                            }
                        } catch (parseMessage) {
                            throw parseMessage;
                        } finally {
                            complete(status.code, status.message, responses, allResponseHeaders);
                        }
                    };
                    xdr.onprogress = function () {};
                    xdr.onerror = function () {
                        complete(500, 'error', {
                            text: xdr.responseText
                        });
                    };
                    var postData = '';
                    if (userOptions.data) {
                        postData = (jQuery.type(userOptions.data) === 'string') ? userOptions.data : jQuery.param(userOptions.data);
                    }
                    xdr.open(options.type, options.url);
                    xdr.send(postData);
                },
                abort: function () {
                    if (xdr) {
                        xdr.abort();
                    }
                }
            };
        }
    });
};
var app = {
    init: function () {
        app.initTypekit();
        app.initCountrySelect();
        app.initSiteSearch();
        app.initQuickLinks();
        app.initFeatures();
        app.initNthChild();
        app.initCookieHeader();
        $.styledForm.config.styledClass = 'styled';
    },
    initTypekit: function () {
        if ($('html').hasClass('wf-inactive')) {
            Typekit.load();
        }
    },
    initNthChild: function () {
        $('aside .article-list li:nth-child(even), .promo-article li:nth-child(even)').addClass('even');
    },
    initCountrySelect: function () {
        $("#country-select").find("a").first().on('click', function (e) {
            e.preventDefault();
            var $el = $(e.target);
            if ($el.hasClass('open')) {
                $el.parent().stop(true, true).animate({
                    'height': '44px',
                    useTranslate3d: true
                }, 200, function () {
                    $el.removeClass('open');
                });
            } else {
                $el.addClass('open').parent().stop(true, true).animate({
                    'height': '220px',
                    useTranslate3d: true
                }, 200);
            }
        });
        $('body').on('click', function (e) {
            if (!$(e.target).parents('#country-select').length) {
                var $el = $('#country-select');
                $el.animate({
                    'height': '44px',
                    useTranslate3d: true
                }, 200, function () {
                    $el.find('a').removeClass('open');
                });
            }
        });
    },
    initFeatures: function () {
        $('.feature').not('.mega-nav .feature').on({
            mouseenter: function () {
                var h4Height = $(this).find('h4').outerHeight();
                $(this).find('.reveal').css('bottom', h4Height);
                if (!app.device.sizeIs('small')) {
                    $(this).find('.reveal').stop(true, true).animate({
                        'height': '280px'
                    }, 10);
                }
            },
            mouseleave: function () {
                if (!app.device.sizeIs('small')) {
                    $(this).find('.reveal').stop(true, true).animate({
                        'height': '0px'
                    }, 10);
                }
            }
        });
    },
    initQuickLinks: function () {
        var $quickLinks = $('#quick-links');
        var $quickLinksHeight = $quickLinks.find('li').size();
        $quickLinks.on('click', function (e) {
            if (!app.device.sizeIs('medium', 'small')) {
                return;
            }
            var $el = $(e.target);
            if (!$el.is('a')) {
                return;
            }
            var $wrap = $el.closest('ul');
            if (!$wrap.hasClass('open')) {
                e.preventDefault();
                $wrap.addClass('open').animate({
                    'height': $quickLinksHeight * 44
                }, 200);
            }
        });
        $('body').on('click', function (e) {
            if (!$(e.target).parents('#quick-links').length || $(e.target).is('.open.hidden')) {
                $('#quick-links').animate({
                    'height': '43px'
                }, 200, function () {
                    $(this).removeClass('open');
                });
            }
        });
    },
    initSiteSearch: function () {
        var fullWidth, $search = $('#site-search');
        if (app.device.sizeIs('small')) {
            fullWidth = 300;
        } else {
            fullWidth = 415;
        }
        $search.on('click', function (e) {
            if ($(e.target).hasClass('search')) {
                openSearch(e);
            } else if ($(e.target).attr('type') == 'reset') {
                closeSearch(e);
            }

            function openSearch(e) {
                e.preventDefault();
                var $el = $(e.target);
                $search.find('#search-field').get(0).focus();
                if ($el.hasClass('open')) {
                    $el.parent().find('form').submit();
                } else {
                    $search.find("form").css('z-index', '99');
                    $el.addClass('open').parent().stop(true, true).animate({
                        width: fullWidth + 'px',
                        useTranslate3d: true
                    }, 'fast');
                }
            }
        });
        $('body').on('click', function (e) {
            var isOpen = $('#site-search').find('a.open').length;
            if (!$(e.target).parents('#site-search').length && isOpen) {
                closeSearch();
            }
        });

        function closeSearch(e) {
            var initialWidth;
            var $searchField = $search.find('#search-field');
            if ($searchField.length) {
                $searchField.get(0).blur();
            }
            if (typeof e != 'undefined') {
                e.preventDefault();
            }
            if (app.device.sizeIs('small')) {
                initialWidth = 49;
            } else {
                initialWidth = 115;
            }
            $search.find('input[type="reset"]').parent().parent().stop(true, true).animate({
                width: initialWidth + 'px',
                useTranslate3d: true
            }, 'fast', function () {
                $search.find("a").removeClass('open');
                $search.find("form").css('z-index', '98');
            });
        }
        $search.find('form').on('submit', function (e) {
            if (!$('#search-field').val()) {
                e.preventDefault();
            }
        });
        app.device.addSizeChangeEvent(closeSearch);
    },
    formatNumberForDate: function (n) {
        return ('0' + n).slice(-2);
    },
    remove: function (array, from, to) {
        var rest = array.slice((to || from) + 1 || array.length);
        array.length = from < 0 ? array.length + from : from;
        return array.push.apply(array, rest);
    },
    isJuniorGunners: function () {
        return $('body').hasClass('junior-gunners');
    },
    reduceSidebar: function () {
        if (app.device.sizeIs('small', 'medium')) {
            return;
        }
        var $wrapper = $('#wrapper');
        var $content = $('#content');
        if (!$wrapper.length || !$content.length) return;
        if ($wrapper.hasClass('no-reduction') || ($wrapper.hasClass('homepage') && !app.isJuniorGunners())) {
            return;
        }
        var wrapperHeight = $wrapper.height();
        var contentHeight = $content.height();
        if ($wrapper.find('#arsenal-player-carousel')) {
            wrapperHeight -= $wrapper.find('#arsenal-player-carousel').height();
        }
        var heightDiff = wrapperHeight - contentHeight;
        if (heightDiff > 350) {
            if (app.isJuniorGunners() && $wrapper.hasClass('homepage')) {
                var removeRules = ['.ad-small', '.ad-tall'];
            } else {
                var removeRules = ['.feature:eq(1)', '.feature:eq(0)', '.ad-small', '.ad-tall', 'li.primary:eq(1)', 'li.primary:eq(0)'];
            }
            $.each(removeRules, function (i, r) {
                var $el = $wrapper.find(r);
                if ($el.parent().hasClass('widget')) {
                    $el.parent().remove();
                } else {
                    $el.remove();
                }
                if (!$wrapper.find('.feature').length) {
                    $wrapper.find('aside.sidebar > div.widgets > h2').remove();
                }
                return (($wrapper.height() - $content.height()) > 300);
            });
        }
    },
    initCookieHeader: function () {
        if (null === $.cookie('arsenal-cookie-warning')) {
            var $cookieWrap = $('#cookie-wrapper');
            $cookieWrap.slideDown('fast');
            $cookieWrap.find('.cookie-close').on('click', function (e) {
                e.preventDefault();
                $cookieWrap.slideUp('fast');
            });
            var domainName = window.location.hostname;
            domainName = domainName.split(/\.(.+)?/)[1];
            $.cookie('arsenal-cookie-warning', '1', {
                path: '/',
                domain: domainName,
                expires: 1095
            });
        }
    }
};
$(app.init);;
app.date = {
    getCurrentDayOfYear: function () {
        var date = new Date();
        var date2 = new Date(date.getFullYear(), 0, 2);
        return Math.ceil((date - date2) / 86400000);
    }
};;
app.user = {
    isLoggedIn: function () {
        return ($.cookie('userloggedin') !== null);
    },
    hasRememberMe: function () {
        return ($.cookie('remember_me') !== null);
    }
};;
app.device = {
    size: null,
    onSizeChange: [],
    onOrientationChange: [],
    init: function () {
        var me = app.device;
        me.updateSize();
        me.initSizeListener();
        me.initOrientationListener();
    },
    addSizeChangeEvent: function (func) {
        if (!typeof func == 'function') {
            return;
        }
        var event = {};
        event.func = func;
        event.args = [];
        $.each(Array.prototype.slice.call(arguments), function (i, arg) {
            if (i === 0) return;
            event.args.push(arg);
        });
        app.device.onSizeChange.push(event);
    },
    addOrientationChangeEvent: function (func) {
        if (!typeof func == 'function') {
            return;
        }
        var event = {};
        event.func = func;
        event.args = [];
        $.each(Array.prototype.slice.call(arguments), function (i, arg) {
            if (i === 0) return;
            event.args.push(arg);
        });
        app.device.onOrientationChange.push(event);
    },
    runSizeChangeEvents: function () {
        $.each(app.device.onSizeChange, function (i, eventObj) {
            if (typeof eventObj.func == 'function') {
                eventObj.func.apply(this, eventObj.args);
            }
        });
    },
    runOrientationChangeEvents: function () {
        $.each(app.device.onOrientationChange, function (i, eventObj) {
            if (typeof eventObj.func == 'function') {
                eventObj.func.apply(this, eventObj.args);
            }
        });
    },
    getSize: function () {
        if (null === this.size) {
            this.updateSize();
        }
        return this.size;
    },
    getOrientation: function () {
        if (window.orientation === 0) {
            return 'portrait';
        }
        return 'landscape';
    },
    getWidth: function () {
        return $(window).width();
    },
    getHeight: function () {
        return $(window).height();
    },
    sizeIs: function () {
        return ($.inArray(this.getSize(), arguments) !== -1);
    },
    updateSize: function () {
        var newSize;
        switch (true) {
        case (Modernizr.mq('only screen and (max-width:767px)')):
            newSize = 'small';
            break;
        case (Modernizr.mq('(min-width:768px) and (max-width:990px)')):
            newSize = 'medium';
            break;
        default:
            newSize = 'large';
        }
        var fire = newSize != app.device.size;
        app.device.size = newSize;
        if (fire) {
            app.device.runSizeChangeEvents();
        }
    },
    initSizeListener: function () {
        $(window).resize(this.updateSize);
    },
    initOrientationListener: function () {
        $(window).on('orientationchange', app.device.runOrientationChangeEvents);
    },
    getScrollTop: function () {
        return document.documentElement.scrollTop || document.body.scrollTop;
    },
    getScrollLeft: function () {
        return document.documentElement.scrollLeft || document.body.scrollLeft;
    },
    getViewport: function () {
        return {
            height: document.documentElement.clientHeight,
            width: document.documentElement.clientWidth
        };
    },
    isWindows: function () {
        return ($.inArray(window.navigator.platform, ['Win32', 'Win64', 'WOW64']) !== -1);
    },
    isIE7: function () {
        return $('html').hasClass('ie7');
    },
    isIE8: function () {
        return $('html').hasClass('ie8');
    },
    hasTouch: function () {
        if (this.isWindows() && navigator.userAgent.indexOf('Chrome') !== false) {
            return false;
        }
        return !!('onmsgesturechange' in window) || Modernizr.touch;
    },
    hasCors: function () {
        return Modernizr.cors;
    },
    supportsOptaWidgets: function () {
        var d = app.device;
        return d.sizeIs('large', 'medium') && !d.isIE7() && !d.isIE8();
    }
};
$(app.device.init);;
app.menu = {
    init: function () {
        var me = app.menu;
        me.initLargeNav();
        me.initFeatureNav();
        me.initMediumNav();
        me.initSmallNav();
        if (app.device.sizeIs('small')) {
            setTimeout(me.initMainNavItems, 750);
        }
        app.device.addSizeChangeEvent(me.initMainNavItems);
        app.device.addOrientationChangeEvent(me.onOrientationChange);
        $(window).resize(me.handleHiddenNavClasses);
    },
    initLargeNav: function () {
        $('.mega-nav').hide();
        $('header nav > ul > li').on({
            mouseenter: function () {
                if (app.device.sizeIs('large', 'medium')) {
                    $(this).addClass('open');
                    $(this).children().next().delay(200).show(10);
                }
            },
            mouseleave: function () {
                if (app.device.sizeIs('large', 'medium')) {
                    $(this).removeClass('open');
                    $(this).children().next().stop().hide();
                }
            }
        });
        app.device.addSizeChangeEvent(function () {
            if (app.device.sizeIs('large')) {
                $('#morelink').closest('nav').css('height', '61px');
            }
        });
    },
    initFeatureNav: function () {
        $('.mega-nav .feature').on({
            mouseenter: function () {
                var h4Height = $(this).find('h4').outerHeight();
                $(this).find('.reveal').css('bottom', h4Height);
                if (app.device.sizeIs('large', 'medium')) {
                    $(this).find('.reveal').stop(true, true).animate({
                        'height': '187px'
                    }, 10);
                }
            },
            mouseleave: function () {
                if (app.device.sizeIs('large', 'medium')) {
                    $(this).find('.reveal').stop(true, true).animate({
                        'height': '0px'
                    }, 10);
                }
            }
        });
    },
    initMediumNav: function () {
        $('#morelink').on('click', function (e) {
            if (!app.device.sizeIs('medium')) {
                return;
            }
            e.preventDefault();
            if ($(this).parent().hasClass('clicked')) {
                slideNavLeft();
            } else {
                slideNavRight();
            }
        });

        function slideNavLeft() {
            var margin = 0;
            if (app.device.sizeIs('medium')) {
                margin = (app.isJuniorGunners()) ? 107 : 78;
            }
            var $li = $('#morelink').parent();
            $li.removeClass('clicked').parent().stop(true, true).animate({
                'margin-left': margin + 'px',
                useTranslate3d: true
            }, 200);
            $li.parent().parent().css('height', 64);
        }

        function slideNavRight() {
            var margin = (app.isJuniorGunners()) ? -240 : -370;
            $('#morelink').parent().addClass('clicked').parent().stop(true, true).animate({
                'margin-left': margin + 'px',
                useTranslate3d: true
            }, 200);
        }
        app.device.addSizeChangeEvent(slideNavLeft);
    },
    initSmallNav: function () {
        $('#morelink').on('click', function (e) {
            if (!app.device.sizeIs('small')) {
                return;
            }
            e.preventDefault();
            if ($(this).parent().hasClass('clicked')) {
                collapseNav();
            } else {
                expandNav();
            }
        });

        function collapseNav() {
            var options = {
                useTranslate3d: true
            };
            if (app.device.sizeIs('small')) {
                options.height = '50px';
            }
            $('#morelink').parent().removeClass('clicked').parent().parent().stop(true, true).animate(options, 200);
        }

        function expandNav() {
            $('#morelink').parent().addClass('clicked').parent().parent().stop(true, true).animate({
                'height': '235px',
                useTranslate3d: true
            }, 200);
        }
        app.device.addSizeChangeEvent(collapseNav);
    },
    handleHiddenNavClasses: function () {
        if (!app.device.sizeIs('small')) {
            return;
        }
        var width = $(window).width();
        var lastVisibleElement;
        $('header nav > ul > li').each(function () {
            var $this = $(this);
            var rightEdge = $this.data('right-edge');
            if (rightEdge < width) {
                lastVisibleElement = $this;
            }
        });
        if (!lastVisibleElement) {
            return;
        }
        lastVisibleElement.removeClass('small-nav-link').prevAll('li').removeClass('small-nav-link');
        lastVisibleElement.nextAll('li').addClass('small-nav-link');
    },
    initMainNavItems: function () {
        if (app.device.sizeIs('small')) {
            var currentRightPosition = 0;
            $('header nav > ul > li').each(function () {
                var $this = $(this);
                currentRightPosition += $this.outerWidth();
                $this.data('right-edge', currentRightPosition);
            });
            app.menu.handleHiddenNavClasses();
        }
    },
    onOrientationChange: function () {
        if (!app.device.sizeIs('medium') || app.device.getOrientation() == 'portrait') {
            return;
        }
        var marginLeft = app.isJuniorGunners() ? 32 : 78;
        $('header nav > ul').css('margin-left', marginLeft);
        $('a#morelnk').parent().removeClass('clicked');
    }
}
$(app.menu.init);;
app.image = {
    init: function () {
        this.initImageOfTheDay();
    },
    initImageOfTheDay: function () {
        $('#image-of-the-day').magnificPopup({
            mainClass: 'my-mfp-zoom-in',
            removalDelay: 300,
            delegate: 'a',
            type: 'image',
            gallery: {
                enabled: true,
                tLoading: 'Loading image #%curr%...',
                navigateByImgClick: true,
                preload: [0, 2]
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                verticalFit: true
            }
        });
    }
};
$(function () {
    app.image.init();
});;
app.social = {
    init: function () {
        app.social.initPlugins();
        app.social.replaceTwitterPlaceholders();
    },
    initPlugins: function () {
        var facebook = function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
            fjs.parentNode.insertBefore(js, fjs);
        }
        facebook(document, 'script', 'facebook-jssdk');
        ! function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (!d.getElementById(id)) {
                js = d.createElement(s);
                js.id = id;
                js.src = "//platform.twitter.com/widgets.js";
                fjs.parentNode.insertBefore(js, fjs);
            }
        }(document, "script", "twitter-wjs");
    },
    replaceTwitterPlaceholders: function () {
        var $tweets = $('div.tweet');
        if ($tweets.length) {
            var now = new Date();
            $.each($tweets, function (i, el) {
                var timeString = '';
                var timeDiff = {
                    days: 0,
                    hours: 0
                };
                var $el = $(el);
                var tweetTime = $el.attr('data-module-timestamp') * 1000;
                var diff = (now - tweetTime) / 1000;
                var hours = diff / 3600;
                if (hours >= 24) {
                    var days = Math.round(hours / 24);
                    timeDiff.days = days;
                    hours -= (days * 24);
                }
                if (hours < 1 && hours > 0) hours = 1;
                timeDiff.hours = Math.round(hours);
                if (timeDiff.days > 0) {
                    timeString += timeDiff.days + 'd ';
                }
                if (timeDiff.hours > 0) {
                    timeString += timeDiff.hours + 'h ';
                }
                $el.find('.time').text(timeString);
            });
        }
    }
};
$(app.social.init);;
app.auth = {
    init: function () {
        app.auth.resetForDigitalMembership();
        app.auth.bindButtonEvents();
        app.auth.updateHeader();
    },
    resetForDigitalMembership: function () {
        var digitalCookie = $.cookie('digital_membership');
        if (digitalCookie === null) {
            var domainName = window.location.hostname;
            domainName = domainName.split(/\.(.+)?/)[1];
            var cookieSettings = {
                path: '/',
                domain: domainName,
                secure: false
            };
            $.removeCookie('live_logged_in', cookieSettings);
            $.removeCookie('userloggedin', cookieSettings);
            $.removeCookie('guid', cookieSettings);
            $.removeCookie('memberhash', cookieSettings);
            $.removeCookie('USERTYPE', cookieSettings);
            $.removeCookie('VLUID', cookieSettings);
            $.removeCookie('identifier', cookieSettings);
            $.removeCookie('remember_me', cookieSettings);
            $.removeCookie('player_subscription', cookieSettings);
            $.removeCookie('ATVOHash', cookieSettings);
            $.removeCookie('ATVOEmail', cookieSettings);
            $.removeCookie('user_forename', cookieSettings);
            $.removeCookie('venda', cookieSettings);
            $.removeCookie('sso', cookieSettings);
            $.cookie('digital_membership', '1', {
                path: '/',
                domain: domainName,
                expires: 3650
            });
        }
    },
    run: false,
    baseDomain: '',
    fromApp: false,
    updateHeader: function () {
        if (app.user.isLoggedIn() || app.user.hasRememberMe()) {
            var name = $.cookie('user_forename');
            if (null === name) name = '';
            var msg = '<span>Welcome back </span>';
            $('#login-btn').hide();
            $('#register-btn').hide();
            $('#manage-btn').show().html(msg + name);
            $('#logout-btn').show();
            app.formlib.showLoginOnlyForms();
            if (window.location.hash == '#registered') {
                if (!app.device.isIE7() && !app.device.isIE8()) {
                    window.location.hash = '';
                }
                if (null !== history) {
                    if (typeof history.replaceState === 'function') {
                        history.replaceState('', document.title, window.location.pathname);
                    }
                }
                app.auth.showRegisterNotification();
            }
        } else {
            $('#login-btn').show();
            $('#register-btn').show();
            $('#manage-btn').hide().html('');
            $('#logout-btn').hide();
            if (window.location.hash == '#signup') {
                if (!app.device.isIE7() && !app.device.isIE8()) {
                    window.location.hash = '';
                }
                if (null !== history) {
                    if (typeof history.replaceState === 'function') {
                        history.replaceState('', document.title, window.location.pathname);
                    }
                }
                app.auth.showLightbox('login');
            }
            if (window.location.hash == '#iphoneauth') {
                if (!app.device.isIE7() && !app.device.isIE8()) {
                    window.location.hash = '';
                }
                if (null !== history) {
                    if (typeof history.replaceState === 'function') {
                        history.replaceState('', document.title, window.location.pathname);
                    }
                }
                app.auth.fromApp = true;
                app.auth.showLightbox('login');
            }
            if (window.location.hash == '#forgottenpassword') {
                if (!app.device.isIE7() && !app.device.isIE8()) {
                    window.location.hash = '';
                }
                if (null !== history) {
                    if (typeof history.replaceState === 'function') {
                        history.replaceState('', document.title, window.location.pathname);
                    }
                }
                app.auth.showLightbox('forgot-password');
            }
        }
    },
    showRegisterNotification: function () {
        var juniorMember = ($('body').hasClass('junior-gunners')) ? 'Junior Gunners' : '';
        $('<div>', {
            'id': 'dm-notification',
            'html': '<div class="message"><span class="success">You are now a ' + juniorMember + ' Digital Member.</span><span class="divider"></span><a class="benefits">What benefits do you get with Arsenal Digital Membership?</a> <a class="hide">Hide</a></div>'
        }).prependTo('body');
        var $notification = $('#dm-notification');
        $notification.find('.benefits').on('click', function (e) {
            e.preventDefault();
            app.auth.showLightbox('benefits');
        });
        $notification.find('.hide').on('click', function (e) {
            e.preventDefault();
            $('#dm-notification').slideUp();
        });
    },
    bindButtonEvents: function () {
        $('#login-btn').on('click', function (e) {
            e.preventDefault();
            app.auth.showLightbox('login');
        });
        $('div.errors span a.red-btn').on('click', function (e) {
            e.preventDefault();
            app.auth.showLightbox('login');
        });
        $('#register-btn').on('click', function (e) {
            e.preventDefault();
            app.auth.showLightbox('register');
        });
        $('a.forgot-btn').on('click', function (e) {
            e.preventDefault();
            app.auth.showLightbox('forgot-password');
        });
        $('#logout-btn').on('click', app.auth.logout);
    },
    showLightbox: function (opt) {
        var me = app.auth;
        $.magnificPopup.open({
            mainClass: 'my-mfp-zoom-in',
            removalDelay: 300,
            items: {
                src: '#digital-membership',
                type: 'inline'
            },
            callbacks: {
                beforeOpen: function () {
                    switch (opt) {
                    case 'benefits':
                        me.showBenefits();
                        break;
                    case 'register':
                        me.showRegister();
                        break;
                    case 'forgot-password':
                        me.showForgotPassword();
                        break;
                    default:
                        me.showLogin();
                    }
                },
                open: function () {
                    if (app.auth.run === false) {
                        me.register.initRegistrationForm();
                        me.register.bindRegistrationEvents();
                        me.initLogin();
                        me.bindLoginEvents();
                        me.bindForgotPasswordEvents();
                        me.applyStyledInput();
                        app.auth.run = true;
                    }
                },
                close: function () {
                    app.auth.resetForms();
                }
            }
        });
    },
    resetForms: function () {
        var $registerForm = $('#dm-register form')[0];
        $registerForm.reset();
        $('select', $registerForm).trigger('change');
    },
    showLogin: function (e) {
        _gaq.push(['_trackEvent', 'Digital Membership', 'View Login']);
        if (typeof e != 'undefined') {
            e.preventDefault();
        }
        $('#digital-membership > div').removeClass('active');
        $('#dm-login').addClass('active');
    },
    showRegister: function (e) {
        _gaq.push(['_trackEvent', 'Digital Membership', 'View Register']);
        if (typeof e != 'undefined') {
            e.preventDefault();
        }
        $('#digital-membership > div').removeClass('active');
        $('#dm-register').addClass('active');
    },
    showBenefits: function (e) {
        _gaq.push(['_trackEvent', 'Digital Membership', 'View Benefits']);
        if (typeof e != 'undefined') {
            e.preventDefault();
        }
        $('#digital-membership > div').removeClass('active');
        $('#dm-benefits').addClass('active');
    },
    hideLightbox: function () {
        $.magnificPopup.close();
    },
    applyStyledInput: function () {
        var sClass = 'styled';
        var $lightbox = $('#digital-membership');
        $lightbox.find('#check-remember').addClass(sClass);
        $lightbox.find('#login-title').addClass(sClass);
        $lightbox.find('#login-day').addClass(sClass);
        $lightbox.find('#login-month').addClass(sClass);
        $lightbox.find('#login-year').addClass(sClass);
        $lightbox.find('#login-country').addClass(sClass);
        $lightbox.find('#login-terms').addClass(sClass);
        $lightbox.find('#dp_first_party').addClass(sClass);
        $lightbox.find('#dp_second_party').addClass(sClass);
        $lightbox.find('#dp_third_party').addClass(sClass);
        $lightbox.find('#check-register-remember').addClass(sClass);
        $lightbox.styledForm();
    },
    initLogin: function () {
        var $login = $('#dm-login');
        $login.find('form').submit(function (e) {
            e.preventDefault();
            app.auth.clearErrors();
            var data = $(this).serialize();
            if (!$login.find('#username').val() || !$login.find('#password').val()) {
                app.auth.displayErrors(['Vui lòng điền email và password']);
                return;
            }
            var loginUrl = base_url+'/dang-nhap';
            var opts = {
                type: 'post',
                url: loginUrl,
                data: data,
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                        window.location.reload();
                    } else if (data.messages) {
                        app.auth.displayErrors(data.messages);
                    }
                },
                error: function (jqXHR) {
                    if (jqXHR.status == 0) {
                        opts.crossDomain = false;
                        opts.url = loginUrl;
                        opts.error = function () {
                            app.auth.displayErrors(['An unknown error was encountered']);
                        };
                        $.ajax(opts);
                    } else {
                        app.auth.displayErrors(['An unknown error was encountered']);
                    }
                }
            };
            
            $.ajax(opts);
        });
        $login.find('input').placeholder();
    },
    logout: function (e) {
        if (typeof e != 'undefined') {
            e.preventDefault();
        }
        $.ajax({
            url: '/auth/logout',
            success: function () {
                window.location.reload();
            }
        });
    },
    clearErrors: function () {
        $('#dm-login').find('.error-row').remove();
    },
    displayErrors: function (messages) {var $loginForm = $('#dm-login').find('form');
        var $loginErrors;		
        if (messages[0] == 'L') {
            $loginErrors = $('<div>', {
                'class': 'row error-row email-not-found'
            });
            $loginErrors.append('<h4>Email không tồn tại</h4><p>Vui lòng đăng ký một tài khoản mới</p>').prependTo($loginForm).off('click', 'a').on('click', 'a', app.auth.showRegister);
        } else {
            $loginErrors = $('<div>', {
                'class': 'row error-row'
            });
            if (messages[0] == 'P') {
                $loginErrors.append('<p>Password của bạn không chính xác. Nếu quên password Click Quên mật khẩu? ' + ' để khôi phục lại password </p>').prependTo($loginForm).off('click', 'a').on('click', 'a.register-link', app.auth.showRegister);
            } else {
                $.each(messages, function (i, m) {
                    $loginErrors.append($('<p>', {
                        'html': m
                    }));
                });
            }
            $loginErrors.prependTo($loginForm);
        }
    },
    bindLoginEvents: function () {
        var $lightbox = $('.mfp-content');
        $lightbox.find('.bind-back').on('click', app.auth.hideLightbox);
        $lightbox.find('.bind-register').on('click', app.auth.showRegister);
        $lightbox.find('.bind-benefits').on('click', app.auth.showBenefits);
        $lightbox.find('.bind-forgot').on('click', app.auth.showForgotPassword);
        $('#dm-register').on('click', 'a.bind-forgot', app.auth.showForgotPassword);
    },
    showForgotPassword: function (hideOthers) {
        hideOthers = typeof hideOthers === 'boolean' ? hideOthers : true;
        _gaq.push(['_trackEvent', 'Digital Membership', 'View Forgot Password']);
        if (typeof e != 'undefined') {
            e.preventDefault();
        }
        if (true === hideOthers) {
            $('#digital-membership > div').removeClass('active');
        }
        $('#dm-forgot').addClass('active');
    },
    showForgotPasswordComplete: function () {
        $('#digital-membership > div').removeClass('active');
        $('#dm-forgot-confirmation').addClass('active');
    },
    bindForgotPasswordEvents: function (successCallback) {
        successCallback = typeof successCallback == 'function' ? successCallback : app.auth.showForgotPasswordComplete;
        var $forgot = $('#dm-forgot');
        var translations = app.auth.translations.forgotpassword;
        $forgot.find('form').submit(function (e) {
            e.preventDefault();
            app.auth.clearForgotPasswordErrors();
            if (!$forgot.find('#forgot-password-email').val()) {
                app.auth.displayForgotPasswordErrors([translations.missing_email_message]);
                return;
            }
            var forgotUrl = '/auth/forgot-password';
            var opts = {
                type: 'post',
                url: forgotUrl,
                data: $(this).serialize(),
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                        successCallback();
                    } else if (data.messages && data.messages.length) {
                        app.auth.displayForgotPasswordErrors(data.messages);
                    } else {
                        var errorMessages = [translations.unknown_user_message];
                        app.auth.displayForgotPasswordErrors(errorMessages);
                    }
                },
                error: function (jqXHR) {
                    var errorMessage = app.auth.translations.registration.registration.unknown_error_message;
                    if (jqXHR.status == 0) {
                        opts.crossDomain = false;
                        opts.url = forgotUrl;
                        opts.error = function () {
                            app.auth.displayErrors([errorMessage]);
                        };
                        $.ajax(opts);
                    } else {
                        app.auth.displayErrors([errorMessage]);
                    }
                }
            };
            if (app.device.hasCors()) {
                opts.url = app.auth.baseDomain + forgotUrl;
                opts.crossDomain = true;
                opts.xhrFields = {
                    withCredentials: true
                };
            }
            $.ajax(opts);
        });
    },
    displayForgotPasswordErrors: function (messages) {
        var $forgotForm = $('#dm-forgot').find('form');
        var $forgotErrors = $('<div>', {
            'class': 'row error-row'
        });
        $.each(messages, function (i, m) {
            $forgotErrors.append($('<p>', {
                'html': m
            }));
        });
        $forgotErrors.prependTo($forgotForm);
    },
    clearForgotPasswordErrors: function () {
        $('#dm-forgot').find('.error-row').remove();
    }
};
$(app.auth.init);;
app.auth.register = {
    getRegisterTab: function () {
        return $('#dm-register');
    },
    formIsValid: function ($register) {
        window.location.hash = '';
        var elements = $register.find('input:visible, select');
        var isValid = true;
        $.each(elements, function (i, e) {
            var $label = $(e).closest('.login-row').find('label');
            if ($label.hasClass('required')) {
                if ($(e).attr('data-required-dependency') !== undefined) {
                    isValid = true;
                } else if ($(e).prop('tagName') == 'SELECT') {
                    isValid = !!$(e).find('option:selected').attr('value');
                } else {
                    isValid = !!$(e).val();
                }
                if (!isValid) {
                    $(e).addClass('error');
                    return false;
                }
            }
            return true;
        });
        app.auth.register.clearErrors();
        if (!isValid) {
            var $registerForm = app.auth.register.getRegisterTab().find('form');
            var $registerErrors = $('<div>', {
                'class': 'row error-row'
            });
            $registerErrors.append($('<p>', {
                'html': app.auth.translations.registration.mandatory_fields_message
            }));
            $registerErrors.prependTo($registerForm);
            window.location.hash = 'dm-register';
        }
        return isValid;
    },
    bindRegistrationEvents: function () {
        var me = app.auth.register;
        var $register = me.getRegisterTab();
        $register.find('#login-country').change(function () {
            if ($(this).val() != 232) {
                $('#login-postcode').val('').parent().hide();
            } else {
                $('#login-postcode').parent().show();
            }
        });
        $register.find('#login-day, #login-month, #login-year').change(function () {
            var today = new Date();
            var birthDate = new Date($register.find('#login-year').val(), $register.find('#login-month').val() - 1, $register.find('#login-day').val(), 0, 0, 0, 0);
            var age = today.getFullYear() - birthDate.getFullYear();
            var month = today.getMonth() - birthDate.getMonth();
            if (month < 0 || (month === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            if (age <= 12) {
                $('#junior-register-message').show();
            } else {
                $('#junior-register-message').hide();
            }
        });
    },
    initRegistrationForm: function () {
        var translations = app.auth.translations.registration;
        var $register = app.auth.register.getRegisterTab();
        $register.find('form').submit(function (e) {
			
            e.preventDefault();
            app.auth.register.clearErrors();
            var registerUrl = base_url+'/auth/register';
            if (true === app.auth.register.formIsValid($register)) {
                if (!$register.find('#login-terms:checked').length) {
                    app.auth.register.displayErrors(translations.missing_terms_and_conditions);
                    $register.find('#login-terms').addClass('error');
                } else {
                    var rememberMe = $(this).parent().find('#check-register-remember').prop('checked') ? 1 : 0;
                    var opts = {
                        url: registerUrl,
                        type: 'post',
                        data: $(this).serialize() + '&remember_me=' + rememberMe,
                        dataType: 'json',
                        success: function (data) {
                            if (data.success) {
                                app.auth.register.showThankYou();
                            } else if (data.messages) {
                                app.auth.register.displayErrors(data.messages);
                            }
                        },
                        error: function (jqXHR) {
                            if (jqXHR.status == 0) {
                                opts.crossDomain = false;
                                opts.url = registerUrl;
                                opts.error = function () {
                                    app.auth.displayErrors([translations.unknown_error_message]);
                                };
                                $.ajax(opts);
                            } else {
                                app.auth.displayErrors([translations.unknown_error_message]);
                            }
                        }
                    };
                    if (app.device.hasCors()) {
                        opts.url = app.auth.baseDomain + registerUrl;
                        opts.crossDomain = true;
                        opts.xhrFields = {
                            withCredentials: true
                        };
                    }
                    $.ajax(opts);
                }
            }
        });
    },
    displayErrors: function (messages) {
        if (typeof $registerTab == 'undefined') {
            var $registerTab = app.auth.register.getRegisterTab();
        }
        window.location.hash = 'dm-register';
        var showIsEmptyMessage = false;
        var showInvalidMessage = false;
        var unrecognisedErrors = {};
        var $registerForm = $registerTab.find('form');
        var $registerErrors = $('<div>', {
            'class': 'row error-row'
        });
        if (typeof messages == 'string') {
            $registerErrors.append($('<p>', {
                'html': messages
            }));
        } else {
            $.each(messages, function (elementIndex, elementMessages) {
                if (typeof elementMessages == 'string') {
                    $registerErrors.append($('<p>', {
                        'html': elementMessages
                    }));
                } else {
                    $.each(elementMessages, function (messageType, messageText) {
                        if (elementIndex.match(/email/)) {
                            $registerForm.find('input[name="' + elementIndex + '"]').addClass('error');
                            if (typeof unrecognisedErrors[elementIndex] === 'undefined') {
                                unrecognisedErrors[elementIndex] = [];
                            }
                            unrecognisedErrors[elementIndex].push(messageText);
                        } else {
                            switch (true) {
                            case 'isEmpty' === messageType:
                                showIsEmptyMessage = true;
                                break;
                            case null !== messageType.match(/^postcode/):
                            case null !== messageType.match(/^emailAddress/):
                            case 'notAlpha' === messageType:
                                $registerForm.find('input[name="' + elementIndex + '"]').addClass('error');
                                showInvalidMessage = true;
                                break;
                            default:
                                if (typeof unrecognisedErrors[elementIndex] === 'undefined') {
                                    unrecognisedErrors[elementIndex] = [];
                                }
                                unrecognisedErrors[elementIndex].push(messageText);
                            }
                        }
                    });
                }
            });
        }
        var translations = app.auth.translations.registration;
        if (showIsEmptyMessage) {
            $registerErrors.append($('<p>', {
                'html': translations.mandatory_fields_message
            }));
        }
        if (showInvalidMessage) {
            $registerErrors.append($('<p>', {
                'html': translations.invalid_fields_message
            }));
        }
        $.each(unrecognisedErrors, function (elementName, messages) {
            $.each(messages, function (index, message) {
                $registerErrors.append($('<p>', {
                    'html': message
                }));
            });
        });
        $registerErrors.prependTo($registerForm);
    },
    clearErrors: function () {
        app.auth.register.getRegisterTab().find('.error-row').remove();
        $('#digital-membership input.error, #digital-membership select.error').removeClass('error');
    },
    showThankYou: function () {
        if (Number($('#dm-register').data('show-thankyou')) === 0) {
            window.location = '/home#registered';
            return;
        }
        $('#register-name').text($.cookie('user_forename') + ',');
        $('#digital-membership > div').removeClass('active');
        $('#dm-register-confirmation').addClass('active');
        window.location.hash = 'dm-register';
        setTimeout(function () {
            window.location.hash = 'registered';
            if (app.auth.fromApp == true) {
                window.location = 'arsenalapp://opentheapp';
            } else {
                window.location.reload();
            }
        }, 2000);
    }
};;
app.auth.register.international = {
    elements: {
        registerTab: null,
        preferredLanguageSelector: null,
        preferredLanguageSelectorWrap: null,
        newsletterMessagePlaceholder: null,
        forgotPassword: null,
        forgotPasswordConfirmation: null,
        countrySelector: null
    },
    init: function () {
        this.initElements();
        this.bindCountryChangeEvents();
        if (true === $('#digital-membership').is(':visible')) {
            this.initForms();
            this.bindBenefitsClickEvent();
            this.bindRegisterClickEvent();
            this.bindEnglishFormClickEvent();
        }
    },
    initForms: function () {
        app.auth.applyStyledInput();
        app.auth.register.initRegistrationForm();
        app.auth.register.bindRegistrationEvents();
        app.auth.initLogin();
        app.auth.bindLoginEvents();
        var me = this;
        this.elements.registerTab.find('form').on('click', 'a.bind-forgot', function (e) {
            e.stopPropagation();
            e.preventDefault();
            me.showForgotPassword();
        });
    },
    initElements: function () {
        this.elements.registerTab = app.auth.register.getRegisterTab();
        this.elements.preferredLanguageSelector = this.elements.registerTab.find('#login-preferred-language');
        this.elements.preferredLanguageSelectorWrap = this.elements.preferredLanguageSelector.closest('div.full-select');
        this.elements.countrySelector = this.elements.registerTab.find('#login-country');
        this.elements.newsletterMessagePlaceholder = this.elements.registerTab.find('#newsletter-language-message');
        this.elements.forgotPassword = $('#dm-forgot');
        this.elements.forgotPasswordConfirmation = $('#dm-forgot-confirmation');
    },
    bindCountryChangeEvents: function () {
        var me = this;
        setTimeout(function () {
            me.elements.countrySelector.trigger('change');
        }, 500);
        this.elements.countrySelector.on('change', function () {
            var value = $(this).val();
            if (me.countryIsSupported(value) === true) {
                me.showPreferredLanguageSelector();
            } else {
                me.hidePreferredLanguageSelector();
            }
            me.elements.preferredLanguageSelector.trigger('change');
        });
    },
    showPreferredLanguageSelector: function () {
        var selector = this.elements.preferredLanguageSelector;
        var countrySelector = this.elements.countrySelector;
        var selectorWrap = selector.closest('div.full-select');
        var trans = this.countryLanguageTranslations;
        selectorWrap.removeClass('hidden');
        selector.find('option[value="local"]').text(trans[countrySelector.val()]['value_local_language']);
        selector.find('option[value="english"]').text(trans[countrySelector.val()]['value_english_language']);
        var newsletterMessageTranslations = this.newsletterMessageTranslations;
        var me = this;
        selector.on('change', onLanguageAndCountryChange);

        function onLanguageAndCountryChange() {
            if (selector.val() === 'local') {
                me.elements.newsletterMessagePlaceholder.removeClass('hidden');
                me.elements.newsletterMessagePlaceholder.text(newsletterMessageTranslations[countrySelector.val()]['country_newsletter_message']);
            } else {
                me.elements.newsletterMessagePlaceholder.addClass('hidden');
            }
        }
        if (!selector.data('styled')) {
            selector.addClass('styled');
            selectorWrap.styledForm();
            selector.data('styled', 1);
        }
        selector.trigger('change');
    },
    hidePreferredLanguageSelector: function () {
        this.elements.preferredLanguageSelector.off('change');
        this.elements.newsletterMessagePlaceholder.addClass('hidden');
        this.elements.preferredLanguageSelectorWrap.addClass('hidden');
    },
    countryIsSupported: function (countryId) {
        return ($.inArray(Number(countryId), app.auth.register.international.supportedCountryIds) !== -1);
    },
    showForgotPassword: function () {
        var elements = this.elements;
        var forgotPasswordSuccess = function () {
            elements.forgotPassword.removeClass('active');
            elements.forgotPasswordConfirmation.addClass('active');
        };
        $.magnificPopup.open({
            mainClass: 'my-mfp-zoom-in',
            removalDelay: 300,
            items: {
                src: '#ir-forgot-password-wrap',
                type: 'inline'
            },
            callbacks: {
                beforeOpen: function () {
                    elements.forgotPasswordConfirmation.removeClass('active');
                    app.auth.showForgotPassword(false);
                },
                open: function () {
                    if (app.auth.run === false) {
                        app.auth.bindForgotPasswordEvents(forgotPasswordSuccess);
                        app.auth.run = true;
                    }
                },
                close: function () {
                    app.auth.resetForms();
                }
            }
        });
    },
    bindBenefitsClickEvent: function () {
        $('a.bind-benefits').off('click').on('click', function () {
            $('#dm-benefits').addClass('active');
            $('#dm-register').find('form').hide();
        });
    },
    bindRegisterClickEvent: function () {
        $('a.bind-register').off('click').on('click', function () {
            $('#dm-benefits').removeClass('active');
            $('#dm-register').find('form').show();
        });
    },
    bindEnglishFormClickEvent: function () {
        $('span.bind-english-form').on('click', function (e) {
            e.stopPropagation();
            window.location = $(this).data('href');
        });
    }
};
$(function () {
    app.auth.register.international.init();
});;
app.formlib = {
    init: function () {
        var forms = $('form[name="frmFormName"]');
        $.each(forms, function () {
            app.formlib.bindSubmit(this);
            app.formlib.bindFriendChange(this);
        });
        app.formlib.applyStyledInput();
    },
    applyStyledInput: function () {
        $('form[name="frmFormName"]').styledForm();
    },
    showLoginOnlyForms: function () {
        $('div[data-require-login="1"]').removeClass('hide-forms').prev().remove();
        app.formlib.injectUserData();
    },
    bindFriendChange: function (form) {
        var form = $(form);
        $('#num_friends', form).change(function () {
            var friends = $(this).val();
            var maxFriends = $('#num_friends option', form).last().val();
            for (var i = 1; i <= maxFriends; i++) {
                var nameInput = $('#frm_friend_name_' + i);
                var emailInput = $('#frm_friend_email_' + i);
                var nameWrapper = nameInput.parent();
                var emailWrapper = emailInput.parent();
                var friendSpacer = nameWrapper.prev();
                if (i > friends) {
                    nameWrapper.hide();
                    emailWrapper.hide();
                    friendSpacer.hide();
                    nameInput.val('');
                    emailInput.val('');
                } else {
                    nameWrapper.show();
                    emailWrapper.show();
                    friendSpacer.show();
                }
            }
        });
    },
    bindSubmit: function (form) {
        $(form).submit(function (e) {
            var form = $(this);
            var data = form.serialize();
            $.ajax('/ajax/process-form', {
                'cache': false,
                'data': data,
                'dataType': 'json',
                'type': 'POST',
                'success': function (response) {
                    if (response.status == 'ok') {
                        app.formlib.formComplete(response, form);
                    } else {
                        app.formlib.formError(response, form);
                    }
                },
                'error': function () {
                    response = {
                        'messages': {
                            'error': 'the server encountered an error whilst trying to process your request, please try again later'
                        }
                    }
                    app.formlib.formError(response, form);
                }
            });
            e.preventDefault();
        });
    },
    injectUserData: function () {
        var forms = $('form[name="frmFormName"]');
        if (app.user.isLoggedIn() || app.user.hasRememberMe()) {
            var regex = /\w/g;
            $.each(forms, function () {
                var form = $(this);
                $('input[type="text"]', form).each(function () {
                    var input = $(this);
                    var label = input.prev().text();
                    label = label.match(regex);
                    label = label.join('');
                    label = label.toLowerCase();
                    switch (label) {
                    case 'name':
                    case 'fullname':
                        var name = $.cookie('user_forename');
                        if (name !== null) input.val(name);
                        break;
                    case 'firstname':
                    case 'forename':
                        var name = $.cookie('user_forename');
                        if (name !== null) input.val(name);
                        break;
                    case 'surname':
                    case 'lastname':
                    case 'secondname':
                        break;
                    case 'email':
                    case 'emailaddress':
                        break;
                    case 'phone':
                    case 'phonenumber':
                    case 'contactnumber':
                        break;
                    case 'houseno':
                    case 'housename':
                    case 'housenoname':
                    case 'housenumber':
                        break;
                    case 'street':
                    case 'streetname':
                    case 'address':
                        break;
                    case 'street2':
                    case 'line2':
                    case 'addressline2':
                        break;
                    case 'towncity':
                    case 'town':
                    case 'city':
                        break;
                    case 'postcode':
                        break;
                    case 'membershipnumber':
                        break;
                    }
                });
            });
        }
    },
    formComplete: function (response, form) {
        var wrapper = $('<div>', {
            'class': 'success'
        });
        var success = $('<span>', {
            'text': response.message
        });
        success.appendTo(wrapper);
        var parent = form.parent();
        parent.children().remove();
        parent.append(wrapper);
    },
    formError: function (response, form) {
        $('div.errors', form).remove();
        var errors = $('<div>', {
            'class': 'errors'
        });
        $.each(response.messages, function () {
            var error = $('<span>', {
                'text': this
            });
            error.appendTo(errors);
        });
        form.prepend(errors);
    }
}
$(app.formlib.init);;
app.poll = {
    init: function () {
        $('.poll').styledForm();
        var polls = $('.poll form');
        $.each(polls, function () {
            var pollId = $('input[name="poll_id"]', this).val();
            if ($.cookie(pollId) !== null) {
                app.poll.loadResults(this, pollId);
            } else {
                app.poll.bindSubmit(this);
            }
        });
    },
    loadResults: function (form, pollId) {
        var form = $(form);
        $.get('/ajax/poll/' + pollId, function (response) {
            app.poll.pollComplete(response, form);
        });
    },
    bindSubmit: function (form) {
        $(form).submit(function (e) {
            var form = $(this);
            var data = form.serialize();
            $.ajax('/ajax/process-poll', {
                'cache': false,
                'data': data,
                'dataType': 'json',
                'type': 'POST',
                'success': function (response) {
                    if (response.status == 'ok') {
                        app.poll.pollComplete(response, form);
                    } else {
                        app.poll.pollError(response, form);
                    }
                },
                'error': function () {
                    response = {
                        'messages': {
                            'error': 'the server encountered an error whilst trying to process your request, please try again later'
                        }
                    }
                    app.poll.pollError(response, form);
                }
            });
            e.preventDefault();
        });
        $('a', form).click(function (e) {
            $(form).trigger('submit');
            e.preventDefault();
        });
    },
    pollComplete: function (response, form) {
        form.parent().replaceWith(response.results);
    },
    pollError: function (response, form) {
        $('div.errors', form).remove();
        var errors = $('<div>', {
            'class': 'errors'
        });
        $.each(response.messages, function () {
            var error = $('<span>', {
                'text': this
            });
            error.appendTo(errors);
        });
        form.prepend(errors);
    }
}
$(app.poll.init);