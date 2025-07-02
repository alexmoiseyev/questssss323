<?php
// ЗАДАНИЕ 1 // 
    //1)
    $sAnyText = "    https://example.com/?var=5     ";
    $sAnyText_  = "           https://example.com/";

    var_dump($sAnyText);
    echo '<br>';
    var_dump($sAnyText_);
    
    $sAnyText = trim($sAnyText); 
    $sAnyText_ = trim($sAnyText_); 

    echo '<br>После удаления пробелов:<br>';

    var_dump($sAnyText);
    echo '<br>';
    var_dump($sAnyText_);

    //2)
    echo '<br>';
    echo "3 символ строки $sAnyText - $sAnyText[2] ";
    
    //3) 
    echo '<br>';

        if(strpos($sAnyText, '?')){
            echo "Длина строки: ".strlen($sAnyText);
        }else{
            echo "символ не найден";
        }
        echo '<br>';
    //4)
    function textFunc($text){
        if(strpos($text, '?')){
            $result = str_replace(['=', '?'], '!!!!!!', $text); 
        }else{
            $result = $text;
        }
        return $result;
    }
   
    echo textFunc($sAnyText);
    echo '<br>';
    echo textFunc($sAnyText_);

// ЗАДАНИЕ 2 //
echo '<br>';
function phoneNumber($phoneStr) {
    if (strlen($phoneStr) !== 11) {
        return $phoneStr; 
    }

    $countryCode = substr($phoneStr, 0, 1);      
    $areaCode = substr($phoneStr, 1, 3);         
    $firstPart = substr($phoneStr, 4, 3);        
    $secondPart = substr($phoneStr, 7, 2);       
    $thirdPart = substr($phoneStr, 9, 2);        

    return sprintf(
        "%s (%s) %s-%s-%s",
        $countryCode,
        $areaCode,
        $firstPart,
        $secondPart,
        $thirdPart
    );
}

$phoneNumber = "84950102030";
echo phoneNumber($phoneNumber); 
