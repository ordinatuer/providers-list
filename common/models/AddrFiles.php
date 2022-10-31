<?php

namespace common\models;

use yii\base\Model;
use yii\base\Exception;

/**
 *
 * @property int $id
 * @property int $user_id
 * @property string $load_date
 * @property string $track_date
 * @property string $name
 * @property string $track_file
 */
class AddrFiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tracks';
    }

    /**
     * Сделать запись о файле и вернуть заполненную модель
     */
    public static function addFile(Model $providersFile)
    {
        $model = new self();
        $date = \Yii::$app->formatter->asDatetime('now');
        
        $model->user_id = \Yii::$app->user->id;
        $model->load_date = $date;
        $model->track_date = $date;
        $model->name = $providersFile->name;
        $model->track_file = $providersFile->file->baseName;

        $model->save();

        return $model;
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
            ['track_file', 'unique', 'message' => '{attribute} с именем "{value}" уже есть'],
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
            'load_date' => 'Время загрузки',
            'track_date' => 'Track Date',
            'name' => 'Название',
            'track_file' => 'Файл с адресами',
        ];
    }
}
