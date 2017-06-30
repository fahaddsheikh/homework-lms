<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$michigan_webnus_options = michigan_webnus_options();

$offlinecategories = get_terms( 'homework-course-category' , array(
    'hide_empty' => 0
) );
$blogusers = get_users( 'orderby=nicename&role=author' );


?>
<div class="archive-course-wrap clearfix">
    <section id="headline"><div class="container"><h2>
    <?php
    $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
    if ( is_search() ) {
        $getcoursesargs = array(
            'post_type' => 'homework-course',
            's' => get_search_query(),
            'paged' => $paged,
            'posts_per_page' => 12
        );
        echo sprintf( esc_html__( 'Search Results: &ldquo;%s&rdquo;', 'michigan' ), get_search_query() );
    if ( get_query_var( 'paged' ) ) {
        echo sprintf( esc_html__( '&nbsp;&ndash; Page %s', 'michigan' ), get_query_var( 'paged' ) ); }
    } elseif ( is_tax() ) {
        echo single_term_title( '', false );
        $tax = $wp_query->get_queried_object();
        $getcoursesargs = array(
            'post_type' => 'homework-course',
            'tax_query' => array(
                array(
                    'taxonomy' => 'homework-course-category',
                    'field'    => 'term_id',
                    'terms'    => $tax->term_id,
                    'paged' => $paged,
                    'posts_per_page' => 12
                ),
            ),
        );
    }else{    
        $getcoursesargs = array(
            'post_type' => 'homework-course',
            'paged' => $paged,
            'posts_per_page' => 12
        );
        echo esc_html__('All Courses','michigan');
    }
    ?>
    </h2></div></section>
    <main class="container content llms-content w-course-archive">
        <hr class="vertical-space">
        <aside class="col-md-3">
            <div class="filter-category">
                <h3> <?php esc_html_e('COURSE CATEGORIES','michigan'); ?> </h3>
                <div class="widget widget_michigan_course_categories">
                    <?php 
                        if ( ! empty( $offlinecategories ) && ! is_wp_error( $offlinecategories ) ){
                            echo '<ul class="course-categories list">';
                            foreach ( $offlinecategories as $offlinecategory ) {
                                echo '<li class="course-category"><a href="' . esc_url( get_term_link( $offlinecategory ) ) . '" alt="' . esc_attr( sprintf( __( 'View all post filed under %s', 'my_localization_domain' ), $offlinecategory->name ) ) . '">' . $offlinecategory->name . ' (' . $offlinecategory->count . ')</a></li>';
                            }
                            echo '</ul>';
                        }
                    ?>
                </div>
            </div>
            <hr class="vertical-space">
        </aside>
        <div id="page-<?php the_ID();?>" <?php post_class('col-md-9'); ?>>
            <div class="btn-group row">
                <div class="col-md-12 col-sm-12 courses-search">
                    <div class="widget widget_michigan_search_course">
                        <form role="search" method="get" class="course-search-form" action="<?php echo site_url( );?>">
                            <div>
                                <input type="hidden" name="post_type" value="homework-course">
                                <input type="search" class="search-field" placeholder="Type Keywords" value="" name="s" title="Search for:" style="width:75%;" >
                                <input type="submit" class="submit-field colorb" value="Search" style="width:25%;">
                            </div>
                        </form></div>
                </div>
            </div>
            <hr class="vertical-space">
        <?php
        $getcourses = new WP_Query( $getcoursesargs );
        if ( $getcourses->have_posts() ){
            echo '<div class="course-loader"></div>';
            echo '<div class="w-courses course-grid-t modern-grid" data-empty-filter-result="' . get_stylesheet_directory_uri() . '/images/filter-courses-empty.png' . '"><div class="courses">';
            $rcount=1;
            $row=3;
            while ( $getcourses->have_posts() ) : $getcourses->the_post();
            $post_id = get_the_ID();
            $batches = get_post_meta( $post_id, 'batch', false );
            if (isset($batches) && !empty($batches)) {
                foreach ($batches as $batch) {
                    $price[] = $batch['price'];
                    $price[] = $batch['discounted_price'];   
                    
                }
            }
                
                echo ($rcount == 1)?'<div class="row">':''; ?>
                <div class="col-md-4 col-sm-6 course-list-col">
                    <article class="w-course-list">
                        <div class="clearfix">
                        <div class="col-md-4 course-list-border-right">                   
                            <figure>
                                <a class="" href="<?php the_permalink(); ?>"><?php get_post_image(get_the_id()); ?></a>
                            </figure>
                        </div>

                        </div>
                        <div class="clearfix">
                            <div class="col-md-4 course-list-border-right">
                                <div class="course-list-review">
                                    <div class="modern-content">
                                        <h3 class="llms-title"><a href="<?php echo get_permalink( )?>"><?php echo get_the_title(); ?></a></h3>
                                          <div class="llms-price-wrapper"><h4 class="llms-price"><span>Starts from Rs <?php  echo intval(min($price))  ?></span></h4></div>
                                                            <div class="clearfix modern-meta">
                        <div class="col-md-8 col-sm-8 col-xs-8">
                            <?php get_author_avatar(get_the_author_meta('ID')); ?>
                        </div>
                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <?php if($rcount == $row){
                echo '</div>';
                $rcount = 0;
                }
                $rcount++;
            endwhile;
            echo '</div></div>';
        }else{
            echo '<p class="lifterlms-info">'._e( 'No products were found matching your selection.', 'michigan' ) .'</p>';
        }
        if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else {
            echo '<div class="wp-pagenavi">';
            next_posts_link(esc_html__('&larr; Previous page', 'michigan'));
            previous_posts_link(esc_html__('Next page &rarr;', 'michigan'));
        } ?>
        </div>
    </main>
</div>
<?php do_action( 'lifterlms_sidebar' ); ?>
<?php get_footer(); ?>