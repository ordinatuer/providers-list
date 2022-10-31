<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "points".
 *
 * @property int $id
 * @property float $lat
 * @property float $lon
 * @property string $location
 * @property int $track_id
 */
class Points extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'points';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lat', 'lon', 'location', 'track_id'], 'required'],
            [['lat', 'lon'], 'number'],
            [['track_id'], 'default', 'value' => null],
            [['track_id'], 'integer'],
            [['location'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lat' => 'Lat',
            'lon' => 'Lon',
            'location' => 'Location',
            'track_id' => 'Track ID',
        ];
    }
}
