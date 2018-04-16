<?php
/**
 * Created by PhpStorm.
 * User: johnn3volta
 * Date: 30.03.2018
 * Time: 19:53
 */

namespace app\controllers;



use app\models\Product;
use yii\db\Connection;
use yii\db\Query;
use yii\web\Controller;

class TestController extends Controller{

//    public function actionIndex(){
//        return $this->renderContent('Здравствуйте, я TestController ! actionindex');
//    }
    public function actionIndex(){


//        _end(\Yii::$app->db->createCommand('SELECT * FROM Product')->queryOne());
        $query = (new Query())->from('Product');
        _end($query->all());

        $model = new Product();
        $model->setAttributes(['id' => 12,'name' => 'firsTest','price' => 12345]);
        app()->test;
//        \Yii::info('success','payment');
//        \Yii::getLogger()->flush();
//
//        return $this->renderContent('success');

//        $model = \Yii::$app->test->run();

        return $this->render('index',['my' => $model]);
    }

}