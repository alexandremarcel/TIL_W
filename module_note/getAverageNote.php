<?php
function getAverageNote($bdd, $idPageTacos){
$qry = $bdd->prepare("SELECT AVG(note) AS noteMoyenne FROM notation WHERE idPageTacos = ".$idPageTacos);
$qry->execute(); 
$avg = $qry->fetch();
return round($avg[0],0);
}
?>