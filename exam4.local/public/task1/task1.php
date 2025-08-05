<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Опрос качества обслуживания</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        .hidden {
            display: none;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Опрос качества обслуживания</h1>
        <form id="surveyForm" class="form">
            <div>
                <label for="">Фамилия:</label>
                <input class="form-control mt-1" type="text" id="surname" name="surname" required>
            </div>
            <div>
                <label for="">Имя:</label>
                <input class="form-control mt-1" type="text" id="name" name="name" required>
            </div>
            <div id="patronymicDiv">
                <label for="">Отчество:</label>
                <input class="form-control mt-1" type="text" id="patronymic" name="patronymic">
            </div>
            <div class="m-2">
                <input class="form-check-input mt-1" type="checkbox" id="noPatronymic" name="no_patronymic">
                <label for="noPatronymic">Нет отчества</label>
            </div>
            <div>
                <label for="">Email:</label>
                <input class="form-control" type="email" id="email" name="email" required>
            </div>

            <div class="mt-3">
                <p><strong>Являетесь ли вы клиентом нашей компании?</strong></p>
                <input type="radio" id="client1" name="company_client" value="Да, более года" required>
                <label for="">Да, более года</label><br>
                <input type="radio" id="client2" name="company_client" value="Да, менее года">
                <label for="">Да, менее года</label><br>
                <input type="radio" id="client3" name="company_client" value="Нет">
                <label for="">Нет</label>
            </div>

            <div class="mt-3">
                <p><strong>Была ли решена ваша проблема?</strong></p>
                <input type="radio" id="problem1" name="problem_solved" value="да" required>
                <label for="problem1">Да</label><br>
                <input type="radio" id="problem2" name="problem_solved" value="нет">
                <label for="">Нет</label>
            </div>

            <div class="mt-3">
                <p><strong>Довольны ли Вы качеством обслуживания?</strong></p>
                <input type="radio" id="quality1" name="quality_service" value="очень доволен" required>
                <label for="">Очень доволен</label><br>
                <input type="radio" id="quality2" name="quality_service" value="доволен">
                <label for="">Доволен</label><br>
                <input type="radio" id="quality3" name="quality_service" value="нейтрально">
                <label for="">Нейтрально</label><br>
                <input type="radio" id="quality4" name="quality_service" value="недоволен">
                <label for="">Недоволен</label><br>
                <input type="radio" id="quality5" name="quality_service" value="очень недоволен">
                <label for="">Очень недоволен</label>
            </div>

            <div id="grudgeDiv" class="hidden">
                <p>Пожалуйста, опишите причину недовольства подробнее</p>
                <textarea id="grudge" name="grudge"></textarea>
            </div>

            <div id="errorDiv" class="error"></div>

            <div class="mt-3">
                <button type="reset" class="btn btn-danger">Сбросить</button>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-primary">Отправить</button>
            </div>
        </form>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#noPatronymic').change(function() {
                if (this.checked) {
                    $('#patronymicDiv').hide();
                    $('#patronymic').val('');
                } else {
                    $('#patronymicDiv').show();
                }
            });

            $('input[name="quality_service"]').change(function() {
                if ($(this).val() === 'недоволен' || $(this).val() === 'очень недоволен') {
                    $('#grudgeDiv').show();
                } else {
                    $('#grudgeDiv').hide();
                    $('#grudge').val('');
                }
            });

            $('#surveyForm').submit(function(e) {
                e.preventDefault();

                let isValid = true;
                $('[required]').each(function() {
                    if (!$(this).val()) {
                        isValid = false;
                        $(this).addClass('error');
                    } else {
                        $(this).removeClass('error');
                    }
                });

                if (!isValid) {
                    $('#errorDiv').text('заполните все обязательные поля');
                    return;
                }

                $('#errorDiv').text('');
                const formData = $(this).serialize();
                $.ajax({
                    url: 'form_handler.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        alert('Успешнo. Ваши ответы сохранены.');
                        $('#surveyForm')[0].reset();
                        $('#patronymicDiv').show();
                        $('#grudgeDiv').hide();
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", status, error);
                        alert('Произошла ошибка при отправке данных: ' + error);
                    }
                });
            });
        });
    </script>
</body>

</html>