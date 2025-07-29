<?php
//ЗАДАНИЕ 1 //
$content = file_get_contents('markup.xml');
$tags = new SimpleXMLElement($content);

foreach($tags->Destination as $destination) {
    $destination[0] = "8(000)000-00-00";
}
echo "<pre>";
var_dump($tags);
echo "</pre>";

file_put_contents('markup.xml', $tags->asXML());
