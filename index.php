<?php
        session_start();    //začne sejo
        $_SESSION["stevec"] = 0;  //nastavi števec na 0
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="vaja1" />
    <title>Potapljanje ladjic</title>
    <link rel="stylesheet" type="text/css" href="stilTable.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" />
  </head>

  <body>
    <?php

		$N = 10;
		$x;
		$y;

		//izpis crk
		echo "<table id='tabela'><tr>";
		echo "<td id='crke'></td><td id='crke'>A</td><td id='crke'>B</td><td id='crke'>C</td><td id='crke'>D</td><td id='crke'>E</td><td id='crke'>F</td><td id='crke'>G</td><td id='crke'>H</td><td id='crke'>I</td><td id='crke'>J</td>";
		echo "</tr>";


		for($i = 0; $i<$N; $i++) // tabela
		{
			echo "<tr>";
			echo "<td id='crke'>".($i+1)."</td>"; //izpis stevilke za vrstico
			for($j = 1; $j<= $N; $j++)
			{
					echo "<td class='polje' id='".($i*$N+$j)."' onclick='funkcija(this, this.id)'></td>";
			}
			echo "</tr>";
		}
		echo "</table>";
		echo "<br>";

		$ladjice = array();
		$current_ladjica = array();
		$setNum = 0;
		$bool = false;
		$allSet=false;

		while($allSet == false)
		{
			loop:
			$current_ladjica = array();
			if($setNum == 0){//1x5
				if(rand(0,1) == 0) //vodoravno
				{
					$x=rand(1,6);
					$y=rand(1,10);
					array_push($ladjice, array($x, $y));

					for($i = 1; $i < 5; $i++)
						array_push($ladjice, array(($x+$i), $y));
					$setNum = 1;
				}
				else //navpicno
				{
					$x=rand(1,10);
					$y=rand(1,6);
					array_push($ladjice, array($x, $y));

					for($i = 1; $i < 5; $i++)
						array_push($ladjice, array($x, ($y+$i)));
					$setNum = 1;
				}
			}
			else if($setNum == 1)//1x4
			{
				if(rand(0,1) == 0) //vodoravno
				{
					$x=rand(1,7);
					$y=rand(1,10);
					for($i = 0; $i<count($ladjice); $i++)//1. kvadratek
					{
						if($x == $ladjice[$i][0] && $y == $ladjice[$i][1])
						{
							goto loop;
							$bool=true;
							break;
						}
					}
					if($bool == false)
					{
						array_push($current_ladjica, array($x, $y));
					}
					else
					{
						$bool=false;
						$current_ladjica = array();
					}


					for($i = 1; $i < 4; $i++){	//ostali kvadratki
						for($j = 0; $j<count($ladjice); $j++)
						{
							if(($x+$i) == $ladjice[$j][0] && $y == $ladjice[$j][1]){
								goto loop;
								$bool=true;
								break;
							}
						}

						if($bool == false)
							array_push($current_ladjica, array(($x+$i), $y));
						else
						{
							$bool=false;
							$current_ladjica = array();
						}

					}
					if(count($current_ladjica == 4))	//ni nič prekrivanja
					{
						for($i=0; $i<4; $i++)
							array_push($ladjice, $current_ladjica[$i]);
						$setNum = 2;
						$current_ladjica = array();
					}
				}
				else //navpicno
				{
					$x=rand(1,10);
					$y=rand(1,7);
					for($i = 0; $i<count($ladjice); $i++)//1. kvadratek
					{
						if($x == $ladjice[$i][0] && $y == $ladjice[$i][1]){
							goto loop;
							$bool=true;
							break;
						}
					}
					if($bool == false)
					{
						array_push($current_ladjica, array($x, $y));

					}
					else
					{
						$bool = false;
						$current_ladjica = array();
					}

					for($i = 1; $i < 4; $i++){	//ostali kvadratki
						for($j = 0; $j<count($ladjice); $j++)
						{
							if($x == $ladjice[$j][0] && ($y+$i) == $ladjice[$j][1]){
								goto loop;
								$bool=true;
								break;
							}
						}

						if($bool == false)
							array_push($current_ladjica, array($x, ($y+$i)));
						else
						{
							$bool = false;
							$current_ladjica = array();
						}
					}

					if(count($current_ladjica == 4))	//ni nič prekrivanja
					{
						for($i=0; $i<4; $i++)
							array_push($ladjice, $current_ladjica[$i]);
						$setNum = 2;
						$current_ladjica = array();
					}
				}
			}
			else if($setNum == 2)//2x3
			{
				if(rand(0,1) == 0) //vodoravno
				{
					$x=rand(1,9);
					$y=rand(1,8);

					for($i = 0; $i < 3; $i++){
						for($k=0; $k < 2; $k++){
							for($j = 0; $j<count($ladjice); $j++)	//primerjam z že postavljenimi
							{
								if(($x+$k) == $ladjice[$j][0] && ($y+$i) == $ladjice[$j][1]){
									$bool=true;
									break;
								}
							}
							if($bool == false)
								array_push($current_ladjica, array(($x+$k), ($y+$i)));
							else
							{
								$bool=false;
								$current_ladjica=array();
							}

						}
					}
					if(count($current_ladjica) == 6)	//ni nič prekrivanja
					{
						for($i=0; $i<6; $i++)
							array_push($ladjice, $current_ladjica[$i]);
						$setNum = 3;
						$current_ladjica = array();
					}
				}
				else	//navpicno
				{
					$x=rand(1,8);
					$y=rand(1,9);

					for($i = 0; $i < 3; $i++){
						for($k=0; $k < 2; $k++){
							for($j = 0; $j<count($ladjice); $j++)	//primerjam z že postavljenimi
							{
								if(($x+$i) == $ladjice[$j][0] && ($y+$k) == $ladjice[$j][1]){
									$bool=true;
									break;
								}
							}
							if($bool == false)
								array_push($current_ladjica, array(($x+$i), ($y+$k)));
							else
							{
								$bool=false;
								$current_ladjica=array();
							}
						}
					}
					if(count($current_ladjica) == 6)	//ni nič prekrivanja
					{
						for($i=0; $i<6; $i++)
							array_push($ladjice, $current_ladjica[$i]);
						$setNum = 3;
						$current_ladjica = array();
					}

				}
			}
			else if($setNum == 3)//2x2
			{
				$x=rand(1,9);
				$y=rand(1,9);

				for($i = 0; $i < 2; $i++){
					for($k=0; $k < 2; $k++){
						for($j = 0; $j<count($ladjice); $j++)	//primerjam z že postavljenimi
						{
							if(($x+$i) == $ladjice[$j][0] && ($y+$k) == $ladjice[$j][1]){
								$bool=true;
								break;
							}
						}
						if($bool == false)
							array_push($current_ladjica, array(($x+$i), ($y+$k)));
						else
						{
							$bool=false;
							$current_ladjica=array();
						}
					}
				}
				if(count($current_ladjica) == 4)	//ni nič prekrivanja
					{
						for($i=0; $i<4; $i++)
							array_push($ladjice, $current_ladjica[$i]);
						$setNum = 4;
						$current_ladjica = array();
						$allSet=true;
					}
			}
		}





		$_SESSION["ladjice"] = $ladjice;	//pozicije ladjic shranim v sejo

		//print_r($_SESSION);
	?>
	<div >
	<textarea readonly id="p"></textarea>

	<label>Ime: </label><input type="text" id="vnos"/>
	<button type="button" id="zac" name="zac" onclick="ponastavi()" >Začni znova </button>
	</div>
	<textarea readonly id="results"></textarea>
	<script>
		function funkcija(celica, l){
			var x = (l % 10); //izračun x
			if (x == 0)
				x = 10;
			var y = Math.ceil(l/10); //izračun y

			var ime = $("#vnos").val();

			$.ajax({
				type: 'get',
				url: 'preveri.php',
				data: {s:x, v:y, n:ime},
				success: function(data){
					obj = JSON.parse(data);
					if(obj[1] == true)
					{
						celica.innerHTML="<img src='ship.png'/>";
						$("#p").prepend("Uganil. Št. poskusov: " + obj[0] + "\n");
					}
					else
					{
						celica.style.backgroundColor = 'blue';
						$("#p").prepend("Zgresil. Št. poskusov: " + obj[0] + "\n");
					}
					celica.removeAttribute('onclick');

					if(obj[2] == true)	//če je igra zaključena
					{
						$("#p").prepend("Konec igre!. Št. poskusov: " + obj[0] + "\n");
						$('td').removeAttr('onclick');


						$.ajax({
							type: 'get',
							url: 'rezultati.php',
							success: function(data1){
								var strJson = data1.split(" ");

								var objects = [];
								for(i = 0; i < strJson.length-1; i++)// -1 ker je zadni ""
								{
									//alert(strJson[i]);
									obj1 = JSON.parse(strJson[i]);
									objects.push(obj1);
								}

								$("#results").html("");
								for(i = 0; i < 5; i++)
								{
									$("#results").append("igralec: " + objects[i]["ime"] + " poskusi: " + objects[i]["poskusi"] + "\n");
								}

							}

						});
					}
				}
			});
		}

		function ponastavi(){
			$.ajax({
				type: 'get',
				url: 'ponastavi.php',
				success: function(odgovor){
					$("table").html(odgovor);
					$("#p").html("");
				}
			});

		}

	</script>

</body>
</html>
