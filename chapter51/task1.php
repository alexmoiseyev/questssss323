<!-- ЗАДАНИЕ 1 -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <script>
    const rectangle = {
      width: 0,  
      height: 0,  
      getWidth() {
        return this.width;
      },
      getHeight() {
        return this.height;
      },
      getArea() {
        return this.width * this.height;
      }
    };
    rectangle.width = 10;
    rectangle.height = 5;
    console.log("Ширина прямоугольника:", rectangle.getWidth()); 
    console.log("Высота прямоугольника:", rectangle.getHeight());
    console.log("Площадь прямоугольника:", rectangle.getArea());   
  </script>
</body>
</html>