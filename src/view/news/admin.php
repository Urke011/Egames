    <p>
    <a class="btn" style="background-color:#20d8da!important; color:white;" href="index.php?run=news/create#title">Nova vest</a>
</p>
<table class="table table-bordered">
    <tr>
        <th>Naslov</th>
        <th>Objavio</th>
        <th>Vreme</th>
        <th>Kategorija</th>
        <th></th>        
    </tr>
    <?php foreach (app\model\News::findAll('ORDER BY pub_date, id') as $news):?>
        <tr>
            <td>
                <a href="index.php?run=news/view&newsId=<?=$news->id?>"><?= htmlspecialchars($news->title)?></a>
            </td>
            <td>
                <?= htmlspecialchars($news->getCreator()->user_name)?>
            </td>
            <td>
                <?= htmlspecialchars($news->pub_date)?>
            </td>

            <td>
                <?= htmlspecialchars($news->getCategory()->name)?>
            </td>

            <td>
                <a title="Izmena" href="index.php?run=news/update&newsId=<?=$news->id?>"><i class="fa fa-edit"></i></a>                
                <a title="Brisanje" href="index.php?run=news/delete&newsId=<?=$news->id?>"><i class="fa fa-trash"></i></a>                            
            </td>
        </tr>
    <?php endforeach;?>
</table>