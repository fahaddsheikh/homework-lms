// A $( document ).ready() block.
jQuery( document ).ready(function($) {
	$( ".course-booking-button" ).click(function() {
		// Get Parent Batch ID from Join button
  		courseid = "#" + $(this).parent().parent().attr('id');
  		// Fetch values from the selected batch
  		coursetitle 			= $( ".course-main  .post-title-ps1" ).text();
  		batchid 				= $( courseid + " #batch-id" ).text();
  		duration 				= $( courseid + " #batch-duration" ).text();
  		startdate 				= $( courseid + " #batch-startdate" ).text();
  		days 					= $( courseid + " #batch-days" ).text();
  		time 					= $( courseid + " #batch-time" ).text();
  		totalstudents			= $( courseid + " #batch-registered-students" ).text();
  		price 					= $( courseid + " #price" ).text();
  		discounted_price    	= $( courseid + " #discounted_price" ).text();
		discount_detail     	= $( courseid + " #discount_detail" ).text();
  		// Fetch Contact form 7 values
  		formtitle 				= $("#course-title");
		formbatch 				= $("#batch-no");
		formduration			= $("#duration");
		formstartdate			= $("#startdate");
		formdays				= $("#days");
		formtime				= $("#time");
		formprice				= $("#price");
		form_discounted_price   = $("#discounted_price"); 
		form_discount_detail    = $("#discount_detail");
		// Apply values to contact form 7
		formtitle.val(coursetitle.trim());
		formbatch.val(batchid.trim());
		formduration.val(duration.trim());
		formstartdate.val(startdate.trim());
		formdays.val(days.trim());
		formtime.val(time.trim());
		formprice.val(price.trim());
		form_discounted_price.val(discounted_price.trim());
		form_discount_detail.val(discount_detail.trim());
	});
});