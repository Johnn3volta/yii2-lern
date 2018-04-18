<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $name
 * @property string $surname
 * @property string $password_hash
 * @property string $access_token
 * @property string $auth_key
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Access[] $accesses
 * @property Note[] $notes
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface{

    public $password;

    /**
     * @inheritdoc
     */
    public static function tableName(){
        return 'user';
    }

    /**
     * @return array
     */
    public function behaviors(){
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => new Expression('NOW()'),
            ],

        ];
    }

    /**
     * @inheritdoc
     */
    public function rules(){
        return [
            [['username', 'name'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [
                [
                    'username',
                    'name',
                    'surname',
                    'password',
                    'access_token',
                    'auth_key',
                ],
                'string',
                'max' => 255,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(){
        return [
            'id'            => 'ID',
            'username'      => 'Ник',
            'name'          => 'Имя',
            'surname'       => 'Фамилия',
            'password'      => 'Пароль',
            'password_hash' => 'Пароль',
            'access_token'  => 'Access Token',
            'auth_key'      => 'Auth Key',
            'created_at'    => 'Создан',
            'updated_at'    => 'Обновлен',
        ];
    }

    public function beforeSave($insert){
        if(!parent::beforeSave($insert)){
            return false;
        }
        if ($this->isNewRecord) {
            $this->auth_key = Yii::$app->security->generateRandomString();
        }
        if($this->password){
            $this->password_hash = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        }

        return true;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccesses(){
        return $this->hasMany(Access::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotes(){
        return $this->hasMany(Note::class, ['creator_id' => 'id']);
    }

    public function getNotesAsArray(){
        return $this->hasMany(Note::class, ['creator_id' => 'id'])->asArray();
    }

    /**
     * @inheritdoc
     * @return \app\models\query\UserQuery the active query used by this AR
     *     class.
     */
    public static function find(){
        return new \app\models\query\UserQuery(get_called_class());
    }

    /**
     * @param $username
     *
     * @return \app\models\User|array|null
     */
    public static function findByUsername($username){
        return User::find()->where(['username' => $username])->one();
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     *
     * @return IdentityInterface|null the identity object that matches the
     *     given ID.
     */
    public static function findIdentity($id){
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     *
     * @return IdentityInterface|null the identity object that matches the
     *     given token.
     */
    public static function findIdentityByAccessToken($token, $type = null){
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey(){
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     *
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey){
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password){
        return Yii::$app->getSecurity()
                        ->validatePassword($password, $this->password_hash);
    }
}
