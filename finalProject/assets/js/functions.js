function selectPage(selected, url, toReload) {
    var dataToSend = new FormData();
    dataToSend.append("selected", selected);

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            console.log(document.getElementById(toReload).innerHTML);

            document.getElementById(toReload).innerHTML = xmlHttp.responseText;
        }
    }

    xmlHttp.open("POST", url, true);
    xmlHttp.send(dataToSend);
}

