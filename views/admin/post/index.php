
<p><a href="/admin/posts/create">AJOUTER UN POSTE</a></p>

<h1>Post</h1>

<?php foreach($params['post'] as $post) : ?>

    <div>
      <?= $post->id; ?>
     <h1><?= $post->titre; ?></h1>
        <p class="transparent">
            <form action="/admin/posts/delete/<?= $post->id ?>" method="POST">
                 <input type="submit" value="SUPPRIME">
            </form>
            <a href="/admin/posts/edit/<?= $post->id; ?>">MODIFIER</a>
        </p>
    </div>

<?php endforeach; ?>