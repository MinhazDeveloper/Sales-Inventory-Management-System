function toggleDropdown() {
    const menu = document.getElementById("userDropdown");
    menu.style.display = menu.style.display === "block" ? "none" : "block";
}

// Optional: Close dropdown when clicking outside
document.addEventListener("click", function(event) {
    const dropdown = document.getElementById("userDropdown");
    const avatar = document.querySelector(".user-avatar-wrapper");

    if (!avatar.contains(event.target)) {
        dropdown.style.display = "none";
    }
});

