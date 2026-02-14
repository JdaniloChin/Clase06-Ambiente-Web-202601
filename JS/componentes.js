// Componente de navegación
function createNavbar(activePage) {
    const menuItems = [
        { text: 'Inicio', href: './home.html', page: 'home' },
        { text: 'Usuarios', href: './usuarios.html', page: 'usuarios' },
        { text: 'Productos', href: './inventarios.html', page: 'inventarios' },
        { text: 'Ventas', href: './ventas.html', page: 'ventas' },
        { text: 'Reportes', href: '#', page: 'reportes' },
        { text: 'Configuración', href: '#', page: 'configuracion' }
    ];

    const navHTML = `
        <aside class="col-md-3 bg-dark text-white p-4">
            <h4 class="mb-4">Menú</h4>
            <ul class="nav flex-column">
                ${menuItems.map(item => `
                    <li class="nav-item">
                        <a class="nav-link text-white ${activePage === item.page ? 'active' : ''}" 
                           href="${item.href}">
                            ${item.text}
                        </a>
                    </li>
                `).join('')}
            </ul>
        </aside>
    `;

    return navHTML;
}

// Componente de footer
function createFooter() {
    return `
        <footer class="text-center mt-3">
            <p>&copy; ${new Date().getFullYear()} - Desarrollado por AWCS - Universidad Fidélitas</p>
        </footer>
    `;
}

// Función para inicializar el layout
function initLayout(pageName) {
    const init = function() {
        const mainRow = document.getElementById('main-row');
        
        if (mainRow) {
            // Insertar el navbar al principio del row
            mainRow.insertAdjacentHTML('afterbegin', createNavbar(pageName));
            
            // Insertar el footer al final del row
            mainRow.insertAdjacentHTML('beforeend', createFooter());
        }
    };

    // Si el DOM ya está cargado, ejecutar inmediatamente
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
}