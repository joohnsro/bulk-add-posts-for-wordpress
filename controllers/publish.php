<?php
if ( isset( $_POST ) && count($_POST) > 0 ) {

    $posts = $_POST['posts'];

    $result = array(
        'success'   => array(),
        'error'     => array(),
    );
    
    foreach ( $posts as $key=>$post ) {

        $author     = ( isset( $post['author'] ) && $post['author'] != '' ) ? $post['author'] : 0;

        $categories = ( isset( $post['categories'] ) && count( $post['categories'] ) > 0 ) ? 
                        array_keys( $post['categories'] ) : array();

        $tags       = ( isset( $post['tags'] ) && count( $post['tags'] ) > 0 ) ? 
                        array_keys( $post['tags'] ) : array();

        $postarr = array(
            'post_title'    => wp_strip_all_tags( $post['title'] ),
            'post_content'  => $post['content'],
            'post_author'   => $author,
            'post_category' => $categories,
            'tags_input'    => $tags,
            'post_status'   => 'publish',
        );        

        if ( isset( $post['date'] ) && $post['date'] != '' &&
             isset( $post['hour'] ) && $post['hour'] != '' ) {

            $postarr['post_date'] = substr( $post['date'], 6, 4 ) . '-' . 
                                    substr( $post['date'], 3, 2 ) . '-' . 
                                    substr( $post['date'], 0, 2 ) . ' ' . 
                                    $post['hour'];
        }
        
        if ( isset( $_FILES['posts']['name'][$key]['file'] ) && 
             $_FILES['posts']['name'][$key]['file'] != '' ) {

            $post['file'] = array(
                'name'      => $_FILES['posts']['name'][$key]['file'],
                'type'      => $_FILES['posts']['type'][$key]['file'],
                'tmp_name'  => $_FILES['posts']['tmp_name'][$key]['file'],
                'error'     => $_FILES['posts']['error'][$key]['file'],
                'size'      => $_FILES['posts']['size'][$key]['file'],
            );
            
        }

        if ( $post_id = wp_insert_post( $postarr ) ) {

            if ( isset($post['file']) && $post['file'] != '' ) {
                
                $attachment_id = media_handle_sideload( $post['file'] );

                if ( $attachment_id ) {
                    set_post_thumbnail( $post_id, $attachment_id );

                    if ( isset( $post['caption'] ) && $post['caption'] != '' ) {

                        $attachment_id_updated = wp_update_post( array(
                            'ID'            => $attachment_id,
                            'post_excerpt'  => sanitize_text_field( $post['caption'] ),
                        ) );

                    }
                }

            }

            $result['success'][]    = wp_strip_all_tags( $post['title'] );
        } else {
            $result['error'][]      = wp_strip_all_tags( $post['title'] );
        }
        
    }

    foreach ( $result['success'] as $success ) {
        echo '<div class="notice notice-success">
                  <p><strong>"' . $success . '"</strong> foi publicada com êxito.</p>
              </div>';
    }

    foreach ( $result['error'] as $error ) {
        echo '<div class="notice notice-error">
                  <p><strong>"' . $error . '"</strong> acabou ocorrendo e não pôde ser publicada.</p>
              </div>';
    }

}