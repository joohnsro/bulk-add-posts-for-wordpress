<style>
<?php require( __DIR__ . '/styles.css' ); ?>
</style>

<div class="container">

    <h2>Adicione várias publicações de uma só vez</h2>
    <br />

    <form method="post" action="#">

        <div class="posts-list">

            <div class="post-item">
                <h3>Publicação #<span class="loopIndex">1</span></h3>
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
                <div class="post-prop double-prop titles">
                    <label>Categorias</label>
                    <label>Tags</label>
                </div>
                <div class="post-prop double-prop">
                    <div class="check-list">
                        <div class="check-list-item">
                            <input type="checkbox" id="post[0]['categoria']['categoria-1']" name="post[0]['categoria']['categoria-1']" placeholder="Categoria 1" />
                            <label for="post[0]['categoria']['categoria-1']">Categoria 1</label>
                        </div>
                    </div>
                    <div class="check-list">
                    <div class="check-list-item">
                            <input type="checkbox" id="post[0]['tag']['tag-1']" name="post[0]['tag']['tag-1']" placeholder="Categoria 1" />
                            <label for="post[0]['tag']['tag-1']">Tag 1</label>
                        </div>
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