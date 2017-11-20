<?php
function GetClassement($bdd)
{
	$queryGetAllPageTacosId = $bdd->prepare("SELECT id, nom FROM page_tacos");
	$queryGetAllPageTacosId->execute(); 
	$allPageTacosId = $queryGetAllPageTacosId -> fetchAll();

	$pageTacosWithAverageNote = [];
	$i = 0;
	
	foreach($allPageTacosId as $pageTacosId)
	{
		$averageNote = getAverageNote($bdd, $pageTacosId['id']);
		$pageTacosWithAverageNote[$i] = array($pageTacosId['id'], $pageTacosId['nom'], $averageNote);
		$i++;
	}
	
	function cmp($a, $b)
	{
		if ($a[2] == $b[2]) {
			return 0;
		}
		return ($a[2] > $b[2]) ? -1 : 1;
	}

	usort($pageTacosWithAverageNote,"cmp");
	
	return $pageTacosWithAverageNote;
}
?>