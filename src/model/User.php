<?php

namespace app\model;

use app\common\ActiveRecord;

class User extends ActiveRecord
{
    public $id;
    public $first_name;
    public $email;
    public $password;
    public $user_name;    
    
    //koristi se samo prilikom registracije
    public $plainPassword;
    
    protected static $attributeLabels = [
        'first_name' => 'Ime', 
        'email' => 'Email', 
        'plainPassword' => 'Lozinka', 
        'user_name' => 'Korisničko ime'
    ];
    
    public static function dbAttrs(): array {return ['id', 'first_name', 'email', 'password', 'user_name'];}

    public static function formAttrs(): array {return ['first_name', 'email', 'plainPassword', 'user_name'];}

    public static function table() {return 'game_user';}

    protected function required(): array
    {
        return [
            'default'  => ['first_name', 'email', 'plainPassword', 'user_name'],
            'login' => ['user_name', 'plainPassword'],
        ];
    }           

    public function save(): bool
    {
        if (!empty($this->plainPassword)) {
            $this->password = password_hash($this->plainPassword, PASSWORD_DEFAULT);
        }
        return parent::save();
    }
    
    public function auth()
    {
        $user = $this->findOneByAttributes(['user_name'=>$this->user_name]);
        if ($user && password_verify($this->plainPassword, $user->password)) {
            return true;
        }
        $this->errors[] = 'Pogrešno korisničko ime ili lozinka!';
        return false;        
    } 
    
    public function isAdmin()
    {
        return $this->user_name === 'admin';
    }
    
    public function isValid(): bool 
    {
        if ($this->scenario !== 'login' && !empty($this->email)) {
            if (!preg_match('/[^@]+@[^\.]+\..+/', $this->email)) {
                $this->errors['email'] = 'Neispravna email adresa!';
            }
        }
        return parent::isValid();
    }
}

