<?php

date_default_timezone_set("Asia/Hong_Kong");
$weekday = date("l");
$hour = date("H");
$min = date("i");
//Global variables
function staffdutylist() {
    //Variables for making the switch.
    $weekday = date("l");
    $hour = date("H");
    $min = date("i");
    //Global variable != functon variable.
    switch ($weekday) {
        case "Sunday":
        if (($hour > 6) && ($hour <= 15)) {
            echo "Mr. J. Liong";
        } elseif (($hour >= 18) && ($hour <= 20)) {
            echo "Mr. M. Ball / Mr. W. Monk";
        } elseif ($hour >= 21) {
            echo "Rev'd Robertson / Mr. K. Lau / Ms. D. Lam";
        } else {
            echo "No Staff is now onduty :'(";
        }
        break;

        case "Monday":
        if (($hour > 6) && ($hour < 15)) {
            echo "Rev'd Robertson, Ms. D. Lam";
        } elseif (($hour >= 15) && ($hour < 23)) {
            echo "Mr. K. Lau, Mr. M. Ball, Mr. W. Monk";
        } else {
            echo "No Staff is now onduty :'(";
        }
        break;

        case "Tuesday":
        if (($hour > 6) && ($hour < 15)) {
            echo "Rev'd Robertson, Mr. W. Monk";
        } elseif (($hour >= 15) && ($hour < 19)) {
            echo "Ms. D. Lam, Mr. M. Ball";
        } elseif (($hour >= 19) && ($hour < 23)) {
            echo "Ms. D. Lam, Mr. M. Ball, Mr. J. Liong";
        } else {
            echo "No Staff is now onduty :'(";
        }
        break;

        case "Wednesday":
        if (($hour > 6) && ($hour < 15)) {
            echo "Rev'd Robertson, Mr. K. Lau";
        } elseif (($hour >= 15) && ($hour < 23)) {
            echo "Ms. D. Lam, Mr. M. Ball";
        } elseif (($hour >= 19) && ($hour < 23)) {
            echo "Ms. D. Lam, Mr. M. Ball, Mr. J. Liong";
        } else {
            echo "No Staff is now onduty :'(";
        }
        break;

        case "Thursday":
        if (($hour > 6) && ($hour < 15)) {
            echo "Rev'd Robertson, Mr. M. Ball";
        } elseif (($hour >= 15) && ($hour < 23)) {
            echo "Mr. K. Lau, Ms. D. Lam, Mr. W. Monk";
        } else {
            echo "No Staff is now onduty :'(";
        }
        break;

        case "Friday":
        if (($hour > 6) && ($hour < 15)) {
            echo "Mr. K. Lau, Ms. D. Lam";
        } elseif (($hour >= 15) && ($hour < 23)) {
            echo "Mr. J. Liong / Mr. W. Monk";
        } else {
            echo "No Staff is now onduty :'(";
        }
        break;

        case "Saturday":
        if (($hour > 6) && ($hour < 15)) {
            echo "Mr. W. Monk / Mr. M. Ball";
        } elseif (($hour >= 15) && ($hour < 23)) {
            echo "Mr. M. Ball / Mr. W. Monk";
        } else {
            echo "No Staff is now onduty :'(";
        }
        break;

        default:
        echo "No staff is onduty now :(";
        break;
    }
}
?>
