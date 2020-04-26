<style>
<?php require( __DIR__ . '/styles.css' ); ?>
</style>

<div class="container">

    <h2>Adicione várias publicações de uma só vez</h2>
    <br />

    <div class="posts-list">

        <div class="post-item">
            <h3>Post #1</h3>
            <div class="post-prop">
                <input name="post[0]['title']" type="text" placeholder="Título" />
            </div>
            <div class="post-prop">
                <textarea name="post[0]['content']" placeholder="Conteúdo"></textarea>
            </div>
            <div class="post-prop double-prop">
                <input name="post[0]['date']" type="text" placeholder="Dia" />
                <input name="post[0]['hour']" type="text" placeholder="Hora" />
            </div>
            <div class="post-prop">
                <label>Imagem destacada</label>
                <input name="post[0]['file']" type="file" />
            </div>        
        </div>

    </div>

    <div class="controls">
        <button class="btn btn-publish">Publicar</button>
        <button class="btn btn-addpost">Adicionar nova publicação</button>
    </div>
    

</div>