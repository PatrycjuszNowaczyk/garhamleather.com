<?php
 
if(isset($_POST['email'])) {
 
     
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
 
    $email_to = "info.garham@gmail.com";
 
    $email_subject = "GARHAM - Kontakt";
 
     
 
     
 
    function died($error) {
 
        // your error code can go here
 
        echo "Hej. Znalezione zostały błędy w formularzu.<br >";
 
        echo "Oto lista pól do poprawienia:<br ><br >";
 
        echo $error."<br ><br >";
 
        echo "Proszę wróć do poprzedniej strony i uzupełnij ją właściwie.<br ><br >";
 
        die();
 
    }
 
     
 
    // validation expected data exists
 
    if(!isset($_POST['first_name']) ||
 
        !isset($_POST['last_name']) ||
 
        !isset($_POST['email']) ||
 
        !isset($_POST['telephone']) ||
 
        !isset($_POST['comments'])) {
 
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
 
    }
 
     
 
    $first_name = $_POST['first_name']; // required
 
    $last_name = $_POST['last_name']; // required
 
    $email_from = $_POST['email']; // required
 
    $telephone = $_POST['telephone']; // not required
 
    $comments = $_POST['comments']; // required
 
     
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
 
    $error_message .= 'Adres e-mail nie jest prawidłowy.<br >';
 
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
 
    $error_message .= 'Imię wydaje się zawierać w sobie błąd.<br >';
 
  }
 
  if(!preg_match($string_exp,$last_name)) {
 
    $error_message .= 'Nazwisko wydaje się zawierać w sobie błąd.<br >';
 
  }
 
  if(strlen($comments) < 2) {
 
    $error_message .= 'Treść, formularza wydaje się być nie poprawna.<br >';
 
  }
 
  if(strlen($error_message) > 0) {
 
    died($error_message);
 
  }
 
    $email_message = "Szczegóły poniżej.\n\n";
 
     
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
 
     
 
    $email_message .= "First Name: ".clean_string($first_name)."\n";
 
    $email_message .= "Last Name: ".clean_string($last_name)."\n";
 
    $email_message .= "Email: ".clean_string($email_from)."\n";
 
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
 
    $email_message .= "Comments: ".clean_string($comments)."\n";
 
     
 
     
 
// create email headers
 
$headers = 'From: '.$email_from."\r\n".
 
'Reply-To: '.$email_from."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
@mail($email_to, $email_subject, $email_message, $headers);  
 
?>
 
 
 
<!-- include your own success html here -->
 
 
 
<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Garham - Kontakt</title>
    <link rel="icon" type="image/png" href="../img/logo/favicon.png" >
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/reset.css">
    <link href="../css/style.css" rel="stylesheet" type="text/css" >
    <meta charset="UTF-8" >
    <meta name="keywords" content="skóra, torba, portfel, craft, poznań, warszawa," >
    <meta name="description" content="Leather goods from Poland since 2015" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" >
    <meta name="author" Marcin Kaczmarek and Patrycjusz Nowaczyk >

    <link rel='shortlink' href='http://garhamleather.com/' >
    <link rel="alternate" href="http://garhamleather.com/pl" hreflang="pl" >
    <link rel="alternate" href="http://garhamleather.com/en" hreflang="en" >
    <link rel="alternate" href="http://garhamleather.com/" hreflang="x-default" >


    <script src="../js/jquery.js"></script>
    <script src="../js/jquery.waypoints.min.js"></script>

        

</head>
<body onload="document.body.style.opacity='1'">
<!--begin-------------------------------->
<div id="container">
<!--PRZYCISK LANG
        <a href="#" class="lang nav_index">EN</a>
-->
<!--header------------------------------->
    <header id="header">

        <a href="../index.html" ><img src="../img/logo/logo_garham.svg" class="logo anim fadeInDown"></a>
        <nav>
        <ul id="menu">
            <li class="menu-collection"><a href="kolekcja.html">Kolekcja</a></li>
            <li class="menu-shop"><a href="sklep.html">Sklep</a></li>
            <li class="menu-aboutus"><a href="onas.html">O nas</a></li>
            <li class="menu-contact"><a href="kontakt.html">Kontakt</a></li>
        </ul>
        </nav>
    </header>

<!--head-image--------------------------->
    <div id="headimage" class="anim">
        <noscript><img src="../img/collection/16.jpg"></noscript>
    </div>


<!-- content----------------------------->

<!--Contact---------------------------------->
<div class="row"></div>
<div class="row anim" id="kontakt"></div>
    <div class="row">
            <div class="cell-left"><h1 class="name">Kontakt</h1></div>
            <div class="cell-right description">
<p>Dziękujemu bardzo za skontaktowanie się z nami. Odpowiemy najszybciej jak to możliwe.</p><br>
<p>Zespół GARHAM</p>
            </div>
</div>
<div class="row"></div>

<!--footer------------------------------->
    <footer id="footer">
        <nav>
            <img src="../img/logo/logo_garham_mini.svg" class="logomini">
        <ul id="menu">
            <li class="menu-collection"><a href="kolekcja.html">Kolekcja</a></li>
            <li class="menu-shop"><a href="sklep.html">Sklep</a></li>
            <li class="menu-aboutus"><a href="onas.html">O nas</a></li>
            <li class="menu-contact"><a href="kontakt.html">Kontakt</a></li>
        </ul>
        </nav>
    </footer>
</div>

<!-- Navigation -->
<div class="b-nav">
    <li><a class="b-link" href="kolekcja.html">Kolekcja</a></li>
    <li><a class="b-link" href="sklep.html">Sklep</a></li>
    <li><a class="b-link" href="onas.html">O nas</a></li>
    <li><a class="b-link" href="kontakt.html">Kontakt</a></li>
</div>

<!-- Burger-Icon -->
<div class="b-container">
    <div class="b-menu">
        <div class="b-bun b-bun--top"></div>
        <div class="b-bun b-bun--mid"></div>
        <div class="b-bun b-bun--bottom"></div>
    </div>
</div>

<!--scripts------------------------------>
    <!--burger------------------------------->
<script>
    'use strict';

(function() {
  var body = document.body;
  var burgerMenu = document.getElementsByClassName('b-menu')[0];
  var burgerContain = document.getElementsByClassName('b-container')[0];
  var burgerNav = document.getElementsByClassName('b-nav')[0];

  burgerMenu.addEventListener('click', function toggleClasses() {
    [body, burgerContain, burgerNav].forEach(function (el) {
      el.classList.toggle('open');
    });
  }, false);
})();
</script>
<!--headimage randomizer----------------->
<script>
//Dodaj nazwy obrazów, ścieżkę ustawisz w następnym kroku
    var images = ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg'];
    
//Wskaż ścieżkę do obrazów, wpisz jakieś działanie matematyczne i przypisz do odpowiedniego DIV'a ID
    $('<img src="../img/header/' + images[Math.floor(Math.random() * images.length)] + '" style="width: 100%;height: 100%">').appendTo('#headimage');
</script>
<!--Animate----------------->
<script>

$(document).ready(function() {
	var waypointClass = '.anim';
	var delayTime;
	$(waypointClass).css({opacity: '0'});
	
	$(waypointClass).waypoint(function() {
		delayTime += 3;
		$(this).delay(delayTime).queue(function(next){
			$(this).toggleClass('animated');
			$(this).toggleClass('fadeInUp');
			delayTime = 0;
			next();
		});
	},
	{
		offset: '95%',
		triggerOnce: true
	});
});
</script>
</body>
</html>
 
 
 
<?php
 
}
 
?>