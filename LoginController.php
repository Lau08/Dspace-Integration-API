<?php


namespace app\modules\dspace\controllers;


use app\modules\dspace\models\ConfiguracionDspace;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;

class LoginController extends Controller
{
    public function beforeAction($action)
    {
        $this->enableCsrfValidation=false;
        //Se valida que este logeado el usuario
        $body = Yii::$app->request->getRawBody();
        $body = Json::decode($body);
        //LLevo a cabo la autenticacion del usuario

        //return parent::beforeAction($action);
        return true;
    }

    public function actionLogin()
    {
        if(Yii::$app->request->isPost){
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $email = $body['email'];
            $password = $body['password'];
            $credenciales = array('email' => $email, 'password' => $password);
            $datos_credenciales = json_encode($credenciales);

            $prefijo = '/rest/login';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $url = $host . ':' . $puerto . $prefijo;

            $headers = array('Content-Type: application/json', 'Accept: application/json');

            $curl = curl_init($url);
            $options = array(
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $datos_credenciales,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => $headers
            );

            curl_setopt_array($curl, $options);
            $token = curl_exec($curl);
            curl_close($curl);
            return $token;
        }
    }

    public function actionStatus()
    {
        if(Yii::$app->request->isGet){
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/status';
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

    public function actionLogout()
    {
        if(Yii::$app->request->isPost){
            $body = Yii::$app->request->getRawBody();
            $body = Json::decode($body);

            $prefijo = '/rest/logout';
            $host = ConfiguracionDspace::find()->where("clave='host'")->one()->valor;
            $puerto = ConfiguracionDspace::find()->where("clave='puerto'")->one()->valor;

            $url = $host . ':' . $puerto . $prefijo;

            $token = $body['token'];

            $headers = array("Content-Type: application/json", "Accept: application/json", "rest-dspace-token: " . $token);

            $curl = curl_init($url);
            $options = array(
                CURLOPT_CUSTOMREQUEST => "POST",
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
