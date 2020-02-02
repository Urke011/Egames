<table class="table table-bordered">
    <tr>
        <th>Vest</th> 
        <th>Komentar</th> 
        <th>Autor</th>
        <th>Vreme</th>
        <th></th>        
    </tr>
    <?php foreach (app\model\Comment::findAll('ORDER BY id DESC') as $comment):?>
    <tr>

        <td>
            <?= htmlspecialchars($comment->getNews()->title)?>
        </td>          
        
        <td>
            <?= htmlspecialchars($comment->content)?>
        </td>      

        <td>
            <?= htmlspecialchars($comment->getAuthor()->first_name)?>
        </td>        

        <td>
            <?= htmlspecialchars($comment->pub_date)?>
        </td>        
        
        
        <td>
            <a href="index.php?run=comment/delete&commentId=<?=$comment->id?>"><i class="fa fa-trash"></i></a>            
        </td>
    </tr>
    <?php endforeach;?>
</table>