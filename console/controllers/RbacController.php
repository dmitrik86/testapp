<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // add "updatePost" permission
        $actionAbout = $auth->createPermission('actionAbout');
        $actionAbout->description = 'Action about';
        $auth->add($actionAbout);

        // add "updatePost" permission
        $actionContact = $auth->createPermission('actionContact');
        $actionContact->description = 'Action contact';
        $auth->add($actionContact);

        // add "client" role and give this role the "actionContact" permission
        $client = $auth->createRole('client');
        $auth->add($client);
        $auth->addChild($client, $actionContact);

        // add "admin" role and give this role the "actionAbout" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $actionAbout);
        $auth->addChild($admin, $client);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        //$auth->assign($author, 2);
        //$auth->assign($admin, 1);
    }
}