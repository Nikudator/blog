<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use \app\rbac\UserGroupRule;

class RbacController extends Controller
{
    public function actionInit()
    {
        $authManager = \Yii::$app->authManager;
        $authManager->removeAll();

        // Create roles
        $guest = $authManager->createRole('guest');
        $user = $authManager->createRole('user');
        $redactor = $authManager->createRole('redactor');
        $moderator = $authManager->createRole('moderator');
        $admin = $authManager->createRole('admin');
        $root = $authManager->createRole('root');

        // Create simple, based on action{$NAME} permissions
        $login = $authManager->createPermission('login');
        $logout = $authManager->createPermission('logout');
        $emailconfirm = $authManager->createPermission('emailconfirm');
        $passwordrequest = $authManager->createPermission('passwordrequest');
        $resendverificationemail = $authManager->createPermission('resendverificationemail');
        $error = $authManager->createPermission('error');
        $auth = $authManager->createPermission('auth');
        $signup = $authManager->createPermission('signup');
        $index = $authManager->createPermission('index');
        $view = $authManager->createPermission('view');
        $update = $authManager->createPermission('update');
        $delete = $authManager->createPermission('delete');
        $create = $authManager->createPermission('create');


        // Add permissions in Yii::$app->authManager
        $authManager->add($login);
        $authManager->add($logout);
        $authManager->add($emailconfirm);
        $authManager->add($passwordrequest);
        $authManager->add($resendverificationemail);
        $authManager->add($auth);
        $authManager->add($error);
        $authManager->add($signup);
        $authManager->add($index);
        $authManager->add($view);
        $authManager->add($update);
        $authManager->add($delete);
        $authManager->add($create);


        // Add rule, based on UserExt->group === $user->group
        $userGroupRule = new UserGroupRule();
        $authManager->add($userGroupRule);

        // Add rule "UserGroupRule" in roles
        $guest->ruleName = $userGroupRule->name;
        $user->ruleName = $userGroupRule->name;
        $redactor->ruleName = $userGroupRule->name;
        $moderator->ruleName = $userGroupRule->name;
        $admin->ruleName = $userGroupRule->name;
        $root->ruleName = $userGroupRule->name;

        // Add roles in Yii::$app->authManager
        $authManager->add($guest);
        $authManager->add($user);
        $authManager->add($redactor);
        $authManager->add($moderator);
        $authManager->add($admin);
        $authManager->add($root);

        // Add permission-per-role in Yii::$app->authManager
        // Guest
        $authManager->addChild($guest, $login);
        $authManager->addChild($guest, $signup);
        $authManager->addChild($guest, $emailconfirm);
        $authManager->addChild($guest, $passwordrequest);
        $authManager->addChild($guest, $resendverificationemail);
        $authManager->addChild($guest, $auth);
        $authManager->addChild($guest, $error);
        $authManager->addChild($guest, $index);
        $authManager->addChild($guest, $view);

        // user
        $authManager->addChild($user, $logout);
        $authManager->addChild($user, $passwordrequest);
        $authManager->addChild($user, $guest);

        // redactor
        $authManager->addChild($redactor, $create);
        $authManager->addChild($redactor, $user);

        //moderator
        $authManager->addChild($moderator, $redactor);
        $authManager->addChild($moderator, $update);
        $authManager->addChild($moderator, $redactor;

        // Admin
        $authManager->addChild($admin, $delete);
        $authManager->addChild($admin, $moderator);

        // root
        $authManager->addChild($admin, $root);
    }
}