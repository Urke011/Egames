<?php

namespace app\common;

use app\App;

abstract class ActiveRecord extends Model
{
    public abstract static function dbAttrs(): array;
    public abstract static function table();
        
    public static function findById($id)
    {
        return self::findOneByAttributes(['id'=>$id]);
    }
    
    public static function findOneByAttributes(array $pairs)
    {
        $all = self::findAllByAttributes($pairs);
        if (empty($all)) {
            return null;
        }
        return $all[0];
    }
    
    public static function findAllByAttributes(array $pairs, $orderBy='')
    {
        $sql = 'SELECT * FROM ' . static::table();
        $bindParams = [];
        $condition = '';
        foreach ($pairs as $key => $value) {
            $condition .= " $key=:$key AND";
            $bindParams[":$key"] = $value;
        }
        if ($condition) {
            $sql .= ' WHERE ';
            $sql .= substr($condition, 0, strlen($condition) - strlen('AND'));
        }
        $sql .= ' ' . $orderBy;
        return self::findAllBySql($sql, $bindParams);
        
    }
    
    public static function findAllBySql($sql, $params)
    {
        $stm = App::get()->db()->prepare($sql);
        foreach ($params as $key => $value) {
            $stm->bindValue($key, $value);
        }
        $stm->execute();
        $result = [];
        while (($row = $stm->fetch())) {
            $model = new static();
            $model->loadFromDbRow($row);
            $result[] = $model;
        }        
        return $result;
    }
    
    public static function findAll($orderBy='')
    {
        return static::findAllByAttributes([], $orderBy);
    }
    
    protected function loadFromDbRow($row)
    {
        $this->load(static::dbAttrs(), $row);
    }
    
    public function isNew()
    {
        return empty($this->id);
    }
    
    public function save(): bool
    {
        if (!$this->isValid()) {
            return false;
        }
        $columns = array_filter(static::dbAttrs(), function($attr) {return $attr !== 'id';});
        if ($this->isNew()) {
            $columnList = implode(',', $columns);
            $placeholderListArray = array_map(function($attr){return ':'.$attr;}, $columns);
            $placeholderList = implode(',', $placeholderListArray);
            $sql = 'INSERT INTO ' . static::table() .'('. $columnList . ') VALUES('.$placeholderList . ')';
        } else {
            $assignValues = '';
            foreach ($columns as $column) {
                $assignValues .= " $column=:$column,";
            }
            $sql = 'UPDATE ' . static::table() . ' SET ' . rtrim($assignValues, ',') . ' WHERE id='.$this->id;
        }
        $stm = App::get()->db()->prepare($sql);
        foreach ($columns as $attr) {
            $stm->bindValue(":$attr", $this->$attr);
        } 
        $stm->execute();
        if ($this->isNew()) {
            $this->id = App::get()->db()->lastInsertId();
        }
        return true;
    }
    
    public function delete()
    {
        if ($this->isNew()) {
            return;
        }
        $sql = 'DELETE FROM ' . static::table() . ' WHERE id='.$this->id;
        $st = App::get()->db()->prepare($sql);        
        return $st->execute();
    }    
}
