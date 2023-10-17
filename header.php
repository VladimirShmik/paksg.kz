<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="image/x-icon" href="<?php echo bloginfo('template_url'); ?>/favicon.ico" rel="shortcut icon">
    <link type="Image/x-icon" href="<?php echo bloginfo('template_url'); ?>/favicon.ico" rel="icon">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="header">
    <!--contacts-section-->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!--contacts-section-->
                <div class="header-contacts">
                    <a href="/" class="header-logo">
                        <img src="<?php echo bloginfo('template_url'); ?>/assets/img/logo.png" alt=""
                             class="header-logo__img">
                    </a>
                    <div class="contacts-row">
                        <div class="contacts-box">
                            <svg class="contacts-box__icon contacts-box__icon--orange">
                                <use href="<?php echo bloginfo('template_url'); ?>/assets/img/sprite.svg#phone-icon">
                                </use>
                            </svg>
                            <div class="contacts-block">
                                <p class="contacts-block__title contacts-block__title--orange">Актобе:</p>
                                <a href="tel:+77132717323" class="contacts-block__phone" target="_blank">+7 (7132)
                                    71-73-23</a>
                                <a href="tel:+77711672375" class="contacts-block__phone" target="_blank">+7 (771)
                                    167-23-75</a>
                            </div>
                        </div>
                        <div class="contacts-box">
                            <svg class="contacts-box__icon contacts-box__icon--blue">
                                <use href="<?php echo bloginfo('template_url'); ?>/assets/img/sprite.svg#phone-icon">
                                </use>
                            </svg>
                            <div class="contacts-block">
                                <p class="contacts-block__title contacts-block__title--blue">Алматы:</p>
                                <a href="tel:+77279738477" class="contacts-block__phone" target="_blank">+7 (727)
                                    973-84-77</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--menu-section-->
    <div class="container-fluid">
        <div class="menu-bg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="menu-desktop">
                            <!--header-menu-->
                            <?php wp_nav_menu(array('theme_location' => 'header-menu')); ?>
                            <?php  echo get_product_search_form(); ?>
                        </div>
                        <!--mobile-menu-section-->
                        <div class="mobile-wrap">
                            <div class="mobile-nav">
                                <div class="burger-icon">
                                    <span class="bar"></span>
                                    <span class="bar"></span>
                                    <span class="bar"></span>
                                </div>
                                <a href="/" class="mobile-logo">
                                    <img src="<?php echo bloginfo('template_url'); ?>/assets/img/logo.png" alt="">
                                </a>
                            </div>
                            <div class="menu-wrap">
                                <!--mobile-menu-->
                                <?php wp_nav_menu( array( 'theme_location' => 'mobile-menu' ) ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
