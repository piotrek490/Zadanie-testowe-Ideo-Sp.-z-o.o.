<?php 


//===================================================================
class tableData{     //Klasa danych w naszym "drzewie"

	public $data, $value; //Zawiera swoją wartość i dane, czyli podrzędną Linked Liste
	public $next; //NEXT wskazuje na następny obiekt listy
	
	function __construct($value){
		$this->value = $value;
		$this->data = null;
	}
	
	
	function printData(){     //Funkcja służy do prostego wypisywania wartości i danych zawartych w obiekcie
		echo "<div style=\"float:left; border:1px solid black;padding:3px;margin:3px; text-align:center\">";
		echo $this->value."<br>";
		if($this->data!=null){
			for($i=0;$i<$this->data->size();$i++) $this->data->getIndex($i)->printData();
		}
		echo "</div>";
	}

}

//===================================================================

class LinkedList{  //Klasa do zarządzania Linked Listą utworząną z powyższej klasy danych
	private $first;   //Zmienna first zawiera obiekt, który jest pierwszy w naszej liście
	
	function __construct(){
		$this->first = null;      //Domyślnie po utworzeniu listy, nie zawiera ona obiektu first
	}
	
	function isEmpty(){        //Funkcja służy do sprawdzania czy istnieje obiekt first
		if($this->first==null) return true;
			else return false;
	}
	
	function getFirst(){      //Getter firsta
		return $this->first;
	}
	
	
	function setFirst($first){ //Setter firsta
		$this->first=$first;
	}
	
	function setFirstNext($next){  //Setter first -> next-a
		$this->first->next=$next;
	}
	
	function insertFirst($value){ //Metoda tworzy obiekt z podaną wartością i umieszcza go na pierwszym miejscu listy
			$newData = new tableData($value);
			$newData->next=$this->first;			
			$this->first=$newData;
	}
	
	function insertLast($value){ //Jak wyżej tylko umieszcza na końcu :D
			$newData = new tableData($value);
			if($this->first==null) $this->first=$newData;
			else{
				$current=$this->first;
				$previous = null;
				while($current!=null)
				{
					$previous=$current;
					$current=$current->next;
				}
				$previous->next=$newData;
			}
	}
	
	
	function insertFirstObj($object){   	   //   <----------  Tutaj dwie metody które działają na obiekcie a nie na zmiennej value 		
			$object->next=$this->first;
			$this->first=$object;
	}
	
	function insertLastObj($object){      	//  <----------
			if($this->first==null){
				 $this->first=$object;
				 $object->next=null;
			}
			else{
				$current=$this->first;
				$previous = null;
				while($current!=null)
				{
					$previous=$current;
					$current=$current->next;
				}
				$previous->next=$object;
				$object->next=null;
			}
	}
	
	function deleteFirst(){	//Usuwa pierwszy element listy (jeśli isnieje)             			     (Zwraca True/False)
		if($this->isEmpty()){
			return false;
		}
		
		$buffer = $this->first->next;
		$this->first = $buffer;
		return true;
	}
	
	function deleteElem($val){ 	//Usuwa element listy o podanej wartości (jeśli isnieje)  	(Zwraca True/False)
		if($this->isEmpty()){
			return false;
		}
		
		$current = $this->first;
        $previous = null;
		
		while ($current->value != $val)
        {
            if ($current->next == null) return null; //Nie znalazl elementu
            else
            {
                $previous = $current;     // Przechodzimy do następnego elementu
                $current = $current->next;
            }
        }
		
		//Mam już element. Teraz zacznę go usuwać
		
		if ($previous == null)  // jeżeli jest to pierwszy element...
        {
            $this->first = $this->first->next; // ...zmieniamy pole first
        }
        else                  // jeżeli nie jest to pierwszy
        {
            $previous->next = $current->next;   // Usuwamy aktualny element przez jego pominiecie
        }

        return $current; //Zwracamy usuniety element
	}
	
	
	function deleteIndex($index){	//Usuwa element listy o podanym indexie  	(Zwraca usunięty obiekt)
		if($this->isEmpty()){
			return null;
		}
		
		
		$toReturn = $this->getIndex($index);
		
		
		if($index==0){
			$this->first=$this->getIndex($index)->next;
			return $toReturn;
		}
		
		if($index>0){
			$this->getIndex($index-1)->next=$this->getIndex($index)->next;
			return $toReturn;
		}
		
		return null;
	}
	
	
	function getElem($elem)     // Pobieranie elementu po jego zawartości
    {

        $current = $this->first;  // Rozpoczynamy od pierwszego elementu
        while ($current->value != $elem)
        {
            if ($current->next == null) return null;
            else
                $current = $current->next;
        }
		return $current;

    }
	
