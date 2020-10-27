<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
<div class="row">
    <div class="col-md-8">
        <?php foreach($posts as $post):?>
            <post class="post">

                <div class="post-content">
                    <header class="entry-header text-center text-uppercase">

                        <h1 class="entry-title"><a href="<?= Url::toRoute(['/post/view', 'id'=>$post->id]);?>"><?= $post->title?></a></h1>

                    </header>
                    <div class="entry-content">
                        <p><?= $post->anons?>
                        </p>

                        <div class="btn-continue-reading text-center text-uppercase">
                            <a href="<?= Url::toRoute(['/post/view', 'id'=>$post->id]);?>" class="more-link">Читать далее</a>
                        </div>
                    </div>
                    <div class="social-share">
                        <span class="social-share-title pull-left text-capitalize">Автор: <?= $post->author->username; ?> Опубликовано: <?= $post->getDate();?></span>
                        <ul class="text-center pull-right">
                            <li><a class="s-facebook" href="#"><i class="fa fa-eye"></i></a></li>
                        </ul>
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

