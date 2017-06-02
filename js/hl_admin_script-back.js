// A $( document ).ready() block.
jQuery( document ).ready(function($) {

  /*Add Accordions to the batch on page load*/
   $("#show-batch-accordion").accordion({
      active: false,
      collapsible: true            
  });

   /*Add Random number to Batch Id*/
   $( '#create_batch_metabox #batch_number' ).val(Math.floor(Math.random() * (99999 - 10000 + 1)) + 10000);

   /* If post id is not defined hide the metaboxes */
   if (!ajax_object.post_id) {
    $( '#create_batch_metabox' ).hide();
      $( '#save_batch_metabox' ).hide();
  }
  
  /*
  * Incase of an error
  *   @param text
  */
   function hl_show_error(text) {
    $( '#create-batch' ).prop('disabled', true);
    $(".notice.notice-error").css("display", "block");
    $(".notice.notice-error h4").text(text);
    $('html,body').animate({ scrollTop: 0 },'slow');
  }

   /**
    *
    * Function to create a new batch
    *
    */

   $( "#create-batch" ).live("click", function(event){
      event.preventDefault();

      // If title of the page is not defined do not allow to create batches
      if( !$( "#title" ).val() ) {
         hl_show_error('Please save the course before assigning batches');
      }
      else {
         jQuery.ajax({
            type : "post",
            dataType : "text",
            url : ajax_object.ajax_url,
            data : {
               action            : 'hl_create_batch_ajax', 
               post_id           : ajax_object.post_id, 
               nonce             : $( '#submitted' ).val(),

               /* Fetch values from the selected batch */
               coursetitle       : $( "#title" ).val(),
               batchid           : $( "#batch_number" ).val(),
               price             : $( "#price" ).val(),
               venue             : $( "#venue" ).val(),
               startdate         : $( "#start_date" ).val(),
               enddate           : $( "#end_date" ).val(),
               duration          : $( "#duration" ).val(),
               days              : $( "#days" ).val(),
               time              : $( "#time" ).val(),
               registeredstudents: $( "#number_registered_students" ).val(),
               totalstudents     : $( "#number_total_students" ).val()          
            },
            beforeSend: function() { 
               $('.spinner.hl-create').addClass( 'is-active' );       
               $('#create-batch').prop('disabled', true);
               $('#show_batch_metabox').css('opacity', '0.3');
               $('.spinner.hl-show').addClass( 'is-active' );
            },
            success: function(response) {
               $( ".spinner" ).removeClass( "is-active" );
               // If php function didnt suceed show error
               if (response == -1) {
                  hl_show_error('Something went wrong please try again');
               }
               // Else show success
               else {
                  $( '#create-batch' ).prop('disabled', false);
                  $("#show_batch_metabox").css('opacity', '1');

                  jQuery.ajax({
                     type: "post",
                     dataType: "text",
                     url: ajax_object.ajax_url,
                     data : {
                     action       : 'hl_show_batch',
                     post_id        : ajax_object.post_id,
                     },
                     success: function(response) {
                        $('#show_batch_metabox .inside').html('');
                        $('#show_batch_metabox .inside').prepend(response);
                        $("#show-batch-accordion").accordion({
                           active: false,
                           collapsible: true            
                        });
                        $( '.spinner.hl-show' ).removeClass( 'is-active' );
                     }
                  });
                  $( '#create_batch_metabox #batch_number' ).val(Math.floor(Math.random() * (99999 - 10000 + 1)) + 10000);
               }
            }
         });
      }  
   });

   /**
    *
    * Global function to fetch previous batch valuesTo fetch previous batch values
    *
    */
   
    function fetchvalues(currentbatch) {
      /* Fetch previous values from the selected batch  so that they can be used in before value on update post meta*/
      before_batchid                         = $( "#" + currentbatch + " #batch_number" ).val();
      before_price                           = $( "#" + currentbatch + " #price" ).val();
      before_venue                           = $( "#" + currentbatch + " #venue" ).val();
      before_startdate                       = $( "#" + currentbatch + " #start_date" ).val();
      before_enddate                         = $( "#" + currentbatch + " #end_date" ).val();
      before_duration                        = $( "#" + currentbatch + " #duration" ).val();
      before_days                            = $( "#" + currentbatch + " #days" ).val();
      before_time                            = $( "#" + currentbatch + " #time" ).val();
      before_registeredstudents              = $( "#" + currentbatch + " #number_registered_students" ).val();
      before_totalstudents                   = $( "#" + currentbatch + " #number_total_students" ).val();        
      $( "#" + currentbatch + " #price" ).attr("readonly", false);             
      $( "#" + currentbatch + " #venue" ).attr("disabled", false);                     
      $( "#" + currentbatch + " #start_date" ).attr("readonly", false);            
      $( "#" + currentbatch + " #end_date" ).attr("readonly", false);              
      $( "#" + currentbatch + " #duration" ).attr("readonly", false);                  
      $( "#" + currentbatch + " #days" ).attr("readonly", false);                      
      $( "#" + currentbatch + " #time" ).attr("readonly", false);                      
      $( "#" + currentbatch + " #number_registered_students" ).attr("readonly", false);
      $( "#" + currentbatch + " #number_total_students" ).attr("readonly", false);
   }

/**
 *
 * Global Function to delete or update a batch
 *
 */
 function batch_process(type, currentbatch) {

      jQuery.ajax({
         type : "post",
         dataType : "text",
         cache: false,
         url : ajax_object.ajax_url,
         data : {
            action                          : 'hl_update_batch_ajax', 
            post_id                         : ajax_object.post_id,

            /* Fetch values from the selected batch */
            type                            : type,
            nonce                           : $( "#" + currentbatch + " #submitted" ).val(),
            before_coursetitle              : $( "#title" ).val(),
            before_batchid                  : before_batchid,
            before_price                    : before_price,
            before_venue                    : before_venue,
            before_startdate                : before_startdate,
            before_enddate                  : before_enddate,
            before_duration                 : before_duration,
            before_days                     : before_days,
            before_time                     : before_time,
            before_registeredstudents       : before_registeredstudents,
            before_totalstudents            : before_totalstudents,
            coursetitle                     : $( "#title" ).val(),
            batchid                         : $( "#" + currentbatch + " #batch_number" ).val(),
            price                           : $( "#" + currentbatch + " #price" ).val(),
            venue                           : $( "#" + currentbatch + " #venue" ).val(),
            startdate                       : $( "#" + currentbatch + " #start_date" ).val(),
            enddate                         : $( "#" + currentbatch + " #end_date" ).val(),
            duration                        : $( "#" + currentbatch + " #duration" ).val(),
            days                            : $( "#" + currentbatch + " #days" ).val(),
            time                            : $( "#" + currentbatch + " #time" ).val(),
            registeredstudents              : $( "#" + currentbatch + " #number_registered_students" ).val(),
            totalstudents                   : $( "#" + currentbatch + " #number_total_students" ).val()         
         },
         beforeSend: function() { 
            $('#show_batch_metabox').css('opacity', '0.3');
            $('.spinner.hl-show').addClass( 'is-active' );
         },
         success: function(response) {
            
            $( ".spinner.hl-show" ).removeClass( "is-active" );
            // If php function didnt suceed show error
            if (response == -1) {
               hl_show_error('Something went wrong please try again');
            }
            // Else show success
            else {
               $( '#create-batch' ).prop('disabled', false);
               $("#show_batch_metabox").css('opacity', '1');

               jQuery.ajax({
                  type: "post",
                  dataTYpe: "text",
                  url: ajax_object.ajax_url,
                  data : {
                  action            : 'hl_show_batch',
                  post_id           : ajax_object.post_id,
                  },
                  success: function(response) {
                     $('#show_batch_metabox .inside').html('');
                     $('#show_batch_metabox .inside').prepend(response);
                     $("#show-batch-accordion").accordion({
                        active: false,
                        collapsible: true            
                     });
                     $( '.spinner.hl-show' ).removeClass( 'is-active' );
                  }
               });
            }
         }
      });
}

   /**
    *
    * Function to Delete an Exisitng batch
    *
    */

   $( "#delete-batch" ).live("click", function(event){
      event.preventDefault();
      currentbatch = $(this).parent().parent().attr('id');
      batch_process("delete", currentbatch);
   }); 

   /**
    *
    * Function to fetch previous values for udpate
    *
    */

   $( "#edit-batch" ).live("click", function(event) {
      console.log("Clicked");
      $('.spinner.hl-show').addClass( 'is-active' );
      event.preventDefault();
      currentbatch = $(this).parent().parent().attr('id');
      fetchvalues(currentbatch);
      $('.spinner.hl-show').removeClass( 'is-active' );
      $("#" + currentbatch + " #edit-batch").css("display", "none");
      $("#" + currentbatch + " #update-batch").css("display", "inline");
      $("#" + currentbatch + " #delete-batch").css("display", "inline");
   });
   
   /**
    *
    * Function to Update an Exisitng batch
    *
    */

   $( "#update-batch" ).live("click", function(event){
      event.preventDefault();
      currentbatch = $(this).parent().parent().attr('id');
      batch_process("update", currentbatch);
   }); 



});
       