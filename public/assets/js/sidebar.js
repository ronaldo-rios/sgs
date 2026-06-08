const sidebar = document.getElementById('sidebar')
const sidebarToggle = document.getElementById('sidebar-toggle')

if (sidebar && sidebarToggle) {
    sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('active')
    })
}
