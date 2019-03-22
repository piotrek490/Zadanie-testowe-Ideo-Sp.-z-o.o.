<?php


function bdMainData( $val, $valNext, $dataKey, $isFirst){            //Funkcja dodawania rekordów do głównej tabeli [MainTableData], która przechowuje zawartość głównej listy
	
	include 'BaseFunction\loadBase.php';
	
	
	$zapytanie = "INSERT INTO MainTableData values(".$val.",".$valNext.",\"".$dataKey."\",".$isFirst.");";
	
	$wynik = mysqli_query($polaczenie, $zapytanie);
	if(!$wynik){
		echo "Problem funkcji addData => bdMainData();";
	}
	
}


function bdMainSetFirst($dataKey){		//Funkcja aktualizuje tabele, wyznaczając w niej pierwszy element LinkedListy [na rootLiście]
	
	include 'BaseFunction\loadBase.php';
	
	
	$zapytanie = "UPDATE MainTableData SET isFirst=0;";
	
	$wynik = mysqli_query($polaczenie, $zapytanie);
	if(!$wynik){
		echo "Problem funkcji addData => bdMainSetFirst()   e1;";
	}
	
	$zapytanie = "UPDATE MainTableData SET isFirst=1 WHERE dataKey=\"".$dataKey."\";";
	
	$wynik = mysqli_query($polaczenie, $zapytanie);
	if(!$wynik){
		echo "Problem funkcji addData => bdMainSetFirst()   e2;";
	}
	
}



function bdAddData($dataKey){  //Funkcja dodaje tabele z danymi dla danej listy
	
	include 'BaseFunction\loadBase.php';
	
	//Dodam nową tabele do reprezentacji DATA obiektów
	
	$zapytanie = "CREATE TABLE ".$dataKey." (
	val int(20), 
	valNext int(20),
	dataKey text,
	isFirst int(1)
	)";
	
	$wynik = mysqli_query($polaczenie, $zapytanie);
	if(!$wynik){
		echo "|     Problem funkcji addData => bdAddData()    Key:".$dataKey."    |";
	}
	
}

function bdSubData($tableKey, $val, $valNext, $dataKey, $isFirst){  //Dodaje rekord do sub listy
	
	include 'BaseFunction\loadBase.php';
	
	//Dodam nową tabele do reprezentacji DATA obiektów
	
	$zapytanie = "INSERT INTO ".$tableKey." values(".$val.",".$valNext.",\"".$dataKey."\",".$isFirst.");";
	
	$wynik = mysqli_query($polaczenie, $zapytanie);
	if(!$wynik){
		echo "Problem funkcji addData => bdSubData() ";
	}
	
}


function bdSubExist($tableKey){	//Funkcja sprawdzająca, czy dana tabela istnieje w Bazie Danych
	
	include 'BaseFunction\loadBase.php';
	
	
	$zapytanie = "select * from ".$tableKey." limit 1;";
	$wynik =  mysqli_query($polaczenie, $zapytanie);

	if($wynik)
	{
		//echo "|     Tabela już istnieje! key: ".$tableKey."     |";           TESTER
		return true;
	}
	else{
		//echo "|     Tabela NIE istnieje! key: ".$tableKey."     |";           TESTER
		return false;
	} 
}


function bdSetFirst($tableKey, $dataKey){		//Funkcja aktualizuje tabele, wyznaczając w niej pierwszy element LinkedListy [na subListach]
	
	include 'BaseFunction\loadBase.php';
	
	//Dodam nową tabele do reprezentacji DATA obiektów
	
	$zapytanie = "UPDATE ".$tableKey." SET isFirst=0;";
	
	$wynik = mysqli_query($polaczenie, $zapytanie);
	if(!$wynik){
		echo "Problem funkcji addData => bdSetFirst()   e1;";
	}
	
	$zapytanie = "UPDATE ".$tableKey." SET isFirst=1 WHERE dataKey=\"".$dataKey."\";";
	
	$wynik = mysqli_query($polaczenie, $zapytanie);
	if(!$wynik){
		echo "Problem funkcji addData => bdSetFirst()   e2;";
	}
	
}





?>