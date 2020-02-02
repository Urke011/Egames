<?php $app = \app\App::get();?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Title -->
    <title><?=$app->getTitle(true)?></title>

    <!-- Favicon -->
    <link rel="icon" href="<?=$app->resource('img/core-img/favicon.ico')?>">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="<?=$app->resource('style.css')?>">

</head>

<body>
    <!-- Preloader -->
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">
        <!-- Top Header Area -->
        <div class="top-header-area">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12 d-flex align-items-center justify-content-between">
                        <!-- Logo Area -->
                        <div class="logo">
                            <a href="index.php"><img src="<?=$app->resource('img/core-img/logo.png')?>" alt=""></a>
                        </div>

                        <!-- Search & Login Area -->
                        <div class="search-login-area d-flex align-items-center">
                            <!-- Top Search Area -->
                            <div class="top-search-area">
                                <form action="index.php" method="get">
                                    <input type="hidden" name="run" value="site/search">
                                    <input type="hidden" name="categoryId" value="<?=$_GET['categoryId'] ?? ''?>">
                                    <input type="search" name="search" id="topSearch" placeholder="Pretraga">
                                    <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                            <?php if (!$app->getUser()) :?>
                                <!-- Login Area -->
                                <div class="login-area">
                                    <a href="index.php?run=user/register#title">
                                        <span>Registracija</span> <i class="fa fa-user" aria-hidden="true"></i>
                                    </a>                                
                                </div>

                                <div class="login-area">
                                    <a href="index.php?run=user/login#title">
                                        <span>Prijava</span> <i class="fa fa-lock" aria-hidden="true"></i>
                                    </a>                                
                                </div>
                            <?php else: ?>
                                <div class="login-area">
                                    <a href="index.php?run=user/logout">
                                        <span>Odjava</span> <i class="fa fa-power-off" aria-hidden="true"></i>
                                    </a>                                
                                </div>
                            <?php endif;?>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navbar Area -->
        <div class="egames-main-menu" id="sticker">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="egamesNav">

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul>
                                    <li><a href="index.php">Početna</a></li>
                                    <li>
                                        <a href="#">Žanrovi igara</a>
                                        <ul class="dropdown">
                                            <?php foreach (\app\model\Category::findAll('ORDER BY name') as $category):?>
                                                <li>
                                                    <a href="index.php?categoryId=<?=$category->id?>">
                                                        <?= htmlspecialchars($category->name)?>
                                                    </a>
                                                </li>
                                            <?php endforeach;?>                                            
                                        </ul>
                                    </li>
                                    <?php if ($app->getUser() && $app->getUser()->isAdmin()) :?>
                                    <li><a href="#">Admin</a>
                                        <ul class="dropdown">
                                            <li><a href="index.php?run=news/admin#title">Vesti</a></li>
                                            <li><a href="index.php?run=comment/admin#title">Komentari</a></li>
                                            <li><a href="index.php?run=category/admin#title">Kategorije</a></li>                                            
                                        </ul>                                        
                                    </li>
                                    <?php endif;?>                                    
                                    
                                    <li><a href="index.php?run=site/contact">Kontakt</a></li>
                                </ul>
                            </div>
                            <!-- Nav End -->
                        </div>

                        <!-- Top Social Info -->
                        <div class="top-social-info">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Dribbble"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Behance"><i class="fa fa-behance" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Breadcrumb Area Start ##### -->
    <div class="breadcrumb-area bg-img bg-overlay" style="background-image: url(<?=$app->resource('img/bg-img/27.jpg')?>);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div style="position: absolute; top:40px;" id="title"></div>

                <!-- Breadcrumb Text -->
                <div class="col-12">
                    <div class="breadcrumb-text">
                        <h2><?=$app->getTitle(true)?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcrumb Area End ##### -->

    <!-- ##### Game Review Area Start ##### -->
    <section class="game-review-area section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    
                    <?= $content ?>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Game Review Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area">
        <!-- Main Footer Area -->
        <div class="main-footer-area section-padding-100-0">
            <div class="container">
                <div class="row">
                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget mb-70">
                            <div class="widget-title">
                                <a href="index.php"><img src="img/core-img/logo2.png" alt=""></a>
                            </div>
                            <div class="widget-content">
                                <p>Video-igra, video-igrica ili samo igrica je igra koja se igra uz pomoć analognih ili digitalnih računara ili igračkih konzola priključenih na računar ili televizor. U novije vreme je jedan od najpopularnijih oblika zabave na svetu. Video-igre se iz dana u dan razvijaju, i poboljšavaju im se tehničke karakteristike.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget mb-70">
                            <div class="widget-title">
                                <h4>Preporuke</h4>
                            </div>
                            <div class="widget-content">
                                <nav>
                                    <ul>
                                        <li><a href="index.php?run=news/view&newsId=1">Need For Speed 2</a></li>
                                        <li><a href="index.php?run=news/view&newsId=2">Call of Duty</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget mb-70">
                            <div class="widget-title">
                                <h4>Korisni linkovi</h4>
                            </div>
                            <div class="widget-content">
                                <nav>
                                    <ul>
                                        <li><a href="https://store.steampowered.com/">Steam</a></li>
                                        <li><a href="https://www.blizzard.com/en-us/">Blizzard</a></li>
                                        <li><a href="https://games.rs/">Gamers</a></li>
                                        <li><a href="index.php">This site</a></li>
                                        <li><a href="index.php?run=site/contact">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Copywrite Area -->
        <div class="copywrite-content">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12 col-sm-5">

                    </div>
                    <div class="col-12 col-sm-7">
                        <!-- Footer Nav -->
                        <div class="footer-nav">
                            <ul>
                                <?php foreach (\app\model\Category::findAll('ORDER BY name') as $category):?>
                                    <li>
                                        <a href="index.php?categoryId=<?=$category->id?>">
                                            <?= htmlspecialchars($category->name)?>
                                        </a>
                                    </li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="<?=$app->resource('js/jquery/jquery-2.2.4.min.js')?>"></script>
    <!-- Popper js -->
    <script src="<?=$app->resource('js/bootstrap/popper.min.js')?>"></script>
    <!-- Bootstrap js -->
    <script src="<?=$app->resource('js/bootstrap/bootstrap.min.js')?>"></script>
    <!-- All Plugins js -->
    <script src="<?=$app->resource('js/plugins/plugins.js')?>"></script>
    <!-- Active js -->
    <script src="<?=$app->resource('js/active.js')?>"></script>
</body>

</html>