<?php

namespace app\controllers;


use app\models\Note;
use app\models\User;
use yii\db\Connection;
use yii\db\Query;
use yii\web\Controller;

class TestController extends Controller{

    /**
     * @return string
     */
    public function actionIndex(){
        $model = Note::findOne(6);
        _end($model->creator->name);

        return $this->render('index', ['my' => $model]);
    }

    /**
     * @return int|string
     */
    public function actionSelect(){
        $query = (new Query())->from('user')->count();
        $query1 = (new Query())->from('user')->where(['id' => 1])->all();
        $query2 = (new Query())->from('user')
                               ->where(['>', 'id', 1])
                               ->orderBy('id')
                               ->all();
        _end($query);

        return $query;
    }

    /**
     * @throws \yii\db\Exception
     */
    public function actionInsert(){
        \Yii::$app->db->createCommand()->batchInsert('user', [
            'username',
            'name',
            'surname',
            'password_hash',
            'created_ad',
        ], [
            [
                'firsUser',
                'Johnn',
                'Pavlovski',
                'awdawdawfaw2e1212',
                time(),
            ],
            [
                'secondUser',
                'Johnn2',
                'Pavlovski2',
                'awda21212wdawfaw2e1212',
                time(),
            ],
            [
                'thirdUser',
                'Johnn3',
                'Pavlovski3',
                'awda21212wdawfaw2e1212',
                time(),
            ],
        ])->execute();
    }
}