<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tracks".
 *
 * @property int $id
 * @property int $user_id
 * @property string $load_date
 * @property string $track_date
 * @property string $name
 * @property string $track_file
 */
class Tracks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tracks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'load_date', 'track_date', 'name', 'track_file'], 'required'],
            [['user_id'], 'default', 'value' => null],
            [['user_id'], 'integer'],
            [['load_date', 'track_date'], 'safe'],
            [['name', 'track_file'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'load_date' => 'Load Date',
            'track_date' => 'Track Date',
            'name' => 'Name',
            'track_file' => 'Track File',
        ];
    }
}
