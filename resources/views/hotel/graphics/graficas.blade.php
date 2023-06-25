<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>
        Aquí se muestra todas las gráficas:
        https://api.highcharts.com/highcharts/
    </h1>

<?php
    use Illuminate\Support\Facades\Crypt;

$encryptedText = "asdasdas"; // Texto cifrado previamente con Crypt::encrypt()

$encryptedText = Crypt::encrypt($encryptedText);
$encryptedText = Crypt::decrypt($encryptedText);

echo $encryptedText;
?>


</body>
</html>