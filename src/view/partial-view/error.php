<?php if (!empty($errors)):?>
    <div class="alert alert-danger" role="alert">
        <?php 
            foreach ($errors as $error) {
                echo htmlspecialchars($error) . '<br>';
            }
        ?>
    </div>
<?php endif;?>
