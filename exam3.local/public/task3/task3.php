<?php
class ValidationException extends Exception
{
    private $fieldName;
    private $lineNumber;

    public function __construct(string $fieldName, int $lineNumber, string $message = "")
    {
        $this->fieldName = $fieldName;
        $this->lineNumber = $lineNumber;
        parent::__construct($message);
    }

    public function getFieldName(): string
    {
        return $this->fieldName;
    }

    public function getLineNumber(): int
    {
        return $this->lineNumber;
    }
}

class Validator
{
    public function validate(string $file, array $format): array
    {
        try
        {
            if (!file_exists($file))
            {
                throw new Exception("Файл не найден: {$file}");
            }

            $fileHandle = fopen($file, 'r');
            if ($fileHandle === false)
            {
                throw new Exception("Ошибка в открытии файла: {$file}");
            }

            $lineNumber = 0;
            $headers = [];
            $errors = [];

            while ($row = fgetcsv($fileHandle, 0, ';'))
            {
                $lineNumber++;

                if ($lineNumber === 1)
                {
                    $headers = array_map('trim', $row);
                    continue;
                }

                foreach ($format as $field)
                {
                    $fieldName = trim($field['NAME']);
                    $fieldFormat = $field['FORMAT'];

                    $fieldIndex = array_search($fieldName, $headers);
                    if ($fieldIndex === false)
                    {
                        throw new ValidationException($fieldName, $lineNumber, "Поля $fieldName нет в CSV заголовках");
                    }

                    if (!isset($row[$fieldIndex]))
                    {
                        throw new ValidationException($fieldName, $lineNumber, "Поля $fieldName нет в строке");
                    }

                    $value = trim($row[$fieldIndex]);

                    switch ($fieldFormat)
                    {
                        case 'string':
                            if (!is_string($value))
                            {
                                throw new ValidationException($fieldName, $lineNumber, "Ошибка в имени: $fieldName");
                            }
                            break;
                        case 'ipv4':
                            if (filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) === false)
                            {
                                throw new ValidationException($fieldName, $lineNumber, "Ошибка в IPv4: $fieldName");
                            }
                            break;
                        case 'email':
                            if (filter_var($value, FILTER_VALIDATE_EMAIL) === false)
                            {
                                throw new ValidationException($fieldName, $lineNumber, "Ошибка в email: $fieldName");
                            }
                            break;
                        case 'url':
                            if (filter_var($value, FILTER_VALIDATE_URL) === false)
                            {
                                throw new ValidationException($fieldName, $lineNumber, "Ошибка в URL: $fieldName");
                            }
                            break;
                    }
                }
            }

            fclose($fileHandle);
            return ['SUCCESS' => true, 'MESSAGE' => 'Верно'];
        }
        catch (ValidationException $e)
        {
            return [
                'SUCCESS' => false,
                'FILENAME' => $file,
                'MESSAGE' => $e->getMessage(),
                'FIELD' => $e->getFieldName(),
                'LINE' => $e->getLineNumber(),
                'ERROR_TYPE' => 'VALIDATION_ERROR'
            ];
        }
        catch (Exception $e)
        {
            return [
                'SUCCESS' => false,
                'MESSAGE' => $e->getMessage(),
                'ERROR_TYPE' => 'SYSTEM_ERROR'
            ];
        }
    }
}

$format = [
    ['NAME' => 'Логин пользователя', 'FORMAT' => 'string'],
    ['NAME' => 'IP адрес', 'FORMAT' => 'ipv4'],
    ['NAME' => 'e-mail', 'FORMAT' => 'email'],
    ['NAME' => 'URL', 'FORMAT' => 'url'],
];
$filename = 'file.csv';
$validator = new Validator();
$validationResult = $validator->validate($filename, $format);

if ($validationResult['SUCCESS'])
{
    echo "Файл содержит корректные данные<br>";
}
else
{
    echo "Ошибка в файле {$validationResult['FILENAME']} : {$validationResult['MESSAGE']}<br>";
    if (isset($validationResult['FIELD']))
    {
        echo "Поле: {$validationResult['FIELD']}<br>";
    }
    if (isset($validationResult['LINE']))
    {
        echo "Строка CSV: {$validationResult['LINE']}<br>";
    }
}
