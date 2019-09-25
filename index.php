<?php include('head.php'); ?>

<body>
    <?php include('menu.php'); ?>
    <main class="Main">
        <h1>Dashboard</h1>
        <script>
            function getHTTPPost(url, data, success) {
                var b = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
                b.open('GET', url, true);
                b.onreadystatechange = function() {
                    if (b.readyState > 3 && b.status >= 200) {
                        success(b.responseText);
                    }
                };
                b.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                b.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                b.send(data);
            }

            function getHTTPPost('/API', '', console.log);
        </script>



    </main>
</body>

</html>