<?php

namespace app\controllers;

use app\models\Note;
use Yii;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller{

    /**
     * @inheritdoc
     */
    public function behaviors(){
        return [
            'verbs' => [
                'class'   => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     *
     * @return mixed
     */
    public function actionIndex(){
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return mixed
     */
    public function actionTest(){
        $models = User::find()->with('notes')->asArray()->all();
        $models2 = User::find()->joinwith('notes')->asArray()->all();

//        _end($models);


        return $this->render('test', [
            'models' => $models,
            'models2' => $models2
        ]);
    }

    /**
     *
     */
    public function actionAdd(){
        $model = User::findOne(2);
        $modNote = new Note();
        $modNote->text = 'Очередная запись'.time();
        return $modNote->link('creator',$model);
    }

    /**
     * Displays a single User model.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id){
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view'
     * page.
     *
     * @return mixed
     */
    public function actionCreate(){
        $model = new User();

        if($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view'
     * page.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id){
        $model = $this->findModel($id);

        if($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     *
     * @return \yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionDelete($id){
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id){
        if(($model = User::findOne($id)) !== null){
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
