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
try{ $clan = @$api->getClan([$clanId]);
//d($clan); //This display the array with Player objects





try {
    
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
//-----------------------------------------
//Lesen des Feldes "Dabei seit"
    
    $clan_php = json_decode($clan);
    $members_php = $clan_php->{"members"};
    
    $sql = "SELECT Tag , MIN(timestamp) as timestamp FROM `members` GROUP BY Tag";
    
    foreach( $conn->query($sql) as $row ){
        foreach( $members_php as $members ){
            if ($row["Tag"] == $members->{"tag"})
                $members->{"since"} = $row["timestamp"];
        }
        
    }
   
    //-----------------------------------------
    //Lesen des Feldes "Spenden Vorwoche"
    
    //Gibt immer den SQL-Timestanp des Sonntag 18:00 vor X-Wochen zurueck
    function getDueDate($noWeeksBack){
        $datetoday = new DateTime(date("Y-m-d H:i:s"));
        $datetoday->modify("-".$noWeeksBack." week");
        
        $datetoday->modify("+". ($end_of_period_day - $datetoday->format("N")) ." days");
            
        return $datetoday->format("Y-m-d") . $end_of_period_time;
    };
    
    
    
    $sql2 = "SELECT m.Tag , (SELECT Donations from `members` WHERE Tag = m.Tag AND Timestamp = max(m.Timestamp) ) as Donations, max(m.Timestamp) FROM `members` AS m where m.Timestamp < DATE_FORMAT('".getDueDate(1)."','%Y-%m-%d %H:%i:%s') GROUP BY Tag";
    $y = false;
    
    foreach( $conn->query($sql2) as $row ){
        $x = false;
        foreach( $members_php as $members ){
            if ($row["Tag"] == $members->{"tag"})
                $members->{"donlastweek"} = $row["Donations"];
                $x = true;
        }
        if ($x = false){
            $members->{"donlastweek"} = 9999999;
        }
        $y = true;
    }
    if ($y == false){
        foreach( $members_php as $members ){
                $members->{"donlastweek"} = 0;
        
    };
    }
    
    $sql3 = "SELECT m.Tag , (SELECT Donations from `members` WHERE Tag = m.Tag AND Timestamp = max(m.Timestamp) ) as Donations, max(m.Timestamp) FROM `members` AS m where m.Timestamp < DATE_FORMAT('".getDueDate(2)."','%Y-%m-%d %H:%i:%s') GROUP BY Tag";
    $y = false;
    
    foreach( $conn->query($sql3) as $row ){
        $x = false;
        foreach( $members_php as $members ){
            if ($row["Tag"] == $members->{"tag"})
                $members->{"don2week"} = $row["Donations"];
                $x = true;
        }
        if ($x = false){
            $members->{"don2week"} = 9999999;
        }
        $y = true;
    }
    if ($y == false){
        foreach( $members_php as $members ){
            $members->{"don2week"} = 0;
            
        }
    }
        
        $sql4 = "SELECT m.Tag , (SELECT Donations from `members` WHERE Tag = m.Tag AND Timestamp = max(m.Timestamp) ) as Donations, max(m.Timestamp) FROM `members` AS m where m.Timestamp < DATE_FORMAT('".getDueDate(3)."','%Y-%m-%d %H:%i:%s') GROUP BY Tag";
        $y = false;
        
        foreach( $conn->query($sql4) as $row ){
            $x = false;
            foreach( $members_php as $members ){
                if ($row["Tag"] == $members->{"tag"})
                    $members->{"don3week"} = $row["Donations"];
                    $x = true;
            }
            if ($x = false){
                $members->{"don3week"} = 9999999;
            }
            $y = true;
        }
        if ($y == false){
            foreach( $members_php as $members ){
                $members->{"don3week"} = 0;
                
            }
        }
        
        
        $sql5 = "SELECT Tag , CollPlayed, WarDayPlayed FROM `war` where WarEndTime < DATE_FORMAT('".date("Y-m-d H:i:s")."','%Y-%m-%d %H:%i:%s') ORDER BY WarEndTime DESC";
        $result = array();
        $nr = 1;
        foreach( $conn->query($sql5) as $row ){
            $result[$nr] = $row;
            $nr += 1; 
        }
        foreach( $members_php as $members ){
            $nr = 1;
            foreach( $result as $row ){
            
                if ($row["Tag"] == $members->{"tag"}){
                    if($nr == 1){
                    $members->{"CW1"} = $row["CollPlayed"] . "/". $row["WarDayPlayed"] ;
                    }elseif ($nr == 2){
                        $members->{"CW2"} = $row["CollPlayed"] . "/". $row["WarDayPlayed"] ;                        
                    }elseif ($nr == 3){
                        $members->{"CW3"} = $row["CollPlayed"] . "/". $row["WarDayPlayed"] ;                        
                    }
                    
                    $nr += 1;
                }
            }
            if ($nr == 1){
                $members->{"CW1"} = $members->{"CW2"}= $members->{"CW3"}= "";
            }
        }
        
        foreach( $members_php as $members ){
            $members->{"lastseen"} = ( strtotime("now") - strtotime( $members->{"lastSeen"} ) ) / 60/60/24;
            $members->{"lastseen"} = round($members->{"lastseen"},1);
            

            $members->{"color"} = define_line_color($members);
        }
        
       
    
    $myArray = array("members" => $members_php);
    echo json_encode($myArray);
     }

catch(PDOException $e)
{
    echo $e;
    
}
;











//echo $clan;
}
catch(Exception $e){
 //   d($e);
};
?>