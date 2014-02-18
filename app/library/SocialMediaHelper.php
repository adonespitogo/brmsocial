<?php

class SocialMediaHelper{
    
public static function checkUrlExists($url){
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_NOBODY, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8');
	curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
	if(substr($url, 0, 8)=='https://'){
		curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	}
	$data = curl_exec($ch); 
	$info = curl_getinfo($ch); 
	$code = $info['http_code']; 
	return ($code==200);
}

public static function checkAccountExists($service_alias, $service_flavor_alias, $email, $url, $username = '', $password = ''){
	$tempUrl = $url;
	if($service_alias=='twitter' && ($service_flavor_alias=='followers' || $service_flavor_alias=='followers-wopw')) $tempUrl = 'https://twitter.com/'.$username;
	return self::checkUrlExists($tempUrl);
}

// return an array('count'=>55, 'is_error'=>false, 'comment'=>'OK')
// return an array('count'=>0, 'is_error'=>true, 'comment'=>'Unable to get count.')
// return an array('count'=>0, 'is_error'=>true, 'comment'=>'Over the request quota')
public static function getCount($service_alias, $service_flavor_alias, $email, $url, $username, $password=''){
	// dd($service_alias);
	$service_alias = str_replace('_', '-', $service_alias);
	$service_flavor_alias = str_replace('_', '-', $service_flavor_alias);

	if(substr($url,0,4)!='http') $url = 'http://'.$url; 

	// if(!self::checkAccountExists($service_alias, $service_flavor_alias, $email, $url, $username, $password)) return array('count'=>0, 'is_error'=>true, 'comment'=>'Account not exist.');
	// dd($service_alias);
	switch($service_alias){
		case 'googleplus':
			return array('count'=>1, 'is_error'=>false, 'comment'=>'OK');
		case 'vine':
			return array('count'=>1, 'is_error'=>false, 'comment'=>'OK');
		case 'instagram':
			return array('count'=>1, 'is_error'=>false, 'comment'=>'OK');
		case 'twitter':
			switch($service_flavor_alias){
				case 'followers': return self::getTwitterFollowers($email, $url, $username, $password);
				case 'retweets': return self::getTwitterRetweets($email, $url, $username, $password);
			}
		case 'youtube':
			switch($service_flavor_alias){
				case 'views': 
				case 'usa-views':
                case 'high-retention-views':
                case 'regular-views':
				case 'express-views': return self::getYoutubeViews($email, $url, $username, $password);
				case 'likes': return self::getYoutubeLikes($email, $url, $username, $password);
				case 'subscribers': return self::getYoutubeSubscribers($email, $url, $username, $password);
				case 'comments': return self::getYoutubeComments($email, $url, $username, $password);
			}
		case 'vimeo':
			switch($service_flavor_alias){
				case 'regular-views': 
				case 'express-views': return self::getVimeoViews($email, $url, $username, $password);
			}
		case 'soundcloud':
			switch($service_flavor_alias){
				case 'regular-plays': 
				case 'express-plays': return self::getSoundCloudPlays($email, $url, $username, $password);
				case 'downloads': return self::getSoundCloudDownloads($email, $url, $username, $password);
				case 'followers': return array('count'=>1, 'is_error'=>false, 'comment'=>'OK');
				case 'comments': return array('count'=>1, 'is_error'=>false, 'comment'=>'OK');
				case 'favorites': return array('count'=>1, 'is_error'=>false, 'comment'=>'OK');
			}
		case 'tumblr':
			return array('count'=>1, 'is_error'=>false, 'comment'=>'OK');
			// switch($service_flavor_alias){
			// 	case 'followers':
			// 		if(strpos($url, 'http://') === false)
			// 			$url = 'http://'.$url;
			// 		if(strpos($url, '.tumblr.com') === false)
			// 			$url = $url.'.tumblr.com';
			// 		return self::getTumblrFollowers($email, $url, $username, $password);
			// 	case 'reblogs': return array('count'=>1, 'is_error'=>false, 'comment'=>'OK');
			// }
			// return self::getTumblrFollowers($email, $url, $username, $password);
		case 'pinterest':
			switch($service_flavor_alias){
				case 'followers': return self::getPinterestFollowers($email, $url, $username, $password);
				case 'likes': return self::getPinterestLikes($email, $url, $username, $password);
				case 'repins': return self::getPinterestRepins($email, $url, $username, $password);
			}
		case 'facebook':
			return self::getFacebookLikes($email, $url, $username, $password);	
		
		case 'reverbnation':
			switch($service_flavor_alias){
				case 'song-plays': return self::getReverbnationSongPlays($email, $url, $username, $password);
				case 'video-plays': return self::getReverbnationVideoPlays($email, $url, $username, $password);
			}	

		case 'datpiff':
			switch($service_flavor_alias){
				case 'streams': return self::getDatPiffStreams($url);
			}
	}
	return array('count'=>1, 'is_error'=>true, 'comment'=>'No service flavor available.');
}
 
public static function getReverbnationSongPlays($email, $url, $username, $password){
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8');
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY); 
	$temp = curl_exec($ch);
	curl_close($ch);

