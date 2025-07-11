<?php
// ЗАДАНИЕ 3 //
$sExecuteCode = '
<?
$arStringsList = ["string1", "string2", "string3"];
?>


<ul>
<?foreach($arStringsList as $sStringVal):?>
    <li>
        <?=$sStringVal?>
    </li>
<?endforeach;?>
</ul>
';



ob_start();
eval('?>'.$sExecuteCode.'<?php ');
$result = ob_get_clean();

echo $result;
