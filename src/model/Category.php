<?php

namespace app\model;

use app\common\ActiveRecord;

use app\model\News;

use app\App;

class Category extends ActiveRecord
{
    public $id;
    public $name;
    
    protected static $attributeLabels = ['name' => 'Naziv kategorije'];
    
    public static function dbAttrs(): array {return ['id', 'name'];}

    public static function formAttrs(): array {return ['name'];}

    public static function table() {return 'category';}
    
    public function getNews()
    {
        return News::findAllByAttributes(['category_id' => $this->id], 'ORDER BY id DESC');
    }
    
    public function isEmpty()
    {
        return ! News::findAllByAttributes(['category_id' => $this->id], 'LIMIT 1');
    }
    
    public function required(): array {return ['name'];}

}