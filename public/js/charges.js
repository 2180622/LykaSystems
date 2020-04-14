function getFile() {
    document.getElementById("upfile").click();
}

function sub(obj) {
    var file = obj.value;
    var fileName = file.split("\\");
    document.getElementById("addFileButton").innerHTML = fileName[fileName.length - 1];
}

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
