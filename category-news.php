<?php
/**
 * Template Name: Категории новостей
 */
?>
<?php get_header(); ?>
<main class="main">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!--breadcrumbs-->
                <div class="breadcrumbs">
                    <?php woocommerce_breadcrumb() ?>
                </div>
                <!--content-section-->
                <div class="content-wrapper">
                    <h1 class="content-wrapper__title">Новости</h1>
                    <div class="content-grid content-grid--news">
                        <?php $args = array(
                            'posts_per_page' => -1,
                            'category_name' => 'news'
                        );
                        $query = new WP_Query($args);
                        if ($query->have_posts()) {
                            while ($query->have_posts()) {$query->the_post(); ?>
                                <div class="content-item">
                                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                                    <div class="content-block">
                                        <a href="<?php the_permalink(); ?>" class="content-item__title"><?php the_title(); ?></a>
                                        <?php the_excerpt(); ?>
                                        <a href="<?php the_permalink(); ?>" class="content-item__link">Подробнее</a>
                                    </div>

                                </div>
                            <?php }
                            wp_reset_postdata();
                        } else
                            echo 'Записей нет.'; ?>
                    </div>
                </div>
            </div>
    </div>
</main>
<?php get_footer(); ?>