function toggleSidebar() {
    var sidebar = document.getElementById("sidebar");
    var content = document.getElementById("content");
    var icon = document.getElementById("sidebar-icon");
    sidebar.classList.toggle("collapsed");
    if (content) {
        content.classList.toggle("expanded");
    }
    if (sidebar.classList.contains("collapsed")) {
        if (icon) icon.src = "../../assets/img_misc/sidebar_open.png";
    } else {
        if (icon) icon.src = "../../assets/img_misc/sidebar_close.png";
    }
}