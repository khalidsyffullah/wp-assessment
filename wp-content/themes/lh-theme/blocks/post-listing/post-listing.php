<div
    id="<?php print $el_id; ?>"
    class="<?php print implode(' ', $el_class); ?>"
    data-base-url="<?php echo $base_url ?>"
    data-posts-type="<?php echo is_array($post_type) ? implode(',', $post_type) : $post_type ?>"
    data-posts-taxonomy-name="<?php echo $taxonomy_name ?>"
    data-posts-category="<?php echo $lh_category ?>"
    data-posts-per-page="<?php echo $posts_per_page ?>"
    data-posts-page="<?php echo $lh_page ?>"
    data-posts-max-page="<?php echo $max_page ?>"
    data-posts-pagination="<?php echo $show_pagination ?>"
    data-posts-featured="<?php echo json_encode($featured_posts) ?>"
    data-posts-excluded="<?php echo json_encode($exclude_posts) ?>"
    data-posts-included="<?php echo json_encode($include_posts) ?>"
    data-first-pages-count="<?php echo $first_pages_count ?>"
    data-last-pages-count="<?php echo $last_pages_count ?>"
    data-around-current-page="<?php echo $around_current_page ?>"
    data-display-all_count="<?php echo $display_all_count ?>"
    data-block-name="<?php echo self::$slug ?>"
    data-template-name="posts-listing"
>
    <?php lh_print_block_style(self::$slug); ?>

    <h1><?php echo $title ?></h1>

    <?php if(!empty($posts_data['posts'])){ ?>
        <h2>Posts:</h2>

        <div class="lh-post-listing lh-content-layout-default">       
            <?php require('posts-listing.php'); ?>
        </div>

        <?php if(!$show_pagination && $lh_page < $max_page){ ?>
            <div class="lh-more-posts-container">
                <a href="#" class="lh-more-posts lh-btn lh-btn-secondary lh-btn-small lh-buttons-small-text" data-page="<?php echo $lh_page + 1 ?>"><?php _e("Load more", LH_THEME_SLUG); ?></a>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if(empty($category_slug)){ ?>
        <h2>Categories:</h2>
        <nav class="lh-category-navigation">
            <?php
                foreach($categories as $category){ 
                    $category_count  =  $category->category_count;
                    $category_info   = $category_count . ' ';
                    $category_info  .= ($category_count > 1) ? $post_type_obj->labels->name : $post_type_obj ->labels->singular_name;
                    $category_active = ($category->slug === $lh_category);
                    ?>
                        <a 
                            class="lh-category-button lh-btn lh-btn-secondary lh-btn-small lh-buttons-small-text<?php echo ($category_active) ? ' active' : '' ?>"
                            href="<?php echo $base_url . 'category/' . $category->slug ?>/page/1/" 
                            data-category-slug="<?php echo $category->slug ?>" 
                            data-category-nice-name="<?php $category->name ?>"
                            data-category-id="<?php echo $category->term_id ?>"
                        >
                            <?php echo $category->name ?>
                            (<?php echo $category_info ?>)
                        </a>
                    <?php 
                }
            ?>
            <a 
                class="lh-btn lh-btn-secondary lh-btn-small lh-buttons-small-text"
                href="#" 
                data-map-view="true"
            >
                Map for instance<?php // this is optional may codify it ?>
            </a>
        </nav>
    <?php } ?>

    <?php if($show_pagination) { ?>
        <h2>Pagination</h2>
        <?php 
            if($max_page > 1 && $show_pagination){
                lh_print_pagination($base_url, $max_page, $lh_page, $first_pages_count, $last_pages_count, $around_current_page, $display_all_count);
            }
        ?>
    <?php } ?>

    <h2>Query args paged</h2>
    <pre><?php var_dump($query_args_dev) ?></pre>
    <?php var_dump($page_num_dev) ?>
</div>