<?php
// ЗДАНИЕ 2 //
class Logger
{
    public function writeMessage2Log($sLogMessage)
    {
        $filename = date('Y_m_d__H_i') . '__messages.log';

        $time = date('H_i_s');
        $logEntry = "========  $time  ======\n$sLogMessage\n\n";

        file_put_contents('logs/' . $filename, $logEntry, FILE_APPEND);
    }
}
$objLogger = new Logger();

// *** раскомментировать для проверки: *** //

$objLogger->writeMessage2Log("Произошла ошибка!!!");

// $i = 0;
// $objLogger->writeMessage2Log(var_export($i, true));


// $arTestArray = [[], [0], [[], [1]]];
// $objLogger->writeMessage2Log(var_export($arTestArray, true));
