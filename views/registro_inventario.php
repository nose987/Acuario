<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Storage/logo.jpg">
    <link rel="stylesheet" href="../Styles/inventario/registro_medicamento.css">
    <title>Registro Medicamento</title>
</head>

<body>




    <?php include("layout/header.php") ?>




    <div class="contenido">
        <aside>
            <?php include("layout/aside.php") ?>
        </aside>
        <div class="container">
            <div class="titulo">
                <h1>Registro de inventario</h1>
            </div>
            <form action="../Class/clase_inventario.php" method="POST">
                <div class="formulario">


                    <label for="codigo">Codigo: </label>
                    <input type="text" class="input" name="codigo" placeholder="Codigo del producto." required>

                    <label for="nombre">Nombre: </label>
                    <input type="text" class="input" name="nombre" placeholder="Nombre del producto." required>

                    <label for="">Categoria:</label>
                    <select class="input" name="categoria" id="">
                        <?php include("../Class/clase_inventario.php");
                            $categoria = new Inventario();
                            $categorias = $categoria->categoria();
                            foreach ($categorias as $categoria): ?>
                                <option value="<?php echo $categoria['pk_categoria']; ?>">
                                    <?php echo htmlspecialchars($categoria['nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        
                    </select>

                    <label for="stock">Cantidad: </label>
                    <input type="text" class="input" name="stock" placeholder="Cantidad del producto a registrar." required>

                    <label for="">Descripcion: </label>
                    <textarea type="text" class="input" name="descripcion" placeholder="Breve descripcion del producto." required></textarea>

                    <div class="btn_formulario">
                        <input type="submit" value="Guardar" class="btn" onclick="">
                        <a href="panel_inventario.php "><button value="Cancelar" class="btn">Cancelar</button></a>
                    </div>



                </div>
            </form>
        </div>



    </div>



</body>

</html>