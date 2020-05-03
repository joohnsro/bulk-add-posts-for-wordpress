<style>
<?php require( __DIR__ . '/styles.css' ); ?>
</style>

<div class="container">

    <h2>Adicione várias publicações de uma só vez</h2>
    <br />

    <form method="post" action="#" enctype="multipart/form-data">

        <div class="posts-list">

            <div class="post-item">
                <h3>Publicação #<span class="loopIndex">1</span></h3>
                <div class="post-prop">
                    <input name="posts[0][title]" type="text" placeholder="Título" required />
                </div>
                <div class="post-prop">
                    <textarea name="posts[0][content]" placeholder="Conteúdo" required></textarea>
                </div>
                <div class="post-prop double-prop">
                    <input name="posts[0][date]" type="text" placeholder="Dia (dd/mm/aaaa)" class="date" maxlength="12" />
                    <input name="posts[0][hour]" type="text" placeholder="Hora (hh:mm:ss)" class="time" maxlength="10" />
                </div>
                <div class="post-prop">
                    <label>Imagem destacada</label>
                    <input name="posts[0][file]" type="file" />
                </div>
                <div class="post-prop">
                    <label>Autores</label>
                    <select name="posts[0][author]">
                    <option value=""></option>
                        <?php if ( $authors && count( $authors ) > 0 ) { ?>
                            <?php foreach( $authors as $author ) { ?>
                                <option value="<?php echo $author->ID; ?>"><?php echo esc_html($author->display_name); ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                <div class="post-prop double-prop titles">
                    <label>Categorias</label>
                    <label>Tags</label>
                </div>
                <div class="post-prop double-prop">
                    <div class="check-list">

                        <?php if ( $categories && count( $categories ) > 0 ) { ?>
                            <?php foreach( $categories as $category ) { ?>
                                <div class="check-list-item">
                                    <input type="checkbox" id="posts[0][categories][<?php echo $category->term_id; ?>]" 
                                        name="posts[0][categories][<?php echo $category->term_id; ?>]" />
                                    
                                    <label for="posts[0][categories][<?php echo $category->term_id; ?>]">
                                        <?php echo esc_html($category->name); ?>
                                    </label>
                                </div>
                            <?php } ?>
                        <?php } ?>

                    </div>
                    <div class="check-list">

                        <?php if ( $tags && count( $tags ) > 0 ) { ?>
                            <?php foreach( $tags as $tag ) { ?>
                                <div class="check-list-item">
                                    <input type="checkbox" id="posts[0][tags][<?php echo $tag->term_id; ?>]" 
                                        name="posts[0][tags][<?php echo $tag->term_id; ?>]" />
                                    
                                    <label for="posts[0][tags][<?php echo $tag->term_id; ?>]">
                                        <?php echo esc_html( $tag->name ); ?>
                                    </label>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>   
            </div>

        </div>

        <div class="controls">
            <button class="btn btn-publish" type="submit">Publicar</button>
            <button class="btn btn-addpost">Adicionar nova publicação</button>
        </div>
    
    </form>

</div>

<script>
<?php require( __DIR__ . '/scripts.js' ); ?>
</script>