	function getIndex($index)     // Pobieranie elementu po jego indexie      element FIRST to index 0!         Jeśli podany index nie istnieje: zwracam NULL
    {
		if($this->first==null) return null;
        $current = $this->first;  // Rozpoczynamy od pierwszego elementu
        
		for($i=0; $i<$index;$i++){
			if($current->next==null) return null;
			$current = $current->next;
		}
		return $current;

    }
	
	function editValue($index,$newValue)  //Metoda do zmiany wartości elementu listy
	{
		$this->getIndex($index)->value = $newValue;
    }
	
	
	function printList()   //Print list służy do wypisywania listy (w celach testowych :D)
    {
		$current = $this->first;
        while ($current!=null)      // Dopóki nie koniec listy...
        {
            echo $current->value." ";
			$current=$current->next;
        }
    }
	
	function size(){   //Zwraca ilość elementów/obiektów w danej liście
		$elems=0;
		if($this->first==null) return 0;
		
		$current = $this->first;
        while ($current!=null)      // Dopóki nie koniec listy...
        {
            $elems++;
			$current=$current->next;
        }
		
		return $elems;
		
	}
	
	
	function iterPrint(){  //Iteruje liste w celu wywołania metody printData() dla każdej danej
		for($nr=0; $nr<$this->size();$nr++){
			$this->getIndex($nr)->printData();
		}
	}
	
	
	
}

//===================================================================

class HashSet{  //Obiekt stworzony testowo dla Hash Listy

	private $rootList;   //Główna lista Hash Listy
	
	function __construct(){
		$this->rootList = null;
	}
	
	function rootList($list){
		$this->rootList=$list;      
	}
	 
	function addSubListElem($supList,$supElem,$subElem){           //Dodaje Element do SubListy (Danych zawartych w obiekcie Listy)   (Element znajduje po wartości)
		if($supList->getElem($supElem)->data==null) $supList->getElem($supElem)->data=new LinkedList();
		$supList->getElem($supElem)->data->insertLast($subElem);
	}
	
	function addSubListIndex($supElem,$subElem){           			//Dodaje Element do SubListy (Danych zawartych w obiekcie Listy) 	  (Element znajduje po indexie)
		if($supElem->data==null) $supElem->data=new LinkedList();
		$supElem->data->insertLast($subElem);
	}
	
	
	
