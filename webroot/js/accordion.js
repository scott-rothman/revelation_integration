$(function(){
    var $years = $('.year');
    var $months = $('.month');
    var $childMonths;
    var $childShows;

    $years.on('click', function(){
        $childMonths = $(this).next('.months');
        if ($(this).hasClass('open')) {
           $(this).removeClass('open');
            $childMonths.removeClass('open');     
        } else {
            $(this).addClass('open');
            $childMonths.addClass('open');    
        }
    });

    $months.on('click', function(){
        $childShows = $(this).next('.shows');
        if ($childShows.hasClass('open')) {
            $childShows.removeClass('open');     
        } else {
            $childShows.addClass('open');    
        }
    });

});