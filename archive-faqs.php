<?php
if ( !is_admin() ):
    $class = "";
    extract( $args );
    $args = array('post_type' => 'bs-faqs', 'order' => 'ASC', 'orderby' => 'menu_order');
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) :
        echo '<div class="accordion '.$class.'" id="accordion_bsFAQ">';
        while ( $the_query->have_posts() ) :
            $the_query->the_post();
            $collapsed = ( $the_query->current_post === 0 ) ? "" : "collapsed";
            $expanded  = ( $the_query->current_post === 0 ) ? "true" : "false";
            $show      = ( $the_query->current_post === 0 ) ? "show" : "";
        ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading">
                    <button class="accordion-button <?= $collapsed ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?= $post->ID ?>" aria-expanded="<?= $expanded ?>" aria-controls="collapse-<?= $post->ID ?>">
                        <strong><?= $post->post_title; ?></strong>
                    </button>
                </h2>
                <div id="collapse-<?= $post->ID ?>" class="accordion-collapse collapse <?= $show ?>" aria-labelledby="heading-<?= $post->ID ?>" data-bs-parent="#accordion_bsFAQ">
                    <div class="accordion-body">
                        <?= $post->post_content ?>
                    </div>
                </div>
            </div>
        <?php
        endwhile;
        echo "</div>";
    endif;
endif;
