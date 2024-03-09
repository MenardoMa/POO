<h1>post</h1>

<?php foreach($params['post'] as $post) : ?>

    <div>
        <h3 class="title"><?= $post->titre; ?></h3>
        <p>
            <?php foreach($post->getTags() as $tag) : ?>
                <a href="/tags/<?=$tag->id;?>">
                    <?=$tag->name;?>
                </a>
            <?php endforeach; ?>
        </p>
        <p><?= $post->getCreate_at(); ?></p>
        <p><?= $post->troContent(); ?></p>
        <p><?= $post->Elemnt(); ?></p>
    </div>

<?php endforeach; ?>