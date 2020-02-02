<?php

namespace app\controller;

use app\common\Controller;
use app\model\News;
use app\App;

class SiteController extends Controller
{            
    public function actionIndex()
    {
        $categoryId = $_GET['categoryId'] ?? 0;
        $category = $categoryId ? \app\model\Category::findById($categoryId) : null;
        $orderBy = 'ORDER BY pub_date, id DESC';
        if ($category) {
            App::get()->setTitle($category->name);
            $newsList = $category->getNews();
        } else {
            $newsList = News::findAll($orderBy);
        }
        return $this->render('site/index', ['newsList' => $newsList]);
    }
    
    public function actionContact()
    {
        App::get()->setTitle('Kontakt');
        return $this->render('site/contact');
    }
    
    public function actionSearch()
    {
        if (empty($_GET['search'])) {
            $this->redirect('index.php');
        }        
        $search = $_GET['search'];
        $categoryId = $_GET['categoryId'] ?? 0;
        $category = $categoryId ? \app\model\Category::findById($categoryId) : null;
        $title = 'Pretraga: `' . $search .'` ';
        $title .= $category ? ' za kategoriju '. $category->name : '';
        App::get()->setTitle($title);
        $newsList = News::search($search, $category);
        return $this->render('site/index', ['newsList' => $newsList]);        
    }
    
}