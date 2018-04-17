<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $name
 * @property string $surname
 * @property string $password_hash
 * @property string $access_token
 * @property int $created_ad
 * @property int $updated_ad
 *
 * @property Access[] $accesses
 * @property Note[] $notes
 */
class User extends \yii\db\ActiveRecord{

    /**
     * @inheritdoc
     */
    public static function tableName(){
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules(){
        return [
            [['username', 'name', 'password_hash', 'created_ad'], 'required'],
            [['created_ad', 'updated_ad'], 'integer'],
            [
                [
                    'username',
                    'name',
                    'surname',
                    'password_hash',
                    'access_token',
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
            'username'      => 'Username',
            'name'          => 'Name',
            'surname'       => 'Surname',
            'password_hash' => 'Password Hash',
            'access_token'  => 'Access Token',
            'created_ad'    => 'Created Ad',
            'updated_ad'    => 'Updated Ad',
        ];
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
}
