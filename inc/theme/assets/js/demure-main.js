(function($) {
    var ajax_url = DemureGlobal.ajaxurl;
    var blognav = DemureGlobal.blognav;
    
    Holder.run({
        images: '.holder'
    });
    
    smoothScroll.init();
    
    function demureDisableScroll() {
        $('html, body').on('scroll touchmove mousewheel', function(e){
          e.preventDefault();
          e.stopPropagation();
          return false;
        })
        window.oldScrollPos = $(window).scrollTop();

       $(window).on('scroll.scrolldisabler',function ( event ) {
          $(window).scrollTop( window.oldScrollPos );
          event.preventDefault();
       });
    }
    
    function demureEnableScroll() {
        $('html, body').off('scroll touchmove mousewheel');
        $(window).off('scroll.scrolldisabler');
    }
    
    function setColorbox() {
        var gallery = $('.gallery');
        
        if ($(gallery).length > 0 && !$(gallery).hasClass('colorbox-activated')) {
            $(gallery).find('.gallery-item').colorbox({
                rel: $(this).attr('rel'),
                width: "100%",
                height: "100%"
            });
            $(gallery).addClass('colorbox-activated');
        }
    }
    function setCarouselHeight(){
        if ($(".homepage-slider").length > 0) {
            var wpAdminBar = 0;
            var screenHeight = $(window).height();
            var headerHeight = $('#masthead').height();
            if ($('body').hasClass('admin-bar')) {
                var wpAdminBar = $('#wpadminbar').height();
            }
            $(".homepage-slider").height(screenHeight - headerHeight - wpAdminBar);
        }
    }
    
    $(window).load(function(){
        setColorbox();
    });
    $(window).scroll(function(){
        setColorbox();
    });
    $(window).resize(function(){
        setCarouselHeight();
    });

    $(document).ready(function() {        
        setCarouselHeight();
        // navigation 
        $('#site-navigation ul li').each(function(){
            if ($(this).hasClass('menu-item-has-children') && $(this).not().find('> div.open-sub-menu')) {
                $(this).find('> ul.sub-menu').before('<div class="open-sub-menu"></div>');
            }
        });

        $('#masthead .menu-toggle').click(function(){
            var menu = $('.main-navigation');
            if (!$(menu).hasClass('open-main-menu')) {
                $(menu).addClass('open-main-menu');
            } else {
                $(menu).removeClass('open-main-menu');
            }
        });

        $('#site-navigation').on( 'click', '.open-sub-menu', function(e) {
            e.preventDefault();
            $(this).parent().find('>.sub-menu').toggle();
        });
        
         // init owl-carousel
         if ($(".homepage-slider").length > 0) {
            var carousel = $('.owl-carousel');
            $(carousel).owlCarousel({
                navigation: true, // Show next and prev buttons
                singleItem: true,
                navigationText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
                slideSpeed : 300,
                items: 1,
            });
         }
         
         if ($('.demure-preloader').length > 0) {
             $(window).on("load", function(){
                 $('.demure-preloader').css({
                     'opacity':'0',
                     'visibility':'hidden'
                 });
             });
             $('body a').on('click', function(){
                 if ($(this).attr('href').indexOf('#') == -1 && $(this).attr('href').length > 0 ) {
                     $('.demure-preloader').css({
                         'opacity':'1',
                         'visibility':'visible'
                     });
                 }
                 
             });
         }
         
         $('select').selectize();
    });

    // loadmore posts
    if ($('#true_loadmore').length > 0) {
        if ( blognav == 3 ) {
            $(window).scroll(function(){
                var bottomOffset = 2000;
                var data = {
                    'action': 'loadposts',
                    'query': true_posts,
                    'page' : current_page
                };
                if( $(document).scrollTop() > ($(document).height() - bottomOffset) && !$('body').hasClass('loading')){
                    $.ajax({
                        url: ajax_url,
                        data: data,
                        type: 'POST',
                        beforeSend: function(xhr){
                            $('body').addClass('loading');
                        },
                        success:function(data){
                            if( data ) { 
                                $('#true_loadmore').before(data);
                                $('body').removeClass('loading');
                                current_page++;
                            }
                        }
                    });
                }
            });
        } else if ( blognav == 2 ) {
            $('#loadmore').click(function(){
                if ( !$('body').hasClass('loading') ) {
                    var data = {
                        'action': 'loadposts',
                        'query': true_posts,
                        'page' : current_page
                    };
                    $.ajax({
                        url: ajax_url,
                        data: data,
                        type: 'POST',
                        beforeSend: function(xhr){
                            $('body').addClass('loading');
                            $('#loadmore span').text($('#loadmore span').data( 'loading' )); 
                            $('#loadmore').before(data); 
                        },
                        success:function(data){
                            if( data ) { 
            					$('#loadmore span').text($('#loadmore span').data( 'load-more' ));
                                $('#loadmore').before(data); 
            					current_page++;
                                
            					if (current_page == max_pages) $("#loadmore").remove();
                                $('body').removeClass('loading');
            				} else {
            					$('#loadmore').remove();
            				}
                        }
                    });
                }
            });
        }
    }

})( jQuery );