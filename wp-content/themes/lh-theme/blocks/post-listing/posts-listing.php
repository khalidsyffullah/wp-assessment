<?php 
    if(!empty($posts_data['posts'])){
        foreach($posts_data['posts'] as $post){
            //Post vars
            $post_category = lh_get_primary_cat_by_post_id($post->ID, $taxonomy_name);
            ?><div data-testing-post-title="<?php echo $post->post_title ?>"><?php
            ?><h3><?php echo $post->post_title .' <i style="font-size: 0.5em">(id: ' . $post->ID . ')</i>' ?></h3><?php
            ?><div class="lh-h6><?php echo '<strong>Category: </strong>' . $post_category->name; ?> <i style="font-size: 0.75em">(id:<?php echo lh_get_cat_id_from_slug($post_category->slug, $taxonomy_name) ?>)</i></div><?php
            ?></div><?php
        }
    }
?>