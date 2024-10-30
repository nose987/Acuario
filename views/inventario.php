<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/tabla.css">
    <link rel="stylesheet" href="../Styles/layouts/modal.css">
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
                    <?php
                    include("../Class/clase_inventario.php");
                    $inventario = new Inventario();
                    $datos = $inventario->mostrar();
                    if ($datos->num_rows === 0) {
                        echo "No se encontraron datos";
                    } else {
                        while ($fila = $datos->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?php echo $fila['codigo']; ?></td>
                                <td><?php echo $fila['nombre']; ?></td>
                                <td><?php echo $fila['categoria']; ?></td>
                                <td><?php echo $fila['stock']; ?></td>
                                <td><?php echo $fila['descripcion']; ?></td>


                                <td>
                                    <button type="button" class="boton" onclick="abrirModal('<?php echo $fila['codigo']; ?>', '<?php echo $fila['nombre']; ?>', '<?php echo $fila['stock']; ?>')">Añadir</button>
                                </td>




                            </tr>
                    <?php
                        }
                    }
                    
                    ?>



                </tbody>
            </table>


        </div>

    </div>

    
    <div id="modal" class="modal" >
        <div class="contenido_modal">
        <span class="cerrar" onclick="cerrarModal()">&times;</span>
            <div class="titulo">
                <h2>Ingresa nuevo stock</h2>  
            </div>
            <div class="form_modal">
                <form method="post">
                    <label for="">Codigo producto: </label>
                    <input type="text" id="codigo" name="codigo" class="input" readonly><br><br>
                    <label for="">Nombre del producto: </label>
                    <input type="text" id="nombre" name="nombre" class="input" readonly><br><br>
                    <label for="">Stock actual: </label>
                    <input type="text" id="stock" name="stock" class="input" readonly><br><br>
                    <label for="">Nuevo stock: </label>
                    <input type="number" id="nuevo_stock" name="nuevo_stock" class="input" required><br>
                    <input type="submit" value="Agregar" class="boton" style="margin-top: 15px;">
                </form>
            </div>
        </div>

        
    </div>


</body>
<script src="../functions/modal.js"></script>

</html>