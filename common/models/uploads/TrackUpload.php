<?php

namespace common\models\uploads;

use yii\base\Model;

class TrackUpload extends Model
{
    public $name;
    public $track_file;

    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
            [
                ['track_file'],
                'file',
                'skipOnEmpty' => false,
                //'extensions' => 'application/xml, text/xml, xml, gpx',
                'maxFiles' => 1,
            ]
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->track_file->saveAs('uploads/' . $this->track_file->baseName . '.' . $this->track_file->extension);
            return true;
        }

        return false;
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'track_file' => 'Track File',
        ];
    }
}