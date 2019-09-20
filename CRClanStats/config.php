<?php
$token = "";
$clanId = "";


//Database
$dbname = "";
$servername = "localhost";
$username = "";
$password = "";


//The 3 Fields "Donations last Week", "Donations 2 Weeks ago" and "Donations 3 Weeks ago"
// The following two variables decide when the end of any week is defined. Make shure that 
// this is before the reset of the donation, also aknowlidging, that the cronjob is normally called something like all 1/2 hour 
$end_of_period_time = " 18:00:00";
$end_of_period_day = 7;


//You can here define there of coloring. These our our clans kicking rules, therefore I only have to see for the red players 
//and kick them directly 
function define_line_color($members){
  
    //First check the availability of all relevant values. Missing value will lead to no color
    if (isset($members->{"since"}) && isset($members->{"donlastweek"}) && isset($members->{"lastseen"})){
        //all players will be marked red, which have less than 100 donations last week (because we kick at the week after) 
        //or which are offline longer than 5 days, both is only accountable, when the player is longer than a week within the clan
        if ( ( $members->{"donlastweek"} < 100 or $members->{"lastseen"} > "5"  )
        && $members->{"since"} <= getDueDate(1)
        ){
            return 'Error';
            
        }else{
            return 'Success';
        }
    }
};

?>