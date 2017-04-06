<?php
	session_start();
	session_unset();
	$_SESSION["stevec"] = 0;

	$ladjice = array();

	//znova zgeneriram pozicije
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

	$N = 10;

	echo "<tr>";
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

	?>
