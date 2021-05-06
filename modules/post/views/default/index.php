<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-md-8">
        <?php foreach($posts as $post):?>
            <post class="post">

                <div class="post-content">
                    <header class="entry-header text-center text-uppercase">

                        <h1 class="entry-title"><a href="<?= Url::toRoute(['/post/view', 'id'=>$post->id]);?>"><?= $post->title?></a></h1>

                    </header>
                    <div class="tags">
                        Тэги: <?php //foreach($model->getTagPost()->all() as $post) : ?>
                            <?php //$post->getTag()->one()->title ?>
                        <?php //endforeach; ?>
                    </div>
                    <div class="entry-content">
                        <p><?php echo Html::encode($post->anons);?>
                        </p>

                        <div class="btn-continue-reading text-center text-uppercase">
                            <a href="<?= Url::toRoute(['/post/view', 'id'=>$post->id]);?>" class="more-link">Читать далее</a>
                        </div>
                    </div>
                    <div
                        <span class="pull-left text-capitalize">Автор: <?= $post->author->username; ?> Опубликовано: <?= $post->getDate(); $post->getDate()===$post->getUpdate() ? 'Обновлено: '.$post->getUpdate() : false ;?></span>
                    </div>
                </div>
            </post>
        <?php endforeach; ?>

        <?php
        echo LinkPager::widget([
            'pagination' => $pagination,
        ]);
        ?>
    </div>
</div>
</div>

