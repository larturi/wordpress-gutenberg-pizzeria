<?php get_header(); ?>

    <?php  
        $pagina_blog = get_option('page_for_posts');
        $imagen = get_the_post_thumbnail_url($pagina_blog, 'full');
    ?>

    <div class="hero" style="background-image: url(<?php echo $imagen; ?>);">
        <div class="contenido-hero">
            <h1><?php echo get_the_title($pagina_blog); ?></h1>
        </div>
    </div>

    <div class="seccion contenedor">
        <main class="contenido-principal">
            <?php while(have_posts()): the_post(); ?>
                <h1><?php the_title(); ?></h1>
            <?php endwhile; ?>
        </main>
    </div>


<?php get_footer(); ?>