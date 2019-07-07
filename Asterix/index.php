<?php
include 'config.php';
session_start();
if(isset($_GET["logout"]))
{
	session_destroy();
}

if(isset($_POST['submit_prijava']))
	{
		$email = $_POST["email"];
		$lozinka = $_POST["lozinka"];
		$flag = 'true';

		$result = $mysqli->query('SELECT id,email,lozinka,ime,rola FROM korisnik');

		if($result === FALSE){
		  die(mysql_error());
		}

		if($result){
			while($obj = $result->fetch_object()){
				if($obj->email == $email && $obj->lozinka == $lozinka) {
					$_SESSION['email'] = $email;
					$_SESSION['rola'] = $obj->rola;
					$_SESSION['id'] = $obj->id;
					$_SESSION['ime'] = $obj->ime;
					
				} 
			}
		}
    
	}
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
	<meta charset="UT-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Asterix</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Favicons -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/icon.png">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/plugins.css">
	<link rel="stylesheet" href="style.css">

	<!-- Cusom css -->
 <link rel="stylesheet" href="css/custom.css">

 <!-- Modernizer js -->
 <script src="js/vendor/modernizr-3.5.0.min.js"></script>
</head>
<body>

	<!-- Main wrapper -->
	<div class="wrapper" id="wrapper">
		<!-- Start Header Area -->
        <header class="htc__header bg--white">
            <!-- Start Mainmenu Area -->
            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 col-sm-4 col-md-6 order-1 order-lg-1">
                            <div class="logo">
                                <a href="index.php">
                                    <img src="images/logo/logo.png" alt="logo images">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-sm-4 col-md-2 order-3 order-lg-2">
                            <div class="main__menu__wrap">
                                <nav class="main__menu__nav d-none d-lg-block">
                                    <ul class="mainmenu">
                                        <li class="drop"><a href="index.php">Početna</a></li>
                                        <li class="drop"><a href="menu-list.php">Ponuda</a>
                                           
                                        </li>
                                        <li class="drop"><a href="#onama">O nama</a>
                                        
                                        <li class="drop"><a href="#kontakt">Kontakt</a>
                                           
                                        </li>

                                    </ul>
                                </nav>
                                
                            </div>
                        </div>
                        <div class="col-lg-1 col-sm-4 col-md-4 order-2 order-lg-3">
                        <div class="header__right d-flex justify-content-end">
                                <div class="log__in">
                                       <?php
                                            
											if(isset($_GET["logout"]))
											{
												session_start();
                                                session_unset();
                                               session_destroy();
                                                header("location:index.php");
                                                exit();
											}
											if(!isset($_SESSION['email']))
											{
												echo ' <a class="accountbox-trigger" href="#" id="login_click">';
												echo ' <span class="prijava" id="user" value="null">Prijava&nbsp&nbsp</span>';
											}
											else
											{
												echo ' <a class="" href="profile.php" id="login_click">';
												echo '<span class="prijava" id="user" value="' . $_SESSION['email'] . '">'. $_SESSION['ime'] .'&nbsp&nbsp</span>';
											}											
											?>
                                        <i class="zmdi zmdi-account-o"></i></a>
                                </div>
								    <div class="shopping__cart">
                                       <a href="kosarica.php"><span class="prijava">Košarica&nbsp&nbsp</span><i class="zmdi zmdi-shopping-basket"></i></a>
                                    <div class="shop__qun">
                                        <span>
										<?php
											if (!isset($_SESSION ['cart']))
											{
												$_SESSION ['cart'] = array ();
											}
											echo count($_SESSION ['cart']);
											?>
									  </span>
                                    </div>
									</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Mobile Menu -->
                    <div class="mobile-menu d-block d-lg-none"></div>
                    <!-- Mobile Menu -->
                </div>
            </div>
            <!-- End Mainmenu Area -->
        </header>
        <!-- End Header Area -->
        <!-- Start Slider Area -->
        <div class="slider__area slider--one">
            <div class="slider__activation--1">
                <!-- Start Single Slide -->
                <div class="slide fullscreen bg-image--1">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="slider__content">
                                    <div class="slider__inner">
                                        <h1>Da li vam je frižider prazan ili Vam se jednostavno danas ne da kuhati?</h1>
                                        <div class="slider__input">
                                            <div class="src__btn">
                                                <a href="menu-list.php">Naruči odmah!</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Slide -->
            </div>
        </div>
        <!-- End Slider Area -->
        <!-- Start Service Area -->
        <section id="onama" class="fd__service__area bg-image--2 section-padding--xlg">
            <div class="container">
                <div class="service__wrapper bg--white">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="section__title service__align--left">
                                <h2 class="title__line">O nama</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row mt--30">
                      
                      <p class="opis">

            Restoran Asterix je web aplikacija za online narudžbu hrane. Projekt je stvorila i održava skupina studenata Fakulteta Strojarstva Računarstva i Elektrotehnike pri Sveučilištu u Mostaru.

            Restoran Asterix je otvoren s namjerom da gostima pruži hranu vrhunskog kvaliteta, ukusa i svježine. Od te namjere nikad nismo odustali. Ukusi su različiti, ali svi se slažu u jednom - kvalitet naše hrane je neosporiv.

            </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- End O nama Area -->

        <!-- Start Footer Area -->
        <footer id="kontakt" class="footer__area footer--1">
            <div class="footer__wrapper bg__cat--1 section-padding--lg">
                <div class="container">
                    <div class="row">
                        <!-- Start Single Footer -->
                        <div class="col-md-6 col-lg-3 col-sm-12">
                            <div class="footer">
                                <h2 class="ftr__title">Kontakt</h2>
                                <div class="footer__inner">
                                    <div class="ftr__details">
                                        
                                        <div class="ftr__address__inner">
                                            <div class="ftr__address">
                                                <div class="ftr__address__icon">
                                                    <i class="zmdi zmdi-home"></i>
                                                </div>
                                                <div class="frt__address__details">
                                                    <p>Sveučilište u Mostaru, FSRE</p>
                                                </div>
                                            </div>
                                            <div class="ftr__address">
                                                <div class="ftr__address__icon">
                                                    <i class="zmdi zmdi-phone"></i>
                                                </div>
                                                <div class="frt__address__details">
                                                    <p><a href="#">+387 63 146 917</a></p>
                                                   
                                                </div>
                                            </div>
                                            <div class="ftr__address">
                                                <div class="ftr__address__icon">
                                                    <i class="zmdi zmdi-email"></i>
                                                </div>
                                                <div class="frt__address__details">
                                                    <p><a href="#">ivan.ivancic@student.fsre.ba</a></p>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="social__icon">
                                            <li><a href="https://www.facebook.com/ivan.ivancic.921" target="_blank"><i class="zmdi zmdi-facebook"></i></a></li>
                                           
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Footer -->
                        
                     
                        <!-- Start Single Footer -->
                        <div class="col-md-6 col-lg-3 col-sm-12 md--mt--40 sm--mt--40">
                            <div class="footer">
                                <h2 class="ftr__title">Radno vrijeme</h2>
                                <div class="footer__inner">
                                    <ul class="opening__time__list">
                                        <li>Subota<span>.......</span>9h do 23h</li>
                                        <li>Nedjelja<span>.......</span>9h do 23h</li>
                                        <li>Ponedjeljak<span>.......</span>9h do 23h</li>
                                        <li>Utorak<span>.......</span>9h do 23h</li>
                                        <li>Srijeda<span>.......</span>9h do 23h</li>
                                        <li>Četvrtak<span>.......</span>9h do 23h</li>
                                        <li>Petak<span>.......</span>9h do 23h</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Footer -->

                    </div>
                </div>
            </div>
            <div class="copyright bg--theme">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="copyright__inner">
                                <div class="cpy__right--left">
                                    <p>Sva prava podrzana. FSRE 2019</p>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer Area -->
        <!-- Login Form -->
        <div class="accountbox-wrapper">
            <div class="accountbox text-left">
                <ul class="nav accountbox__filters" id="myTab" role="tablist">
                    <li>
                        <a id="loginpage" class="active" id="log-tab" data-toggle="tab" href="#log" role="tab" aria-controls="log" aria-selected="true">Prijava</a>
                    </li>
                    <li>
                        <a id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Registracija</a>
                    </li>
                </ul>
                <div class="accountbox__inner tab-content" id="myTabContent">
                   <div class="accountbox__login tab-pane fade show active" id="log" role="tabpanel" aria-labelledby="log-tab">
                        <form method="POST" action="">
                            <div class="single-input">
                                <input class="cr-round--lg" type="text" placeholder="Unesi e-mail" name="email">
                            </div>
                            <div class="single-input">
                                <input class="cr-round--lg" type="password" placeholder="Unesi lozinku" name="lozinka">
                            </div>
                            <div class="single-input">
                                <button type="submit" class="food__btn" name="submit_prijava"><span>Prijava</span></button>
                            </div>
                          
                        </form>
                    </div>
                    <div class="accountbox__register tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form method="POST" action="registracija.php">
                            
                            <div class="single-input">
                                <input class="cr-round--lg" type="text" placeholder="Unesi ime" name="ime">
                            </div>
                            <div class="single-input">
                                <input class="cr-round--lg" type="text" placeholder="Unesi prezime" name="prezime">
                            </div>
                            
                            <div class="single-input">
                                <input class="cr-round--lg" type="text" placeholder="Unesi grad" name="grad">
                            </div>
                            <div class="single-input">
                                <input class="cr-round--lg" type="text" placeholder="Unesi adresu" name="adresa">
                            </div>
                            
                            <div class="single-input">
                                <input class="cr-round--lg" type="text" placeholder="Unesi broj" name="broj">
                            </div>
                            
                            <div class="single-input">
                                <input class="cr-round--lg" type="email" placeholder="Unesi e-mail" name="email">
                            </div>
                            <div class="single-input">
                                <input class="cr-round--lg" type="password" placeholder="Unesi lozinku" name="lozinka">
                            </div>
                            
                            
                            <div class="single-input">
                                <button type="submit" class="food__btn"><span>Registriraj </span></button>
                            </div>
                        </form>
                    </div>
                    <span class="accountbox-close-button"><i class="zmdi zmdi-close"></i></span>
                </div>
            </div>
        </div>
        <!-- //Login Form -->
        
    </div>
    <!-- //Main wrapper -->

    <!-- JS Files -->
    <script src="js/vendor/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/active.js"></script>
</body>
</html>
