<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\helpers\Html;
?>
<div class="posts">
    <?php $players = '';?>
    <?php foreach($posts as $post):?>

    <?= $this->render('_post', [
        'post' => $post,
    ]) ?>
                        <?php $players=$players . empty(trim(Html::encode($post->youtube))) ? false : "player[".$post->id."] = new YT.Player('ytplayer".$post->id."', {
                        height: '360',
                        width: '640',
                        videoId: '".Html::encode($post->youtube)."'
                        });

                        ";?>

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