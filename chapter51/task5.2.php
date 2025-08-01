<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <button id="showCountersData">Показать значение счетчиков</button>
    <ul id="itemsList">
        <li data-counter="0">item1</li>
        <li data-counter="0">item2</li>
        <li data-counter="0">item3</li>
        <li data-counter="0">item4</li>
    </ul>

    <script>
        const items = document.querySelectorAll('#itemsList li');
        
        items.forEach(item => {
            item.addEventListener('click', function() {
                const currentCount = parseInt(this.getAttribute('data-counter'));
                this.setAttribute('data-counter', currentCount + 1);
            });
        });
        document.getElementById('showCountersData').addEventListener('click', function() {
            itemsData.forEach(item => {
                const count = item.getAttribute('data-counter');
                console.log(`${item.textContent}: ${count} кликов`);
                alert(`${item.textContent}: ${count} кликов`);
            });
        });
    </script>
</body>
</html>