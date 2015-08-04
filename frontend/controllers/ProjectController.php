<?php
namespace frontend\controllers;

use Yii;
use common\models\Project;
use common\models\Keyword;
use common\services\ProjectService;
use common\services\ProjectKeywordRelation;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

/**
 * Site controller
 */
class ProjectController extends Controller
{
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['actionView', 'actionAddProject'],
                'rules' => [
                    [
                        'actions' => ['actionAddProject'],
                        'allow' => true,
                        'roles' => ['actionAddProject'],
                    ],
                    [
                        'actions' => ['actionView'],
                        'allow' => true,
                        'roles' => ['actionView'],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    throw new ForbiddenHttpException('Access denied');
                }
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionView($id)
    {
    	$model = $this->findModel($id);
		$dataProvider = new ActiveDataProvider(['query' => $model->getKeywords()]);
		return $this->render('view', [
            'model' => $model,
//            'keyword' => $projectKeywords
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAddProject()
    {
/*
        $model = new Project();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        	$model->status = self::STATUS_ACTIVE;
        	$model->user_id = Yii::$app->user->id;
	        $model->save();
	        $keyword = new Keyword();
	        $keywordsId = $keyword->getKeywordsIdByText(Yii::$app->request->post('keywords'));
	        if($keywordsId) {
		        $params = array('project_id' => $model->id, 'keywordsId' => $keywordsId);
		        $projectKeywordRelation = new ProjectKeywordRelation();
		        $projectKeywordRelation->addProjectKeywordRelation($params);
	        }
            return $this->redirect(['project/view/' . $model->id . '/']);
        } else {
            return $this->render('addProject', [
                'model' => $model,
            ]);
        }
*/
        $service = new ProjectService();
        $model = new Project();
        if($model->load(Yii::$app->request->post()) && $model->validate()) {
        	$project_id = $service->addProject($model);
        	return $this->redirect(['project/view/' . $project_id . '/']);
        } else {
            return $this->render('addProject', [
                'model' => $model,
            ]);
        }

    }
/*
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['project/view/'.$model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
*/
    public function actionAddKeywordToProject() {

    }



    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}