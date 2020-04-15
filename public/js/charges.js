function getFile() {
    document.getElementById("upfile").click();
}

function sub(obj) {
    var file = obj.value;
    var fileName = file.split("\\");
    document.getElementById("addFileButton").innerHTML = fileName[fileName.length - 1];
}

$(function() {
    $('[data-toggle="tooltip"]').tooltip()
})

/* Charges -> Option File */
var chargeDiv = document.getElementsByClassName('charge-div');

for (var i = 0; i < chargeDiv.length; i++) {
    chargeDiv[i].onmouseover = function() {
        var optionButton = this.getElementsByClassName('option-button');
        optionButton[0].style.opacity = "1";
    }
}

for (var i = 0; i < chargeDiv.length; i++) {
    chargeDiv[i].onmouseout = function() {
        var optionButton = this.getElementsByClassName('option-button');
        optionButton[0].style.opacity = "0";
    }
}
