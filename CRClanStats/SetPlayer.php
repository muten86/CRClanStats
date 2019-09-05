<?php 
use CR\Api;
require 'vendor/autoload.php';
/**
 * Return all the information about the given users tag
 * @method getPlayer
 * @param  array     $player          Array with the id of the profiles
 * @param  array     $keys            Array with the exact parameters to request
 * @param  array     $exclude         Array with the exact parameters to exclude in the request
 * @return Player[]                   Array of Player Objects if given more than one profile, else return one Player Object
 */
include "config.php";

 $api = @new Api($token);
try{ $clan = @$api->getClan([$clanID]);
//d($clan); //This display the array with Player objects
$content = json_decode($clan, true);
$members = $content["members"];
//$player = $members[1];
//$member = $members[1];
//var_dump($members[1]);
}

catch(Exception $e){
    //   d($e);
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    
    $sql = "INSERT INTO members ( Rank, Name, Tag, Donations, Trophies, Role, ExpLevel) VALUES ";
    $counter = 1;
    foreach($members as $member) {
        if ($counter > 1){
            $sql .= ",";
        }
    
        $sql .= "( " .
                    $member["rank"] . ",'" .
                    $member["name"]  ."','" . 
                    $member["tag"] ."'," . 
                    $member["donations"]  ."," . 
                    $member["trophies"] .",'" . 
                    $member["role"]."'," . 
                    $member["expLevel"]  .
                                        ") ";
        
                    $counter += 1;
    };
    //echo $sql;
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully";
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();


}
;
?>