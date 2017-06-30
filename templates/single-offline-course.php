<?php
/******************/
/**  Single Course
/******************/
get_header();
$michigan_webnus_options = michigan_webnus_options();
$course_features = $michigan_webnus_options['michigan_webnus_course_features'];
?>
<section class="container page-content">
	<hr class="vertical-space2">
	<?php
	//===============//
	// BreadCrumb
	//===============//
	if($michigan_webnus_options['michigan_webnus_enable_breadcrumbs']){
		$homeLink = esc_url(home_url('/'));
		$w_courses = get_post_type_object( 'homework-course' );
		$w_courses_slug = strtolower($w_courses->label);
		$w_courses_title = $w_courses->label;
		$cat = (get_the_term_list(get_the_id(), 'course_cat','',', ' ))? '<i class="fa-angle-right"></i> '.get_the_term_list(get_the_id(), 'course_cat','',', ' ) : '';
		echo '<div class="breadcrumbs-w"><div class="container"><div id="crumbs"><a href="'.$homeLink.'">'.esc_html__('Home','michigan').'</a> <i class="fa-angle-right"></i> <a href="' . $homeLink .  $w_courses_slug . '/">' . $w_courses_title . '</a> '. $cat .' <i class="fa-angle-right"></i> <span class="current">'.get_the_title().'</span></div></div></div>';
	}
	?>
	<div class="course-main">
		<?php if( have_posts() ): while( have_posts() ): the_post();
			$post_id = get_the_ID();
			$batches = get_post_meta( $post_id, 'batch', false );
			if (isset($batches) && !empty($batches)) {
				foreach ($batches as $batch) {
		    		$price[] = $batch['price'];
		    		$price[] = $batch['discounted_price'];	    		
		    		$latestbatchdate = strtotime($batch['startdate']);						
					$latestbatch[$latestbatchdate] = $batch;
		    		
		    	}
    	    	ksort($latestbatch);
			}
		?>
		<div class="col-md-12 post-trait-w">
			<h1 class="post-title-ps1"><?php the_title(); ?></h1>
			<?php
			if(isset($price) && !empty($price)){
				echo '<div class="w-course-price">';
					echo "<div class='w-course-price'>Starts from Rs. ". intval(min($price)) ."</div>";
				echo '</div>';
			}
			?>
		</div>
		<section class="col-md-9 course-content cntt-w">
			<article class="course-single-post">
				<?php 
				$content = get_the_content(); ?>
				<div <?php post_class('post'); ?>>
				<div class="container">
					<?php
					global $post;
					$course_no_img = $michigan_webnus_options['michigan_webnus_course_no_image'];
					//Course Thumbnail
						echo '<div class="post-thumbnail">';
						if(has_post_thumbnail()){
							get_the_image(array('meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'michigan_webnus_latest_img', 'link_to_post' => false));
						}elseif($course_no_img){
							$no_image_src = isset($michigan_webnus_options['michigan_webnus_course_no_image_src']['url'])?$michigan_webnus_options['michigan_webnus_course_no_image_src']['url']: get_template_directory_uri().'/images/course_no_image.png';
							echo '<img alt="'.get_the_title().'" width="420" height="330" src="'.$no_image_src.'">';
						}
						echo '</div>';
					?>
					<h4 class="course-titles"><?php esc_html_e('Course Details','michigan'); ?></h4>
					<div class="course-details">
						<?php echo  do_shortcode( $post->post_content ); ?>
						<div class="clear"></div>
					</div>
					<h4 class="course-titles"><?php esc_html_e('Course Batches','michigan');?></h4>
					<?php if (!empty($batches)) : ?>
						<div class="course-features clearfix col-md-12 online-t">
						    <div id="head" style="font-weight:bold;" class="single-batch">
						        <div class="batch-column">Batch No.</div>
						        <div class="batch-column">Duration</div>
						        <div class="batch-column">Start Date</div>
						        <div class="batch-column">Days</div>
						        <div class="batch-column">Time</div>
						        <div class="batch-column">Enrollments</div>
						        <div class="batch-column">Venue</div>
						        <div class="batch-column">Price</div>
						        <div class="batch-column"></div>
						        <div class="clearfix"></div>
						    </div>
						    <?php
				    		foreach ($latestbatch as $batch ) :
				        		if (isset($batch['batchid']))    : $batchnoset   = $batch['batchid']; endif;
				        		if (isset($batch['startdate']))  : $startdate    = strtotime($batch['startdate']); endif;
				        		if (isset($batch['enddate']))    : $enddate      = strtotime($batch['enddate']); endif;
				        		if (isset($batch['duration']))   : $duration     = $batch['duration']; endif;
				        		if (isset($batch['days']))       : $days         = $batch['days']; endif;
				        		if (isset($batch['time']))       : $time         = $batch['time']; endif;
				        		if (isset($batch['price']))      : $price        = $batch['price']; endif;
				        		if (isset($batch['venue']))      : $venue        = $batch['venue']; endif;
				        		if (isset($batch['price']))      : $price        = $batch['price']; endif;
				        		if (isset($batch['venue']))      : $venue        = $batch['venue']; endif;
				        		if (isset($batch['discounted_price'])) : $discounted_price = $batch['discounted_price']; endif;
				        		if (isset($batch['discount_detail'])) : $discount_detail   = $batch['discount_detail']; endif;
				        		if (isset($batch['registeredstudents'])) : $number_registered_students = $batch['registeredstudents']; endif;
				        		if (isset($batch['totalstudents'])) : $number_total_students = $batch['totalstudents']; endif;
				        		$startdatecomparision = strtotime("+2 weeks", $startdate);
				        		if ($startdatecomparision > strtotime("now")) : ?>
				        			<div id="batch-no-<?php echo $batchnoset ?>" class="single-batch">
								        <div id="batch-id" class="batch-column"><?php echo $batchnoset; ?></div>
								        <div id="batch-duration" class="batch-column"><?php echo $duration; ?></div>
								        <div id="batch-startdate" class="batch-column"><?php echo date('j M Y',$startdate);  ?></div>
								        <div id="batch-days" class="batch-column"><?php echo $days; ?></div>
								        <div id="batch-time" class="batch-column"><?php echo $time; ?></div>
								        <div id="batch-registered-students" class="batch-column"><?php echo $number_registered_students . '/' . $number_total_students; ?></div>
								        <div id="venue" class="batch-column"><?php echo $venue; ?></div>
								        <div id="batch-price" class="batch-column" <?php if (!empty($discount_detail)) { echo "style='cursor:pointer;'"; } ?> >
								        <?php if(isset($discounted_price) && !empty($discounted_price)): echo "<span id='discounted_price'>Rs. ". $discounted_price ." </span><span id='original_price'>Rs.".  $price . "</span>"; else:  echo "Rs." . $price; endif;?>
								        	<?php 
								        		if(isset($discount_detail) && !empty($discount_detail)): 
								        			echo "<span class='discount_detail'>" . $discount_detail . "</span>"; 
								        		endif;
								        	?>
								        </div>
								        
								        
								        <?php if (intval($number_registered_students) < intval($number_total_students) ) : ?>
								        	<div  class="batch-column col-xs-2 top-bar" style="background-color:transparent">
								        	    <a class="course-booking-button inlinelb topbar-contact" href="#w-Join" target="_self">
								        	    	<span class="media_label">JOIN</span>
								        	    </a>
								        	</div>	
								        <?php else : ?>
								         	<div  class="batch-column col-xs-2 top-bar" style="background-color:transparent">
								         	    <span class="course-booking-button inlinelb topbar-contact" href="#w-Join" target="_self" style="background-color: #000 !important;cursor: context-menu;">
								         	    	<span class="media_label">FULL</span>
								         	    </span>
								         	</div>
								         <?php endif; ?>
								         <div class="clearfix"></div>
								    </div>
				        		<?php endif;	?>
							<?php endforeach; ?>
							<div class="w-modal modal-book  colorskin-custom  online-t " id="w-Join" style="display: none;">
								<h3 class="modal-title">Registration for <?php the_title(); ?></h3>
								<?php echo do_shortcode("[contact-form-7 id='14631' title='Course Batch Registration]" ); ?>
							</div>
						</div>
					</div>
					<hr class="vertical-space2">
				<?php else : 
					echo "<div class='w-course-price batch-start-soon' style='text-align: center;margin: 50px 0;max-width: 80%;margin: 30px auto;line-height: 25px;'>Registrations for this course will be starting soon</div>";
					endif; ?>
			</article>
			<?php
			endwhile;
			endif;
			wp_reset_query();
			$post_ids[] = $post->ID;
			$author_id = get_the_author_meta('ID');
			$args = array('post__not_in' => $post_ids,'showposts' => 3,'orderby'=>'date','order'=>'desc','post_type'=>'homework-course','author' => $author_id,);
			$rec_query = new wp_query($args);
			if($rec_query->have_posts()){
			echo '<h4 class="course-titles">'.esc_html__('More Courses by this Instructor','michigan').'</h4><hr class="vertical-space1">';
			echo '<div class="row recent-course">';
			while ($rec_query->have_posts()){
			$rec_query->the_post();
			global $wpdb;
			$post_id = get_the_ID();
			?>
			<div class="col-md-4 col-sm-4">
				<article class="modern-grid llms-course-list"><div class="llms-course-link">
					<?php
					if (get_the_terms($post->ID, 'course_cat' )) {
						echo '<div class="modern-cat">';
						$categories = get_the_terms($post->ID, 'course_cat' );
						$typeName = array();
						foreach ( $categories as $category ){
							$cat_icon = (function_exists('tax_icons_output_term_icon'))?tax_icons_output_term_icon( $category->term_id ):'';
							$typeName[] = '<a class="hcolorf" href="' . esc_url( get_category_link( $category ) ) . '" title="' . esc_attr( sprintf( esc_html__( 'View all courses under %s', 'michigan' ), $category->name ) ) . '">'. $cat_icon . esc_html( $category->name ). '</a>';
						}
						echo implode(', ', $typeName);
						echo '</div>';
					} ?>
					<div class="modern-feature"><a class="" href="<?php the_permalink(); ?>">
						<?php
						if ( has_post_thumbnail( $post->ID ) ) {
							$img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'michigan_webnus_blog2_img' );
							if (class_exists('LLMS_Product')){
								echo apply_filters( 'lifterlms_featured_img', '<img src="' . $img[0] . '" alt="Placeholder" class="llms-course-image llms-featured-imaged wp-post-image" />' );
							}else{
								echo '<img src="' . $img[0] . '" alt="Placeholder" class="llms-course-image llms-featured-imaged wp-post-image" />';
							}
						}elseif(function_exists('llms_placeholder_img_src')){
							if(llms_placeholder_img_src()){
								$no_img = get_template_directory_uri().'/images/course_no_image.png';
								echo apply_filters( 'lifterlms_placeholder_img', '<img src="' . $no_img . '" alt="Placeholder" class="llms-course-image llms-placeholder wp-post-image" />' );
							}
						}
						echo '</a>';
					?>
					</div>
					<div class="modern-content">
						<h3 class="llms-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					</div>
					<div class="clearfix modern-meta">
						<div class="col-md-8 col-sm-8 col-xs-8">
							<?php
							$instructor_title = '<a href="'.get_author_posts_url( $author_id ).'">'. get_avatar( get_the_author_meta( 'user_email',$author_id ), 20 ).get_the_author_meta( 'display_name',$author_id ).'</a>';
							echo '<div class="modern-instructor">'.$instructor_title.'</div>';
							?>
						</div>
					</div>
				</article>
			</div>
			<?php }
			echo '</div>'; //close row
			}
			wp_reset_postdata();
			?>
		</section>
		<div class="col-md-3 sidebar">
			<aside class="course-bar">
				<?php			
				$author_id = get_the_author_meta('ID');
				$instructor_avatar = get_avatar( get_the_author_meta( 'user_email',$author_id ), 265 );
				$instructor_title = get_the_author_meta( 'display_name',$author_id );
				$facebook = esc_url(get_the_author_meta( "facebook",$author_id));
				$twitter = esc_url(get_the_author_meta( "twitter",$author_id));
				$google_plus = esc_url(get_the_author_meta( "googleplus",$author_id));
				$linkedin = esc_url(get_the_author_meta( "linkedin",$author_id));
				$youtube = esc_url(get_the_author_meta( "youtube",$author_id));
				$instructor_email = get_the_author_meta( 'display_email' , $author_id);
				$url = esc_url(get_the_author_meta( "url",$author_id));
				$bio =  get_the_author_meta( "biography",$author_id);
					
				echo '<div class="instructor-box">';
				echo '<div class="w-avatar">'.$instructor_avatar.'</div>';	
				echo '<h5>'.esc_html__('Instructor: ','michigan').$instructor_title.'</h5>';
				echo '<div class="instructor-info-box">';
				echo '<div class="w-about-me">'.$bio.'</div>' ;
				echo '<div class="social-instructor">';
				echo ($url)?'<a href="'.$url.'" class="instructor-social" target="_blank"><i class="fa-globe"></i></a>':'';
				echo ($instructor_email)?'<a href="mailto:'.$instructor_email.'" class="instructor-social"><i class="fa-envelope"></i></a>':'';
				echo ($facebook)?'<a target="_blank" href="'.$facebook.'" class="instructor-social" target="_blank"><i class="fa-facebook"></i></a>' : '';
				echo ($twitter)?'<a target="_blank" href="'.$twitter.'" class="instructor-social" target="_blank"><i class="fa-twitter"></i></a>' : '';
				echo ($google_plus)?'<a target="_blank" href="'.$google_plus.'" class="instructor-social" target="_blank"><i class="fa-google-plus"></i></a>' : '';
				echo ($linkedin)?'<a target="_blank" href="'.$linkedin.'" class="instructor-social" target="_blank"><i class="fa-linkedin"></i></a>' : '';				
				echo ($youtube)?'<a target="_blank" href="'.$youtube.'" class="instructor-social" target="_blank"><i class="fa-youtube"></i></a>' : '';				
				echo '</div>';
				echo '</div>';
				echo '</div>'; 
				if(isset($course_features['sharing']) && $course_features['sharing'])					get_template_part('parts/sharing');?>

				<ins class="adsbygoogle"
				     style="display:block"
				     data-ad-client="ca-pub-2825367626708661"
				     data-ad-slot="1178049961"
				     data-ad-format="auto"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
					</div>
			</aside>
		</div>
	</div>
	<!-- end-main-content -->
	<div class="white-space"></div>
</section>
<?php get_footer(); ?>