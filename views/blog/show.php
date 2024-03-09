
<div>
    <h1><?= $params['post']->titre ?></h1>
    <p><i><?= $params['post']->getCreate_at(); ?></i></p>

         <p>
            <?php foreach($params['post']->getTags() as $tag) : ?>
                <strong><?=$tag->name;?></strong>
            <?php endforeach; ?>
        </p>

    <p><?= $params['post']->content ?></p>
    <p><a href="/posts/">Retour</a></p>
</div>