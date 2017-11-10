<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../bootstrap-3.3.7-dist/css/bootstrap.css" />
        <title>Page</title>
    </head>
	<?php 
	include('../bdd/connexion.php'); include('../module_note/notation.php'); include('../module_note/getAverageNote.php'); 
	$idPageTacos = 1;
	?>
    <body>
        <div class="container">
			<header class="page-header">
				<h1>Titre</h1>
			</header>
			<section class="row">
				<div class="col-lg-12">
				  <p>
					Description
				  </p>
				</div>
				<div class="col-lg-12">
					<h3>Note :</h3>
					<p>
						<?php echo note($bdd, 'notation', $idPageTacos); ?>
					</p>
				</div>
				<div class="col-lg-12">
				  <h3>Note moyenne :</h3>
				  <p style="color:orange;font-size: 45px;margin: 0 auto 1em;text-align:center;">
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
				</div>
			</section>
			
			<h3>Commentaires :</h3>
			<?php
			$query = $bdd->prepare("SELECT nom, commentaire FROM commentaire");
			$query->execute(); 
			$result = $query -> fetchAll();
			?>
			<div class="media mb-4">
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
			</div>            
			
			<?php
			if(!empty($_POST["nom"]) && !empty($_POST["commentaire"]))
			{
				$bdd->query("INSERT INTO commentaire (nom, commentaire, idPageTacos) VALUES ('".$_POST['nom']."','".$_POST['commentaire']."',".$idPageTacos.");");
				header('Location: mistertacos.php'); 
			}
			?>
			<div class="card my-4">
				<h4 class="card-header">Donner votre avis :</h4>
				<div class="card-body">
					<form onsubmit="" method="post">
						<div class="form-group">
							Nom :<input type="text" class="form-control" name="nom">
							Commentaire :<textarea class="form-control" rows="3" name = "commentaire"></textarea>
						</div>
						<button type="submit" class="btn btn-primary">Envoyer</button>
					</form>
				</div>
			</div>
        </div>
    </body>
</html>