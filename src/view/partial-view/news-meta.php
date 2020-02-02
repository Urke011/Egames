    <span class="game-tag"><?= htmlspecialchars($news->getCategory()->name)?></span>
    <a href="index.php?run=news/view&newsId=<?=$news->id?>" class="game-title"><?= htmlspecialchars($news->title)?></a>
    <div class="game-meta">
        <a href="index.php?run=news/view&newsId=<?=$news->id?>" class="game-date"><?=date('d.m.Y.', strtotime($news->pub_date))?></a>
        <?php $commentsNum = $news->getCommentsNumber()?>
        <?php if ($commentsNum):?>
            <a href="index.php?run=news/view&newsId=<?=$news->id?>" class="game-comments">
                <?=$commentsNum?> Komentar<?=$commentsNum > 1 ? 'a' : ''?>
            </a>
        <?php endif;?>
    </div>