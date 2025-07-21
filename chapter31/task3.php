<?php
// ЗАДАНИЕ 3 //
function changeUrl($sUrl){

    $parsedUrl = parse_url($sUrl); 
    echo "<pre>";
    var_dump($parsedUrl);
    echo "</pre><br>";
    $path = $parsedUrl['path'] ?? '';

    if (strpos($path, '/path/test/') !== false) {
        
        $newQuery = http_build_query([
            'param1' => '123',
            'param2' => '012'
        ]);
    } elseif (strpos($path, '/test/path/') !== false) {
        $newQuery = http_build_query([
            'param123' => '1',
            'param012' => '2'
        ]);
    } else {
        $newQuery = $parsedUrl['query'] ?? '';
    }

    $newUrl = ($parsedUrl['scheme'] ?? 'http') . '://' . ($parsedUrl['host'] ?? '') . $path . ($newQuery ? '?' . $newQuery : '');

    echo "новый URL: " . htmlspecialchars($newUrl) . "<br>";
    return true;
}
changeUrl($sUrl = "https://tast3.com/path/test/?something1=value&something2=value");
changeUrl($sUrl = "https://tast3.com/test/path/?something1=value&something2=value");