<?php
	session_start();

	//koordinate klika
	$s = $_GET["s"];
	$v = $_GET["v"];
	//ime
	$n = $_GET["n"];


	$jeKonec = false;
	$jeUgotovil = false;

	$json = array();
	$json_result = array();

	if(!isset($_SESSION["stevec"]))//ustvarim stevec
	{
		$_SESSION["stevec"] = 0;
	}

	$_SESSION["stevec"]++;
	$json[0] = $_SESSION["stevec"];
	$json_result['poskusi'] = $_SESSION["stevec"];
	for($i = 0; $i < count($_SESSION["ladjice"]); $i++)
	{
		if($_SESSION["ladjice"][$i][0] == $s)
		{
			if($_SESSION["ladjice"][$i][1] == $v)	//je ugotovil
			{
				unset($_SESSION["ladjice"][$i]);
				$_SESSION["ladjice"] = array_values($_SESSION["ladjice"]);
				$jeUgotovil = true;

				if(count($_SESSION["ladjice"]) == 0)	//ugotovljene vse ladjice
				{
					$jeKonec = true;
					$_SESSION["stevec"] = 0;
				}
				break;
			}
			else	//ni ugotovil
			{

			}
		}
	}

	$json_result['ime'] = $n;

	if($jeKonec == true)
	{
		$resultsFile = fopen("rezultati.txt", "a+");
		fwrite($resultsFile, json_encode($json_result)." ");
	}

	//pripravim polje za json objekt

	$json[1] = $jeUgotovil;
	$json[2] = $jeKonec;

	echo json_encode($json);

	?>
