<?php
<?php
/*
Plugin Name: ALC Testimonials
*/

add_action('init', function () {
    register_post_type('testimonial', [
        'label' => 'Témoignages',
        'public' => true,
        'show_in_rest' => true,
        'supports' => ['title', 'editor'],
    ]);
});

add_action('add_meta_boxes', function () {
    add_meta_box('alc_rating', 'Note', function ($post) {
        $val = get_post_meta($post->ID, 'rating', true);
        wp_nonce_field('save_rating', 'alc_rating_nonce');
        echo '<input type="number" name="rating" min="1" max="5" value="' . esc_attr($val) . '"/>';
    }, 'testimonial');
});

add_action('save_post', function ($post_id) {
    // Vérifie le type de post
    if (get_post_type($post_id) !== 'testimonial') return;
    // Vérifie les permissions
    if (!current_user_can('edit_post', $post_id)) return;
    // Vérifie le nonce
    if (!isset($_POST['alc_rating_nonce']) || !wp_verify_nonce($_POST['alc_rating_nonce'], 'save_rating')) return;
    if (isset($_POST['rating'])) {
        update_post_meta($post_id, 'rating', intval($_POST['rating']));
    }
});

add_shortcode('alc_testimonials', function () {
    ob_start();
    $testimonials = get_posts(['post_type' => 'testimonial', 'numberposts' => 6]);
    foreach ($testimonials as $t) {
        $rating = get_post_meta($t->ID, 'rating', true);
        echo '<blockquote>' . esc_html($t->post_content) . '</blockquote>';
        echo '<div>Note : ' . esc_html($rating) . '/5</div>';
    }
    echo '<button id="loadMore">Charger plus</button>';
    return ob_get_clean();
});