<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/tabla.css">
    <link rel="icon" href="../Storage/logo.jpg">
    <title>Inventario</title>
</head>

<body>
    <?php include("layout/header.php") ?>
    <div class="contenido">
        <div class="aside"><?php include("layout/aside.php") ?></div>

        <div class="tabla">

            <form method="get" action="" class="buscador">
                <input type="text" name="busqueda" id="busqueda" value="" placeholder="Buscar" class="input">
                <!--<input type="submit" value="Buscar" class="btn-busqueda">-->
            </form>

            <table>
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Categoria</th>
                        <th>Stock</th>
                        <th>Descripcion</th>
                        <th>Añadir stock</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>123</td>
                        <td>Galletas</td>
                        <td>Alimento</td>
                        <td>100</td>
                        <td>Este es un alimento muy bueno</td>
                        <td>
                            <a href="">
                                <input type="button" value="Añadir" class="boton">
                            </a>
                        </td>

                    </tr>


                </tbody>
            </table>

        </div>
</body>

</html>