	$temp = str_replace("\r", '', $temp);
	$temp = str_replace("\n", '', $temp);
	$temp = str_replace(',', '', $temp);
	$temp = str_replace(' ', '', $temp);

	preg_match('/class=\"stat_name\">SongPlays<\/span><spanclass=\"stat_count\">([0-9]+)/', $temp, $matches);
	
	if(isset($matches[1])){
		if(!is_numeric($matches[1])) return array('count'=>1, 'is_error'=>true, 'comment'=>'Count is not a number.');
		if(is_numeric($matches[1]) && $matches[1] == 0) return array('count'=>1, 'is_error'=>false, 'comment'=>'OK');

		return array('count'=>$matches[1], 'is_error'=>false, 'comment'=>'OK');
		
	}
	return array('count'=>1, 'is_error'=>true, 'comment'=>'Unable to get count.');
}

public static function getReverbnationVideoPlays($email, $url, $username, $password){
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8');
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY); 
	$temp = curl_exec($ch);
	curl_close($ch);

	$temp = str_replace("\r", '', $temp);
	$temp = str_replace("\n", '', $temp);
	$temp = str_replace(',', '', $temp);
	$temp = str_replace(' ', '', $temp);

	preg_match('/class=\"stat_name\">VideoPlays<\/span><spanclass=\"stat_count\">([0-9]+)/', $temp, $matches);
	
	if(isset($matches[1])){
		if(!is_numeric($matches[1])) return array('count'=>1, 'is_error'=>true, 'comment'=>'Count is not a number.');
		if(is_numeric($matches[1]) && $matches[1] == 0) return array('count'=>1, 'is_error'=>false, 'comment'=>'OK');
		return array('count'=>$matches[1], 'is_error'=>false, 'comment'=>'OK');
	}
	return array('count'=>1, 'is_error'=>true, 'comment'=>'Unable to get count.');
}
 
