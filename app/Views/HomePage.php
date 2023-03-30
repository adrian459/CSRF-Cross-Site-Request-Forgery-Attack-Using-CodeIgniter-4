<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
    <h3>Login Success</h3>
    <img src="https://i.pinimg.com/564x/c4/7f/b4/c47fb4211682a1cfde01d3a085e5e4e1.jpg" alt="">
    <br>
    <br>
    <br>
    <form action="<?php echo base_url('ExecutePost')?>" method="post">
        <input type="hidden" name="username" value="Tanida">
        <input type="hidden" name="password" value="Fuadi">
        <button class="btn btn-primary" type="submit">See My Page</button>
    </form>
</body>
</html>