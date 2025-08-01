<!-- ЗАДАНИЕ 4 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <button id="increaseCount">увеличить счетчик</button>
    <button id="showCount">показать значение счетчика</button>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    let counter = 0;
    $(document).ready(function(){
         $('#increaseCount').click(function() {
            counter++;
         });
         $('#showCount').click(function() {
            alert(counter);
         });
    })
    
</script>