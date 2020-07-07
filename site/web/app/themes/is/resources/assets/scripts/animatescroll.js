var AnimateScroll = {
    offset: null,
    imediate: null,
    init: function(){
        AnimateScroll.immediate = 0;
        AnimateScroll.offset   = jQuery(window).height() * 7/8;
        AnimateScroll.go();
        AnimateScroll.setDebounce();
    },
    setDebounce: function(){
        jQuery(document).scroll(AnimateScroll.debounce(function(){ AnimateScroll.go() }, AnimateScroll.immediate));
    },
    go: function(){
        var target      = jQuery('[data-as="true"]');
        var documentTop = jQuery(document).scrollTop();
        target.each(function(){
            var animationClass = jQuery(this).data('as-animation');
            var itemTop        = jQuery(this).offset().top;
            if (documentTop > itemTop - AnimateScroll.offset) {
                jQuery(this).addClass(animationClass);
            } else {
                jQuery(this).removeClass(animationClass);
            }
        });
    },
    debounce: function(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    },
};

jQuery(document).ready(function() {
    AnimateScroll.init();
});
