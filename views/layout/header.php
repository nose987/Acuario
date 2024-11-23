<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Heebo', Arial, Helvetica, 'Nimbus Sans L', sans-serif;
            ;
        }

        .cerrar-sesion{
            text-decoration: none;
            background-color: grey;
            margin: 10px 15px;
            padding: 10px 15px;
            color: white;
            border-radius: 10px;
            transition: all 0.5s ease;
        }

        .cerrar-sesion:hover{
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        header {
            display: flex;
            background-color: #0080c8;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            justify-content: space-between;
            align-items: center;
        }

        header img {
            padding: 10px 20px;
        }
    </style>
</head>

<body>
    <header>
        <a href="panel.php"><img src="../Storage/logo.jpg" alt="logo" height="100px" width="180px"></a>
        <a href="../functions/cerrarsesion.php" class="cerrar-sesion">Cerrar sesión</a>
    </header>
</body>

</html>