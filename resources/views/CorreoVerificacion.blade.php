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
        <h1>Bienvenido</h1>
    </center>
    <center>
        <h2>Tu nombre {{ $datosUsuCorreo['nombre'] }} </h2>
        <h2>Tu apellido {{ $datosUsuCorreo['apellido'] }} </h2>
        <h2>Tu correo {{ $datosUsuCorreo['email'] }} </h2>
    </center>

    <p>Cremos que la decicion de ingresar a nuestra pagina web es la mejor</p>
    <br>
    <p>para continuar, has click en el siguiente link</p>
    <h2><a href="{{ $datosUsuCorreo['direccionUrl'] }}">Que esperas, has clic aqui!!!</a></h2>

    <h2>O pega el siguiente enlace en la barra de busqueda</h2>
    <h3> {{ $datosUsuCorreo['direccionUrl'] }} </h3>

</body>

</html>