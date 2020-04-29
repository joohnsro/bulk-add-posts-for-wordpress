<?php
if ( isset( $_POST ) && count($_POST) > 0 ) {

    $posts = $_POST['posts'];
    
    $result = array(
        'success'   => array(),
        'error'     => array(),
    );
    
    foreach ( $posts as $key=>$post ) {

        $full_date  = substr( $post['date'], 6, 4 ) . '-' . 
                     substr( $post['date'], 3, 2 ) . '-' . 
                     substr( $post['date'], 0, 2 ) . ' ' . 
                     $post['hour'];

        $author     = ( $post['author'] != '' ) ? $post['author'] : 0;

        $categories = ( isset( $post['categories'] ) && count( $post['categories'] ) > 0 ) ? 
                        array_keys( $post['categories'] ) : array();

        $tags       = ( isset( $post['tags'] ) && count( $post['tags'] ) > 0 ) ? 
                        array_keys( $post['tags'] ) : array();

        $postarr = array(
            'post_title'    => wp_strip_all_tags( $post['title'] ),
            'post_content'  => $post['content'],
            'post_date'     => $full_date,
            'post_author'   => $author,
            'post_category' => $categories,
            'tags_input'    => $tags,
            'post_status'   => 'publish',
        );        
        
        if ( isset( $_FILES['posts']['name'][$key]['file'] ) ) {
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
                
                $filename = sanitize_text_field( $post['file']['name'] );
                $upload_file = wp_upload_bits($filename, null, file_get_contents($post['file']['tmp_name']));
                
                if (!$upload_file['error']) {
                    $wp_filetype = wp_check_filetype($filename, null );
                    $attachment = array( 'post_mime_type' => $wp_filetype['type'] );
                    $attachment_id = wp_insert_attachment( $attachment, $upload_file['file'] );

                    set_post_thumbnail( $post_id, $attachment_id );
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