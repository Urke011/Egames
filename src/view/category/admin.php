<p>
    <a class="btn" style="background-color:#20d8da!important; color:white;" href="index.php?run=category/create#title">Nova kategorija</a>
</p>
<table class="table table-bordered">
    <tr>
        <th>Kategorija</th>
        <th></th>        
    </tr>
    <?php foreach (app\model\Category::findAll('ORDER BY name') as $category):?>
        <tr>

            <td>
                <?= htmlspecialchars($category->name)?>
            </td>

            <td>
                <a href="index.php?run=category/update&categoryId=<?=$category->id?>"><i class="fa fa-edit"></i></a>
                <?php if ($category->isEmpty()):?>
                    <a href="index.php?run=category/delete&categoryId=<?=$category->id?>"><i class="fa fa-trash"></i></a>            
                <?php endif;?>
            </td>
            
        </tr>
    <?php endforeach;?>
</table>