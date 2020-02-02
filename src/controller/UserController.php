<?php

namespace app\controller;

use app\common\Controller;

use app\model\User;
use app\App;

class UserController extends Controller
{
    public function actionRegister()
    {
        App::get()->setTitle('Registracija');
        $user = new User();
        $formData = App::get()->getPostData('User');
        if ($user->formLoad($formData) && $user->save()) {
            App::get()->loginUser($user);
            $this->redirect('index.php');
        }
        return $this->render('user/register', ['user' => $user]);
    }
    
    public function actionLogin()
    {
        App::get()->setTitle('Prijava');
        $user = new User();
        $user->scenario = 'login';
        $formData = App::get()->getPostData('User');
        if ($user->formLoad($formData) && $user->isValid() && $user->auth()) {
            $account = User::findOneByAttributes(['user_name' => $user->user_name]);
            App::get()->loginUser($account);
            $this->redirect('index.php');
        }
        return $this->render('user/login', ['user' => $user]);        
    }
    
    public function actionLogout()
    {
        App::get()->logoutUser();
        $this->redirect('index.php');
    }
}

