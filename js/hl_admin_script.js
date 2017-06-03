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
    * Get Existing Batches.
    * Used to refresh batches in the metabox
    *
    */
   function getexistingbatches() {
       jQuery.ajax({
          type: "post",
          dataType: "text",
          url: ajax_object.ajax_url,
          data : {
          action           : 'hl_show_batch',
          post_id          : ajax_object.post_id,
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


   /**
    *
    * Global function to fetch previous batch values
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

      console.log(before_batchid)
      console.log(before_price)
      console.log(before_venue)
      console.log(before_startdate)
      console.log(before_enddate)
      console.log(before_duration)
      console.log(before_days)
      console.log(before_time)
      console.log(before_registeredstudents)
      console.log(before_totalstudents )


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

      if (type == 'update') {
        batchvars = {
          /* Fetch values from the selected batch */
          batchid                         : $( "#" + currentbatch + " #batch_number" ).val(),
          price                           : $( "#" + currentbatch + " #price" ).val(),
          venue                           : $( "#" + currentbatch + " #venue" ).val(),
          startdate                       : $( "#" + currentbatch + " #start_date" ).val(),
          enddate                         : $( "#" + currentbatch + " #end_date" ).val(),
          duration                        : $( "#" + currentbatch + " #duration" ).val(),
          days                            : $( "#" + currentbatch + " #days" ).val(),
          time                            : $( "#" + currentbatch + " #time" ).val(),
          registeredstudents              : $( "#" + currentbatch + " #number_registered_students" ).val(),
          totalstudents                   : $( "#" + currentbatch + " #number_total_students" ).val(), 
          before_batchid                  : before_batchid,
          before_price                    : before_price,
          before_venue                    : before_venue,
          before_startdate                : before_startdate,
          before_enddate                  : before_enddate,
          before_duration                 : before_duration,
          before_days                     : before_days,
          before_time                     : before_time,
          before_registeredstudents       : before_registeredstudents,
          before_totalstudents            : before_totalstudents
        }
      }
      else {
        batchvars = {
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
        }
      }
      jQuery.ajax({
         type : "post",
         dataType : "text",
         url : ajax_object.ajax_url,
         data : {
            action                          : 'hl_update_batch_ajax', 
            post_id                         : ajax_object.post_id,
            type                            : type,
            nonce                           : $( "#" + currentbatch + " #submitted" ).val(),
            result                          : batchvars        
         },
         beforeSend: function() { 
            $('#show_batch_metabox').css('opacity', '0.3');
            $('.spinner.hl-create').addClass( 'is-active' );       
            $('#create-batch').prop('disabled', true);
            $('#update-batch').prop('disabled', true);
            $('#delete-batch').prop('disabled', true);
         },
         success: function(response) {
            
            // If php function didnt suceed show error
            if (response == -1) {
               hl_show_error('Something went wrong please try again');
            }
            // Else show success
            else {
               $( '#create-batch' ).prop('disabled', false);
               $('.spinner.hl-create').removeClass( 'is-active' );
               $("#show_batch_metabox").css('opacity', '1');
               getexistingbatches();
               console.log(response);
            }
         }
      });
    }

   /**
    *
    * Function to create a new batch
    *
    */

   $( "#create-batch" ).live("click", function(event){
      event.preventDefault();
      // If title of the page is not defined do not allow to create batches
      currentbatch = $(this).parent().parent().attr('id');
      console.log(currentbatch);
      if( !$( "#title" ).val() ) {
         hl_show_error('Please save the course before assigning batches');
      }
      else {
         batch_process("create", currentbatch)
      }  
   });
   

   /**
    *
    * Function to Delete an Exisitng batch
    *
    */

   $( "#delete-batch" ).live("click", function(event){
      event.preventDefault();
      console.log(currentbatch);
      currentbatch = $(this).parent().parent().attr('id');
      batch_process("delete", currentbatch);
   }); 

   /**
    *
    * Function to fetch previous values for udpate
    *
    */

   $( "#edit-batch" ).live("click", function(event) {
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
      console.log(currentbatch);
      currentbatch = $(this).parent().parent().attr('id');
      batch_process("update", currentbatch);

   }); 
});
       