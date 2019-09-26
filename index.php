<?php include('head.php'); ?>

<body>
    <?php include('menu.php'); ?>
    <main class="Main Dashboard">
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
                google.charts.load('current', {
                    'packages': ['corechart']
                });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var test = 60;
                    // var data = google.visualization.arrayToDataTable([
                    //     ['Heure', 'Humidité', 'Température'],
                    //     ['test', test, test]
                    // ]);
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'Topping');
                    data.addColumn('number', 'Humidté');
                    data.addColumn('number', 'Température');
                    data.addRows([
                        ['12:45:58', 30, 3],
                        ['12:46:58', 15, 60],
                        ['12:47:58', 80, 20]
                    ]);

                    var options = {
                        title: 'Company Performance',
                        hAxis: {
                            title: 'Heure',
                            titleTextStyle: {
                                color: '#FFF'
                            }
                        },
                        vAxis: {
                            minValue: 0
                        }
                    };

                    var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
                    chart.draw(data, options);

                    JSON.parse(json).Value.forEach(element => {



                        //console.log(element.Date);
                        date = "\'" + element.Date + "\'";
                        Humidite = parseInt(element.Pourcentage_Humidite);
                        Temperature = parseInt(element.Temperature);
                        data.addRow([date, 1005, 700]);
                        //var tab;
                        //tab = "[\'" + element.Date + "\'], [\'" + element.Temperature + "\'], [\'" + element.Temperature + "\']";
                        data.addRow(['test', Humidite, Temperature]);
                    });
                }
            }
        </script>
        <div id="chart_div"></div>




    </main>
</body>

</html>