<head>
    <style>
        * {
            font-family: 'Heebo', Arial, Helvetica, 'Nimbus Sans L', sans-serif;
            ;
            z-index: 1;
        }

        .container-nav {
            width: 100%;
            height: 100%;
            background-color: whitesmoke;
            
        }

        .container-nav nav {
            display: flex;
            flex-direction: column;
            width: 100%;
            gap: 1px;
        }

        .container-nav nav a {
            display: block;
            text-decoration: none;
            width: 100%;
            padding: 10px;
            color: black;
            border-left: 5px solid transparent;
            transition: all 500ms ease;
            cursor: pointer;
        }

        .container-nav nav a:hover {
            background-color: grey;
            color: white;
            border-left: 5px solid white;
        }

       
    </style>

</head>



<div class="container-nav">
   
    <nav>
        <a href="">Inicio</a>
        <a href="">Panel de control</a>
        <a href="panel_inventario.php">Inventario</a>
        <a href="">Tanques</a>
        <a href="">Control del agua</a>
        <a href="">Especies</a>
        <a href="">Equipos</a>
        <a href="">Empleados</a>
    </nav>
</div>