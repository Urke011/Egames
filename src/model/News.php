<?php

namespace app\model;

use app\common\ActiveRecord;

use app\App;

class News extends ActiveRecord
{
    public $id;
    public $title;
    public $content;
    public $intro;
    public $img_url;
    public $pub_date;
    public $game_user_id;
    public $category_id;
    
    protected static $attributeLabels = [
        'title' => 'Naslov', 
        'content' => 'Glavni tekst', 
        'intro' => 'Uvodni tekst', 
        'img_url' => 'Adresa slike',
        'pub_date' => 'Vreme objave', 
        'game_user_id' => 'Autor', 
        'category_id' => 'Kategorija', 

    ];
    public static function dbAttrs(): array 
    {
        return ['id', 'title', 'content', 'intro', 'img_url', 'pub_date', 'game_user_id', 'category_id'];
    }

    public static function formAttrs(): array 
    {
        return ['title', 'content', 'intro', 'img_url', 'game_user_id', 'category_id'];        
    }

    public static function table() {return 'news';}
    
    protected function required(): array {return static::formAttrs();}
    
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

    public function getCreator()
    {
        if ($this->isNew()) {
            if (App::get()->getUser()) {
                return App::get()->getUser();
            }
            return null;
        }
        return User::findById($this->game_user_id);
    }
    
    public function getCategory()
    {
        if ($this->isNew()) {
            return null;
        }
        return Category::findById($this->category_id);
    }
    
    public function getCommentsNumber()
    {
        if ($this->isNew()) {
            return 0;
        }
        $sql = 'SELECT COUNT(*) AS count FROM ' . Comment::table() . ' WHERE news_id='.$this->id;
        $st = App::get()->db()->prepare($sql);
        $st->execute();
        $row = $st->fetch();
        if (!$row) {
            return 0;
        }
        return $row['count'];
    }
    
    public function getComments()
    {
        return Comment::findAllByAttributes(['news_id' => $this->id], 'ORDER BY id DESC');
    }
    
    public static function search($search, $category) 
    {
        $params = [':search' => $search];
        $sql = 'SELECT * FROM ' . static::table() . 
               ' WHERE match(title, intro, content) AGAINST (:search IN NATURAL LANGUAGE MODE) ';
        if ($category) {
            $sql .= ' AND category_id=:category_id';
            $params[':category_id'] = $category->id;
        }
        $sql .= ' ORDER BY id DESC';
        return static::findAllBySql($sql, $params);
    }
}