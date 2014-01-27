<?php

function formatFacebookUsers($content) {
	for($i=0; $i<count($content['data']); $i++) {
		$id = $content['data'][$i]['id'];
		$name = $content['data'][$i]['name'];
		
		$picture = 'https://graph.facebook.com/'.$id.'/picture?type=square'; //square, small, large
		$url = 'http://www.facebook.com/profile.php?id='.$id;
		
		$users[$i]['id'] = $id;
		$users[$i]['name'] = $name;
		$users[$i]['picture'] = $picture;
		$users[$i]['url'] = $url;
	}
	return $users;
}

function displayUsersIcons($criteria) {
	$users = $criteria['users'];
	$nb_display = $criteria['nb_display'];
	$width = $criteria['width'];
	
	if($width=='') $width="30";
	
	if($nb_display>count($users) || $nb_display=='') $nb_display=count($users); //display value never bigger than nb users
	
	$display = '';
	for($i=0;$i<$nb_display;$i++) {
		$name = $users[$i]['name'];
		$picture = $users[$i]['picture'];
		$url = $users[$i]['url'];
		
		$display .= '<a href="'.$url.'" target="_blank" title="'.$name.'">';
		$display .= '<img src="'.$picture.'" width="'.$width.'" style="padding:2px;">';
		$display .= '</a>';
	}
	return $display;
}
	
?>