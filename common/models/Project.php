<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property integer $category_id
 * @property string $price
 *
 * @property Image[] $images
 * @property OrderItem[] $orderItems
 * @property Category $category
 */
class Project extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 'active';
    const STATUS_DELETED = 'deleted';
    const STATUS_DISABLED = 'disabled';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['projectname', 'filter', 'filter' => 'trim'],
            ['projectname', 'required', 'message' => 'Это поле обязательно'],
            ['projectname', 'unique', 'targetClass' => '\common\models\Project', 'message' => 'Проект с этим именем уже есть в базе'],
            ['projectname', 'string', 'min' => 2, 'max' => 255, 'message' => 'Название проекта дожно быть от 2 до 255 символов'],
        ];
    }

    public static function tableName()
    {
        return 'project';
    }
/*
	public function getProjects() {
	    return $this->hasMany(Project::className(), ['id' => 'project_id'])
	      ->viaTable('project_keyword_relation', ['keyword_id' => 'id']);
	}
*/
	public function getKeywords() {
	    return $this->hasMany(Keyword::className(), ['id' => 'keyword_id'])
	      ->viaTable('project_keyword_relation', ['project_id' => 'id']);
	}

	public function getUser() {
	    return $this->hasOne(User::className(), ['id' => 'user_id']);
	}

    public function search($params)
    {
        $query = Project::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

//        $query->joinWith('');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'projectname', $this->keyword])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'user_id', $this->user_id]);

        return $dataProvider;
    }

}