<?php
/**
 * Created by PhpStorm.
 * User: johnn3volta
 * Date: 30.03.2018
 * Time: 19:53
 */

namespace app\controllers;



use app\models\Product;
use yii\web\Controller;

class TestController extends Controller{

//    public function actionIndex(){
//        return $this->renderContent('Здравствуйте, я TestController ! actionindex');
//    }
    public function actionIndex(){




        $model = \Yii::$app->test->run();

        return $this->render('index',['my' => $model]);
    }

}