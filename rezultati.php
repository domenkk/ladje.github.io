<?php
	$resultsFile;

	if(fopen("rezultati.txt", "r") != false)
		$resultsFile = fopen("rezultati.txt", "r");

	$vsebina = file_get_contents("rezultati.txt"); //dobim vsebino
	$array = explode(" ", $vsebina);	//parsam vsebino po presledku
	$objekti;
	for($i = 0; $i < count($array); $i++)	//json spremenim v objekt
	{
		$objekti[$i] = json_decode($array[$i], true);
	}

	for($i = 0; $i < count($objekti) - 2; $i++)//sortiranje
	{
		for($j = 0; $j < count($objekti) - 2; $j++)
		{
			if($objekti[$j]["poskusi"] > $objekti[($j+1)]["poskusi"])
			{
				$temp = $objekti[$j];
				$objekti[$j] = $objekti[($j+1)];
				$objekti[($j+1)] = $temp;
			}
		}
	}

	if(count($objekti) > 5){//če je več kot 5 rezultatov shranjenih
		for($i = 1; $i < 6; $i++)
		{
			echo json_encode($objekti[$i])." ";
		}
	}
	else
	{
		for($i = 0; $i < count($objekti); $i++)
		{
			echo json_encode($objekti[$i])." ";
		}
	}

?>
