<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yz\shoppingcart\CartPositionInterface;
use yz\shoppingcart\CartPositionTrait;

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
class ProjectKeywordRelation extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'project_keyword_relation';
    }

    public function addProjectKeywordRelation($params) {
        if($params) {
            foreach($params['keywordsId'] as $keywordId) {
                $projectKeywordRelation = new ProjectKeywordRelation();
                $projectKeywordRelation->project_id = $params['project_id'];
                $projectKeywordRelation->keyword_id = $keywordId;
                $projectKeywordRelation->save();
                unset($projectKeywordRelation);
            }
        }
    }

}