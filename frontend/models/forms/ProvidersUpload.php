<?php

namespace frontend\models\forms;

use yii\base\Model;
use common\models\AddrFiles;

class ProvidersUpload extends Model
{
    const PROVIDERS_DIR = 'providers';
    const UPLOAD_DIR = 'uploads';

    public $name;
    public $file;
    public $file_id;

    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
            [
                ['file'],
                'file',
                'skipOnEmpty' => false,
                'extensions' => 'csv',
                'maxFiles' => 1,
            ],
        ];
    }

    /**
     * Сохраняем файл и запоминаем это в БД
     * @throws yii\base\Exception
     */
    public function upload(): bool
    {
        if ($this->validate()) {
            // upload file
            $fileName = $this->getUploadFileName();
            $this->file->saveAs($fileName);
            $this->name = ($this->name) ? $this->name : $this->file->baseName;

            // add to DB
            $file = AddrFiles::addFile($this);

            if ($file->hasErrors()) {
                $this->addError('file', $file->getErrorSummary(true)[0]);
                return false;
            }

            $this->file_id = $file->id;

            return true;
        }

        return false;
    }

    public function attributeLabels()
    {
        return [
            'name' => \Yii::t('app', 'Name'),
            'file' => 'Список адресов',
        ];
    }

    public function getUploadFileName()
    {
        return $this->getUploadDir() . $this->file->baseName . '.' . $this->file->extension;
    }

    public function getUploadDir()
    {
        return self::UPLOAD_DIR . '/' . self::PROVIDERS_DIR . '/';
    }
}