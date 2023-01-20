<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href='assets/index.css'>
    <title>여명문고</title>
</head>
<body>
    <h1>여명문고</h1>
    <h2 id="clock"></h2>
    
    <hr>
    @yield('content')
    <script src="http://code.jquery.com/jquery-latest.js"></script> 
    <script src="assets/clock.js"></script>
</body>
</html>