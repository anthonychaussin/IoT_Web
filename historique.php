<?php include('head.php'); ?>

<body>
    <?php include('menu.php'); ?>
    <main class="Main Historique">
        <h1 class="Dashboard-title">Dashboard</h1>
        <script> 
            function getHTTPPost(url, data, callback) {
                var b = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
                b.open('GET', url, true);
                b.onreadystatechange = function() {
                    if (b.readyState > 3 && b.status >= 200) {
                        callback(b.responseText);
                    }
                };
                b.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                b.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                b.send(data);
            }
            $url = 'http://iot2.floki.io/IoT_Web/API';


            var d = new Date();
            var StartDateTime = d.getFullYear() + "-" + d.getDate() + "-" + d.getDay() + " " + (d.getHours() - 1) + ":" + d.getMinutes() + ":" + d.getSeconds()
            var EndDateTime = d.getFullYear() + "-" + d.getDate() + "-" + d.getDay() + " " + d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds()
            getHTTPPost($url, encodeURI("Start_Datetime=" + StartDateTime + "&End_Datetime=" + EndDateTime), Display);
            console.log(encodeURI("Start_Datetime=" + StartDateTime + "&End_Datetime=" + EndDateTime));



            function Display(json) {

                JSON.parse(json).Value.forEach(element => {

                    //console.log(element.Date);
                    date = "\'" + element.Date + "\'";
                    Humidite = parseInt(element.Pourcentage_Humidite);
                    Temperature = parseInt(element.Temperature);
                    var s = new Set([date, Humidite, Temperature]);

                    var node = document.createElement("li"); // Create a <li> node
                    var textnode = document.createTextNode("Date : "+ element.Date + " - Humidité : " +  Humidite +" - Température :" + Temperature); // Create a text node
                    node.appendChild(textnode); // Append the text to <li>
                    document.getElementById("myList").appendChild(node); // Append <li> to <ul> with id="myList"

                });

            }
        </script>
        <ul id="myList"></ul>

    </main>
</body>

</html>