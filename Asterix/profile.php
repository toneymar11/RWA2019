<?php
    include'config.php';
	session_start();
	
	if(isset($_POST['submit']))
	{
		$target = $_FILES['picture']['name'];	
		$picture = 'images/menu-list/'.$target;
		
		$sql = "INSERT INTO jelo (ime_jela, url_slike, cijena ) VALUES('" . $_POST['naziv'] . "', '" . $picture . "', '" . $_POST['cijena'] . "')";
		
		if($mysqli->query($sql)){
			move_uploaded_file($_FILES["picture"]["tmp_name"], $picture);
		}
	}
	
	if(isset($_POST['akcija']))
	{
        if($_POST['akcija']=='Obrisi'){
		$sql = "DELETE FROM jelo WHERE id=" . $_POST['jelo_id'];
		$mysqli->query($sql);
        }
        else if($_POST['akcija']=='Uredi'){
            $ime=$_POST['ime_jela'];
            $cijena=$_POST['cijena'];
            $id=$_POST['jelo_id'];
         $query="UPDATE jelo SET ime_jela='".$ime."',cijena=$cijena WHERE id=$id";
												
            $result = mysqli_query($mysqli, $query);
            
            if($result){
                echo 'Update';
            }
            else{
                echo'nije';
            }
            
            
        }
	}
	
	if(isset($_POST['delete_user']))
	{
		$sql = "DELETE FROM korisnik WHERE id=" . $_POST['odabrani_korisnik_id'];
		$mysqli->query($sql);
	}
