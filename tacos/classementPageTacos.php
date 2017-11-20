<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Page Tacos</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/creative.min.css" rel="stylesheet">
	
	<link href="../stylesheet_perso.css" rel="stylesheet">

  </head>  

  <body id="page-top">  
  
	<?php 
	include('../bdd/connexion.php'); include('../module_note/getAverageNote.php'); include('../module_note/classement.php');
	
	$classement = GetClassement($bdd);
	?>
	<header class="masthead text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase">
              <strong>Classement</strong>
            </h1>
            <hr>
          </div>
		  <div class="col-lg-8 mx-auto">
		  <?php
			foreach ($classement as $row)
			{
				echo '<p class="text-faded mb-5 description"><a style="color:white" href="pagetacos.php?idPageTacos=' . $row[0] . '">' . $row[1] . '</a>';
				
				switch($row[2])
				{
					case '1' :
						echo " : ★";
						break;
					case '2' :
						echo " : ★★";
						break;
					case '3' :
						echo " : ★★★";
						break;
					case '4' :
						echo " : ★★★★";
						break;
					case '5' :
						echo " : ★★★★★";
						break;
				}
				
				echo '</p>';
			}
		  ?>
		  </div>
        </div>
      </div>
    </header>	
	
	<?php
	foreach ($classement as $row)
	{
		echo $row[1] . $row[2];
	}
	?>
  
  </body>
  
</html>