<?php
include 'config.php';
session_start();
if(isset($_POST['jelo_id']))
		{
			  if(empty($_SESSION["cart"])) {
						$_SESSION['cart']=array($_POST['jelo_id'] => 1);
					}
					else
					{
						$found = false;
						foreach ($_SESSION['cart'] as $key => $item)
						{
							if($key == $_POST['jelo_id'])
							{
								$_SESSION['cart'][$key] += 1;
								$found = true;
							}
						}
						if($found==false)
						{
							$_SESSION['cart'] += [ $_POST["jelo_id"] => 1];
						}
					}
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
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Ponuda</title>
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
	<!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	<![endif]-->

	<!-- Add your site or application content here -->
	
	<!-- <div class="fakeloader"></div> -->

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
                                        <li><a href="menu-list.php">Ponuda</a></li>

                                        <li><a href="index.php#onama">O nama</a></li>
                                      
                                        <li><a href="index.php#kontakt">Kontakt</a></li>
                                    </ul>
                                </nav>
                                
                            </div>
                        </div>
                        <div class="col-lg-1 col-sm-4 col-md-4 order-2 order-lg-3">
                            <div class="header__right d-flex justify-content-end">
                                <div class="log__in">
                                       <?php
                              
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
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area bg-image--18">
            <div class="ht__bradcaump__wrap d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title">Pogledajte ponudu</h2>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area --> 
        
        
        <!-- Start Menu Grid Area -->
        <section class="food__menu__grid__area section-padding--lg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="kategorije" class="food__nav nav nav-tabs" role="tablist">
                              
                            <a class="active" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab">Sva ponuda</a>

                        </div>
                    </div>
                </div>
                <div class="row mt--30">
                    <div class="col-lg-12">
                        <div class="fd__tab__content tab-content" id="nav-tabContent">
                            <!-- Start Single Content -->
                            <div class="food__list__tab__content tab-pane fade show active" id="nav-all" role="tabpanel">
                                
                                
                               
                                <?php
                            
                            $result = $mysqli->query('SELECT id,ime_jela, url_slike, cijena FROM jelo' );
                            
                            if($result){
                                    while($obj = $result->fetch_object()){
                                    
                                        echo sprintf('
										<div class="single__food__list d-flex wow fadeInUp">
                                    <div class="food__list__thumb">
                                        <a href="menu-details.html">
                                            <img src="%s" alt="list food images">
                                        </a>
                                    </div>
                                    <div class="food__list__inner d-flex align-items-center justify-content-between">
                                        <div class="food__list__details">
                                            <h2><a href="menu-details.html">%s</a></h2>
                                            <p>Lorem ipsum dolor sit aLorem ipsum dolor sit amet, consectetu adipis cing elit, sed do eiusmod tempor incididunt ut labore et dolmagna aliqua. enim ad minim veniam, quis nomagni dolores eos qnumquam.</p>
                                            <div class="list__btn">
											<form method="post" action="">
												<input type="hidden" name="jelo_id" value="%s">
                                                <input type="submit" name="submit" value="Dodaj u košaricu" class="food__btn " />
														</form>		
                                            </div>
                                        </div>
                                        <div class="food__rating">
                                            <div class="list__food__prize">
                                                <span id="cijena_jela">%s KM</span>
                                            </div>
                                            <ul class="rating">
                                                <li><i class="zmdi zmdi-star"></i></li>
                                                <li><i class="zmdi zmdi-star"></i></li>
                                                <li><i class="zmdi zmdi-star"></i></li>
                                                <li><i class="zmdi zmdi-star"></i></li>
                                                <li class="rating__opasity"><i class="zmdi zmdi-star"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                </div>
						',$obj->url_slike,$obj->ime_jela,$obj->id, $obj->cijena);
                                    }
                                }
                            
                            ?>
                                
                                
                               
                            </div>
                            <!-- End Single Content -->
                            
                            
                
                            
                           
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Menu Grid Area -->
        
        
       
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
            

	<!-- JS Files -->
	<script src="js/vendor/jquery-3.2.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/plugins.js"></script>
	<script src="js/active.js"></script>
</body>
</html>
