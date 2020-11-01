<?php
namespace app\rbac;

use Yii;
use yii\rbac\Rule;
use yii\rbac\Item;

class UserGroupRule extends Rule
{
    public $name = 'userGroup';

    public function execute($user, $item, $params)
    {
        if (!\Yii::$app->user->isGuest) {
          $group = \Yii::$app->user->identity->group;

          //echo '<pre>'.var_export($params).'</pre>';exit;

          if ($item->name === 'root') {
                return $group == 'root';
            } elseif ($item->name === 'admin') {
                return $group == 'root' || $group == 'admin';
            } elseif ($item->name === 'moderator') {
                return $group == 'root' || $group == 'admin' || $group == 'moderator';
            } elseif ($item->name === 'redactor') {
                return $group == 'root' || $group == 'admin' || $group == 'moderator' || $group == 'redactor';
            } elseif ($item->name === 'user') {
                return $group == 'root' || $group == 'admin' || $group == 'moderator' || $group == 'redactor' || $group == 'user';
            }
        }
        else {
            return $item->name === 'guest';
        }
        return false;
    }
}
