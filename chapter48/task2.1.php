<?php
// ЗАДАНИЕ 2.1 //
$currentStep = isset($_GET['step']) ? $_GET['step'] : 1;

$isFinished = doHardWorkBySteps($currentStep);

if (!$isFinished) {
    $nextStep = $currentStep + 1;
    header("Location: task2.1.php?step={$nextStep}");
    exit;
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