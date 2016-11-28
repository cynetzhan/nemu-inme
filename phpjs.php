<?php
$query=urlencode($_GET['query']);
//$key="AIzaSyA2uR58x5F61hqOWQgLTaks1OUY9hz1pZM";
//$url="https://maps.googleapis.com/maps/api/place/textsearch/json?query=".$query."&key=".$key;
$url="map.json";
$content = file_get_contents($url);
$json_a=json_decode($content,true);
$i=0;
foreach($json_a['results'] as $p){
  echo "<li class='list-group-item' id='item".$i."' ><a href='#' onclick='latlngEnabled(".$i.")' >".$p['name']."<br /><span>".$p['formatted_address']."</span></a>";
  echo "<input type='hidden' name='place' value='".$p['name']."' disabled>";
  echo "<input type='hidden' name='address' value='".$p['formatted_address']."' disabled>";
  echo "<input type='hidden' name='lat' value='".$p['geometry']['location']['lat']."' disabled>";
  echo "<input type='hidden' name='lng' value='".$p['geometry']['location']['lng']."' disabled></li>";
  $i++;
  }
?>