public static function getDatPiffStreams($url){
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8');
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY); 
	$temp = curl_exec($ch);
	curl_close($ch);

	$temp = str_replace("\r", '', $temp);
	$temp = str_replace("\n", '', $temp);
	$temp = str_replace(',', '', $temp);
	$temp = str_replace(' ', '', $temp);

	preg_match('/<divclass=\"numberstreams\">([0-9]+)/', $temp, $matches);
	
	if(isset($matches[1])){
		if(!is_numeric($matches[1])) return array('count'=>1, 'is_error'=>true, 'comment'=>'Count is not a number.');
		if(is_numeric($matches[1]) && $matches[1] == 0) return array('count'=>1, 'is_error'=>false, 'comment'=>'OK');
		return array('count'=>$matches[1], 'is_error'=>false, 'comment'=>'OK');
	}
	return array('count'=>1, 'is_error'=>true, 'comment'=>'Unable to get count.');
}
public static function getDatPiffViews($url){
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8');
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY); 
	$temp = curl_exec($ch);
	curl_close($ch);

	$temp = str_replace("\r", '', $temp);
	$temp = str_replace("\n", '', $temp);
	$temp = str_replace(',', '', $temp);
	$temp = str_replace(' ', '', $temp);

	preg_match('/<divclass=\"numberviews\">([0-9]+)/', $temp, $matches);
	
	if(isset($matches[1])){
		if(!is_numeric($matches[1])) return array('count'=>1, 'is_error'=>true, 'comment'=>'Count is not a number.');
		return array('count'=>$matches[1], 'is_error'=>false, 'comment'=>'OK');
	}
	return array('count'=>1, 'is_error'=>true, 'comment'=>'Unable to get count.');
}

public static function getTwitterFollowers($email = '', $url='', $username, $password=''){

	/*
	$mUrl = str_replace('http://', 'https://', $url);
	$mUrl = str_replace('www.twitter.com', 'twitter.com', $mUrl);
	$mUrl = str_replace('mobile.twitter.com', 'twitter.com', $mUrl);
	$mUrl = str_replace('twitter.com', 'mobile.twitter.com', $mUrl);
	*/
	
	
	$mUrl = 'https://mobile.twitter.com/'.$username;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $mUrl);
	curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8');
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY); 
	curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$temp = curl_exec($ch);
	curl_close($ch);

	$temp = str_replace("\r", '', $temp);
	$temp = str_replace("\n", '', $temp);
	$temp = str_replace(',', '', $temp);

	preg_match('/\/followers\">([\s]+)<div class=\"statnum\">([0-9]+)<\/div>/', $temp, $matches);
	
	if(isset($matches[2])){
		if(!is_numeric($matches[2])) return array('count'=>1, 'is_error'=>true, 'comment'=>'Count is not a number.');
		if(is_numeric($matches[2]) && $matches[2] == 0) return array('count'=>1, 'is_error'=>false, 'comment'=>'OK');
		return array('count'=>$matches[2], 'is_error'=>false, 'comment'=>'OK');
	}
	return array('count'=>1, 'is_error'=>true, 'comment'=>'Unable to get count.');
}

public static function getTwitterRetweets($email, $url, $username, $password){
	$url = str_replace('http://', 'https://', $url);
	$url = str_replace('www.twitter.com', 'twitter.com', $url);
	$url = str_replace('mobile.twitter.com', 'twitter.com', $url);
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8');
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY); 
	curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	$temp = curl_exec($ch);
	curl_close($ch);

	$temp = str_replace("\r", '', $temp);
	$temp = str_replace("\n", '', $temp);
	$temp = str_replace(' ', '', $temp);
	$temp = str_replace(',', '', $temp);

	preg_match('/class=\"request-retweeted-popup\"([^0-9]+)([0-9]+)/', $temp, $matches);
	
	if(isset($matches[2])){
		if(!is_numeric($matches[2])) return array('count'=>1, 'is_error'=>true, 'comment'=>'Count is not a number.');
                if(is_numeric($matches[2]) && $matches[2] == 0) return array('count'=>1, 'is_error'=>false, 'comment'=>'OK');
		return array('count'=>$matches[2], 'is_error'=>false, 'comment'=>'OK');
	}	

	return array('count'=>1, 'is_error'=>true, 'comment'=>'Unable to get count.');
}


