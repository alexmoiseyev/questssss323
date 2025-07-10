<?php 
// ЗАДАНИЕ 1 //
function isSnils($string):bool{
    $pattern = '/^\d{3}-\d{3}-\d{3} \d{2}$/';
    if(preg_match($pattern, $string)===1){
        echo "Это СНИЛС";
        return true;
    }else{
        echo "Это не СНИЛС";
        return false;
    }
}
isSnils("159-529-737 20");
echo "<br>";

// ЗАДАНИЕ 2 //
function hasEmail($string):bool{
    $pattern = '/@.+\..+/';
    if(preg_match($pattern, $string) === 1){
        echo "В строке $string cодержится email";
        return true;
    }
    else{
        echo "email не найден";
        return false;
    }
}
hasEmail("gipoop24@gmail.com");
echo "<br>";


// ЗАДАНИЕ 3 //
function checkDocumentNumber($string):bool{
    $pattern = '/^\d{2}(?:-\d{3})+\/\d+$/';
    if(preg_match($pattern, $string) === 1){
        echo "Договор в нужном формате ";
        return true;
    }else{
        echo "Неправильный формат договора";
        return false;
    }
}
checkDocumentNumber("12-333-444/53412");
echo "<br>";

// ЗАДАНИЕ 4 //
function checkString($string):bool{
    $pattern = '/^[a-zA-Z0-9_]+$/';
    if(preg_match($pattern, $string) === 1){
        echo "В строке только латински буквы, цифры и знаки подчеркивания";
        return true;
    }else{
        echo "В строке есть лишние символы";
        return false;
    }
}
checkString("String_71");