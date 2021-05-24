<?php
namespace app\modules\comments\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\comments\models\Comments;

class CommentsWidget extends Widget
{
    public $master_id;

    public function init()
    {
        parent::init();




    }

    public function run()
    {
        return Html::encode($this->message);
    }
}