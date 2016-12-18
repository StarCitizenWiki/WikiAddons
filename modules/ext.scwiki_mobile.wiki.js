jQuery('.mw-lingo-tooltip').on('click', function(){
    if (jQuery(this).hasClass('vis'))
    {
        jQuery('.mw-lingo-tooltip-tip', this).fadeOut();
        jQuery(this).removeClass('vis');
    }
    else
    {
        jQuery('.mw-lingo-tooltip-tip', this).fadeIn();
        jQuery(this).addClass('vis');
    }
});
