<?php
    /*
     *
     * Template Name: Services
     * @package Services
    */

    get_header();
    
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $args = array(  
        'post_type' => 'service',
        'post_status' => 'publish',
        'posts_per_page' => 10,
        'paged' => $paged,
    );

    $query1 = new WP_Query( $args );
?>
    <div class="top-banner">
    <div class="overlay"></div>
    <h1 class="page-title"><?php echo get_the_title();?></h1>
    </div>
<?php    
    echo '<div class="srv-container">
            <div class="srv-list">';
    while ( $query1->have_posts() ) {
        $query1->the_post();
        $postid = get_the_id();
        echo  '<div class="srv-list-item"> 
                    <div class="left">
                        <a href="'.get_permalink().'">'.get_the_post_thumbnail($postid, $size = 'medium').'</a>
                    </div>
                    <div class="right">
                        <a href="'.get_permalink().'">
                            <h3 class="srv-title">'. get_the_title() . '</h3>
                        </a>
                        <p class="srv-descrp">'.wp_trim_words(get_the_content(), 10).'</p>
                        <div class="srv-redmore-dv">
                            <a href="'.get_permalink().'" class="srv-readmore">Read More</a>
                        </div>
                    </div>
                </div>';
    }
?>
            </div>
        </div>
        <nav class="pagination">
        <ul class="page-links">
            <li class="page-link"><?php previous_posts_link( 'Prev', $query1->max_num_pages) ?></li> 
            <li class="page-link"><?php next_posts_link( 'Next', $query1->max_num_pages) ?></li>
        </ul>
    </nav>

<?php

    get_footer();