<?php 
    /* 
        Plugin Name: La Pizzeria Gutenberg
        Plugin URI:
        Description: Plugin para agregar un bloque de contenido personalizado
        Version: 1.0
        Author: Leandro Arturi    
        Author URI: https://leandroarturi.com.ar
        License: GPL2
        License URI: https://www.gnu.org/licenses/gpl-2.0.html   
    */

    if(!defined('ABSPATH')){
        exit;
    }

    // Categorias personalizadas
    function lapizzeria_categoria_personalizada($categories, $post){
        return array_merge(
            $categories,
            array(
                array(
                    'slug' => 'lapizzeria',
                    'title' => 'La Pizzeria Gutenberg',
                    'icon' => 'store', // https://developer.wordpress.org/resource/dashicons/#menu-alt2
                )
            )
        );
    }
    add_filter('block_categories', 'lapizzeria_categoria_personalizada', 10, 2);


    function lapizzeria_registrar_bloques() {
        // Si no esta instalado Gutenberg, no se registra el bloque
        if(!function_exists('register_block_type')){
            return;
        }

        // Registra los bloques en el editor
        wp_register_script(
            'lapizzeria-editor-script',
            plugins_url('/build/index.js', __FILE__),
            array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor'),
            filemtime(plugin_dir_path(__FILE__) . 'build/index.js')
        );

        // Estilos para el editor
        wp_register_style(
            'lapizzeria-editor-styles',
            plugins_url('/build/editor.css', __FILE__),
            array('wp-edit-blocks'),
            filemtime(plugin_dir_path(__FILE__) . 'build/editor.css')
        );

        // Estilos para los bloques
        wp_register_style(
            'lapizzeria-frontend-styles',
            plugins_url('/build/styles.css', __FILE__),
            array(),
            filemtime(plugin_dir_path(__FILE__) . 'build/styles.css')
        );

        // Registra los bloques en el editor
        $blocks = [
            'lapizzeria/boxes',
        ];

        foreach($blocks as $block){
            register_block_type($block, [
                'editor_script' => 'lapizzeria-editor-script',
                'editor_style' => 'lapizzeria-editor-styles',
                'style' => 'lapizzeria-frontend-styles',
            ]);
        }        

        register_block_type( 'lapizzeria/menu', array(
            'editor_script' => 'lapizzeria-editor-script', // script principal para editor
            'editor_style' => 'lapizzeria-editor-styles', // estilos para el editor
            'style' => 'lapizzeria-frontend-styles', // estilos para el front end
            'render_callback' => 'lapizzeria_especialidades_front_end' // Query a la base de datos
        ));

    }
    add_action('init', 'lapizzeria_registrar_bloques');

    function lapizzeria_especialidades_front_end() {
        
        // Obtener los datos del Query
        $especialidades = wp_get_recent_posts(array(
            'post_type' => 'especialidades',
            'post_status' => 'publish',
            'numberposts' => 10
        ));

        // Revisar que haya resultados
        if(count($especialidades) == 0 ) {
            return 'No hay Especialidades';
        }

        $cuerpo = '';
        $cuerpo .= '<h2 class="titulo-menu">';
        $cuerpo .= "Nuestras Especialidades";
        $cuerpo .= '</h2>';
        $cuerpo .= '<ul class="nuestro-menu">';
        foreach($especialidades as $esp):
            // obtener un objeto del post
            $post = get_post( $esp['ID'] );
            setup_postdata($post);

            $cuerpo .= sprintf(
                '<li>
                    %1$s
                    <div class="platillo">
                        <div class="precio-titulo">
                            <h3>%2$s</h3>
                            <p>$ %3$s</p>
                        </div>
                        <div class="contenido-platillo">
                            <p>%4$s</p>
                        </div>
                    </div>
                </li>', 
                get_the_post_thumbnail($post, 'especialidades'),
                get_the_title($post),
                get_field('precio', $post),
                get_the_content($post)
            );
            wp_reset_postdata();
        endforeach;
        $cuerpo .= '</ul>';

        return $cuerpo;

    }

?>