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
        <h3>A continuacion se mostraran los Siguientes cambios</h3>
    </center>



    <h3>El Usuario: {{ $informacionActalizada['username'] }} </h3>
    <h3>con el correo: {{ $informacionActalizada['email'] }} ha efectuado</h3>
    <h3>ha efectuado el siguiene cambio: {{ $informacionActalizada['proceso'] }} </h3>
    <h3>{{ $informacionActalizada['accion'] }} </h3>

</body>

</html>