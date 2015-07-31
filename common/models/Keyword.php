<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;

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
class Keyword extends \yii\db\ActiveRecord
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
            ['keyword', 'trim'],
            ['keyword', 'required', 'message' => 'Это поле обязательно'],
            ['keyword', 'unique', 'targetClass' => '\common\models\Keyword', 'message' => 'Это ключевое слово уже есть в базе'],
            ['keyword', 'string', 'min' => 2, 'max' => 255, 'message' => 'Ключевое слово должно состоять минимум из 2  и максимум из 255 символов'],
        ];
    }

    public static function tableName()
    {
        return 'keyword';
    }
/*
    public function getKeywords()
    {
        return $this->hasMany(Keyword::className(), ['id' => 'keyword_id'])
          ->viaTable('project_keyword_relation', ['project_id' => 'id']);
    }
*/
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['id' => 'project_id'])
          ->viaTable('project_keyword_relation', ['keyword_id' => 'id']);
    }

    public function search($params)
    {
        $query = Keyword::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'keyword', $this->keyword])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }


    public function getKeywordsIdByText($params)
    {
        $keywords = $this->getKeywordsArrayByText($params);
        if($keywords) {
            $keywordsId = array();
            foreach($keywords as $keyword) {
                $keywordData = Keyword::findOne(['keyword' => $keyword]);
                if($keywordData) {
                    $keywordsId[] = $keywordData->id;
                }
                else {
                    $keywordsId[] = $this->addKeyword($keyword);
                }
            }
        }
        if(isset($keywordsId) && $keywordsId)
            return $keywordsId;
        return false;
    }

    public function addKeyword($params) {
        $model = new Keyword();
        if(is_string($params)) {
            $model->keyword = $params;
        }
        $model->status = self::STATUS_ACTIVE;
        $model->save();
        return $model->id;
    }

    public function getKeywordsArrayByText($params) {
        if(is_string($params) && trim($params)) {
            if(mb_strpos($params, "\r\n", 0, 'utf-8') !== false) {
                $keywords = array_map('trim', explode("\r\n", $params));
            }
            else {
                $keywords = array(trim($params));
            }
        }
        if(isset($keywords) && is_array($keywords))
            return $keywords;
        return false;
    }


}