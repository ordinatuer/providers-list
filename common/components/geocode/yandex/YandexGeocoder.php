<?php

namespace common\components\geocode\yandex;
use yii\base\Exception;
use yii\base\BaseObject;
use yii\httpclient\Client;
use yii\httpclient\Response;

class YandexGeocoder extends BaseObject
{
    const GEOCODE_SEPARATOR = '+';
    const CSV_SEPARATOR = ',';

    public $apikey;
    public $apiurl;
    public $format;
    public $city;
    public $kind = 'house';

    private $geocode;
    private $client;

    public function init()
    {
        parent::init();

        $this->client = new Client();
    }


    public function getNameAndCoords($address): Array
    {
        $data = [];
        $response = $this->sendGeocode($address);

        $data['api_response'] = $response->data;

        $data['address_text'] = $response->data['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['metaDataProperty']['GeocoderMetaData']['Address']['formatted'];
        $data['name'] = $response->data['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['name'];

        // [lon, lat]
        list($data['lon'], $data['lat']) = explode(' ', $response->data['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos']);

        return $data;
    }

    /**
     * Формирование и отправка запроса
     * Array [City, Street, House, Build] | String "City, Street, House, Build"
     * @param Array|String $query
     * @return yii\httpclient\Response
     * @throws Exception
     */
    private function sendGeocode(Array|String $query)
    {
        if (is_string($query)) {
            $query = explode(self::CSV_SEPARATOR, $query);
        }

        array_unshift($query, $this->city);
        $this->geocode = implode(self::GEOCODE_SEPARATOR, $query);


        if (!$this->geocode) {
            throw new Exception("Smtg wrng with \"geocode\" parameter");
        }

        return $this->get();
    }

    /**
     * Отправка запроса с использовнием yii/httpclient
     * https://geocode-maps.yandex.ru/1.x/?apikey=API_KEY&geocode=City+Street+house+build&format=json&kind=house
     * @return yii\httpclient\Response
     */
    private function get(): Response
    {
        $response = $this->client->get($this->apiurl, [
            'apikey' => $this->apikey,
            'geocode' => $this->geocode,
            'format' => $this->format,
            'kind' => $this->kind,
        ])->send();

        if (!$response->isOk) {
            throw new Exception(self::class . ' API error');
        }

        return $response;
    }
}