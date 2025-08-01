<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <button id="showCounters">Показать значение счетчиков</button>
    <ul id="itemsList">
        <li>item1</li>
        <li>item2</li>
        <li>item3</li>
        <li>item4</li>
    </ul>

    <script>
        const items = document.querySelectorAll('#itemsList li');
        items.forEach(item => {
            item.counter = 0;
            
            item.addEventListener('click', function() {
                this.counter++;
            });
        });

        document.getElementById('showCounters').addEventListener('click', function() {
            items.forEach(item => {
                console.log(`${item.textContent}: ${item.counter} кликов`);
                alert(`${item.textContent}: ${item.counter} кликов`);
            });
        });
    </script>
</body>
</html>