public static function extractYoutubeId($url){
	$temp = explode('?', $url);
	if(!isset($temp[1])) return '--';
	parse_str($temp[1], $row);
	
	if(!isset($row['v'])) return '--';
	return trim($row['v']);
}
public static function extractYoutubeChannel($channelUrl){
	$url = str_replace('/user', '', $channelUrl);
	preg_match('/youtube.com\/([a-zA-Z0-9\-]*)/', $url, $matches);
	if(isset($matches[1])) return $matches[1];
	return '--';	
	
}
public static function getYoutubeViews($email, $url, $username, $password){
	$youtubeId = self::extractYoutubeId($url);
	$temp = json_decode(file_get_contents('http://gdata.youtube.com/feeds/api/videos/'.$youtubeId.'?v=2&alt=json'), true);
	if(isset($temp['entry']['yt$statistics']['viewCount'])){ 
		$temp['entry']['yt$statistics']['viewCount'] = str_replace(' ', '', $temp['entry']['yt$statistics']['viewCount']);
		$temp['entry']['yt$statistics']['viewCount'] = str_replace(',', '', $temp['entry']['yt$statistics']['viewCount']);
		if(!is_numeric($temp['entry']['yt$statistics']['viewCount'])) return array('count'=>1, 'is_error'=>true, 'comment'=>'Count is not a number.');
                if(is_numeric($temp['entry']['yt$statistics']['viewCount']) && $temp['entry']['yt$statistics']['viewCount'] == 0) return array('count'=>1, 'is_error'=>false, 'comment'=>'OK');
		return array('count'=>$temp['entry']['yt$statistics']['viewCount'], 'is_error'=>false, 'comment'=>'OK');
	}
	return array('count'=>1, 'is_error'=>true, 'comment'=>'Unable to get count.');
}
public static function getYoutubeLikes($email, $url, $username, $password){
	$youtubeId = self::extractYoutubeId($url);
	$temp = json_decode(file_get_contents('http://gdata.youtube.com/feeds/api/videos/'.$youtubeId.'?v=2&alt=json'), true);
	if(isset($temp['entry']['yt$rating']['numLikes'])){ 
		$temp['entry']['yt$rating']['numLikes'] = str_replace(' ', '', $temp['entry']['yt$rating']['numLikes']);
		$temp['entry']['yt$rating']['numLikes'] = str_replace(',', '', $temp['entry']['yt$rating']['numLikes']);	
		if(!is_numeric($temp['entry']['yt$rating']['numLikes'])) return array('count'=>1, 'is_error'=>true, 'comment'=>'Count is not a number.');
                if(is_numeric($temp['entry']['yt$rating']['numLikes']) && $temp['entry']['yt$rating']['numLikes'] == 0) return array('count'=>1, 'is_error'=>false, 'comment'=>'OK');
		return array('count'=>$temp['entry']['yt$rating']['numLikes'], 'is_error'=>false, 'comment'=>'OK');
	}	
	
	return array('count'=>1, 'is_error'=>true, 'comment'=>'Unable to get count.');
}
public static function getYoutubeSubscribers($email, $url, $username, $password){
	$youtubeId = self::extractYoutubeId($url);
	$temp = array();
	if($youtubeId!='--'){
		$temp = json_decode(file_get_contents('http://gdata.youtube.com/feeds/api/videos/'.$youtubeId.'?v=2&alt=json'), true);
		if(!isset($temp['entry']['author'][0]['yt$userId']['$t'])) return array('count'=>0, 'is_error'=>true, 'comment'=>'Unable to get channel in video url.');
		$channel = 'UC'.$temp['entry']['author'][0]['yt$userId']['$t'];
	}
	else{
		$channel = self::extractYoutubeChannel($url);
		if($channel=='--') return array('count'=>0, 'is_error'=>true, 'comment'=>'Unable to get channel id in channel url.');
	}
	if(!self::checkUrlExists('http://gdata.youtube.com/feeds/api/users/'.$channel.'?v=2&alt=json')) return array('count'=>0, 'is_error'=>true, 'comment'=>'Unable to get count.');
	$temp = json_decode(file_get_contents('http://gdata.youtube.com/feeds/api/users/'.$channel.'?v=2&alt=json'), true);
	if(isset($temp['entry']['yt$statistics']['subscriberCount'])){ 
		$temp['entry']['yt$statistics']['subscriberCount'] = str_replace(' ', '', $temp['entry']['yt$statistics']['subscriberCount']);
		$temp['entry']['yt$statistics']['subscriberCount'] = str_replace(',', '', $temp['entry']['yt$statistics']['subscriberCount']);		
		if(!is_numeric($temp['entry']['yt$statistics']['subscriberCount'])) return array('count'=>1, 'is_error'=>true, 'comment'=>'Count is not a number.');
                if(is_numeric($temp['entry']['yt$statistics']['subscriberCount']) && $temp['entry']['yt$statistics']['subscriberCount'] == 0) return array('count'=>1, 'is_error'=>false, 'comment'=>'OK');
		return array('count'=>$temp['entry']['yt$statistics']['subscriberCount'], 'is_error'=>false, 'comment'=>'OK');
	}	
	return array('count'=>1, 'is_error'=>true, 'comment'=>'Unable to get count.');
}
public static function getYoutubeComments($email, $url, $username, $password){
	$youtubeId = self::extractYoutubeId($url);
	$temp = json_decode(file_get_contents('http://gdata.youtube.com/feeds/api/videos/'.$youtubeId.'?v=2&alt=json'), true);	
	if(isset($temp['entry']['gd$comments']['gd$feedLink']['countHint'])){ 
		$temp['entry']['gd$comments']['gd$feedLink']['countHint'] = str_replace(' ', '', $temp['entry']['gd$comments']['gd$feedLink']['countHint']);
		$temp['entry']['gd$comments']['gd$feedLink']['countHint'] = str_replace(',', '', $temp['entry']['gd$comments']['gd$feedLink']['countHint']);		
		if(!is_numeric($temp['entry']['gd$comments']['gd$feedLink']['countHint'])) return array('count'=>1, 'is_error'=>true, 'comment'=>'Count is not a number.');
                if(is_numeric($temp['entry']['gd$comments']['gd$feedLink']['countHint']) && $temp['entry']['gd$comments']['gd$feedLink']['countHint'] == 0) return array('count'=>1, 'is_error'=>false, 'comment'=>'OK');
		return array('count'=>$temp['entry']['gd$comments']['gd$feedLink']['countHint'], 'is_error'=>false, 'comment'=>'OK');
	}	
	return array('count'=>1, 'is_error'=>true, 'comment'=>'Unable to get count.');
}
public static function extractVimeoId($url){
	$temp = explode('vimeo.com/', $url);
	if(!isset( $temp[1] )) return '--';
	$temp2 = explode('/', $temp[1]);
	if(!isset( $temp2[0] )) return '--';
	return $temp2[0];
}	
public static function getVimeoViews($email, $url, $username, $password){
	$vimeoId = self::extractVimeoId($url);
	$temp = json_decode(file_get_contents("http://vimeo.com/api/v2/video/$vimeoId.json"), true);
	if(isset($temp[0]['stats_number_of_plays'])){ 
		$temp[0]['stats_number_of_plays'] = str_replace(' ', '', $temp[0]['stats_number_of_plays']);
		$temp[0]['stats_number_of_plays'] = str_replace(',', '', $temp[0]['stats_number_of_plays']);	
		if(!is_numeric($temp[0]['stats_number_of_plays'])) return array('count'=>1, 'is_error'=>true, 'comment'=>'Count is not a number.');
		if(is_numeric($temp[0]['stats_number_of_plays']) && $temp[0]['stats_number_of_plays'] == 0) return array('count'=>1, 'is_error'=>false, 'comment'=>'OK');
		return array('count'=>$temp[0]['stats_number_of_plays'], 'is_error'=>false, 'comment'=>'OK');
	}	
	return array('count'=>1, 'is_error'=>true, 'comment'=>'Unable to get count.');
}
public static function getSoundCloudPlays($email, $url, $username, $password){
	$client_id = 'bde5d4aae57c9d649dad6f8dbab53a52';
	$track_url = $url;
	$url = 'http://api.soundcloud.com/resolve.json?url='.urlencode($track_url).'&client_id='.$client_id;
	$temp = json_decode(file_get_contents($url), true);
	if(isset($temp['playback_count'])){ 
		$temp['playback_count'] = str_replace(' ', '', $temp['playback_count']);
		$temp['playback_count'] = str_replace(',', '', $temp['playback_count']);		
		if(!is_numeric($temp['playback_count'])) return array('count'=>1, 'is_error'=>true, 'comment'=>'Count is not a number.');
		if(is_numeric($temp['playback_count']) && $temp['playback_count'] == 0) return array('count'=>1, 'is_error'=>false, 'comment'=>'OK');
		return array('count'=>$temp['playback_count'], 'is_error'=>false, 'comment'=>'OK');
	}	
	return array('count'=>1, 'is_error'=>true, 'comment'=>'Unable to get count.');
}
public static function getSoundCloudDownloads($email, $url, $username, $password){
	$client_id = 'bde5d4aae57c9d649dad6f8dbab53a52';
	$track_url = $url;
	$url = 'http://api.soundcloud.com/resolve.json?url='.urlencode($track_url).'&client_id='.$client_id;
	$temp = json_decode(file_get_contents($url), true);
	
	if(isset($temp['download_count'])){ 
		$temp['download_count'] = str_replace(' ', '', $temp['download_count']);
		$temp['download_count'] = str_replace(',', '', $temp['download_count']);		
		if(!is_numeric($temp['download_count'])) return array('count'=>1, 'is_error'=>true, 'comment'=>'Count is not a number.');
		if(is_numeric($temp['download_count']) && $temp['download_count'] == 0) return array('count'=>1, 'is_error'=>false, 'comment'=>'OK');
		return array('count'=>$temp['download_count'], 'is_error'=>false, 'comment'=>'OK');
	}	
	return array('count'=>1, 'is_error'=>true, 'comment'=>'Unable to get count.');
}
public static function getTumblrFollowers($email, $url, $username, $password){

	$temp = file_get_contents($url);
	$temp = str_replace("\r", '', $temp);
	$temp = str_replace("\n", '', $temp);
	$temp = str_replace(',', '', $temp);

	preg_match('/<div class=\"hide_overflow\">Followers<\/div>(.*?)<span class="count">([0-9]+)<\/span>/', $temp, $matches);
	dd($matches);
	if(isset($matches[2])){ 
		$matches[2] = str_replace(' ', '', $matches[2]);
		$matches[2] = str_replace(',', '', $matches[2]);	
		if(!is_numeric($matches[2])) return array('count'=>1, 'is_error'=>true, 'comment'=>'Count is not a number.');
		if(is_numeric($matches[2]) && $matches[2] == 0) return array('count'=>1, 'is_error'=>false, 'comment'=>'OK');
		return array('count'=>$matches[2], 'is_error'=>false, 'comment'=>'OK');
	}		
	return array('count'=>1, 'is_error'=>true, 'comment'=>'Unable to get count.');
}
public static function getPinterestFollowers($email, $url, $username, $password){
	$tempUrl = str_replace('www.pinterest.com', 'pinterest.com', $url);
	$tempUrl = str_replace('pinterest.com', 'm.pinterest.com', $tempUrl);
	$temp = file_get_contents($tempUrl);
	preg_match('/([0-9]+) [Ff]ollowers/', $temp, $matches);
	if(isset($matches[1])){ 
		$matches[1] = str_replace(' ', '', $matches[1]);
		$matches[1] = str_replace(',', '', $matches[1]);	
		if(!is_numeric($matches[1])) return array('count'=>1, 'is_error'=>true, 'comment'=>'Count is not a number.');
		if(is_numeric($matches[1]) && $matches[1] == 0) return array('count'=>1, 'is_error'=>false, 'comment'=>'OK');
		return array('count'=>$matches[1], 'is_error'=>false, 'comment'=>'OK');
	}	
	return array('count'=>1, 'is_error'=>true, 'comment'=>'Unable to get count.');
}
public static function getPinterestLikes($email, $url, $username, $password){
	$tempUrl = str_replace('www.pinterest.com', 'pinterest.com', $url);
	$tempUrl = str_replace('pinterest.com', 'm.pinterest.com', $tempUrl);
	$temp = file_get_contents($tempUrl);
	preg_match('/([0-9]+) [Ll]ikes/', $temp, $matches);
	if(isset($matches[1])){ 
		$matches[1] = str_replace(' ', '', $matches[1]);
		$matches[1] = str_replace(',', '', $matches[1]);		
		if(!is_numeric($matches[1])) return array('count'=>1, 'is_error'=>true, 'comment'=>'Count is not a number.');
		if(is_numeric($matches[1]) && $matches[1] == 0) return array('count'=>1, 'is_error'=>false, 'comment'=>'OK');
		return array('count'=>$matches[1], 'is_error'=>false, 'comment'=>'OK');
	}		
	return array('count'=>1, 'is_error'=>true, 'comment'=>'Unable to get count.');
}
public static function getPinterestRepins($email, $url, $username, $password){
	$tempUrl = str_replace('www.pinterest.com', 'pinterest.com', $url);
	$tempUrl = str_replace('pinterest.com', 'm.pinterest.com', $tempUrl);
	$temp = file_get_contents($tempUrl);
	//preg_match('/([0-9]+) [Rr]epins/', $temp, $matches);
	preg_match('/<span class=\"buttonText\">([0-9]+)<\/span>/', $temp, $matches);
	if(isset($matches[1])){ 
		$matches[1] = str_replace(' ', '', $matches[1]);
		$matches[1] = str_replace(',', '', $matches[1]);		
		if(!is_numeric($matches[1])) return array('count'=>1, 'is_error'=>true, 'comment'=>'Count is not a number.');
		if(is_numeric($matches[1]) && $matches[1] == 0) return array('count'=>1, 'is_error'=>false, 'comment'=>'OK');
		return array('count'=>$matches[1], 'is_error'=>false, 'comment'=>'OK');
	}		
	return array('count'=>1, 'is_error'=>true, 'comment'=>'Unable to get count.');
}