	function sortList($supList, $minMax){    //Funkcja sortowania oparta na Bubble Sort
		
		$sizeList = $supList->size();	
		
		for($x=0; $x < $sizeList-1; $x++){
			
			for($y=0; $y < $sizeList-1; $y++) 		//true - od Min do Max             false - od Max do Min
			{
					if($minMax){
						if($supList->getIndex($x)->value > $supList->getIndex($x+1)->value) 
						{
							$this->swap($supList,$x,($x+1));
						}
					}
					
					if(!$minMax){
						if($supList->getIndex($x)->value < $supList->getIndex($x+1)->value)  
						{
							$this->swap($supList,$x,($x+1));
						}
					}
			}
		
		}
	}
	
	
	function swap($supList,$index1,$index2){         //Metoda zmienia dwuch sąsiadów
		
		//JEśli index1 wskazuje na zmienną first                   
		if($index1==0 && $index2==1){        //Będzie zamieniał tylko pierwszy z drugim
			$goToFirst = $supList->getIndex($index2);
			
			$supList->getIndex($index1)->next=$goToFirst->next;
			$goToFirst->next=$supList->getIndex($index1);
			
			$supList->setFirst($goToFirst);
		}
		
		
		if($index1>0){ 
			$index1Next=$supList->getIndex($index1)->next;
			$index2Next=$supList->getIndex($index2)->next;
			$index1_1Next=$supList->getIndex($index1-1)->next;
			
			$supList->getIndex($index2)->next=$index1_1Next;
			$supList->getIndex($index1)->next=$index2Next;
			$supList->getIndex($index1-1)->next=$index1Next;
		}
		
	}
	
	
	
	function moveTo($list,$indexToMove,$toList){    	//Metoda przenosi element listy do innej listy
		$movingObject=$list->getIndex($indexToMove);
		$list->deleteIndex($indexToMove);		
		$toList->insertLastObj($movingObject);
	}
	
	
	
}



///////////////////////////TO DO LIST////////////////////////////////
/*
	DODAWANIE								[V]
	EDYCJA										[V]
	USUWANIE									[V]
	SORTOWANIE								[V]
	PRZENOSZENIE WĘZŁÓW			[V]
	ROZWIJANIE STRUKTURY				[X]
	ZABEZPIECZENIA							[X]
	WYPISYWANIE                          	[V]
*/

?>	



<!DOCTYPE html>
<html>


<head>
<meta charset="utf-8"/>
<title></title>
<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" href="style.css" type="text/css" />	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>


<body>
	
	<?php 
	$list = new LinkedList();
	$list->insertFirst(3);
	$list->insertFirst(2);
	$list->insertFirst(9);
	
	
	
	
	//$list->printList(); 
	
	$hashSet = new HashSet();
	
	$hashSet->sortList($list,false);
	
	$hashSet->addSubListElem($list,2,4);
	$hashSet->addSubListElem($list,2,5);
	$hashSet->addSubListElem($list,2,8);
	
	$hashSet->addSubListElem($list,3,2);
	$hashSet->addSubListElem($list,3,42);
	
	$hashSet->addSubListElem($list,9,0);
	
	$hashSet->addSubListIndex($list->getIndex(0),10);
	$hashSet->addSubListIndex($list->getIndex(0),14);
	$hashSet->addSubListIndex($list->getIndex(0),5);
	
	$hashSet->addSubListIndex($list->getIndex(0)->data->getIndex(1),1);
	$hashSet->addSubListIndex($list->getIndex(0)->data->getIndex(1),2);
	$hashSet->addSubListIndex($list->getIndex(0)->data->getIndex(1),3);
	
	
	$hashSet->addSubListIndex($list->getIndex(0)->data->getIndex(1)->data->getIndex(2),100);
	$hashSet->addSubListIndex($list->getIndex(0)->data->getIndex(1)->data->getIndex(2),200);
	
	//$list->getElem(2)->data->printList();
	
	//echo $list->size(); 
	
	
	
	
	$list->iterPrint();	
	
	
	echo "<br><br><br><br><br><br><br><br><br><br>";
	echo "<b><big>[Przenoszę element 9->10->1 do Sub listy 9->10->3]  [Usuwam element 3 z listy głównej] [Usuwam elementy 2->4 i 2->8]</big></b>";
	echo "<br><br><br><br>";
	
	$list->deleteIndex(1);	
	
	$list->getIndex(1)->data->deleteElem(4);	
	$list->getIndex(1)->data->deleteElem(8);	
	
	$hashSet->moveTo($list->getIndex(0)->data->getIndex(1)->data  , 0 ,   $list->getIndex(0)->data->getIndex(1)->data->getIndex(2)->data);
	$list->iterPrint();
	?>
	
</body>


</html>