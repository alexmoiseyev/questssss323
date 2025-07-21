<?php
// зАДАНИЕ 2 //
if(!isset($_COOKIE['TEST_COOKIE'])){
    setcookie('TEST_COOKIE', 'TEST_31', time() + 60, '/'); 
    echo "Куки установлены";
}else{
    setcookie('TEST_COOKIE', '', time() - 60, '/');
    echo "куки " . $_COOKIE['TEST_COOKIE'] . " удалён";
}
echo "<br><pre>куки:<br>";
print_r($_COOKIE);
echo "</pre>";