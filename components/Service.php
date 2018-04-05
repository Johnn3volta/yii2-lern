<?php

namespace app\components;

class Service extends \yii\base\Component{

    public $my = 'My  Service';

    public function run(){

        return $this->my;

    }
}