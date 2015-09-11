<?php
include "functions.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Boarding School</title>
    <style>
    @font-face{
        font-family: CenturyGothic;
        src: url('GOTHIC');
    }
    body{
        width: 100%;
        height: auto;
        font-weight: bold;
        margin: 0;
        padding: 0;
        background-image: url('background.jpg');
        background-size: 1500px 1500px;
        background-repeat: no-repeat;
        color: white;
        font-family: CenturyGothic, GOTHIC, "Century Gothic", CenturyGothic, AppleGothic, sans-serif;
        font-weight: lighter;
    }
    .header{
        overflow: auto;
        width: 100%;
        position: relative;
        height: 15%;
        background-color: rgba(0,0,0,0.9);
        font-size: 45px;
    }
    .header div{
        float: left;
    }
    .header .title{
        margin-bottom: 10px;
        margin-top: 25px;
        margin-left: 10px;
    }
    .header .logo{
        margin-bottom: 15px;
        margin-top: 25px;
        margin-left: 15px;
        margin-right: 15px;
    }
    .content{
        height: 80%;
        width: 53%;
        float: left;
        margin-left: 3%;
        margin-top: 3%;
    }

    .content .fbs{
        padding: 3%;
        margin-bottom: 3%;
        background-color: rgba(0,0,0,0.7);
    }

    .content .fbs .facebook{
        font-size: 30px;
        margin-bottom: 20px;
    }

    .content .fbs .fb{
        font-size: 30px;
        margin-bottom: 2%;
    }

    .content .fbs .fb .date{
        margin-bottom: 2%;
        font-size: 20px;
    }

    .content .fbs .fb .desc{
        font-size: 23px;
        line-height: 130%;
    }

    .content .whiteboard{
        padding: 3%;
        background-color: rgba(0,0,0,0.7);
        margin-bottom: 2%;
    }

    .content .whiteboard .head{
        font-size: 35px;
    }

    .sidebar{
        height: 80%;
        width: 35%;
        float: right;
        padding: 3%;
    }
    .weather{
        margin-bottom: 5%;
        height: 20%;
        background-color: rgba(0,0,0,0.7);
        overflow: auto;
        padding-top: 2%;
        padding-bottom: 2%;
    }
    .weather .left{
        float: left;
        width: 35%;
        margin-right: 5%;
        margin-left: 3%;
    }
    .weather .left .degree{
        margin-left: 3%;
        font-size: 70px;
    }
    .weather .left .icons{

    }
    .weather .icons img{
        margin: 10px;
        margin-top: 25px;
        margin-bottom: 15px;
    }
    .weather .left .location{
        margin-left: 5%;
        margin-bottom: 2%;
        font-size: 25px;
    }
    .news{
        height:auto;
        background-color: rgba(0,0,0,0.7);
    }
    .news .item{
        padding: 2%;
    }
    .news .item .title{
        font-size: 25px;
        text-decoration: underline;
    }
    .news .item .desc{
        font-size: 15px;
    }
    .time{
        font-size: 30px;
        padding: 5%;
    }

    .whiteboard .activities .title {
        font-size: 25px;
    }

    .whiteboard .news .desc {
        font-size: 30px;
        color: red;
    }

    </style>
</head>
<body>
    <div class="header">
        <div class="logo"><img src="boarding.png" width="45"></img></div>
        <div class="title">Diocesan Boys' School Boarding School</div>
    </div>
    <div class="content">
        <div class="fbs" id="fbs">
            <div class="fb">
                Staff who is now onduty:</br>
                <?php
                staffdutylist();
                ?>
            </div>
        </div>
        <div class="whiteboard">
            <div class="head">White Board</div>
        </br>
        <div class="activities">
            <div class="title">
                Activity list.
            </div>
        </div>
    </div>
</div>
<div class="sidebar">
    <div class="weather">
        <div class="left">
            <div class="degree" id="degree">
            </div>
            <div class="location">
                Kowloon City
            </div>
        </div>
        <div class="icons" id="icons">
        </div>
    </div>
    <div class="news" id="news"></div>
</div>
</body>
<script>
function ajax(url, method){
    if(typeof(method)==='undefined') method = 'GET';
    var xhr = new XMLHttpRequest();
    if ("withCredentials" in xhr){
        xhr.open(method, url, true);
    } else if (XDomainRequest){
        xhr = new XDomainRequest();
        xhr.open(method, url);
    } else {
        xhr = null;
    }
    return xhr;
}

function reload(){
    var tunnel = ajax('content.php');
    if (tunnel){
        tunnel.onload = function(){
            //console.log(tunnel.responseText);
            var json = JSON.parse(tunnel.responseText);
            console.log(json);
            $('news').innerHTML = json['news'];
            $('icons').innerHTML = json['warning'];
            $('degree').innerHTML = json['weather'] + '&deg;<font size="60">C</font>';
            eval(json['script']);

            var fb = '<div class="facebook">Announcement on Official Website</div>';
            console.log(json['fb']);
            for (var i=0; i<2; i++){
                fb += '<div class="fb">';
                fb += '<div class="date">' + json['fb']['data'][i]['created_time'] + '</div>';
                fb += '<div class="desc">' + json['fb']['data'][i]['description'] + '</div>';
                //fb += '<div class="desc">' + json['fb'] + '</div>';
                fb += '</div><hr />';
            }

            $('fbs').innerHTML = fb;


        };
        tunnel.setRequestHeader("charset", "utf8");
        tunnel.send();
    }
}

var $ = function(id) {return document.getElementById(id);};

reload();

setInterval(reload,30000);

</script>
</html>
