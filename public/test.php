<?php 
    /**
    * 
    */
    class ClassName 
    {   
    	public $name;
    	public $age;
    	public $action;
    	
    	function __construct($name,$age)
    	{
    		
    		$this->name = $name;
            $this->age = $age;
    	}
    	function age() {
    		echo "ten toi la".$this->name ;
    		echo "</br> toi ".$this->age."tuoi </br>";
    	  
    	}
    	function __destruct(){
    		echo "end ";
    	}

    }
     $A = new ClassName('Dich','23');
    $A->age();


?>