<?php

namespace common\components\parse\csv;

use yii\base\Model;
use common\models\AddrList;

class Parser
{
    const OPERATORS = [
        'DEFAULT' => 1,
    ];

    private Model $file;
    private $geocoder;

    public function __construct(Model $file, $geocoder)
    {
        $this->file = $file;
        $this->geocoder = $geocoder;
    }

    /**
     * each strings
     * Перебираем строки в CSV файле
     * 1 - Запрос к API для геокодинга
     * 2 - Проверка адреса на наличие в базе
     * 3 - Заполнение и сохранение данных по адресу
     * @return void
     * @throws \Exception
     */
    public function go(): void
    {
        if (($handle = fopen($this->file->getUploadFileName(), 'r') ) !== false) {
            // street, house, building
            while ($address = fgetcsv($handle, separator: ',')) {
                // запрос к апи геокодера
                $responseData = $this->geocoder->getNameAndCoords($address);

                // проверка наличия в базе (пропустить, если есть)
                if (AddrList::findOne(['address' => $responseData['address_text']])) {
                    continue;
                }

                // сохранение
                $model = new AddrList();

                $model->file_id = $this->file->file_id;
                $model->city = $this->geocoder->city;

                $model->street = $address[0];
                $model->house = $address[1];
                $model->build = $address[2];

                $model->address = $responseData['address_text'];

                $model->lon = $responseData['lon'];
                $model->lat = $responseData['lat'];

                $model->operator = self::OPERATORS['DEFAULT'];
                $model->api_response = json_encode($responseData['api_response'], JSON_UNESCAPED_UNICODE);

                if (!$model->save() ) {
                    throw new \Exception('Addr List add failed');
                }
            }
        }
    }
}
