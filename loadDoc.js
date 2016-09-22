 //send option to php script
function loadDoc(choose, name) {
    if (choose.length == 0) {
        document.getElementById("optionContent").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("optionContent").innerHTML = this.responseText;
                document.getElementById("optionContent").style.display="block";
            }
        };
        xmlhttp.open("GET", "cmpgn.php?choose=" + choose+"&name="+name, true);
        xmlhttp.send();
    }
}
