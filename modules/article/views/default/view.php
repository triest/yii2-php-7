<div class="Article-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        <a class="btn btn-primary" href="/article/edit/<?= $article->id ?>">Редактировать статью</a>
    </p>

    <div class="card mb-4">
        <div class="card-body">
            <h2 class="card-title">
                <?= $article->title ?>
            </h2>
            <div class="card-body">
                <?= $article->description ?>
            </div>
            <a href="/article" class="btn btn-primary">К списку статей</a>
        </div>
    </div>

</div>
