<?php
namespace common\models;

use Yii;
use common\models\Project;

class ProjectService
{

    public function addProject(Project $project) {
        $project->status = Project::STATUS_ACTIVE;
        $project->user_id = Yii::$app->user->id;
        $project->save();
        $keyword = new Keyword();
        $keywordsId = $keyword->getKeywordsIdByText(Yii::$app->request->post('keywords'));
        if($keywordsId) {
            $params = array('project_id' => $project->id, 'keywordsId' => $keywordsId);
            $projectKeywordRelation = new ProjectKeywordRelation();
            $projectKeywordRelation->addProjectKeywordRelation($params);
        }
        return $project->id;
    }
}