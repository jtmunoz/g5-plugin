<h1 class="uk-article-title g5-page-title" style="color:#732c39 !important">Workshops</h1>
<?php 
     //args for loop query
    $workshop_args = array('post_type' => 'workshops');
     //query the loop
    $workshops_query = new WP_Query($workshop_args); 
?>
<?php if ( $workshops_query->have_posts() ) : ?>
    <?php while ( $workshops_query->have_posts() ) : ?>
        <?php $workshops_query->the_post(); ?>
            <article id="<?php the_ID(); ?>" class="uk-article">
               <!--  <p class="uk-article-meta">
                      <span class="nst-author uk-link-reset"><i class="uk-icon-user"></i> <?php// the_author(); ?></span>
                      <span class="nst-entry-time uk-margin-small-left"><i class="uk-icon-clock-o"></i> <?php// the_date(); ?></span>
                      <span class="nst-category-list uk-margin-small-left uk-link-reset"><i class="uk-icon-ticket"></i> <?php// the_category(', '); ?> </span><br>
                 </p> -->
                <div class="uk-grid uk-grid-small" data-uk-grid-margin="">
                    <div class="uk-width-1-1">
                        <p class="uk-h2 uk-text-bold g5-color-success-shade"><?php echo get_the_date(); ?></p>
                    </div>
                    <div class="uk-width-medium-2-3">
                        <div class="nst-entry-summary">
                            <h3 class="" style="text-transform: uppercase"><a class="g5-color-success g5-hover-color-success-shade g5-transition uk-text-bold" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="g5-post-excerpt uk-margin-bottom">
                                
                                <?php 
                                    $workshop_title = the_title('','', false);
                 
                                 
                                    if( ! empty( $workshop_title ) ) {
                                        echo '<h3 class="g5-color-success">Title:</h3>';
                                        echo '<p class="uk-margin-small-top">' . $workshop_Title . '</p>';
                                    }
                                 
                                ?>
                            </div>
                            <a href="<?php the_permalink() ?>" class="tm-button-ghost g5-border-small g5-border-success g5-color-success g5-hover-background-success g5-hover-color-white g5-transition-half uk-align-medium-left uk-align-center uk-text-center">Read More</a>
                        </div>
                    </div>
                    <div class="uk-width-medium-1-3">
                        <?php
                            if (has_post_thumbnail()) {
                                $thumbnail_url  = get_the_post_thumbnail_url();
                                $url = strstr($thumbnail_url, '/files');
                                echo '<img src="//blogsdir.imgix.net/1596'.$url.'?w=1024&auto=format&auto=compress" alt="" class="uk-align-center g5-padding-small-all g5-border-small g5-border-primary g5-boxshadow-all-small">';
                            } else {
                                echo '<img src="//stock.imgix.net/7557?w=1024&auto=format&auto=compress" alt="" class="uk-align-center g5-padding-small-all g5-border-small g5-border-primary g5-boxshadow-all-small">';
                            }
                        ?>
                    </div>
                </div>

            </article> <!-- .post -->
            <?php wp_reset_postdata(); ?>
        <?php endwhile; ?>
    <?php echo g5_getPostsPagination(); ?>
<?php else : ?>
    <div class="uk-alert-large uk-alert-danger uk-margin-large-top">
        <h1 class="uk-heading-large uk-text-danger uk-text-center">There are currently no workshops</h1>
    </div>
    <div class="uk-panel uk-panel-box uk-panel-box-primary uk-margin-large-top">
        <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentysixteen' ); ?></p>
        <?php get_search_form(); ?>
    </div>
<?php endif; ?>
<!-- </div> -->