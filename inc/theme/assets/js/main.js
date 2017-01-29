(function($) {
    var ajax_url = DemureGlobal.ajaxurl;
    var blognav = DemureGlobal.blognav;
    
    Holder.run({
        images: '.holder'
    });
    
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
    $(window).load(setColorbox);
    $(window).scroll(setColorbox);

    $(document).ready(function() {
        
        // navigation 
        $('#site-navigation ul li').each(function(){
            if ($(this).hasClass('menu-item-has-children') && $(this).not().find('> div.open-sub-menu')) {
                $(this).find('> ul.sub-menu').before('<div class="open-sub-menu"></div>');
            }
        });
        
        // secondary navigation
        var sContainer = $('.secondary-navigation-container');
        var hContainer = $('#masthead .header-container');
        $(sContainer).css('top', $(hContainer).outerHeight(true) + $(hContainer).offset().top);
        $('#masthead .secondary-navigation').on('click', function(){
            var trigger = $(this);
            var tSpan = $(trigger).find('>span');

            if (!$(trigger).hasClass('open')) {
                $(trigger).addClass('open');
                $(sContainer).addClass('open');
                $(tSpan).text($(tSpan).data('content-close'));
                
                $(sContainer).css('opacity','1');
                demureDisableScroll();
            } else {
                $(trigger).removeClass('open');
                $(sContainer).removeClass('open');
                $(tSpan).text($(tSpan).data('content-open'));
                demureEnableScroll();
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
        
        // modal 
        $('.open-modal').on('click', function(e){
            e.preventDefault();
        	if ($('.de_modal').length > 0) {
        		var ModalName = $(this).attr('name');
        		var Modal = $('body').find($('.de_modal[data-name="' + ModalName + '"]'));
        		if (Modal.length > 0 ) {
        			$(Modal).toggleClass("open");
        			var close = $(Modal).find('.close');
        			var overlay = $(Modal).find('.overlay');
        			$(Modal).find('.overlay, .close').on('click', function(){
        				$(this).parents('.de_modal').removeClass('open');
        			});
        		}
        	}
        	
        });
        
         // init owl-carousel
         if ($(".homepage-slider").length > 0) {
            $(".homepage-slider").owlCarousel({
                navigation: true, // Show next and prev buttons
                singleItem: true,
                navigationText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
                slideSpeed : 300,
                items: 1
            });
         }
         

         // login form ajax
         $('.de_modal[data-name="login-form"] form').submit(function(e){
            var trigger = $(this);
            var loading = '<div class="notification loading"> loading ... </div>';
            var data = {
                'action' : 'user_authenticate',
                'form' : $(this).serialize()
            }
            $.ajax({
                url:ajax_url,
                data:data,
                type:'POST',
                beforeSend: function(){
                    $(trigger).find('.notification').remove();
                    $(loading).appendTo(trigger);
                },
            }).done(function(data){
                $(trigger).find('.notification').remove();
                $(data).appendTo($(trigger));
                if ($(trigger).find('.notification-success').length > 0) {
                    setTimeout(function(){
                        location.reload();
                    }, 2000);
                }
                
            });
            e.preventDefault();
         });

         // registration form ajax
         $('.de_modal[data-name="register-form"] form').submit(function(e){
            var trigger = $(this);
            var loading = '<div class="notification loading"> loading ... </div>';
            var data = {
                'action' : 'user_registration',
                'form' : $(this).serialize()
            }
            $.ajax({
                url:ajax_url,
                data:data,
                type:'POST',
                beforeSend: function(){
                    $(trigger).find('.notification').remove();
                    $(loading).appendTo(trigger);
                },
            }).done(function(data){
                $(trigger).find('.notification').remove();
                $(data).appendTo($(trigger));
                //console.log(data);
                if ($(trigger).find('.notification-success').length > 0) {
                    setTimeout(function(){
                        location.reload();
                    }, 2000);
                }
                
            });
            e.preventDefault();
         });
         
         function readURL(input, preview) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(preview).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
         
         $(window).on("load", function(){
             $('.demure-preloader').fadeOut();
         });
         
         if ($('.profile-avatar').length > 0) {
            var trigger = $(this);
            var upload = $(this).find('input[name="user_avatar"]');
            var remove = $(this).find('input[name="remove_profile_avatar"]');
            var form = $(this).find('form[name="update_user_avatar"]');
            
             
            $(upload).on( 'change', function(event){
                
                event.stopPropagation();
                event.preventDefault();
                
                //  -------------------------XHR request-------------------------
                var data = new FormData();
                data.append( 'action', 'demure_update_avatar' );

                var error = 0;
                var this_input = $( 'input[type="file"]' );
                if (this_input[0] != undefined && this_input[0].files != undefined && $(this_input[0].files).length > 0) {
                    var file = $(this_input)[0].files;
                    if (file[0].size > 2000000) {
                        alert('File size should be less than 2 mb');
                        return;
                    } else {
                        data.append( 'avatar', file[0], file[0].name );
                        readURL(this, $('.profile-avatar form img'));
                    }
                } else {
                    return;
                }

                var xhr = new XMLHttpRequest();
                // Create a new XMLHttpRequest
                xhr.open('POST', ajax_url, true); 
                xhr.send(data);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        var response = JSON.parse(xhr.response);
                        switch (response) {
                            case 1:
                                alert("File type must be jpeg or png");
                                break;
                            case 2:
                                alert("File size should be less than 2 mb");
                                break;
                        }
                    }
                }
            });
            
            $(form).find('input[name="remove_profile_avatar"]').click(function(event){
                event.stopPropagation();
                event.preventDefault();
                
                var data = new FormData();
                data.append( 'action', 'demure_delete_avatar' );
                var xhr = new XMLHttpRequest();
                // Create a new XMLHttpRequest
                xhr.open('POST', ajax_url, true); 
                xhr.send(data);
                xhr.onreadystatechange = function() {
                  if (xhr.readyState == XMLHttpRequest.DONE) {
                     $(trigger).find('form img').attr('src', 'http://0.gravatar.com/avatar/081b4d55627f2996caa3c76d2cc014d6?s=456&d=mm&r=g');
                     $(upload).val('');
                  }
                }
            });
            
         }
         
         if ($('.user-profile-page').length > 0) {
            $( '.user-profile-page' ).tabs({
                active: 2
            });
         }
         
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