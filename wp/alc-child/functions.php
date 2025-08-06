<?php
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('alc-child', get_stylesheet_uri());
});

register_nav_menus([
    'primary' => __('Menu Principal', 'alc')
]);

add_action('init', function () {
    register_block_pattern('alc/hero-a', [
        'title' => 'Hero ALC',
        'content' => '<section><h1>Bienvenue</h1><p>Votre solution web</p></section>'
    ]);
});
