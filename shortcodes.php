<?php 

/**
 *
 * List Popular Courses
 *
 */


function popularcourses( $atts ) {
    $atts = shortcode_atts( array(
        'number' => '3'
    ), $atts );

    $args = array(
    	'post_type' 		=> 'homework-course',
    	'posts_per_page' 	=> $atts['number'],
    	'order-by' 			=> 'post_date',
    );
    $query = new WP_Query( $args );
    

    if ( $query->have_posts() ) : ?>
    	<div class="container courses-modern">
    		<div class="row"> 
    	<?php while ( $query->have_posts() ) : $query->the_post(); ?>
			<div class="col-md-4 col-sm-4">
				<article class="modern-grid llms-course-list">
					<div class="llms-course-link">
						<div class="modern-feature"><a class="" href="<?php the_permalink(); ?>">
							<?php get_post_image(get_the_id()); ?>
						</div>
					<div class="modern-content">
						<h3 class="llms-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
<!-- 						<div class="llms-price-wrapper"><h4 class="llms-price"><span><?php /* price_starting_from(get_the_id());*/  ?></span></h4></div>
 -->					</div>
					<div class="clearfix modern-meta">
						<div class="col-md-8 col-sm-8 col-xs-8">
							<?php get_author_avatar(get_the_author_meta('ID')); ?>
						</div>
					</div>
				</article>
			</div>
    	<?php endwhile;?>
    		</div>
    	</div>
    <?php endif;
}
add_shortcode( 'popularcourses', 'popularcourses' );


?>