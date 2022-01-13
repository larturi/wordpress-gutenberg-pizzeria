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

    <div class="seccion contenedor con-sidebar">
        <main class="contenido-principal">
            <?php while(have_posts()): the_post(); ?>
                
                <article class="entrada-blog">

                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('especialidades'); ?>
                    </a>

                   <?php get_template_part('templates/informacion', 'entrada'); ?>

                    <div class="contenido-entrada">
                        <?php echo the_excerpt(); ?>

                        <a class="boton boton-primario" href="<?php the_permalink(); ?>">Leer mas</a>
                    </div>

                </article>

            <?php endwhile; ?>

            <!-- Paginador -->
            <div class="paginacion">
                <?php previous_posts_link('Anteriores'); ?>
                <?php next_posts_link('Siguientes'); ?>
            </div>


        </main>

        <?php get_sidebar(); ?>

    </div>


<?php get_footer(); ?>