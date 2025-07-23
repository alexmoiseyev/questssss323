<?php
// ЗАДАНИЕ 1 //
class Sanitizer {
    public function sanitize(array $data, array $format): array {
        $sanitizedData = [];

        foreach ($format as $field) {
            $fieldName = $field['NAME'];
            $fieldFormat = $field['FORMAT'];

            if (!isset($data[$fieldName])) {  // если поле не сушествует - пропускаем
                continue;
            }

            $value = $data[$fieldName];

            switch ($fieldFormat) {
                case 'email':
                    $sanitizedData[$fieldName] = filter_var($value, FILTER_SANITIZE_EMAIL);
                    break;
                case 'encoded':
                    $sanitizedData[$fieldName] = filter_var($value, FILTER_SANITIZE_ENCODED);
                    break;
                case 'magic_quotes':
                    $sanitizedData[$fieldName] = addslashes($value);
                    break;
                case 'float':
                    $sanitizedData[$fieldName] = filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    break;
                case 'int':
                    $sanitizedData[$fieldName] = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
                    break;
                case 'special_chars':
                    $sanitizedData[$fieldName] = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
                    break;
                case 'string':
                    $sanitizedData[$fieldName] = filter_var($value, FILTER_UNSAFE_RAW);
                    break;
                case 'url':
                    $sanitizedData[$fieldName] = filter_var($value, FILTER_SANITIZE_URL);
                    break;
                case 'ipv4':
                    $sanitizedData[$fieldName] = filter_var($value, FILTER_UNSAFE_RAW);
                    break;
                case 'bool':
                    $sanitizedData[$fieldName] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
                    break;
                default:
                    $sanitizedData[$fieldName] = $value;
                    break;
            }
        }
        return $sanitizedData;
    }
}
class Validator {
    public function validate(array $data, array $format): array {
        foreach ($format as $field) {
            $fieldName = $field['NAME'];
            $fieldFormat = $field['FORMAT'];

            if (!isset($data[$fieldName])) {
                return [
                    'SUCCESS' => false,
                    'WRONG_FIELD_NAME' => $fieldName,
                ];
            }

            $value = $data[$fieldName];
            $isValid = true;

            switch ($fieldFormat) {
                case 'string':
                    $isValid = is_string($value);
                    break;
                case 'email':
                    $isValid = filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
                    break;
                case 'url':
                    $isValid = filter_var($value, FILTER_VALIDATE_URL) !== false;
                    break;
                case 'encoded':
                    $isValid = is_string($value); 
                    break;
                case 'special_chars':
                    $isValid = is_string($value); 
                    break;
                case 'int':
                    $isValid = filter_var($value, FILTER_VALIDATE_INT) !== false;
                    break;
                case 'float':
                    $isValid = filter_var($value, FILTER_VALIDATE_FLOAT) !== false;
                    break;
                case 'ipv4':
                    $isValid = filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false;
                    break;
                case 'bool':
                    $isValid = filter_var($value, FILTER_VALIDATE_BOOLEAN) !== false;
                    break;
                case 'regular':
                    $isValid = filter_var($value, FILTER_VALIDATE_REGEXP ) !== false;
                    break;

                default:
                    $isValid = true;
                    break;
            }

            if (!$isValid) {
                return [
                    'SUCCESS' => false,
                    'WRONG_FIELD_NAME' => $fieldName,
                ];
            }
        }
        return ['SUCCESS' => true];
    }
}
// Массив данных
$data = [
    'username' => 'Alexey123',
    'email' => 'alexey@gmail.com',
    'age' => 'мне 20лет',
    'price' => 'цена 19.99',
    'website' => 'вебсайт https://example.com',
    'ip_address' => '192.168.1.1',
    'is_active' => 'true',
];

// Формат проверки
$format = [
    ['NAME' => 'username', 'FORMAT' => 'string'],
    ['NAME' => 'email', 'FORMAT' => 'email'],
    ['NAME' => 'age', 'FORMAT' => 'int'],
    ['NAME' => 'price', 'FORMAT' => 'float'],
    ['NAME' => 'website', 'FORMAT' => 'url'],
    ['NAME' => 'ip_address', 'FORMAT' => 'ipv4'],
    ['NAME' => 'is_active', 'FORMAT' => 'bool'],
];

$sanitizer = new Sanitizer();//очистка стркои
$validator = new Validator();//проверка строки

$sanitizedData = $sanitizer->sanitize($data, $format);
echo "<br><pre>";
var_dump($sanitizedData);
echo "</pre><br>";
$validationResult = $validator->validate($sanitizedData, $format);
var_dump($validationResult);
echo "<br>";    

// ошибка
$invalidData = $data;
$invalidData['email'] = 'invalid-email';
$invalidResult = $validator->validate($invalidData, $format);
var_dump($invalidResult ); 