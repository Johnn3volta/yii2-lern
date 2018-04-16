<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Product".
 *
 * @property int $id
 * @property int $price
 * @property string $name
 * @property string $category
 * @property string $create_ad
 */
class Product extends \yii\db\ActiveRecord{

    /**
     * @inheritdoc
     */
    public static function tableName(){
        return 'Product';
    }

//    public function scenarios(){
//        return [
//            self::SCENARIO_DEFAULT => ['name']
//        ];
//    }

    /**
     * @inheritdoc
     */
    public function rules(){
        return [
            [['price','create_ad'], 'integer', 'max' => 1000, 'min'=> 0],
            [['name', 'category'], 'string'],
            [
                ['name'],
                'filter',
                'filter' => function ($value){
                    return trim(strip_tags($value));
                },
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(){
        return [
            'id'        => 'ID',
            'price'     => 'Price',
            'name'      => 'Name',
            'category'  => 'Category',
            'create_ad' => 'Create Ad',
        ];
    }
}
