<?php
	
	header("charset=utf-8");
	error_reporting(0);
	function getWeb($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
	}

	$news = getWeb("http://hk.news.yahoo.com/rss/hong-kong");
	$news = simplexml_load_string($news);
	
	
	//$warning = getWeb("http://web.archive.org/web/20131128095039/http://www.hko.gov.hk/wxinfo/dailywx/wxwarntoday.htm");
	$warning = getWeb("http://www.hko.gov.hk/wxinfo/dailywx/wxwarntoday.htm");
	$warning = str_replace("explaine.issuing.gif", "", $warning);	
	preg_match_all('/images_e\/(.*)\.issuing\.gif/', $warning, $warning);
	
	//print_r($warning[0]);
	
	$weather = getWeb("http://www.hko.gov.hk/wxinfo/currwx/current.htm");
	
	//print_r($weather);
		
	$weather = strstr($weather, '<SPAN style="float:left; width:30ex; text-align:left">Kowloon City</SPAN>');
	$weather = strip_tags($weather, '');
	$weather = strstr($weather, '&nbsp;degrees;', true);
	$weather = str_replace('Kowloon City', '', $weather);
	
	//$fbtoken = getWeb("https://graph.facebook.com/oauth/access_token?client_id=205995266259118&client_secret=8e87fcf3ac96639c0e14017f98af0792&grant_type=client_credentials");
	$fbtoken = file_get_contents("https://graph.facebook.com/oauth/access_token?client_id=205995266259118&client_secret=8e87fcf3ac96639c0e14017f98af0792&grant_type=client_credentials");
	$fb = file_get_contents("https://graph.facebook.com/dbsboarding/posts?fields=picture,description&limit=30&".$fbtoken);
	//echo $fb;
	$fb = json_decode($fb);
	
	//echo $fb;
	//print_r($fb);

	foreach ($fb->data as $key => $item) {
		if (empty($item->description) || empty($item->created_time)){
			unset($fb->data[$key]);
		} else {
			$item->created_time = date('Y-m-d H:i',strtotime($item->created_time));
		}
	}
	
	$fb->data = array_values($fb->data);
	
	$json['fb'] = $fb;
	
	if (count($warning[0]) == 0){
 		$json['warning'] =  '<div class="time" id="time">Good Day</div>';
 		$json['script'] =  'function checkTime(a){10>a&&(a="0"+a);return a}function startTime(){var a=new Date,c=a.getHours(),b=a.getMinutes(),a=a.getSeconds(),b=checkTime(b),a=checkTime(a);document.getElementById("time").innerHTML=c+":"+b+":"+a;t=setTimeout(function(){startTime()},500)}startTime();';
 	}else{
 		foreach($warning[0] as &$icon){
 			$json['warning'] .= '<img src="http://www.hko.gov.hk/wxinfo/dailywx/'.$icon.'" width="50"></img>';
 		}
 	}

	$json['weather'] = (int)$weather;	
	
	for ($i=0; $i<=3; $i++){
 		$json['news'] .= '<div class="item">';
 		$json['news'] .=  '<div class="title">';
		$json['news'] .=  $news->channel->item[$i]->title;
		$json['news'] .=  '</div>';
		$json['news'] .=  '<div class="pubDate">';
		$json['news'] .=  date('Y-m-d H:i',strtotime($news->channel->item[$i]->pubDate));
		$json['news'] .=  '</div>';
		$json['news'] .=  '<div class="desc">';
		$json['news'] .=  strip_tags($news->channel->item[$i]->description, '');
		$json['news'] .=  '</div>';
		$json['news'] .=  '</div>';
	}
	
	$output = json_encode($json);
	
	echo $output;
?>