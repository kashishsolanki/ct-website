  // Project Slider Start
$(window).on('load', function(){
  var width = $(window).width();
  if (width > 767) {
    var project_scroll = new ScrollMagic.Controller();
    $(function () {
      var $project_list = $('.project-slider'),
          $project_item_gap_px = $('  .project-slider').css('grid-column-gap');
          $project_item_gap = parseInt($project_item_gap_px);
          $project_item = $project_list.find('.project-box'),
          project_list_width = $project_list.outerWidth(),
          project_item_width = $project_item.outerWidth(),
          project_total_width = project_item_width * $project_item.length + $project_item.length * $project_item_gap - $project_item_gap,
          travel_distance = project_total_width - project_list_width;
      
      var project_scene = new ScrollMagic.Scene({
        triggerElement: "#project", 
        duration: '150%',
        triggerHook: 0
      })
      .setPin('.project-slider')
      .addTo(project_scroll);
      
      project_scene.on('progress', function(e) {
        var progress = e.progress,
            move = -travel_distance * progress + "px";
        $project_list.css({
          transform: "translateX(" + move + ")"
        });
      });
    });

    // Cutsom Cursor Start
    var cursorinner = document.querySelector('.cursor_dot');
    document.addEventListener('mousemove', function(e){
      var x = e.clientX;
      var y = e.clientY;
      cursorinner.style.left = x - 3 + 'px';
      cursorinner.style.top = y - 3 + 'px';
    });
    $("a, input[type='submit'], button.slick-arrow").on({
      "mouseenter": function() {
        $(cursorinner).addClass("is-active");
      },
      "mouseleave": function() {
        $(cursorinner).removeClass("is-active");
      }
    });
    // Cutsom Cursor End
  }
});

new WOW().init();
// Project slider End

// Expertise section Start
jQuery('.es-box').each(function(){
  var es_box_h4 = jQuery(this).find('h4');
  var h4_text = es_box_h4.text();
  var h4_first = h4_text.substr(0,1);
  es_box_h4.attr('title', h4_first);
});
// Expertise section End

// Testimonial slider Start
$(".ts-main").slick({
  dots: false,
  arrows: true,
  infinite: false,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1330,
      settings: {
        slidesToShow: 3,
      }
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 2,
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1.05,
      }
    }
  ]
});
// Testimonial slider End


// Industry tab
$('#ind-tab li:first-child').addClass('active');
$('.tab-content-box').hide();
$('.tab-content-box:first').show();

$('.ins-tab #ind-tab li').click(function(){
  $('.ins-tab #ind-tab li').removeClass('active');
  $(this).addClass('active');
  $('.ins-tab .tab-content-box').hide();
  
  var activeTab = $(this).find('a').attr('href');
  $(activeTab).fadeIn(1000);
  // $(activeTab).slideDown(1500);
  return false;
});


// Faq accordion
$(document).ready(function() {
    $(".accordion-item .accordion-title").on("click", function() {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(this).siblings(".accordion-text").slideUp(200);
        } else {
            $(".accordion-item .accordion-title").removeClass("active");
            $(this).addClass("active");
            $(".accordion-item .accordion-text").slideUp(200);
            $(this).siblings(".accordion-item .accordion-text").slideDown(200);
        }
    });
});


// Desktop humburger
$(document).ready(function(){
    $('.humburger-icon').click(function(){
        if($('.hum-menu-wrap').hasClass('open-menu')){
            $(this).removeClass('active');
            $('.hum-menu-wrap').removeClass('open-menu');
            $('.humburger-menu-icon').css('z-index', '9');
        } else{
            $(this).addClass('active');
            $('.hum-menu-wrap').addClass('open-menu');
            $('.humburger-menu-icon').css('z-index', '991');
        }
    });
});

//Form Submission

// $(document).ready(function(){
//   $('.form-submitted').hide();
//   $("#form1").submit(function(event){
//     //console.log($(this));
//     //console.log($(this)).serialize();
//     event.preventDefault();
//     $.ajax({
//       type: 'post', 
//       url: 'server.php',
//       data: $('#form1').serialize(),
//       success: function(response) {
//         //alert(response);
//         $('.cs-from-wrap').hide();
//         $('.form-submitted').show().fadeIn(100);
//         // $('#form1').html("<div id='message'></div>");
//         // $('#message').html("<h2>Contact Form Submitted!</h2>")
//         // .append("<p>We will be in touch soon.</p>")
//         // .hide()
//         //  .fadeIn(100, function() {
//         //   //$('#message').append("<h2>Contact Form Submitted!</h2>");
//         // });
//       },
//       error:function(){
//         alert('Error');
//       }
//     })
//   })
// });

// $(document).ready(function(){
//   // $('.form-submitted').hide();
//   // $("#form1").submit(function(event){
//   //   event.preventDefault();
//   //   $.ajax({
//   //     type: 'post', 
//   //     url: 'server.php',
//   //     data: $('#form1').serialize(),
//   //     success: function(response) {
//   //       $('.cs-from-wrap').hide();
//   //       $('.form-submitted').show().fadeIn(100);
//   //     },
//   //     error:function(){
//   //       alert('Error');
//   //     }
//   //   })
//   // })
// });

$(document).ready(function(){
    $('.form-submitted').hide();
    $("#form1").submit(function(event){
      event.preventDefault();
    })
});


function sendContact() {
	var valid;	
	valid = validateContact();
	if(valid) {
		jQuery.ajax({
		url: "https://codetheorem.co/server.php",
		data:'&name='+$("#name").val()+'&company='+$("#company").val()+'&email='+$("#email").val()+'&phone='+$("#phone").val()+'&message='+$(message).val(),
		type: "POST",
		success:function(data){
		$("#mail-status").html(data);
     $('.cs-from-wrap').hide();
      $('.form-submitted').show().fadeIn(100);
		},
		error:function (){}
		});
	}
}

function validateContact() {
	var valid = true;	
	// $(".demoInputBox").css('background-color','');
	$(".info").html('');
	
	if(!$("#name").val()) {
		$("#username-info").html("Please enter Your Name");
		// $("#name").css('background-color','#FFFFDF');
		valid = false;
	}
  if(!$("#company").val()) {
		$("#usercompany-info").html("Please enter Company Name");
		// $("#company").css('background-color','#FFFFDF');
		valid = false;
	}
	if(!$("#email").val()) {
		$("#usermail-info").html("Please enter Email ID");
		// $("#email").css('background-color','#FFFFDF');
		valid = false;
	}
	if(!$("#email").val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
		$("#usermail-info").html("Invalid");
		// $("#email").css('background-color','#FFFFDF');
		valid = false;
	}
	if(!$("#phone").val()) {
		$("#userphone-info").html("Please enter Phone no.");
		// $("#phone").css('background-color','#FFFFDF');
		valid = false;
	}
	if(!$("#message").val()) {
		$("#usercomment-info").html("Please enter Project Details");
		// $("#message").css('background-color','#FFFFDF');
		valid = false;
	}
	
	return valid;
}