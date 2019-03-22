<?php
/*
		Wczytanie bazy danych do zadania
*/
$polaczenie=@mysqli_connect("localhost","root","","HaszSet");
if(!$polaczenie)
{
	echo "Problem polaczenia z baza danych";
	exit(1);
}

?>