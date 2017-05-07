$(function() {
    var $back = $('.scroll_left');
    var $next = $('.scroll_right');
    var $slider = $('.image_wrapper');
    //slide amount takes into consideration the size of the image, the right margin, and the initial space provided to offset the images from the controls
    //4 is the number of images it will slide
    var slide_amount = (($('.image_wrapper img').eq(0).width() + parseInt($('.image_wrapper img').eq(0).css('margin-right'),10)) * 4) + 20;
    var image_path = '';
    var amount_slid = 0;
    var new_pos = 0;

    $next.on('click', function() {
        $(this).off('click');
        slideNext();
        setTimeout(function() {
            $next.on('click', function() {
                slideNext();
            })
        }, 1000);
    });

    $back.on('click', function() {
       $(this).off('click');
        slideBack();
        setTimeout(function() {
            $back.on('click', function() {
                slideBack();
            })
        }, 1000);
    });
    
    $('.image_wrapper img').on('click', function() {
        image_path = $(this).attr('src');
        $('.band_photo').attr('src',image_path);
    });

    function slideNext() {
        amount_slid = $slider.css('left');
        new_pos = parseInt(amount_slid,10) - slide_amount;
        $slider.css('left', new_pos+'px');
        console.log(new_pos);
    }

    function slideBack() {
        amount_slid = parseInt($slider.css('left'),10);
        if (amount_slid < 0) {
            new_pos = amount_slid + slide_amount;
            $slider.css('left', new_pos+'px');
            console.log(new_pos);    
        }
    }

});