<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tag_post".
 *
 * @property integer $tag_id
 * @property integer $post_id
 */
class TagPost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_id', 'post_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tag_id' => 'Tag ID',
            'post_id' => 'Post ID',
        ];
    }
}
