/*
  Theme Name: Bootstrap Admin Dashboard
  Author: Nababur Rahaman
  Support: nababurbd@gmail.com
  Author URL: https://github.com/nababur
  Author URL: https://www.peopleperhour.com/freelancer/development-it/nababur-rahman-wordpress-codeigniter-expert-qjnjaw
  Description: Free use for Backend Development.
  Version: 1.0
*/




(function ($) {
    "use strict";



    // Hide mouse right key click
    // document.addEventListener('contextmenu', function(e) {
    //   e.preventDefault();
    // });



    //===== Prealoader
    
    $(window).on('load', function(){
        $('.spinner_body').delay(500).fadeOut(500);
    });



  // Wow Js
  new WOW().init();


// Add Data Table
  $(document).ready(function() {
      $('#usersTable').DataTable();

      $('#roleTable').DataTable({});
  } );

// Left side Toggle Function

$('#nav-toggle').on('click', function(){
  $('.cta').toggleClass('active');
  // $('#menu-action').toggleClass('active');
  $('.left-sidebar').toggleClass('active');
  $('.page-content-wrapper').toggleClass('active');
  $(this).toggleClass('active');


});




  // Image preview uploader js
  // For Only Profile Photo upload
  function profileURLfind(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#preview-thumb').attr('src', e.target.result);
        $('#preview-thumb').hide();
        $('#preview-thumb').fadeIn(650);


      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#file-input-profile").change(function() {
    profileURLfind(this);
  });


  // Image preview uploader js
  // For Only Favicon upload
  function readFaviconURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#preview-favicon').attr('src', e.target.result);
        $('#preview-favicon').hide();
        $('#preview-favicon').fadeIn(650);

        
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#file-input-favicon").change(function() {
    readFaviconURL(this);
  });

  // Image preview uploader js
  // For Website logo upload
  function readLogoURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#preview-thumb').attr('src', e.target.result);
        $('#preview-thumb').hide();
        $('#preview-thumb').fadeIn(650);

        
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#file-input-logo").change(function() {
    readLogoURL(this);
  });


    //SEARCHING & TAGS SELECTS
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    //Set bootstrap theme
    $.fn.select2.defaults.set( "theme", "bootstrap" );

    //Select2 tagging example
    $("#select2-example-tags").select2({
        placeholder: "Select your permissions Item",
        allowClear: true,
        tags: true,
        tokenSeparators: [',']
    });




    $(document).ready(function () {
        $("#flash-msg").delay(7000).fadeOut("slow");
    });


$(document).ready(function(){
 
      // For email autho
     $('#allow_email').change(function(){
      if($(this).prop('checked'))
      {
       $('#hidden_email').val('1');
      }
      else
      {
       $('#hidden_email').val('0');
      }
     });


     // For Facebook Autho
     $('#fb_autho').change(function(){
      if($(this).prop('checked'))
      {
       $('#hidden_facebook').val('1');
      }
      else
      {
       $('#hidden_facebook').val('0');
      }
     });

     // For Twitter Autho
     $('#tw_autho').change(function(){
      if($(this).prop('checked'))
      {
       $('#hidden_twitter').val('1');
      }
      else
      {
       $('#hidden_twitter').val('0');
      }
     });

     // For Google Autho
     $('#gle_autho').change(function(){
      if($(this).prop('checked'))
      {
       $('#hidden_google').val('1');
      }
      else
      {
       $('#hidden_google').val('0');
      }
     });

     // For Github Autho
     $('#git_autho').change(function(){
      if($(this).prop('checked'))
      {
       $('#hidden_github').val('1');
      }
      else
      {
       $('#hidden_github').val('0');
      }
     });


     $("#allow_authotication").on('submit', function(event){
      event.preventDefault();


        // Email login Authotication
        var id_autho = $('#id_autho').val();
        var allow_email = $('#hidden_email').val();
        var dataString = 'allow_email='+allow_email+'&id_autho='+id_autho;
        if (dataString != '') {
            $.ajax({
                url:"app/ajax-classes/email-allow.php",
                type:"POST",
                data:dataString,
                 async: false,
                success:function(data){
                   $("#msg").html(data);
                   $("#flash-msg").delay(5000).fadeOut("slow");

                }

            });
                   
        }

        // Facebook login Authotication
        var id_autho = $('#id_autho').val();
        var fb_autho = $('#hidden_facebook').val();
        var dataString = 'fb_autho='+fb_autho+'&id_autho='+id_autho;
        if (dataString != '') {
            $.ajax({
                url:"app/ajax-classes/facebook-allow.php",
                type:"POST",
                data:dataString,
                 async: false,
                success:function(data){
                   $("#msg").html(data);
                   $("#flash-msg").delay(5000).fadeOut("slow");


                }

            });
                   
        }


        // Twitter login Authotication
        var id_autho = $('#id_autho').val();
        var tw_autho = $('#hidden_twitter').val();
        var dataString = 'tw_autho='+tw_autho+'&id_autho='+id_autho;
        if (dataString != '') {
            $.ajax({
                url:"app/ajax-classes/twitter-allow.php",
                type:"POST",
                data:dataString,
                 async: false,
                success:function(data){
                   $("#msg").html(data);
                   $("#flash-msg").delay(5000).fadeOut("slow");


                }

            });
                   
        }



        // Google login Authotication
        var id_autho = $('#id_autho').val();
        var gle_autho = $('#hidden_google').val();
        var dataString = 'gle_autho='+gle_autho+'&id_autho='+id_autho;
        if (dataString != '') {
            $.ajax({
                url:"app/ajax-classes/google-allow.php",
                type:"POST",
                data:dataString,
                 async: false,
                success:function(data){
                   $("#msg").html(data);
                   $("#flash-msg").delay(5000).fadeOut("slow");


                }

            });
                   
        }


        // Github login Authotication
        var id_autho = $('#id_autho').val();
        var git_autho = $('#hidden_github').val();
        var dataString = 'git_autho='+git_autho+'&id_autho='+id_autho;
        if (dataString != '') {
            $.ajax({
                url:"app/ajax-classes/github-allow.php",
                type:"POST",
                data:dataString,
                 async: false,
                success:function(data){
                   $("#msg").html(data);
                   $("#flash-msg").delay(5000).fadeOut("slow");


                }

            });
                   
        }





     });

});





