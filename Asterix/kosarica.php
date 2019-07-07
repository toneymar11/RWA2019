<?php
    include'config.php';
	session_start();
	if(isset($_GET["remove"]))
	{
		if($_GET['remove'] == 'all')
		{
			$_SESSION ['cart'] = array ();
		}
		else
		{
			unset($_SESSION ['cart'][$_GET['remove']]);
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
	<title>Košarica</title>
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
<body style="background-color:rgb(234, 234, 234)">
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
											if (! isset ( $_SESSION ['cart'] )) {
											$_SESSION ['cart'] = array ();
											}
											echo count($_SESSION ['cart']);
											?>
									  </span>
                                    </div>
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
        
        
        
        <!-- Start Menu Grid Area -->
        <section class="food__menu__grid__area section-padding--lg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="kategorije" class="food__nav nav nav-tabs" role="tablist">
                              
                            

                        </div>
                    </div>
                </div>
                <div class="row mt--30">
                    <div class="col-lg-12">
                        <div class="fd__tab__content tab-content" id="nav-tabContent">
                            <!-- Start Single Content -->
                            <div class="food__list__tab__content tab-pane fade show active" id="nav-all" role="tabpanel">
                                
                                       <!-- cart-main-area start -->
        <div class="cart-main-area section-padding--lg bg--white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 ol-lg-12">
                        <form action="#">               
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr class="title-top">
                                            <th class="product-thumbnail">Slika</th>
                                            <th class="product-name">Jelo</th>
                                            <th class="product-price">Cijena</th>
                                            <th class="product-quantity">Količina</th>
                                            <th class="product-subtotal">Ukupno</th>
                                            <th class="product-remove">Ukloni</th>
                                        </tr>
                                    </thead>                        
									<?php															
										if(isset($_GET['naruci']))
											{
												if($_GET['naruci'] == 1)
												{
													$time = rand(25,70);
													
													$query = 'INSERT INTO narudzba (korisnik_id, narudzba, vrijeme_narudzbe, vrijeme_dostave) VALUES('.intval($_SESSION['id']).','."'".json_encode($_SESSION["cart"]). "',".'"'.date("Y-m-d H:i:s").'",'.intval($time).')';
													$result = $mysqli->query($query);
													if($result){													
														echo '<h1>Narudžba stiže za '. $time . ' minuta</h1>';	
														$_SESSION ['cart'] = array ();														
													}    													
												}
											}
										$total = 0;
										echo '<tbody>     ';
										foreach($_SESSION["cart"] as $key => $item)
										{
											$query = 'SELECT ime_jela, url_slike, cijena FROM jelo where id='.$key;
											$result = $mysqli->query($query);
											if($result){
											while($obj = $result->fetch_object()){
												echo ' <tr>
															<td class="product-thumbnail"><a href="#"><img src="'.$obj->url_slike.'" alt="product img" /></a></td>
															<td class="product-name"><a href="#">'.$obj->ime_jela.'</a></td>
															<td class="product-price"><span class="amount">'.$obj->cijena.'KM</span></td>
															<td class="product-quantity"><input type="number" name="kolicina" value="'.$item.'" /></td>
															<td class="product-subtotal">'.intval($obj->cijena) * $item.'KM</td>
															<td class="product-remove"><a href="kosarica.php?remove='.$key.'"><i class="fa fa-trash"></i></a></td>
														</tr>';
                                                
													$total += intval($obj->cijena) * $item;
												}
											}    
										}		

echo '       </tbody>
                                </table>
                            </div>
                        </form> 
                        <div class="cartbox__btn">
                            <ul class="cart__btn__list d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">
							<li>
									<a href="kosarica.php?remove=all">Izbriši sva jela</a> 
							</li>
                                <li><a href="menu-list.php">Dodaj još jela</a></li>
                                <li><a href="" name="uredi">Uredi</a></li>
                                <li><a href="kosarica.php?naruci=1" id="naruci">Naruči</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 offset-lg-6">
                        <div class="cartbox__total__area">
                        
                            <div class="cart__total__amount">
                                <span>Ukupno</span>
                                <span>' . $total .'KM</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>';										
									?>
                                    <?php
                                    
                                    
                                    
                                    ?>
                                   
                                        
                             
        <!-- cart-main-area end -->
                                                                                        
                            </div>

                           
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
                        <form method="POST" action="kosarica.php">
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
	<script> 
		document.getElementById("naruci").onclick = function (event) {
			var user  = document.getElementById("user").innerHTML;
			if(user=="Prijava&nbsp;&nbsp;")
			{
				document.getElementById("login_click").click();
				event.preventDefault();
			}
		}
	</script>
</body>
</html>