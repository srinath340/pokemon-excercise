<?php
function Calculate($Units_ofPikachu,$Units_ofSquirtle,$Units_ofCharmander){
		if(($Units_ofPikachu <= $Units_ofCharmander) && ($Units_ofPikachu <= $Units_ofSquirtle)){
			Calculate_Groups("Pikachu",$Units_ofPikachu,$Units_ofSquirtle,$Units_ofCharmander);
		}
		elseif(($Units_ofSquirtle <= $Units_ofCharmander) && ($Units_ofSquirtle <= $Units_ofPikachu)){
			Calculate_Groups("Squirtle",$Units_ofPikachu,$Units_ofSquirtle,$Units_ofCharmander);
		}
		elseif(($Units_ofCharmander <= $Units_ofSquirtle) && ($Units_ofCharmander <= $Units_ofPikachu)){
			Calculate_Groups("Charmander",$Units_ofPikachu,$Units_ofSquirtle,$Units_ofCharmander);
		}	
	}
function Calculate_Groups($FirstMinimum,$Units_ofPikachu,$Units_ofSquirtle,$Units_ofCharmander){
	//calculating groups of 3,2 and 1 by minimum quantity ordered based on each pokemon quantity
	
	if($FirstMinimum =="Pikachu"){
		if($Units_ofSquirtle <= $Units_ofCharmander){
			$SecondMinimum = "Squirtle";
			$ThirdMinimum = "Charmander";
		}else{
			$SecondMinimum = "Charmander";
			$ThirdMinimum = "Squirtle";
		}
	}
	elseif($FirstMinimum=="Squirtle"){
		if($Units_ofPikachu <= $Units_ofCharmander){
			$SecondMinimum = "Pikachu";
			$ThirdMinimum = "Charmander";
		}else{
			$SecondMinimum = "Charmander";
			$ThirdMinimum = "Pikachu";
		}
	}
	elseif($FirstMinimum=="Charmander"){
		if($Units_ofSquirtle <= $Units_ofPikachu){
			$SecondMinimum = "Squirtle";
			$ThirdMinimum = "Pikachu";
		}else{
			$SecondMinimum = "Pikachu";
			$ThirdMinimum = "Squirtle";
		}
	}
	$_SESSION['Order_Types'] = array();
	$_SESSION['Order_Types']['With_3kinds_of_Pokemon'] = array();
	$_SESSION['Order_Types']['With_2kinds_of_Pokemon'] = array();
	$_SESSION['Order_Types']['With_1kind_of_Pokemon'] = array();
	if($FirstMinimum=="Pikachu"){
		$_SESSION['Order_Types']['With_3kinds_of_Pokemon']['units'] = $Units_ofPikachu;
	}elseif($FirstMinimum=="Squirtle"){
		$_SESSION['Order_Types']['With_3kinds_of_Pokemon']['units'] = $Units_ofSquirtle;
	}else{
		$_SESSION['Order_Types']['With_3kinds_of_Pokemon']['units'] = $Units_ofCharmander;
	}
	
	if($SecondMinimum=="Pikachu"){
		$_SESSION['Order_Types']['With_2kinds_of_Pokemon']['units'] = $Units_ofPikachu;
	}elseif($SecondMinimum=="Squirtle"){
		$_SESSION['Order_Types']['With_2kinds_of_Pokemon']['units'] = $Units_ofSquirtle;
	}else{
		$_SESSION['Order_Types']['With_2kinds_of_Pokemon']['units'] = $Units_ofCharmander;
	}
	
	if($ThirdMinimum=="Pikachu"){
		$_SESSION['Order_Types']['With_1kind_of_Pokemon']['units'] = $Units_ofPikachu;
	}elseif($ThirdMinimum=="Squirtle"){
		$_SESSION['Order_Types']['With_1kind_of_Pokemon']['units'] = $Units_ofSquirtle;
	}else{
		$_SESSION['Order_Types']['With_1kind_of_Pokemon']['units'] = $Units_ofCharmander;
	}
	$_SESSION['Order_Types']['With_3kinds_of_Pokemon']['pokemon'] = $FirstMinimum;
	$_SESSION['Order_Types']['With_2kinds_of_Pokemon']['pokemon'] = $SecondMinimum;
	$_SESSION['Order_Types']['With_1kind_of_Pokemon']['pokemon'] = $ThirdMinimum;
}
function Cost($Cost_Pikachu,$Cost_Squirtle,$Cost_Charmander,$Units_ofPikachu,$Units_ofSquirtle,$Units_ofCharmander){
	
	if($_SESSION['Order_Types']['With_3kinds_of_Pokemon']['pokemon'] == "Pikachu"){
		$FirstMinimum_PokemonCost = $Cost_Pikachu; 
	}
	elseif($_SESSION['Order_Types']['With_3kinds_of_Pokemon']['pokemon'] == "Squirtle"){
		$FirstMinimum_PokemonCost = $Cost_Squirtle;
	}
	else{
		$FirstMinimum_PokemonCost = $Cost_Charmander;
	}
	
	if($_SESSION['Order_Types']['With_2kinds_of_Pokemon']['pokemon'] == "Pikachu"){
		$SecondMinimum_PokemonCost = $Cost_Pikachu; 
	}
	elseif($_SESSION['Order_Types']['With_2kinds_of_Pokemon']['pokemon'] == "Squirtle"){
		$SecondMinimum_PokemonCost = $Cost_Squirtle;
	}
	else{
		$SecondMinimum_PokemonCost = $Cost_Charmander;
	}
	
	if($_SESSION['Order_Types']['With_1kind_of_Pokemon']['pokemon'] == "Pikachu"){
		$ThirdMinimum_PokemonCost = $Cost_Pikachu; 
	}
	elseif($_SESSION['Order_Types']['With_1kind_of_Pokemon']['pokemon'] == "Squirtle"){
		$ThirdMinimum_PokemonCost = $Cost_Squirtle;
	}
	else{
		$ThirdMinimum_PokemonCost = $Cost_Charmander;
	}
	
	$Discount_ofGroupsWith3Pokemon = (20*($Cost_Pikachu+$Cost_Squirtle+$Cost_Charmander) * $_SESSION['Order_Types']['With_3kinds_of_Pokemon']['units'])/100;	//finding discount of 20 % from total
	$Discount_ofGroupsWith2Pokemon = (10*($SecondMinimum_PokemonCost+$ThirdMinimum_PokemonCost) * ($_SESSION['Order_Types']['With_2kinds_of_Pokemon']['units']-$_SESSION['Order_Types']['With_3kinds_of_Pokemon']['units']))/100;	//finding discount of 10 % from total
	
	$Cost_ofGroupsWith3Pokemon = (($Cost_Pikachu+$Cost_Squirtle+$Cost_Charmander) * $_SESSION['Order_Types']['With_3kinds_of_Pokemon']['units'])-$Discount_ofGroupsWith3Pokemon;
	$Cost_ofGroupsWith2Pokemon = (($SecondMinimum_PokemonCost+$ThirdMinimum_PokemonCost) * ($_SESSION['Order_Types']['With_2kinds_of_Pokemon']['units']-$_SESSION['Order_Types']['With_3kinds_of_Pokemon']['units']))-$Discount_ofGroupsWith2Pokemon;
	$Cost_ofGroupsWith1Pokemon = ($ThirdMinimum_PokemonCost) * ($_SESSION['Order_Types']['With_1kind_of_Pokemon']['units'] - $_SESSION['Order_Types']['With_2kinds_of_Pokemon']['units']);

	$_SESSION['Order_Types']['With_3kinds_of_Pokemon']['cost'] =$Cost_ofGroupsWith3Pokemon;
	$_SESSION['Order_Types']['With_2kinds_of_Pokemon']['cost'] =$Cost_ofGroupsWith2Pokemon;
	$_SESSION['Order_Types']['With_1kind_of_Pokemon']['cost'] =$Cost_ofGroupsWith1Pokemon;
}
?>