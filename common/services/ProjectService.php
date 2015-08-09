<?php
namespace common\services;

use Yii;
use common\models\Project;
use common\models\Keyword;

class ProjectService
{

    public function addProject(Project $project) {
        $project->status = Project::STATUS_ACTIVE;
        $project->user_id = Yii::$app->user->id;
        $keyword = new Keyword();
        $keywordsId = $keyword->getKeywordsIdByText(Yii::$app->request->post('keywords'));
        $project->setKeywords($keywordsId);
        $project->save();
/*        if($keywordsId) {
            $params = array('project_id' => $project->id, 'keywordsId' => $keywordsId);
            $projectKeywordRelation = new ProjectKeywordRelation();
            $projectKeywordRelation->addProjectKeywordRelation($params);
        }*/
        return $project->id;
    }
}