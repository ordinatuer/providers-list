<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "addr_list".
 *
 * @property int $id
 * @property int $file_id
 * @property string $city
 * @property string $street
 * @property string|null $house
 * @property string|null $build
 * @property string|null $address
 * @property float|null $lon
 * @property float|null $lat
 * @property int|null $operator
 * @property string|null $api_response
 *
 * @property Tracks $file
 */
class AddrList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'addr_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file_id', 'city', 'street'], 'required'],
            [['file_id', 'operator'], 'default', 'value' => null],
            [['file_id', 'operator'], 'integer'],
            [['lon', 'lat'], 'number'],
            [['api_response', 'address'], 'string'],
            [['city', 'street', 'house', 'build'], 'string', 'max' => 255],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tracks::class, 'targetAttribute' => ['file_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'file_id' => Yii::t('app', 'File ID'),
            'city' => Yii::t('app', 'City'),
            'street' => Yii::t('app', 'Street'),
            'house' => Yii::t('app', 'House'),
            'build' => Yii::t('app', 'Build'),
            'build' => Yii::t('app', 'Address'),
            'lon' => Yii::t('app', 'Lon'),
            'lat' => Yii::t('app', 'Lat'),
            'operator' => Yii::t('app', 'Operator'),
            'api_response' => Yii::t('app', 'Api Response'),
        ];
    }

    /**
     * Gets query for [[File]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(Tracks::class, ['id' => 'file_id']);
    }
}
