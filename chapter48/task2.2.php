<?php
// ЗАДАНИЕ 2.2
$currentStep = isset($_GET['step']) ? $_GET['step'] : 1;

$isFinished = doHardWorkBySteps($currentStep);

if (!$isFinished) {
    $nextStep = $currentStep + 1;
    $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . "?step={$nextStep}";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 300); 
    $response = curl_exec($ch);
    curl_close($ch);
    
    echo $response;
} else {
    echo "Работа полностью завершена!";
}

function doHardWorkBySteps($iStepNumber)
{
    sleep(15);

    file_put_contents(
        'messages.log',
        date("d.m.Y H:i:s") . "закончен шаг номер " . $iStepNumber . "\n\n",
        FILE_APPEND
    );

    if ($iStepNumber > 15) {
        return true;
    } else {
        return false;
    }
}