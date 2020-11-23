<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verificacion Email</title>
</head>


<body>
    <center>
        <h1>Hola Administrador</h1>
    </center>
    <center>
        <h3>A continuacion se mostraran los procesos fallidos</h3>
    </center>


    <h3>El Usuario: {{ $infoProceso['username'] }} </h3>
    <h3>con el correo: {{ $infoProceso['email'] }} </h3>
    <h3>Ha presentado el siguiente problema: {{ $infoProceso['problema'] }} </h3>

</body>

</html>