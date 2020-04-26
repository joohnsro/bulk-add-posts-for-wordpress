<?php
/**
 * Plugin Name: Bulk Add Posts For Wordpress
 */

 /**
  * 1 - Adição de campos
  * 2 - Formatação de dados
  * 3 - Inclusão de posts
  */

require __DIR__ . '/controllers/configuration.php';

function bulk_menu_pages() {
    add_menu_page( 'Bulk Add - Congifuração', 'Bulk Add', 'manage_options', 'bulk-add', 'bulk_configuration' );
}

add_action( 'admin_menu', 'bulk_menu_pages' );

?>