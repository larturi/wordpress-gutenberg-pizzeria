<?php get_header(); ?>

<?php 
    while ( have_posts() ) : the_post();
        get_template_part('templates/loop', 'contenido');

        comments_template();
    endwhile; 
?>

<?php get_footer(); ?>
