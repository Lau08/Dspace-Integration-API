<?php

namespace app\modules\dspace\controllers;

use app\modules\dspace\models\ConfiguracionDspace;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use CURLFile;

class ItemController extends Controller
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

    //Items//

    /**
     * Devuelve todos los items
     * @return bool|string
     */
    public function actionGetItems()
    {
        if (Yii::$app->request->isGet) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/items';
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
     * Devuelve un item dado el id del mismo
     * @return bool|string
     */
    public function actionGetItem()
    {
        if (Yii::$app->request->isGet) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/items/';
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
     * Devuelve los metadatos de un item
     * @return bool|string
     */
    public function actionGetItemMetadatos()
    {
        if (Yii::$app->request->isGet) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/items/';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $token = $body['token'];
            $id = $body['id'];
            $final = '/metadata';
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

    /**
     * Devuelve los bitstreams dentro de un item
     * @return bool|string
     */
    //Bitstreams son los archivos
    public function actionGetItemBitstreams()
    {
        if (Yii::$app->request->isGet) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/items/';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $token = $body['token'];
            $id = $body['id'];
            $final = '/bitstreams';
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




    //Bitstreams//
    public function actionGetBitstreams()
    {
        if (Yii::$app->request->isGet) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/bitstreams';
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
    }//no devuelve nada

    /**
     * Devuelve un bitstream dado el id del mismo
     * @return bool|string
     */
    public function actionGetBitstream()
    {
        if (Yii::$app->request->isGet) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/bitstreams/';
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
     * Devuelve las políticas de un bitstream
     * @return bool|string
     */
    public function actionGetPoliticasBit()
    {
        if (Yii::$app->request->isGet) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/bitstreams/';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $token = $body['token'];
            $id = $body['id'];
            $final = '/policy';
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

    /**
     * Devuelve los datos de un bitstream
     * @return bool|string
     */
    //Descarga el archivo
    public function actionGetArchivo()
    {
        if (Yii::$app->request->isGet) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/bitstreams/';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $token = $body['token'];
            $id = $body['id'];
            $final = '/retrieve';
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

    //Items//
    /**
     * Permite Subir un bitstream o archivo a un item ya creado
     * @return bool|string
     */
    public function actionSubirBitstream()
    {
        if (Yii::$app->request->isPost) {
            $body = $_POST;

            $prefijo = '/rest/items/';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $token = $body['token'];
            $id = $body['id'];
            $final = '/bitstreams';

            $name = $body['name'];//nombre del archivo sin espacios
            $params = "?name=$name";
            $url = $host . ':' . $puerto . $prefijo . $id . $final . $params;

            $path = $body['path'];
            $file = new CURLFILE("$path");

            $headers = array("Content-Type: application/json", 'Accept: application/json', "rest-dspace-token: " . $token);

            $curl = curl_init($url);
            $options = array(
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => array('file'=> $file,'name' => $name),
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
     * Permite agregar metadatos a un Item
     * @return bool|string
     */
    public function actionAddMetadatosItem()//Probar Postman
    {
        if (Yii::$app->request->isPost) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/items/';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $token = $body['token'];
            $idItem = $body['idItem'];
            $final = '/metadata';
            $url = $host . ':' . $puerto . $prefijo . $idItem . $final;

            $valueTitulo = $body['titulo'];

            $valueDescripcion = $body['descripcion'];

            $item = "\n[{\n\"key\": \"dc.title\",\n\"value\": \"$valueTitulo\"\n},
            \n{\n\"key\": \"dc.description\",\n\"value\": \"$valueDescripcion\"\n}]\n\n";

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

    //Items//
    /**
     * Permite modificar los metadatos de un Item
     * @return bool|string
     */
    public function actionActualizarMetadatosItem()//Probar Postman
    {
        if (Yii::$app->request->isPut) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/items/';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $token = $body['token'];
            $idItem = $body['idItem'];
            $final = '/metadata';
            $url = $host . ':' . $puerto . $prefijo . $idItem . $final;

            $valueTitulo = $body['titulo'];

            $valueDescripcion = $body['descripcion'];

            $item = "\n[{\n\"key\": \"dc.title\",\n\"value\": \"$valueTitulo\"\n},
            \n{\n\"key\": \"dc.description\",\n\"value\": \"$valueDescripcion\"\n}]\n\n";

            $headers = array('Content-Type: application/json', 'Accept: application/json', "rest-dspace-token: " . $token);

            $curl = curl_init($url);
            $options = array(
                CURLOPT_CUSTOMREQUEST => "PUT",
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


    //Bitstreams//
    /**
     * Permite actualizar el archivo, subir el archivo
     * @return bool|string
     */
    public function actionActualizarDatosBitstream()
    {
        if (Yii::$app->request->isPut) {
            $body = $_REQUEST;

            $prefijo = '/rest/bitstreams/';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $token = $body['token'];
            $id = $body['id'];
            $final = '/data';

            $name = $body['name'];//nombre del archivo sin espacios
            $params = "?name=$name";
            $url = $host . ':' . $puerto . $prefijo . $id . $final . $params;

            $path = $body['path'];
            $file = new CURLFILE("$path");

            $headers = array("Content-Type: application/json", 'Accept: application/json', "rest-dspace-token: " . $token);

            $curl = curl_init($url);
            $options = array(
                CURLOPT_CUSTOMREQUEST => "PUT",
                CURLOPT_POSTFIELDS => array('file'=> $file,'name' => $name),
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

    //Items//
    /**
     * Permite eliminar un Item
     * @return bool|string
     */
    public function actionDeleteItem()//probar postman
    {
        if (Yii::$app->request->isDelete) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/items/';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $token = $body['token'];
            $id = $body['id'];
            $url = $host . ':' . $puerto . $prefijo . $id;

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
     * Permite eliminar los datos de un Item
     * @return bool|string
     */
    public function actionDeleteMetadatosDeItem()//probar en postman
    {
        if (Yii::$app->request->isDelete) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/items/';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $token = $body['token'];
            $id = $body['id'];
            $final = '/metadata';
            $url = $host . ':' . $puerto . $prefijo . $id . $final;

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
     * Permite eliminar un bitstream de un Item
     * @return bool|string
     */
    public function actionDeleteBitstreamDeItem()
    {
        if (Yii::$app->request->isDelete) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/items/';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $token = $body['token'];
            $idItem = $body['idItem']; //id item
            $idBit = $body['idBit']; //id bitstream
            $final = '/bitstreams/';
            $url = $host . ':' . $puerto . $prefijo . $idItem . $final . $idBit;

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


    //Bitstreams//
    /**
     * Permite eliminar un Bitstream
     * @return bool|string
     */
    public function actionDeleteBitstream()//probar postman
    {
        if (Yii::$app->request->isDelete) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/bitstreams/';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $token = $body['token'];
            $id = $body['id'];
            $url = $host . ':' . $puerto . $prefijo . $id;

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
     * Permite eliminar las políticas de un Bitstream
     * @return bool|string
     */
    public function actionDeleteBitstreamPolicy()//probar en postman
    {
        if (Yii::$app->request->isDelete) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/bitstreams/';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $token = $body['token'];
            $idBit = $body['idBit']; //id bitstream
            $idPolicy = $body['idPolicy']; //id policy
            $final = '/policy/';
            $url = $host . ':' . $puerto . $prefijo . $idBit . $final . $idPolicy;

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
