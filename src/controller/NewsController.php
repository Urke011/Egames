<?php

namespace app\controller;

use app\common\Controller;

use app\model\News;
use app\model\Comment;
use app\App;
use Exception;

class NewsController extends Controller
{
    public function actionAdmin()
    {
        App::get()->setTitle('Admin vesti');
        return $this->render('news/admin');
    }
    
    public function actionView()
    {
        $news = $this->getNews($_GET['newsId'] ?? 0);
        $comment = new Comment();
        $comment->news_id = $news->id;
        App::get()->setTitle($news->title);
        if ($comment->formLoad(App::get()->getPostData('Comment')) && $comment->save()) {
            $this->redirect('index.php?run=news/view&newsId='.$news->id);
        }
        return $this->render('news/view', ['news' => $news, 'comment' => $comment]);
    }
    
    public function actionCreate()
    {
        $user = App::get()->getUser();
        if (!$user || !$user->isAdmin()) {
            throw new Exception('Nije dozvoljeno!');
        }
        App::get()->setTitle('Nova vest');
        $news = new News();
        $formData = App::get()->getPostData('News');
        if ($news->formLoad($formData) && $news->save()) {
            $this->redirect('index.php?run=news/admin');
        }
        return $this->render('news/form', ['news' => $news]);
    }
    
    public function actionUpdate()
    {
        $user = App::get()->getUser();
        if (!$user || !$user->isAdmin()) {
            throw new Exception('Nije dozvoljeno!');
        }
        App::get()->setTitle('Uređivanje vesti');
        $news = $this->getNews($_GET['newsId'] ?? 0);
        $formData = App::get()->getPostData('News');
        if ($news->formLoad($formData) && $news->save()) {
            $this->redirect('index.php?run=news/admin');
        }
        return $this->render('news/form', ['news' => $news]);
    }
    
    public function actionDelete()
    {
        $news = $this->getNews($_GET['newsId'] ?? 0);
        $news->delete();
        $this->redirect('index.php?run=news/admin');
    }
    
    private function getNews($id): News
    {
        $news = News::findById($id);
        if (empty($news)) {
            throw new Exception('Vest ne postoji!');
        }
        return $news;
    }
    
}