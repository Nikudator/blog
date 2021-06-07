<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\helpers\Html;
?>
<div class="posts">
        <?php foreach($posts as $post):?>
            <post class="post">

                <div class="post-content">
                    <header class="entry-header text-center">

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
                        <p></p>

                        <?= empty(trim(Html::encode($post->youtube))) ? false : '<div id="ytplayer'.$post->id.'"></div>' ;?>

                        <?php $players=$players."player[".$post->id."] = new YT.Player('ytplayer".$post->id."', {
                        height: '360',
                        width: '640',
                        videoId: '".Html::encode($post->youtube)."'
                        });

                        ";?>

                        <p></p>
                        <div class="btn-continue-reading text-center text-uppercase">
                            <a href="<?= Url::toRoute(['/post/view', 'id'=>$post->id]);?>" class="more-link">Читать далее</a>
                        </div>
                    </div>
                    <div
                        <span class="pull-left text-capitalize">Автор: <?= $post->author->username; ?> Опубликовано: <?= $post->getRelTimeDate();?> <?= $post->getDate()===$post->getUpdate() ? false : 'Обновлено: '.$post->getRelTimeUpdate() ;?></span>
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

<script>
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/player_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    var player = [];
    function onYouTubePlayerAPIReady() {
        <?= $players; ?>
    }
</script>