?>
<html class="no-js" lang="zxx">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Profil</title>
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
                              
                             <!--  <a class="active" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab">Sva ponuda</a> -->

                        </div>
                    </div>
                </div>
                <div class="row mt--30">
                    <div class="col-lg-12">
                        <div class="fd__tab__content tab-content" id="nav-tabContent">
                            <!-- Start Single Content -->
                            <div class="food__list__tab__content tab-pane fade show active" id="nav-all" role="tabpanel">
                                
									<?php
									if(isset($_SESSION['id']))
									{			
										$user_id = $_SESSION['id'];	
										if(!isset($_GET['addmeal']) && !isset($_GET['deletemeal']) && !isset($_GET['showusers']) && !isset($_GET['orders']))
										{
											echo '<a href="profile.php" class="btn btn-primary">Podaci o korisniku</a>';											
										}	
										else
										{
											echo '<a href="profile.php" class="btn btn-danger text-white">Podaci o korisniku</a>';												
										}
										
										if(isset($_GET['orders']))
										{
											echo '&nbsp&nbsp<a href="profile.php?orders=1" class="btn btn-primary">Pregled Narudžbi</a>';												
										}	
										else
										{
											echo '&nbsp&nbsp<a href="profile.php?orders=1" class="btn btn-danger text-white">Pregled Narudžbi</a>';												
										}
										if($_SESSION['rola'] == 0)		
										{
											if(isset($_GET['addmeal']))
											{
												echo '&nbsp&nbsp<a href="profile.php?addmeal=1" class="btn btn-primary">Dodavanje jela</a>';											
											}	
											else
											{
												echo '&nbsp&nbsp<a href="profile.php?addmeal=1" class="btn btn-danger text-white">Dodavanje jela</a>';											
											}

											if(isset($_GET['deletemeal']))
											{
												echo '&nbsp&nbsp<a href="profile.php?deletemeal=1" class="btn btn-primary">Uređivanje jela</a>';									
											}	
											else
											{
												echo '&nbsp&nbsp<a href="profile.php?deletemeal=1" class="btn btn-danger text-white">Uređivanje jela</a>';										
											}	
											
											if(isset($_GET['showusers']))
											{
												echo '&nbsp&nbsp<a href="profile.php?showusers=1" class="btn btn-primary">Pregled Korisnika</a>';										
											}	
											else
											{
												echo '&nbsp&nbsp<a href="profile.php?showusers=1" class="btn btn-danger text-white">Pregled Korisnika</a>';										
											}
                                            
                                            echo'&nbsp&nbsp<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#addUserModal">
            <i class="fa fa-plus"></i> Dodaj Korisnika
          </a>';
											
										}		
										echo '<a href="index.php?logout=1" class="btn btn-danger text-white" style="float:right;">ODLOGIRAJ ME</a>';										
										echo '</br></br><hr style=" border: 0;clear:both;display:block;width: 96%; background-color:#5d5d5d;height: 1px;">';
											
										
										if(isset($_GET['orders']))
										{
											echo '</br><h3>Prethodne narudžbe:</h3>';                                        
											$query = 'SELECT * FROM narudzba where korisnik_id='.$user_id. ' ORDER BY id DESC';
											$result = $mysqli->query($query);
												if($result){ 
												while($obj = $result->fetch_object()){
												   
													$ukupno=0;
													echo '<p>Datum Narudzbe : '. $obj->vrijeme_narudzbe.'<br/>    Vrijeme dostave : '. $obj->vrijeme_dostave .' minuta </p>';
													$data = json_decode($obj->narudzba);
													foreach($data as $key => $item)
													{
														$query1 = 'SELECT * FROM jelo where id='.$key;
														$result1 = $mysqli->query($query1);
														if($result1){
														while($obj1 = $result1->fetch_object()){
															echo '<p1>'.$obj1->ime_jela. ' |  '. $obj1->cijena . ' KM | Kolicina: '.intval($item).' </p1></br>';
															$ukupno+=(intval($obj1->cijena) * intval($item) );
														}
														}
														
													}
													echo' <b>Ukupna cijena: '.$ukupno.'</b>';
													echo '<br/> <br/>';
													}
												   
												}
										}
										else if(isset($_GET['addmeal']))
										{
											if($_SESSION['rola'] == 0)
											{
												echo '</br><h3>Dodavanje Jela</h3><table style="width:300px;">';
												echo '<form enctype="multipart/form-data" name="unos" method="POST" action="">
														<tr><td>Naziv </td><td><input type="text" name="naziv" id="naziv"/></td></tr>	
														<tr><td>Cijena </td><td><input type="text" name="cijena" id="cijena"/></td></tr>
														<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
														<tr><td>Slika</td><td><input type="file" id="picture" name="picture" /></td></tr></table>
														<input type="submit" name="submit" id="submit" value="Dodaj" class="btn btn-primary"/>														
													</form>';												
												
											}
										}
										else if(isset($_GET['deletemeal']))
										{
											if($_SESSION['rola'] == 0)
											{
												echo '</br><h3>Uredjivanje i Brisanje Jela</h3>';												
												$result = $mysqli->query('SELECT id,ime_jela, url_slike, cijena FROM jelo' );									
												if($result){
															echo '<form enctype="multipart/form-data" name="brisanje" method="POST" action=""><table style="width:600px;">';
                                                            echo '<tr><td>Ime jela</td><td>Cijena jela</td><td></td> <td></td></tr>';
															while($obj = $result->fetch_object()){
																	echo '<tr>';
																	echo '<td><input type="text" class="form-control" name="ime_jela"  value="'.$obj->ime_jela.'"/></td>';
                                                                    echo '<td><input type="number" class="form-control" name="cijena"  value="'.$obj->cijena.'"/></td>'; 							echo '<input type="hidden" name="jelo_id" id="jelo_id" value="' . $obj->id .'">';
                                                                    echo '<td><input type="submit" name="akcija" value="Uredi" class="btn btn-primary"/></td>';
																	echo '<td><input type="submit" name="akcija" value="Obrisi" class="btn btn-danger"/></td>';      
																	echo '</tr>';  
															}
															echo '</table></form>';
													}	
											}																		
										}
										else if(isset($_GET['showusers']))
										{
											if($_SESSION['rola'] == 0)
											{
												if(!isset($_POST['details']))
												{
													echo '</br><h3>Pregled Korisnika</h3>';	
													echo '<table style="width:300px;">';
													$result = $mysqli->query('SELECT * from korisnik' );									
													if($result){																
																echo '<tr><td>Ime</td><td>Prezime</td><td>Email</td><td>Adresa</td><td>Grad</td><td>Broj</td><td>Tip</td><td></td><td></td></tr>';
																while($obj = $result->fetch_object()){																		
																		echo '<tr><td>';
																		echo $obj->ime;
																		echo '</td><td>';
																		echo $obj->prezime;
																		echo '</td><td>'; 					
																		echo $obj->email;
																		echo '</td><td>';
																		echo $obj->adresa;
																		echo '</td><td>';
																		echo $obj->grad;
																		echo '</td><td>';
																		echo $obj->broj;
																		echo '</td><td>';
																		if(intval($obj->rola) == 0 )
																		{
																			echo "Admin";
																		}
																		else
																		{
																			echo "Običan korisnik";
																		}																
																		echo '</td><td>';
																		echo '<form enctype="multipart/form-data" name="detalji" method="POST" action="">';
																		echo '<input type="hidden" name="odabrani_korisnik_id" id="odabrani_korisnik_id" value="' . $obj->id .'">';
																		echo '<input type="submit" name="details" id="details" value="Detalji" class="btn btn-primary"/>';   
																		echo '</form>';
																		echo '</td><td>';
																		echo '<form enctype="multipart/form-data" name="obrisi_korisnika" method="POST" action="">';
																		echo '<input type="hidden" name="odabrani_korisnik_id" id="odabrani_korisnik_id" value="' . $obj->id .'">';
																		echo '<input type="submit" name="delete_user" id="delete_user" value="Obriši" class="btn btn-primary"/>'; 	
																		echo '</form>';																		
																		echo '</td></tr>';  
																}
																echo '</table>';
														}
												}														
											}											
										}
										else
										{
											$updated = false;
											  if(isset($_POST['spremi'])){                                    
												$ime = $_POST["ime"];
												$prezime = $_POST["prezime"];
												$adresa = $_POST["adresa"];
												$grad = $_POST["grad"];
												$broj = $_POST["broj"];
												$email = $_POST["email"];
												$upid= $_SESSION['id'];
												
												$query="UPDATE korisnik SET ime='".$ime."', prezime='".$prezime."',email='".$email."', adresa='".$adresa."',
												grad='".$grad."',broj=$broj WHERE id=$upid";
												
												$result = mysqli_query($mysqli, $query);
												
												
												if($result)
												{
													$updated = true;
													$_SESSION['ime']=$ime;
												}
												else
												{
													$updated = false;
												}                                    
                                        
												}	
											echo '</br><h3>Podaci o korisniku</h3>';
											$user_id = $_SESSION['id'];
											$query = 'SELECT * FROM korisnik where id='.$user_id;
												$result = $mysqli->query($query);
												if($result){
												while($obj = $result->fetch_object()){
														echo '<form action="profile.php" method="POST"><table style="width:300px;">';
														echo '<tr><td>Ime</td><td style=" height: 20px;"><input type="text" name="ime" value="'. $obj->ime . '"></input></td></tr>';
														echo '<tr><td>Prezime</td><td><input type="text" name="prezime" value="'. $obj->prezime . '"></input></td></tr>';
														echo '<tr><td>Email</td><td><input type="text" name="email" value="'. $obj->email . '"></input></td></tr>';
														echo '<tr><td>Adresa</td><td><input type="text" name="adresa" value="'. $obj->adresa . '"></input></td></tr>';
														echo '<tr><td>Grad</td><td><input type="text" name="grad" value="'. $obj->grad . '"></input></td></tr>';
														echo '<tr><td>Broj</td><td><input type="text" name="broj" value="'. $obj->broj . '"></input><br/></td></tr><table></br>';
														echo '<input type="submit" value="Spremi" name="spremi" class="btn btn-primary" /> </form>';
													}
												} 
												if($updated)
												{
													echo '</br></br><p style="color:red;">Podaci o korisniku su uspiješno ažurirani</p>';
												}
										}

										if(isset($_POST['details']))
										{
											$query = 'SELECT * FROM korisnik where id='.$_POST['odabrani_korisnik_id'];
											$result = $mysqli->query($query);
											if($result){
												while($obj = $result->fetch_object()){  
													echo '</br><h3>Podaci o odabranom korisniku ' . $obj->ime . ' ' . $obj->prezime .'</h3>';											
													echo 'Email : ' . $obj->email . '</br>Adresa: ' . $obj->adresa . ',' . $obj->grad . '</br>Telefon:' . $obj->broj ;
												}
											} 
											echo '</br></br><h4>Sve korisnikove narudžbe</h4>';
											$query = 'SELECT * FROM narudzba where korisnik_id=' . $_POST['odabrani_korisnik_id'] . ' ORDER BY id DESC';
												$result = $mysqli->query($query);
													if($result){ 
													while($obj = $result->fetch_object()){
													   
														$ukupno=0;
														echo '<p>Datum Narudzbe : '. $obj->vrijeme_narudzbe.'<br/>    Vrijeme dostave : '. $obj->vrijeme_dostave .' minuta </p>';
														$data = json_decode($obj->narudzba);
														foreach($data as $key => $item)
														{
															$query1 = 'SELECT * FROM jelo where id='.$key;
															$result1 = $mysqli->query($query1);
															if($result1){
															while($obj1 = $result1->fetch_object()){
																echo '<p1>'.$obj1->ime_jela. ' |  '. $obj1->cijena . ' KM | Kolicina: '.intval($item).' </p1></br>';
																$ukupno+=(intval($obj1->cijena) * intval($item) );
															}
															}
															
														}
														echo' <b>Ukupna cijena: '.$ukupno.'</b>';
														echo '<br/> <br/>';
														}                                               
													}
													if($result->num_rows == 0)
													{
														echo 'Korisnik nema narudžbi!';
													}												
										}										
									}										
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
            
     <!-- USER MODAL -->
  <div class="modal fade" id="addUserModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title">Dodaj korisnika</h5>
          <button class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="dodajkorisnika.php">
            <div class="form-group">
              <label >Ime</label>
              <input type="text" class="form-control" placeholder="Unesi ime" name="ime">
            </div>
              <div class="form-group">
              <label>Prezime</label>
              <input type="text" class="form-control" placeholder="Unesi prezime" name="prezime">
            </div>
              <div class="form-group">
              <label >Grad</label>
              <input type="text" class="form-control" placeholder="Unesi grad" name="grad">
            </div>
              <div class="form-group">
              <label>Adresa</label>
              <input type="text" class="form-control" placeholder="Unesi adresu" name="adresa">
            </div>
              <div class="form-group">
              <label>Broj</label>
              <input type="text" class="form-control" placeholder="Unesi broj" name="broj">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" placeholder="Unesi e-mail" name="email">
            </div>
            <div class="form-group">
              <label>Lozinka</label>
              <input type="password" class="form-control" placeholder="Unesi lozinku" name="lozinka">
            </div>
            <div class="form-group">
                
             <label>Administrator</label>
            <input type="checkbox" name="rola">
            
            </div>
              <button type="submit" class="btn btn-warning"><span>Spremi</span></button>
              
          <button class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
          
            
           
          </form>
        </div>
        
      </div>
    </div>
  </div>
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