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
    }
    add_action('init', 'lapizzeria_registrar_bloques');

?>