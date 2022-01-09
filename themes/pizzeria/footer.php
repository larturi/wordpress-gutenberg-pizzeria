    <footer class="site-footer">

        <?php  
            $args = array(
                'theme_location' => 'header-menu',
                'container' => 'nav',
                'container_class' => 'footer-nav',
                'container_id' => 'menu',
                'after' => '<span class="separador">|</span>'
            );
            wp_nav_menu($args);
        ?>

        <div class="direccion">
            <p>Av. Directorio 3453 (CABA)</p>
            <p>Tel: 11-2222-3333</p>
        </div>

    </footer>

<?php wp_footer(); ?>

    </body>
</html>