// Custom upload file area
function getFile() {
    document.getElementById("upfile").click();
}

function sub(obj) {
    var file = obj.value;
    var fileName = file.split("\\");
    document.getElementById("addFileButton").innerHTML = fileName[fileName.length - 1];
}

// Tooltip
$(function() {
    $('[data-toggle="tooltip"]').tooltip()
})

// Context Menu
window.onclick = hideContextMenu;
var contextMenu = document.getElementById("contextMenu");

function showContextMenu() {
    contextMenu.style.display = "inline-block";
    contextMenu.style.left = event.clientX + 'px';
    contextMenu.style.top = event.clientY + 'px';
    return false;
}

function hideContextMenu() {
    contextMenu.style.display = "none";
}
