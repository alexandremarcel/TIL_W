<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Page</title>

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
	include('../bdd/connexion.php'); include('../module_note/notation.php'); include('../module_note/getAverageNote.php');
	$idPageTacos = $_GET["idPageTacos"];
	?>
	
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Tacos in Lyon</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#notation">Notation</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#commentaire">Commentaire</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#carte">Carte</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#position">Position</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <header class="masthead text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase">
              <strong>Titre</strong>
            </h1>
            <hr>
          </div>
          <div class="col-lg-8 mx-auto">
            <p class="text-faded mb-5">Description</p>
          </div>
        </div>
      </div>
    </header>

    <section class="bg-primary" id="notation">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading text-white">Noter</h2>
            <hr class="light my-4">
            <p class="text-faded mb-4"><?php echo note($bdd, 'notation', $idPageTacos); ?></p>
			<br/><br/>
            <p class="text-faded mb-4" style="color:orange;font-size: 45px;margin: 0 auto 1em;text-align:center;">
				<h3 class="section-heading text-white">Note moyenne : </h3>
				<p class="text-faded mb-4" style="color:orange;font-size: 45px;margin: 0 auto 1em;text-align:center;">
				<?php 
				switch(getAverageNote($bdd, $idPageTacos))
				{
					case '1' :
						echo "★";
						break;
					case '2' :
						echo "★★";
						break;
					case '3' :
						echo "★★★";
						break;
					case '4' :
						echo "★★★★";
						break;
					case '5' :
						echo "★★★★★";
						break;
				}
				?>
				</p>
			</p>
          </div>
        </div>
      </div>
    </section>

    <section id="commentaire">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading">Commentaire</h2>
            <hr class="my-4">
          </div>
        </div>
      </div>
      <div class="container">
			<?php
			$query = $bdd->prepare("SELECT nom, commentaire FROM commentaire WHERE idPageTacos = ". $idPageTacos);
			$query->execute(); 
			$result = $query -> fetchAll();
			?>
			<div class="media-body">
				<?php
				if (empty($result))
				{
					echo 'Pas de commentaire';
				}
				else
				{
					foreach( $result as $row ) {
					?>
						<h4><?php echo $row['nom']; ?></h4>
						<?php echo $row['commentaire'];
					}
				}?>
			</div>        
			
			<?php
			if(!empty($_POST["nom"]) && !empty($_POST["commentaire"]))
			{
				$bdd->query("INSERT INTO commentaire (nom, commentaire, idPageTacos) VALUES ('".$_POST['nom']."','".$_POST['commentaire']."',".$idPageTacos.");");
				echo'<script>window.location.replace("./pagetacos.php?idPageTacos='.$idPageTacos.'")</script>';
			}
			?>
			<div class="card my-4">
				<h4 class="card-header">Donner votre avis :</h4>
				<div class="card-body">
					<form action="pagetacos.php?idPageTacos=<?=$idPageTacos?>" method="post">
						<div class="form-group">
							Nom :<input type="text" class="form-control" name="nom">
							Commentaire :<textarea class="form-control" rows="3" name = "commentaire"></textarea>
						</div>
						<button type="submit" class="btn btn-primary">Envoyer</button>
					</form>
				</div>
			</div>
      </div>
    </section>

    <section class="p-0" id="carte">
      <div class="container-fluid p-0">
        <div class="row no-gutters popup-gallery">
          <div class="col-lg-4 col-sm-6">
            <div class="portfolio-box" href="img/portfolio/fullsize/1.jpg">
              <img class="img-fluid" src="img/portfolio/thumbnails/1.jpg" alt="">
			  <div class="img-tacos">Appuyer pour découvrir ce tacos</div>
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Tacos 1
                  </div>
                  <div class="project-name">
                    Ingrédients
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-4 col-sm-6">
            <div class="portfolio-box" href="img/portfolio/fullsize/1.jpg">
              <img class="img-fluid" src="img/portfolio/thumbnails/1.jpg" alt="">
			  <div class="img-tacos">Appuyer pour découvrir ce tacos</div>
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Tacos 2
                  </div>
                  <div class="project-name">
                    Ingrédients
                  </div>
                </div>
              </div>
            </div>
          </div>          
          <div class="col-lg-4 col-sm-6">
            <div class="portfolio-box" href="img/portfolio/fullsize/1.jpg">
              <img class="img-fluid" src="img/portfolio/thumbnails/1.jpg" alt="">
			  <div class="img-tacos">Appuyer pour découvrir ce tacos</div>
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Tacos 3
                  </div>
                  <div class="project-name">
                    Ingrédients
                  </div>
                </div>
              </div>
            </div>
          </div>          
          <div class="col-lg-4 col-sm-6">
            <div class="portfolio-box" href="img/portfolio/fullsize/1.jpg">
              <img class="img-fluid" src="img/portfolio/thumbnails/1.jpg" alt="">
			  <div class="img-tacos">Appuyer pour découvrir ce tacos</div>
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Tacos 4
                  </div>
                  <div class="project-name">
                    Ingrédients
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6">
            <div class="portfolio-box" href="img/portfolio/fullsize/1.jpg">
              <img class="img-fluid" src="img/portfolio/thumbnails/1.jpg" alt="">
			  <div class="img-tacos">Appuyer pour découvrir ce tacos</div>
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Tacos 5
                  </div>
                  <div class="project-name">
                    Ingrédients
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6">
            <div class="portfolio-box" href="img/portfolio/fullsize/1.jpg">
              <img class="img-fluid" src="img/portfolio/thumbnails/1.jpg" alt="">
			  <div class="img-tacos">Appuyer pour découvrir ce tacos</div>
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Tacos 6
                  </div>
                  <div class="project-name">
                    Ingrédients
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="bg-dark text-white" id="position">
      <div class="container text-center">
        <h2 class="mb-4">Position</h2>
       <iframe class="img-fluid" width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyC-pJ2EoeWOOE6VODmB1mv3ivRyVp5LKaY&q=Mister+tacos,Lyon" allowfullscreen></iframe>
      </div>
    </section>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/creative.min.js"></script>

  </body>

</html>