public static function extractFacebookScreenName($url){
	$temp = explode('facebook.com/', $url);		
	if(!isset($temp[1])) return '--';
	$temp[1] = str_replace('#!/', '', $temp[1]);
	$temp2 = explode('/', $temp[1]);
	if(!isset($temp2[0])) return '--';
	
	if(count($temp2)==3){
		if(!isset($temp2[2])) return '--';
		$temp3 = explode('?', $temp2[2]);
		if(!isset($temp3[0])) return '--';
		return $temp3[0];
	}
	
	return $temp2[0];	
}
public static function getFacebookLikes($email, $url, $username, $password){
	$screenName = self::extractFacebookScreenName($url);
	if($screenName=='--') return array('count'=>1, 'is_error'=>true, 'comment'=>'Unable to get Facebook Screen Name.');
	$temp = json_decode(file_get_contents('https://graph.facebook.com/'.$screenName), true);
	if(isset($temp['likes'])){ 
		$temp['likes'] = str_replace(' ', '', $temp['likes']);
		$temp['likes'] = str_replace(',', '', $temp['likes']);		
		if(!is_numeric($temp['likes'])) return array('count'=>1, 'is_error'=>true, 'comment'=>'Count is not a number.');
		if(is_numeric($temp['likes']) && $temp['likes'] == 0) return array('count'=>1, 'is_error'=>false, 'comment'=>'OK');
		return array('count'=>$temp['likes'], 'is_error'=>false, 'comment'=>'OK');
	}		
	return array('count'=>1, 'is_error'=>true, 'comment'=>'Unable to get count.');
}

}


