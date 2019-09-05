<?php 

include "config.php";


    
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


echo "ID;Spieler Tag;Sammelphase gespielt;Sammelphase gewonnen;Kriegstag gespielt;Kriegstag gewonnen,Spielername;Ende Sammelphase;Ende Kriegsphase".PHP_EOL; 

try{
        $sql = "SELECT * FROM `war`";
                $found = false;
               // foreach( $conn->query($sql) as $row ){
                
                    $result = $conn->query($sql);
                    
                    $resp = array();
                           
while( $entry =  $result->fetch(PDO::FETCH_NUM) ) {
    $row = array();
    
    foreach ($entry as $key => $value) {
        array_push($row, $value);
        
        
    }
    array_push($resp, implode(';', $row));
}
echo implode(PHP_EOL, $resp);
             
             
          
}

catch(PDOException $e)
{
    echo $e;
    
}

catch(Exception $e){
 //   d($e);
};

?>