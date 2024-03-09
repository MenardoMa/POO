<h1><?=$params['post']->titre ?? "Créer un article";?></h1>

<form action="<?=isset($params['post']) ?" /admin/posts/edit/{$params['post']->id}" :  
    "/admin/posts/create" ?>" method="post">
    <p><input type="text" name="titre" value="<?= $params['post']->titre ?? ''; ?>"></p>
    <p>
        <textarea name="content" id="" cols="30" rows="10">
            <?= $params['post']->content ?? ''; ?>
        </textarea>
    </p>
    <select multiple name="tags[]" id="tags">
        <?php foreach($params['tags'] as $tag) : ?>
           <option value="<?= $tag->id; ?>"
            
            <?php if(isset($params['post'])) : ?>
                <?php foreach($params['post']->getTags() as $postTag)
                {
                    echo  ($tag->id === $postTag->id) ? "selected" : "";
                } ?>
            <?php endif; ?>
           >
           <?= $tag->name; ?></option>
        <?php endforeach; ?>
    </select>
    <p><button type="submit"><?= isset($params['post']) ? "Enregister le modification" : "Ajouter"; ?></button></p>
</form>