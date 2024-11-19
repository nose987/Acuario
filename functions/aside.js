document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.nav-link');
    const sections = document.querySelectorAll('.cards-container');

    // Función para activar una sección
    function activateSection(sectionId) {
        // Ocultar todas las secciones
        sections.forEach(section => {
            section.classList.remove('active');
        });
        
        // Mostrar la sección seleccionada
        document.getElementById(sectionId + '-section').classList.add('active');
        
        // Actualizar el estado activo del menú
        navLinks.forEach(link => {
            if (link.dataset.section === sectionId) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });

        // Guardar la sección activa en localStorage
        localStorage.setItem('activeSection', sectionId);
    }

    // Agregar event listeners a los enlaces del menú
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            activateSection(link.dataset.section);
        });
    });

    // Restaurar la última sección activa
    const lastActiveSection = localStorage.getItem('activeSection') || 'inicio';
    activateSection(lastActiveSection);
});
