<?php

namespace app\controller;

use app\common\Controller;

use app\model\Comment;

use Exception;

use app\App;

class CommentController extends Controller
{
    
    public function actionAdmin()
    {
        App::get()->setTitle('Admin - komentari');
        return $this->render('comment/admin');
    }    
    
    public function actionDelete()
    {
        $user = App::get()->getUser();
        if (!$user) {
            throw new Exception('Niste prijavljeni!');
        }
        $commentId = $_GET['commentId'] ?? 0;
        $comment = Comment::findById($commentId);
        if (empty($comment)) {
            throw new Exception('Komentar ne postoji!');
        }
        if (!$user->isAdmin() && $user->id != $comment->game_user_id) {
            throw new Exception('Brisanje komentara nije dozvoljeno!');
        }
        $comment->delete();
        if ($user->isAdmin()) {
            $this->redirect('index.php?run=news/admin');
        } else {
            $this->redirect('index.php?run=news/view&newsId='.$comment->news_id);
        }
    }
}