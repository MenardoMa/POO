

<h1><?= $params['tag']->name; ?></h1>

<?php foreach($params['tag']->getPost() as $tag) : ?>

    <h1>
        <a href="/posts/<?= $tag->id ?>"><?= $tag->titre; ?></a>
    </h1>

<?php endforeach; ?>