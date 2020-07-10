<? use yii\widgets\LinkPager;

?>

<div class="Article-default-index">
    <p>
        <a class="btn btn-primary" href="/article/create">Создать статью</a>
    </p>
    <?php foreach ($articles as $article): ?>
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title">
                    <?= $article->title ?>
                </h2>
                <a href="article/<?= $article->id ?>" class="btn btn-primary">Read More &rarr;</a>
            </div>
        </div>
    <?php endforeach; ?>
    <?php
        echo LinkPager::widget([
                'pagination' => $pagination,
        ]);
    ?>
</div>
