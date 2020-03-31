$(function(){
    $('#mobilelogo').data('size','big');
});

$(window).scroll(function(){
    if($(document).scrollTop() > 0)
    {
        if($('#mobilelogo').data('size') == 'big')
        {
            $('#mobilelogo').data('size','small');
            $('#mobilelogo').stop().animate({	
              height:'50px',
            },300);
        }
    }
    else
    {
        if($('#mobilelogo').data('size') == 'small')
        {
            $('#mobilelogo').data('size','big');
            $('#mobilelogo').stop().animate({
              height:'125px',
            },300);
        }  
    }
});
$(function(){
    $('#desktoplogo').data('size','big');
});

$(window).scroll(function(){
    if($(document).scrollTop() > 0)
    {
        if($('#desktoplogo').data('size') == 'big')
        {
            $('#desktoplogo').data('size','small');
            $('#desktoplogo').stop().animate({	
              height:'100px',
            },300);
        }
    }
    else
    {
        if($('#desktoplogo').data('size') == 'small')
        {
            $('#desktoplogo').data('size','big');
            $('#desktoplogo').stop().animate({
              height:'175px',
            },300);
        }  
    }
});
