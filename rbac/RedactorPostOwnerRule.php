<?php
namespace app\rbac;

use yii\rbac\Rule;
use yii\rbac\Item;

class RedactorPostOwnerRule extends Rule
{
    public $name = 'isPostOwner';

    /**
     * @param string|integer $user   the user ID.
     * @param Item           $item   the role or permission that this rule is associated with
     * @param array          $params parameters passed to ManagerInterface::checkAccess().
     *
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        return isset($params['author_id']) ? \Yii::$app->user->id === $params['author_id'] : false;
    }
}