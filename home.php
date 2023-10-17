<?php
/**
 * Template Name: Главная
 */
?>

<?php get_header(); ?>

<main class="main">
    <!--slider-section-->
    <div class="container-fluid">
        <div class="slider-container">
            <?php echo do_shortcode('[slide-anything id="6"]'); ?>
        </div>
    </div>
    <!--product-section-->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="product-wrapper">
                    <h2 class="product-wrapper__title">
                        Оборудование
                    </h2>
                    <div class="product-grid">
                        <?php $terms = get_terms(array(
                            'taxonomy' => 'product_cat',
                            'hide_empty' => false,
                            'exclude' => '15',
                            'depth' => 1,
                            'parent' => 0,
                        )); ?>
                        <?php if ($terms) : ?><?php foreach ($terms as $term) : ?>
                            <a href="<?php echo get_term_link($term->term_id); ?>" class="product-item">
                                <div class="product-img">
                                    <?php woocommerce_subcategory_thumbnail($term); ?>
                                </div>
                                <div class="product-title">
                                    <h3 class="product-title__title"><?php echo $term->name; ?></h3>
                                </div>
                            </a>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--about-company-section-->
    <div class="container-fluid">
        <div class="about-bg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="about-wrapper">
                            <h2 class="about-wrapper__title">О компании</h2>
                            <div class="about-block">
                                <p class="about-block__text">Наша компания занимается поставкой оборудования
                                    промышленной автоматизации компании OMRON (Япония) на территорию Республики
                                    Казахстан с 1997 года. Прямые поставки от производителя позволяют нам поддерживать
                                    низкий ценовой порог и небольшие сроки поставки. Ассортимент комплектующих частей
                                    OMRON на нашем складе постоянно расширяется.
                                </p>
                                <p class="about-block__text">
                                    Наша компания поможет Вам подобрать интересующее Вас оборудование компании OMRON.
                                    Имея постоянную техническую поддержку производителя мы постараемся предоставить
                                    квалифицированный ответ в самые кратчайшие сроки. По запросу по электронной почте мы
                                    можем выслать электронные каталоги OMRON.
                                </p>
                                <p class="about-block__text">
                                    Кроме поставок на территории Республики Казахстан, мы также готовы предложить
                                    оборудование OMRON заинтересованным организациям Средней Азии (Узбекистан,
                                    Туркменистан, Таджикистан, Кыргызстан). Оптовым покупателям предлагаем хорошие
                                    скидки. Рассматриваем любые предложения по сотрудничеству. Готовы встречаться,
                                    созваниваться, обсуждать, предлагать...
                                </p>
                                <p class="about-block__text about-block__text--bold">
                                    Будем рады видеть Вас в числе наших покупателей!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--news-section-->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="news-wrapper">
                    <h2 class="news-wrapper__title">
                        Новости и акции
                    </h2>
                    <div class="news-grid">
                        <?php $args = array(
                            'posts_per_page' => 4,
                            'category_name' => 'news'
                        );
                        $query = new WP_Query($args);
                        if ($query->have_posts()) {
                            while ($query->have_posts()) {$query->the_post(); ?>
                                <a href="<?php the_permalink(); ?>" class="news-item">
                                    <?php the_post_thumbnail(); ?>
                                    <div class="news-block">
                                        <h3 class="news-block__title"><?php the_title(); ?></h3>
                                        <?php the_excerpt(); ?>
                                    </div>
                                </a>
                            <?php }
                            wp_reset_postdata();
                        } else
                            echo 'Записей нет.'; ?>
                    </div>
                    <a href="<?php bloginfo('url'); ?>/news/" class="news-link">
                        Смотреть все новости
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>



