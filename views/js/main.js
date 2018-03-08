$=jQuery.noConflict();
$(document).ready(function() {
    $('#frame_fix_header').on('click', function(event){
        event.preventDefault();
        var $this = $(this);
        if ($this.hasClass('active-scroll')) {
            $this.removeClass('active-scroll');
            $('.table_body').css('height', '100%');
            $('.table_body').css('overflow-y', 'unset');
            resizeHeaderLeft();
        } else {
            $this.addClass('active-scroll');
            $('.table_body').css('height', '600px');
            $('.table_body').css('overflow-y', 'scroll');
            resizeHeaderLeft();
        };
    });

    function resizeHeaderLeft() {
        var topsideHeight = $("#topside").height(),
            contentHeight = $("#content").height(),
            heightContent = topsideHeight + contentHeight ;

        var heightLogo = $('.header #logo').height(),
            heightHeaderLeftContent = $('.header .left-sidebar').height(),
            heightSocial = $('.header #social').height() ,
            heightHeader = (heightLogo * 2) + heightHeaderLeftContent + heightSocial;

        if (heightHeader > heightContent) {
            $("header").css('height', heightHeader);
        } else if (heightHeader < heightContent) {
            $("header").css('height', heightContent + heightLogo);
        }
    };
});
