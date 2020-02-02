<?php

namespace app\controller;

use app\common\Controller;

use app\model\Category;

use app\App;

class CategoryController extends Controller
{
    public function actionAdmin()
    {
        App::get()->setTitle('Admin kategorije');
        return $this->render('category/admin');
    }
        
    public function actionCreate()
    {
        $user = App::get()->getUser();
        if (!$user || !$user->isAdmin()) {
            throw new Exception('Nije dozvoljeno!');
        }
        App::get()->setTitle('Nova kategorija');
        $category = new Category();
        $formData = App::get()->getPostData('Category');
        if ($category->formLoad($formData) && $category->save()) {
            $this->redirect('index.php?run=category/admin');
        }
        return $this->render('category/form', ['category' => $category]);
    }
    
    public function actionUpdate()
    {
        $user = App::get()->getUser();
        if (!$user || !$user->isAdmin()) {
            throw new Exception('Nije dozvoljeno!');
        }
        App::get()->setTitle('Uređivanje kategorije');
        $category = $this->getCategory($_GET['categoryId'] ?? 0);
        $formData = App::get()->getPostData('Category');
        if ($user->formLoad($formData) && $category->save()) {
            $this->redirect('index.php?run=category/admin');
        }
        return $this->render('category/form', ['category' => $category]);
    }
    
    public function actionDelete()
    {
        $category = $this->getCategory($_GET['categoryId'] ?? 0);
        $category->delete();
        $this->redirect('index.php?run=category/admin');
    }
    
    private function getCategory($id): Category
    {
        $category = Category::findById($id);
        if (empty($category)) {
            throw new Exception('Kategorija ne postoji!');
        }
        return $category;
    }    
}

