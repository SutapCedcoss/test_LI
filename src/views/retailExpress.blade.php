<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Retail Express</title>
</head>

<body>
  <h1>Retail Express</h1>
  <form action="" method="post">
    @csrf
    <label>Name</label>
    <input type="text" name="name">
    <label>Email</label>
    <input type="email" name="email">
    <input type="submit" value="submit">

  </form>
</body>

</html>
