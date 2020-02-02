<?php

namespace app\model;

use app\common\ActiveRecord;

use app\model\News;

use app\App;

class Comment extends ActiveRecord
{
    public $id;
    public $content;
    public $pub_date;
    public $game_user_id;
    public $news_id;
    
    
    protected static $attributeLabels = ['content' => 'Tekst komentara'];
    
    public static function dbAttrs(): array {return ['id', 'content', 'pub_date', 'game_user_id', 'news_id'];}

    public static function formAttrs(): array {return ['content'];}

    public static function table() {return 'comment';}

    public function required(): array {return ['content'];}
    
    public function save(): bool
    {
        if (empty($this->game_user_id)) {
            $this->game_user_id = App::get()->getUser()->id;
        }
        if (empty($this->pub_date)) {
            $this->pub_date = date('Y-m-d H:i:s');
        }
        return parent::save();
    }
    
    public function getAuthor()
    {
        return User::findById($this->game_user_id);
    }

    public function getNews()
    {
        return News::findById($this->news_id);
    }
    
}