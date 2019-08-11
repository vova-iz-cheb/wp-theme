<?php
//убираем панель администратора
add_filter('show_admin_bar', '__return_false');

//подключаем стили и скрипты
add_action( 'wp_enqueue_scripts', 'theme_add_scripts');

function theme_add_scripts() {
	wp_enqueue_style( 'theme-style' . '?v=' . rand(), get_stylesheet_uri()); //. '?v=' . rand() чтобы не кешировались стили и сразу обновлялись
	wp_enqueue_script( 'jquery.min.js', get_template_directory_uri() . '/js/jquery.min.js' );
	wp_enqueue_script( 'theme-script', get_template_directory_uri() . '/js/script.js' ); 
}

//регистрируем главное меню сайта
register_nav_menu( 'main-menu', 'Main menu of the site' );

//классы для всех анкоров в главном меню
function add_class_to_all_menu_anchors( $atts ) {
    $atts['class'] = 'nav__link';
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_class_to_all_menu_anchors');