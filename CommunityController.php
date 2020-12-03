<?php

namespace app\modules\dspace\controllers;

use app\modules\dspace\models\ConfiguracionDspace;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;

class CommunityController extends Controller
{
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        //Se valida que este logeado el usuario
        $body = Yii::$app->request->getRawBody();
        $body = Json::decode($body);
        //LLevo a cabo la autenticacion del usuario

        //return parent::beforeAction($action);
        return true;
    }



    /* Metodos get asociados a la api de dspace */

    /**
     * Prueba la disponibilidad de la api de dspace
     * @return string
     */
    public function actionTest()
    {
        if (Yii::$app->request->isGet) {
            $prefijo = '/rest/test';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $url = $host . ':' . $puerto . $prefijo;

            $headers = array("Content-Type: application/json", "Accept: application/json");

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
     * Devuelve todas las comunidades en dspace
     * @return bool|string
     */
    public function actionGetComunidades()
    {
        if (Yii::$app->request->isGet) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/communities';
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
     * Devuelve las top comunities de dspace
     * @return bool|string
     */
    public function actionGetTopComunidades()
    {
        if (Yii::$app->request->isGet) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/communities/top-communities';
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
     * Devuelve una comunidad dado el id de la misma
     * @return bool|string
     */
    public function actionGetComunidad()
    {
        if (Yii::$app->request->isGet) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/communities/';
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
     * Devuelve todas las colecciones dentro de determinada comunidad
     * @return bool|string
     */
    public function actionGetColeccionesPorComunidad()
    {
        if (Yii::$app->request->isGet) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/communities/';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $token = $body['token'];
            $id = $body['id'];
            $final = '/collections';
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
     * Devuelve las subcomunidades dentro de una comunidad
     * @return bool|string
     */
    public function actionGetSubComunidad()
    {
        if (Yii::$app->request->isGet) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/communities/';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $token = $body['token'];
            $id = $body['id'];
            $final = '/communities';
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
     * Permite la creacion de una comunidad
     * @return bool|string
     */
    public function actionCreateComunidad()
    {
        if (Yii::$app->request->isPost) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/communities';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $url = $host . ':' . $puerto . $prefijo;

            $token = $body['token'];
            $name = $body['name'];
            $logo = $body['logo'];
            $copyrightText = $body['copyrightText'];
            $introductoryText = $body['introductoryText'];
            $shortDescription = $body['shortDescription'];
            $community = array('name' => "$name", "logo" => $logo,"copyrightText" => "$copyrightText","introductoryText" => "$introductoryText","shortDescription" => "$shortDescription");
            $datos = json_encode($community);

            $headers = array('Content-Type: application/json', 'Accept: application/json', "rest-dspace-token: " . $token);

            $curl = curl_init($url);
            $options = array(
                CURLOPT_CUSTOMREQUEST => "POST",
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

    /**
     * Permite la creacion de una coleccion en una comunidad
     * @return bool|string
     */
    public function actionCreateColeccionEnComunidad()
    {
        if (Yii::$app->request->isPost) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/communities/';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $token = $body['token'];
            $id = $body['id'];
            $final = '/collections';
            $url = $host . ':' . $puerto . $prefijo . $id . $final;

            $name = $body['name'];
            $logo = $body['logo'];
            $copyrightText = $body['copyrightText'];
            $introductoryText = $body['introductoryText'];
            $shortDescription = $body['shortDescription'];
            $sidebarText = $body['sidebarText'];
            $license = $body['license'];
            $community = array('name' => "$name", "logo" => $logo,"copyrightText" => "$copyrightText","introductoryText" => "$introductoryText", "shortDescription" => "$shortDescription","sidebarText" => "$sidebarText","license" => "$license");
            $datos = json_encode($community);

            $headers = array('Content-Type: application/json', 'Accept: application/json', "rest-dspace-token: " . $token);

            $curl = curl_init($url);
            $options = array(
                CURLOPT_CUSTOMREQUEST => "POST",
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

    /**
     * Permite la creacion de una subcomunidad
     * @return bool|string
     */
    public function actionCreateSubcomunidad()
    {
        if (Yii::$app->request->isPost) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/communities/';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $token = $body['token'];
            $id = $body['id'];
            $final = '/communities';
            $url = $host . ':' . $puerto . $prefijo . $id . $final;

            $name = $body['name'];
            $logo = $body['logo'];
            $copyrightText = $body['copyrightText'];
            $introductoryText = $body['introductoryText'];
            $shortDescription = $body['shortDescription'];
            $community = array('name' => "$name", "logo" => $logo,"copyrightText" => "$copyrightText","introductoryText" => "$introductoryText","shortDescription" => "$shortDescription");
            $datos = json_encode($community);

            $headers = array('Content-Type: application/json', 'Accept: application/json', "rest-dspace-token: " . $token);

            $curl = curl_init($url);
            $options = array(
                CURLOPT_CUSTOMREQUEST => "POST",
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

    /* Metodos PUT asociados a la api de dspace */


    public function actionModificarComunidad()
    {
        if (Yii::$app->request->isPut) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/communities/';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $token = $body['token'];
            $id = $body['id'];
            $url = $host . ':' . $puerto . $prefijo . $id;

            $name = $body['name'];
            $logo = $body['logo'];
            $copyrightText = $body['copyrightText'];
            $introductoryText = $body['introductoryText'];
            $shortDescription = $body['shortDescription'];
            $community = array('name' => "$name", "logo" => $logo,"copyrightText" => "$copyrightText","introductoryText" => "$introductoryText","shortDescription" => "$shortDescription");
            $datos = json_encode($community);

            $headers = array("Content-Type: application/json", "Accept: application/json", "rest-dspace-token: " . $token);

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
     * Permite eliminar una comunidad
     * @return bool|string
     */
    public function actionDeleteComunidad()
    {
        if (Yii::$app->request->isDelete) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/communities/';
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
     * Permite eliminar una coleccion en una comunidad
     * @return bool|string
     */
    public function actionDeleteColeccionEnComunidad()
    {
        if (Yii::$app->request->isDelete) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/communities/';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $token = $body['token'];
            $idCom = $body['idCom']; //id comunidad
            $idCol = $body['idCol']; //id coleccion
            $final = '/collections/';
            $url = $host . ':' . $puerto . $prefijo . $idCom . $final . $idCol;

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
     * Permite eliminar una subcomunidad
     * @return bool|string
     */
    public function actionDeleteSubcomunidad()
    {
        if (Yii::$app->request->isDelete) {
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/communities/';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $token = $body['token'];
            $idCom = $body['idCom']; //id comunidad
            $idSub = $body['idSub']; //id subcomunidad
            $final = '/communities/';
            $url = $host . ':' . $puerto . $prefijo . $idCom . $final . $idSub;

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
