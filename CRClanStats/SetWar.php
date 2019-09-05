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
try{ $war = @$api->getWar([$clanID]);
//d($clan); //This display the array with Player objects
/*
$dataSet = array ( "WarId"=> 0,
                   "Tag"=>"",
                  result => array("CollPlayed"=>0,
                                  "CollWin"=>0,
                                  "WarDayPlayed"=>"0",
                                  "WarDayWin"=>0,
                                  "Name"=>"",
                                  "CollEndTime"=>0,
                                  "WarEndTime"=>0));
*/
//echo( $war );
$war_php = json_decode($war);
  
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




    //var_dump($war);


if ($war_php->{"state"} == "collectionDay"){
    
    foreach( $war_php->{"participants"} as $war ){


        $sql = "SELECT * FROM `war` WHERE Tag = '"
                .$war->{"tag"}.
                "' AND CollEndTime ='" . 
                date("Y-m-d H:i:s", $war_php->{"collectionEndTime"})."'";
                $found = false;
                foreach( $conn->query($sql) as $row ){
                    
                    if ($row["Tag"] == $war->{"tag"}){
                       
                        
                       $found = true; 
                       //Eintrag vorhanden, muss geupdatet werden
                       $sql_change = "UPDATE war SET CollPlayed = ".
                           $war->{"collectionDayBattlesPlayed"}.
                           " ,CollWin = ".$war->{"wins"}.
                           " WHERE WarId = ".$row["WarId"] . 
                           " AND Tag = '".$war->{"tag"}."'";
                           echo $sql_change;
                           $conn->prepare($sql_change)->execute();
                           
                    }
                }
                if ($found == false){
                    //Eintrag existiert noch nicht, muss angelegt werden
                    $sql_change = "INSERT INTO war (Tag, CollPlayed, CollWin, Name, CollEndTime) VALUES ('".
                        $war->{"tag"}."',".
                        $war->{"collectionDayBattlesPlayed"}.",". 
                        $war->{"wins"}.",'".
                        $war->{"name"}. "','" .
                            date("Y-m-d H:i:s", $war_php->{"collectionEndTime"}). "')";
                        echo $sql_change;
                        $conn->prepare($sql_change)->execute();
                }
    }
}elseif ("warDay"){
    
    
    foreach( $war_php->{"participants"} as $war ){
        $sql = "SELECT * FROM `war` WHERE Tag = '"
            .$war->{"tag"}.
            "' AND CollEndTime IN (SELECT max(CollEndTime) FROM `war` where Tag = '" .$war->{"tag"}."')";
            $found = false;
            foreach( $conn->query($sql) as $row ){
                if ($row["Tag"] == $war->{"tag"}){
                    $found = true;
                    //Eintrag vorhanden, muss geupdatet werden
                    $sql_change = "UPDATE war SET WarDayPlayed = ".
                        $war->{"battlesPlayed"}.
                        " ,WarDayWin = ".$war->{"wins"}.
                        " ,WarEndTime = '".date("Y-m-d H:i:s", $war_php->{"warEndTime"})."'".
                        " where WarId = ".$row["WarId"] .
                        " AND Tag = '".$war->{"tag"}."'";
                        $conn->prepare($sql_change)->execute();
                }
            }
            if ($found == false){
                //Wenn im War Day angekommen, sollte Datensatz immer Bestehen.
               // Auch neue User joinen der Clan War erst in der nächsten CollectionPhase
            }

    }

        
    }
  

}




catch(PDOException $e)
{
    echo $e;
    
}

catch(Exception $e){
};

?>