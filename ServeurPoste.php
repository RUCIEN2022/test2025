<?php
//indique que le type de la réponse renvoyée sera du texte
	header("Content-Type: text/plain ; charset=utf-8");
	// Anticache pour HTTP/1.1
	header("Cache-Control: no-cache , private");
	// Anticache pour HTTP/1.0
	header("Pragma: no-cache");

	include_once("../../../app/codes/classes/ClasseAgent.php");

	if(isset($_REQUEST['codeposte'])) $codeposte = $_REQUEST['codeposte'];
	else $codeposte="inconnu";

	$Agent = new Agent();
	$TabAgent = $Agent->fx_Agent_Poste($codeposte);

	$reponseSQL = $TabAgent;
if (!$reponseSQL){
	echo 0;
}else{
	
//Création du Document JSON

$debut = true;
$nbColonnes=2;

echo "{\"coment\":[";
	while ($row = $reponseSQL->fetch()) {
		if ($debut){
				echo "{";
				$debut = false;
			} else {
				echo ",{";
			}
			for($j=0;$j<$nbColonnes;$j++){
			if ($j==0)$colonne='idagent';
			if ($j==1)$colonne='nom';

			echo "\"".$colonne."\":\"".$row[$colonne]."\"";
			if ($j != $nbColonnes-1) echo ",";
		} // Fin de la boucle for
		echo "}";
	} // Fin de la boucle while
 // Fin de la boucle if
echo "]}";
// 
}


?>