$(document).ready(function(){
  $.ajax({
    url:"app/ajax-classes/chart.php",
    method: "GET",
    success: function(data) {
      console.log(data);
      var monthly = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
      var usersStatics = [];

      
        
        usersStatics.push(data);
      

      var chartdata = {
        labels: monthly,
        datasets : [
          {
            label: 'Monthly register',
            backgroundColor: 'rgba(45,192,201,.87)',
            borderColor: 'rgba(1,35,148,.87)',
            hoverBackgroundColor: 'rgba(0,31,146,.87)',
            hoverBorderColor: 'rgba(0,31,146,.87)',
            data: usersStatics
          }
        ]
      };

      var ctx = $("#mycanvas");

      var barGraph = new Chart(ctx, {
        type: 'bar',
        data: chartdata
      });
    },
    error: function(data) {
      console.log(data);
    }
  });







    //User Registration 
     $("#register_user").on('submit', function(event){
      event.preventDefault();



          var name                = $("#name").val();
          var email               = $("#email").val();
          var password            = $("#password").val();
          var confirm_password    = $("#confirm_password").val();

          var dataString  = 'name='+name+'&email='+email+'&password='+password+'&confirm_password='+confirm_password;

          if (dataString != '') {
            // Email login Authotication
              $.ajax({
                  url:"app/ajax-classes/register-user.php",
                  type:"POST",
                  data:dataString,
                   async: false,
                  success:function(data){
                     $("#msg").html(data);
                     $("#flash-msg").delay(5000).fadeOut("slow");
                     $("#name").val('');
                     $("#email").val('');
                     $("#password").val('');
                     $("#confirm_password").val('');
                  }

              });
                   
                     
          }


    return false;
    });

      //User Reset password 
       $("#reset_password").on('submit', function(event){
        event.preventDefault();



            var email    = $("#email").val();

            var dataString  = 'email='+email;

            if (dataString != '') {
              // Email login Authotication
                $.ajax({
                    url:"app/ajax-classes/reset-password.php",
                    type:"POST",
                    data:dataString,
                     async: false,
                    success:function(data){
                       $("#msg").html(data);
                       $("#flash-msg").delay(5000).fadeOut("slow");
                    }

                });
                     
                       
            }


      return false;
      });








       // For Mobile Toggle Menu
      var theToggle = document.getElementById('mobile-toggle');

      // based on Todd Motto functions
      // https://toddmotto.com/labs/reusable-js/

      // hasClass
      function hasClass(elem, className) {
        return new RegExp(' ' + className + ' ').test(' ' + elem.className + ' ');
      }
      // addClass
      function addClass(elem, className) {
          if (!hasClass(elem, className)) {
            elem.className += ' ' + className;
          }
      }
      // removeClass
      function removeClass(elem, className) {
        var newClass = ' ' + elem.className.replace( /[\t\r\n]/g, ' ') + ' ';
        if (hasClass(elem, className)) {
              while (newClass.indexOf(' ' + className + ' ') >= 0 ) {
                  newClass = newClass.replace(' ' + className + ' ', ' ');
              }
              elem.className = newClass.replace(/^\s+|\s+$/g, '');
          }
      }
      // toggleClass
      function toggleClass(elem, className) {
        var newClass = ' ' + elem.className.replace( /[\t\r\n]/g, " " ) + ' ';
          if (hasClass(elem, className)) {
              while (newClass.indexOf(" " + className + " ") >= 0 ) {
                  newClass = newClass.replace( " " + className + " " , " " );
              }
              elem.className = newClass.replace(/^\s+|\s+$/g, '');
          } else {
              elem.className += ' ' + className;
          }
      }

      theToggle.onclick = function() {
         toggleClass(this, 'on');
         return false;
      }








  
});































})(jQuery);



