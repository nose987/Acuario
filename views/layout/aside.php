<head>
    <style>
        * {
            font-family: 'Heebo', Arial, Helvetica, 'Nimbus Sans L', sans-serif;
            ;
            z-index: 1;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            gap: 0.75rem;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: #1e90ff;
            border-left-color: white;
            padding-left: 2rem;
        }

        .icon, svg {
            width: 20px;
            height: 20px;
        }

        
    </style>

</head>




<nav>
  <!--<a href="panel.php" class="nav-link" data-section="inicio"><img src="../Storage/iconos/home-icon.png" alt="" class="icon">Inicio</a>-->
  <?php 
    
    if($_SESSION['rol_id'] === 1){
      ?>
      <a href="" class="nav-link" data-section="agua"><img src="../Storage/iconos/water-icon2.png" alt="" class="icon">Control de agua</a>

      
      <a href="" class="nav-link" data-section="alimentacion"><img src="../Storage/iconos/food-icon.png" alt="" class="icon">Alimentación</a>
      
      <a href="" class="nav-link" data-section="salud"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 6C 15 6, 18 8, 18 12C 18 16, 15 18, 12 18C 9 18, 6 16, 6 12C 6 8, 9 6, 12 6"fill="none"stroke="currentColor"stroke-width="2"/><path d="M12 9 L12 15 M9 12 L15 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>Salud de especies</a>
      
      <a href="" class="nav-link" data-section="especie"><img src="../Storage/iconos/fish-icon.png" alt="" class="icon">Especies</a>
<?php

    }else if($_SESSION['rol_id'] === 2){
      ?>
      <a href="" class="nav-link" data-section="agua"><img src="../Storage/iconos/water-icon2.png" alt="" class="icon">Control de agua</a>

      <a href="" class="nav-link" data-section="alimentacion"><img src="../Storage/iconos/food-icon.png" alt="" class="icon">Alimentación</a>

      <a href="" class="nav-link" data-section="tanque"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="6" width="18" height="12" rx="2" fill="none" stroke="currentColor" stroke-width="2"/><path d="M8 13 C8 13, 10 10, 12 13 C14 10, 16 13, 16 13" fill="none" stroke="currentColor" stroke-width="2"/><path d="M5 18 C5 18, 6 15, 7 18" stroke="currentColor" stroke-width="2" fill="none"/><path d="M17 18 C17 18, 18 15, 19 18" stroke="currentColor" stroke-width="2" fill="none"/></svg>Tanque</a>
    
      <a href="" class="nav-link" data-section="salud"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 6C 15 6, 18 8, 18 12C 18 16, 15 18, 12 18C 9 18, 6 16, 6 12C 6 8, 9 6, 12 6"fill="none"stroke="currentColor"stroke-width="2"/><path d="M12 9 L12 15 M9 12 L15 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>Salud de especies</a>
    
      <a href="" class="nav-link" data-section="especie"><img src="../Storage/iconos/fish-icon.png" alt="" class="icon">Especies</a>
    

      <?php
    }else if($_SESSION['rol_id'] === 4){
      ?>
    <a href="" class="nav-link" data-section="agua"><img src="../Storage/iconos/water-icon2.png" alt="" class="icon">Control de agua</a>
    <a href="" class="nav-link" data-section="tanque"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="6" width="18" height="12" rx="2" fill="none" stroke="currentColor" stroke-width="2"/><path d="M8 13 C8 13, 10 10, 12 13 C14 10, 16 13, 16 13" fill="none" stroke="currentColor" stroke-width="2"/><path d="M5 18 C5 18, 6 15, 7 18" stroke="currentColor" stroke-width="2" fill="none"/><path d="M17 18 C17 18, 18 15, 19 18" stroke="currentColor" stroke-width="2" fill="none"/></svg>Tanque</a>
    <a href="" class="nav-link" data-section="salud"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 6C 15 6, 18 8, 18 12C 18 16, 15 18, 12 18C 9 18, 6 16, 6 12C 6 8, 9 6, 12 6"fill="none"stroke="currentColor"stroke-width="2"/><path d="M12 9 L12 15 M9 12 L15 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>Salud de especies</a>
    <a href="" class="nav-link" data-section="especie"><img src="../Storage/iconos/fish-icon.png" alt="" class="icon">Especies</a>
    <a href="" class="nav-link" data-section="equipo"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><rect x="6" y="4" width="12" height="16" rx="2" fill="none" stroke="currentColor" stroke-width="2"/><path d="M4 8 L6 8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M18 8 L20 8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M10 12 C10 12, 12 10, 14 12" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="20" cy="10" r="1" fill="currentColor"/><circle cx="20" cy="12" r="1" fill="currentColor"/></svg>Equipos</a>
    
      <?php
    }else if($_SESSION['rol_id'] === 5){
      ?>
      <a href="" class="nav-link" data-section="equipo"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><rect x="6" y="4" width="12" height="16" rx="2" fill="none" stroke="currentColor" stroke-width="2"/><path d="M4 8 L6 8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M18 8 L20 8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M10 12 C10 12, 12 10, 14 12" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="20" cy="10" r="1" fill="currentColor"/><circle cx="20" cy="12" r="1" fill="currentColor"/></svg>Equipos</a>
    
    <a href="" class="nav-link" data-section="mantenimiento"><img src="../Storage/iconos/maintenance-icon.png" alt="" class="icon">Mantenimiento equipos</a>
  
      <?php

    }else{
?>
<a href="" class="nav-link" data-section="inventario"><img src="../Storage/iconos/inventory-icon.png" alt="" class="icon">Inventario</a>
    
    <a href="" class="nav-link" data-section="agua"><img src="../Storage/iconos/water-icon2.png" alt="" class="icon">Control de agua</a>
    
    <a href="" class="nav-link" data-section="alimentacion"><img src="../Storage/iconos/food-icon.png" alt="" class="icon">Alimentación</a>
    
    <a href="" class="nav-link" data-section="tanque"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="6" width="18" height="12" rx="2" fill="none" stroke="currentColor" stroke-width="2"/><path d="M8 13 C8 13, 10 10, 12 13 C14 10, 16 13, 16 13" fill="none" stroke="currentColor" stroke-width="2"/><path d="M5 18 C5 18, 6 15, 7 18" stroke="currentColor" stroke-width="2" fill="none"/><path d="M17 18 C17 18, 18 15, 19 18" stroke="currentColor" stroke-width="2" fill="none"/></svg>Tanque</a>
    
    <a href="" class="nav-link" data-section="salud"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 6C 15 6, 18 8, 18 12C 18 16, 15 18, 12 18C 9 18, 6 16, 6 12C 6 8, 9 6, 12 6"fill="none"stroke="currentColor"stroke-width="2"/><path d="M12 9 L12 15 M9 12 L15 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>Salud de especies</a>
    
    <a href="" class="nav-link" data-section="empleado"><img src="../Storage/iconos/users-icon.png" alt="" class="icon">Empleados</a>
    
    <a href="" class="nav-link" data-section="especie"><img src="../Storage/iconos/fish-icon.png" alt="" class="icon">Especies</a>
    
    <a href="" class="nav-link" data-section="equipo"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><rect x="6" y="4" width="12" height="16" rx="2" fill="none" stroke="currentColor" stroke-width="2"/><path d="M4 8 L6 8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M18 8 L20 8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M10 12 C10 12, 12 10, 14 12" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="20" cy="10" r="1" fill="currentColor"/><circle cx="20" cy="12" r="1" fill="currentColor"/></svg>Equipos</a>
    
    <a href="" class="nav-link" data-section="mantenimiento"><img src="../Storage/iconos/maintenance-icon.png" alt="" class="icon">Mantenimiento equipos</a>
  

<?php
    }
  ?>
    
    
</nav>

<script src="../../functions/aside.js"></script>