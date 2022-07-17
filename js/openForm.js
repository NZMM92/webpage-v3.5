function openForm(tabName) {
    var i;
    var x = document.getElementsByClassName('formPages');
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    document.getElementById(tabName).style.display = "block";
}