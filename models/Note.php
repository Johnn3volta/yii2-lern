<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "note".
 *
 * @property int $id
 * @property string $text
 * @property int $creator_id
 * @property string $created_at
 *
 * @property Access[] $accesses
 * @property User $creator
 */
class Note extends \yii\db\ActiveRecord{

    const RELATION_CREATOR = 'creator';

    public function behaviors(){
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false
            ],
        ];

    }

    /**
     * @inheritdoc
     */
    public static function tableName(){
        return 'note';
    }

    /**
     * @inheritdoc
     */
    public function rules(){
        return [
            [['text', 'creator_id'], 'required'],
            [['text'], 'string'],
            [['creator_id', 'created_at'], 'integer'],
            [
                ['creator_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => User::class,
                'targetAttribute' => ['creator_id' => 'id'],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(){
        return [
            'id'         => 'ID',
            'text'       => 'Text',
            'creator_id' => 'Creator ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccesses(){
        return $this->hasMany(Access::class, ['note_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator(){
        return $this->hasOne(User::class, ['id' => 'creator_id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\NoteQuery the active query used by this AR
     *     class.
     */
    public static function find(){
        return new \app\models\query\NoteQuery(get_called_class());
    }
}
