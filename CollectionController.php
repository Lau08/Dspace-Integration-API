<?php

namespace app\modules\dspace\controllers;

use app\modules\dspace\models\ConfiguracionDspace;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;

class CollectionController extends Controller
{
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        //Se valida que este logeado el usuario
        $body = Yii::$app->request->getRawBody();
        $body = Json::decode($body);
        //LLevo a cabo la autenticacion del usuario
        return parent::beforeAction($action);
        //return true;
    }

    /* Metodos GET asociados a la api de dspace */

    /**
     * Devuelve todas las colecciones en dspace
     * @return bool|string
     */
    public function actionGetColecciones()
    {
        if (Yii::$app->request->isGet) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/collections';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $url = $host . ':' . $puerto . $prefijo;

            $token = $body['token'];

            $headers = array("Content-Type: application/json", "Accept: application/json", "rest-dspace-token: " . $token);

            $curl = curl_init($url);
            $options = array(
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => $headers
            );

            curl_setopt_array($curl, $options);
            $response = curl_exec($curl);
            curl_close($curl);
            return $response;
        }
    }

    /**
     * Devuelve una coleccion dado el id de la misma
     * @return bool|string
     */
    public function actionGetColeccion()
    {
        if (Yii::$app->request->isGet) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/collections/';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $token = $body['token'];
            $id = $body['id'];
            $url = $host . ':' . $puerto . $prefijo . $id;

            $headers = array("Content-Type: application/json", "Accept: application/json", "rest-dspace-token: " . $token);

            $curl = curl_init($url);
            $options = array(
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => $headers
            );

            curl_setopt_array($curl, $options);
            $response = curl_exec($curl);
            curl_close($curl);
            return $response;
        }
    }

    /**
     * Devuelve los items de una coleccion
     * @return bool|string
     */
    public function actionGetItemsDeColeccion()
    {
        if (Yii::$app->request->isGet) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/collections/';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $token = $body['token'];
            $id = $body['id'];
            $final = '/items';
            $url = $host . ':' . $puerto . $prefijo . $id . $final;

            $headers = array("Content-Type: application/json", "Accept: application/json", "rest-dspace-token: " . $token);

            $curl = curl_init($url);
            $options = array(
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => $headers
            );

            curl_setopt_array($curl, $options);
            $response = curl_exec($curl);
            curl_close($curl);
            return $response;
        }
    }


    //------------------------------------------------------------------------------------------------------------------

    /* Metodos POST asociados a la api de dspace */

    /**
     * Permite la creacion de un item
     * @return bool|string
     */
    public function actionCreateItem()
    {
        if (Yii::$app->request->isPost) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/collections/';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $token = $body['token'];
            $id = $body['id'];
            $final = '/items';
            $url = $host . ':' . $puerto . $prefijo . $id . $final;

            $valueAutor = $body['autor'];

            $valueDescripcion = $body['descripcion'];

            $valueResumen = $body['resumen'];

            $valueTitulo = $body['titulo'];

            $item = "{\"metadata\":[\n    {\n      \"key\": \"dc.contributor.author\",\n      
                \"value\": \"$valueAutor\"\n    },\n    {\n      \"key\": \"dc.description\",\n     
                 \"value\": \"$valueDescripcion\"\n    },\n    {\n      \"key\": \"dc.description.abstract\",\n     
                  \"value\": \"$valueResumen\"\n    },\n    {\n      \"key\": \"dc.title\",\n     
                   \"value\": \"$valueTitulo\"\n    }\n]}";
            //$datos = json_encode($item);

            $headers = array('Content-Type: application/json', 'Accept: application/json', "rest-dspace-token: " . $token);

            $curl = curl_init($url);
            $options = array(
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $item,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => $headers
            );

            curl_setopt_array($curl, $options);
            $response = curl_exec($curl);
            curl_close($curl);
            return $response;
        }
    }


    //------------------------------------------------------------------------------------------------------------------

    /*Metodos PUT asociados a la api de dspace */

    /**
     * Permite modificar una coleccion
     * @return bool|string
     */
    public function actionActualizarColeccion()
    {
        if (Yii::$app->request->isPut) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/collections/';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $token = $body['token'];
            $idCol = $body['idCol'];//id coleccion
            $url = $host . ':' . $puerto . $prefijo . $idCol;

            $name = $body['name'];
            $logo = $body['logo'];
            $copyrightText = $body['copyrightText'];
            $introductoryText = $body['introductoryText'];
            $shortDescription = $body['shortDescription'];
            $sidebarText = $body['sidebarText'];
            $license = $body['license'];
            $community = array('name' => "$name", "logo" => $logo, "copyrightText" => "$copyrightText", "introductoryText" => "$introductoryText", "shortDescription" => "$shortDescription", "sidebarText" => "$sidebarText", "license" => "$license");
            $datos = json_encode($community);

            $headers = array('Content-Type: application/json', 'Accept: application/json', "rest-dspace-token: " . $token);

            $curl = curl_init($url);
            $options = array(
                CURLOPT_CUSTOMREQUEST => "PUT",
                CURLOPT_POSTFIELDS => $datos,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => $headers
            );

            curl_setopt_array($curl, $options);
            $response = curl_exec($curl);
            curl_close($curl);
            return $response;
        }
    }


    //------------------------------------------------------------------------------------------------------------------

    /*Metodos DELETE asociados a la api de dspace */

    /**
     * Permite eliminar una coleccion
     * @return bool|string
     */
    public function actionDeleteColeccion()//probar postman
    {
        if (Yii::$app->request->isDelete) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/collections/';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $token = $body['token'];
            $idCol = $body['idCol'];//id de coleccion a eliminar
            $url = $host . ':' . $puerto . $prefijo . $idCol;

            $headers = array("Content-Type: application/json", "Accept: application/json", "rest-dspace-token: " . $token);

            $curl = curl_init($url);
            $options = array(
                CURLOPT_CUSTOMREQUEST => "DELETE",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => $headers
            );

            curl_setopt_array($curl, $options);
            $response = curl_exec($curl);
            curl_close($curl);
            return $response;
        }
    }

    /**
     * Permite eliminar un item de una coleccion
     * @return bool|string
     */
    public function actionDeleteItemEnColeccion()//probar en postman
    {
        if (Yii::$app->request->isDelete) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/collections/';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $token = $body['token'];
            $idCol = $body['idCol']; //id coleccion
            $idItem = $body['idItem']; //id item
            $final = '/items/';
            $url = $host . ':' . $puerto . $prefijo . $idCol . $final . $idItem;

            $headers = array("Content-Type: application/json", "Accept: application/json", "rest-dspace-token: " . $token);

            $curl = curl_init($url);
            $options = array(
                CURLOPT_CUSTOMREQUEST => "DELETE",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => $headers
            );

            curl_setopt_array($curl, $options);
            $response = curl_exec($curl);
            curl_close($curl);
            return $response;
        }
    }

}
