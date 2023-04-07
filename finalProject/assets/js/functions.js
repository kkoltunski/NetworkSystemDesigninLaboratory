function selectPage(selected, url, toReload) {
    var dataToSend = new FormData();
    dataToSend.append("selected", selected);

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            console.log(xmlHttp.responseText);
            console.log("-------------------");
            console.log(document.getElementById(toReload).innerHTML);

            document.getElementById(toReload).innerHTML = xmlHttp.responseText;
            // var parser = new DOMParser();
            // var xmlDoc = parser.parseFromString(xmlHttp.responseText, "text/xml");
            // var tds = xmlDoc.getElementsByTagName(toReload);
            // document.getElementById(toReload).innerHTML = tds[0].innerHTML;
        }
    }

    xmlHttp.open("POST", url, true);
    xmlHttp.send(dataToSend);
}

