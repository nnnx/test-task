<?php

namespace console\controllers;

use common\models\User;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit($username = 'admin', $email = 'admin@example.com')
    {
        $authManager = Yii::$app->authManager;
        $authManager->removeAll();

        foreach (User::getRoles() as $key => $label) {
            $role = $authManager->createRole($key);
            $role->description = $label;
            $authManager->add($role);
        }

        $user = User::find()->where(['username' => $username])->one();
        if (!$user) {
            $user = new User();
            $user->setAttributes([
                'username' => $username,
                'email' => $email,
                'status' => User::STATUS_ACTIVE,
            ]);
            $password = Yii::$app->security->generateRandomString(8);
            $user->setPassword($password);
            $user->generateAuthKey();
            if ($user->save()) {
                $authManager->assign($authManager->getRole(User::ROLE_ADMIN), $user->id);
                echo "\n$username:$password\n";
            }
        }
    }
}
