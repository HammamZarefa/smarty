<?php

// get_header(vibe_get_header());
get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();

?>
<section id="title">
    <?php do_action('wplms_before_title'); ?>
    <div class="<?php echo vibe_get_container(); ?>">
        <div class="row">
            <div class="col-md-12">
                <div class="pagetitle">
                    <?php
                        $breadcrumbs=get_post_meta(get_the_ID(),'vibe_breadcrumbs',true);
                        if(vibe_validate($breadcrumbs) || empty($breadcrumbs))
                            vibe_breadcrumbs(); 

                        $title=get_post_meta(get_the_ID(),'vibe_title',true);
                        if(vibe_validate($title) || empty($title)){
                    ?>
                    <h1><?php the_title(); ?></h1>
                    <?php the_sub_title(); }?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php

    $v_add_content = get_post_meta( $post->ID, '_add_content', true );
 
?>
<section id="content">
    <div class="<?php echo vibe_get_container(); ?>">
        <div class="row">
            <div class="col-md-12">

                <div class="<?php echo $v_add_content;?> content">
                    <?php
                        the_content();
                        $page_comments = vibe_get_option('page_comments');
                        if(!empty($page_comments))
                            comments_template();
                     ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
endwhile;
endif; 
?>
<?php
get_footer();
// get_footer( vibe_get_footer() );
