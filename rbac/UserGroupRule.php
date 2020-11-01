<?php
namespace app\rbac;

use Yii;
use yii\rbac\Rule;

class UserGroupRule extends Rule
{
    public $name = 'userGroup';

    public function execute($user, $item, $params)
    {
        if (!\Yii::$app->user->isGuest) {
          $group = \Yii::$app->user->identity->group;

          //echo '<pre>'.$group.'</pre>';exit;

          if ($item->name === 'root') {
                return $group == 'root' || $group == 'admin' || $group == 'moderator' || $group == 'redactor' || $group == 'user';
            } elseif ($item->name === 'admin') {
                return $group == 'admin' || $group == 'moderator' || $group == 'redactor' || $group == 'user';
            } elseif ($item->name === 'moderator') {
                return $group == 'moderator' || $group == 'redactor' || $group == 'user';
            } elseif ($item->name === 'redactor') {
                return $group == 'redactor' || $group == 'user';
            } elseif ($item->name === 'user') {
                return $group == 'user';
            }
        }
        else {
            return $group == 'guest';
        }
        return false;
    }
}
