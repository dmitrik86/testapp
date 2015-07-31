<?php
namespace common\models;

use Yii;
use common\models\User;

class UserService
{

    public static function getProjectItems() {
        $items = [];
        $items[] = ['label' => 'Добавить проект', 'url' => ['/project/add-project']];
        $user = new User();
        $projects = $user->findOne(Yii::$app->user->identity->id)->getProjects()->all();
        if($projects && is_array($projects)) {
            foreach($projects as $project) {
                $items[] = ['label' => $project->projectname, 'url' =>['/project/view', 'id' => $project->id]];
            }
        }
        return $items;
    }
}
