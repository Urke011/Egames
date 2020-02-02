<?php

namespace app\common;

abstract class Model
{
    public $errors = [];
    public $scenario = 'default';
    
    protected static $attributeLabels = [];

    public abstract static function formAttrs(): array;
    
    public function getLabel($attribute)
    {
        if (empty(static::$attributeLabels[$attribute])) {
            return $attribute;
        }
        return static::$attributeLabels[$attribute];
    }
    
    /**
     * Učitava podatke iz niza. Vraca false samo ako je niz $data prazan.
     * 
     * @param array $attrs
     * @param array $data
     * @param array $skip
     * @return boolean
     */
    protected function load(array $attrs, ?array $data, array $skip = [])
    {
        if (empty($data)) {
            return false;
        }
        foreach ($attrs as $attr) {
            if (!empty($skip[$attr])) {
                continue;
            }
            $this->$attr = $data[$attr] ?? null;
        }
        return true;
    }
    
    /**
     * Učitava podatke iz forme u model. Statički niz $formAttrs sadrzi nazive
     * kljuceva podataka iz forme. Nazivi kljuceva iz forme moraju se poklapati
     * sa nazivima promenljivih klase izvedene iz Model.
     * 
     * @param array $data
     * @return bool
     */
    public function formLoad($data)
    {
        return $this->load(static::formAttrs(), $data);
    }
    
    protected function required():array
    {
        return [];
    }
    
    public function isValid():bool
    {
        $scenario = $this->scenario ?? 'default';
        $required = $this->required();
        if ($scenario !== 'default') {
            if (empty($required[$scenario])) {
                return false;
            }
            $required = $required[$scenario];
        } elseif (!empty($required['default'])) {
            $required = $required['default'];
        }
        foreach ($required as $attr) {
            if (empty($this->$attr)) {
                $this->errors[$attr] = "Polje " . $this->getLabel($attr) . ' je obavezno. ';
            }
        }
        return empty($this->errors);
    }   
    
}

