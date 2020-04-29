<?php
function bulk_configuration() {

    require( __DIR__ . '/publish.php' );

    $authors    = get_users( array( 'role__in' => [ 'author' ] ) );
    $categories = get_categories( array( 'hide_empty' => false ) );
    $tags       = get_tags( array( 'hide_empty' => false ) );

    set_query_var( 'authors', $authors );
    set_query_var( 'categories', $categories );
    set_query_var( 'tags', $tags );

    require( __DIR__ . '/../views/configuration.php' );
}