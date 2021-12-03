<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href = "./assets/styles.css" rel="stylesheet">
    <script defer src="./assets/script.js"></script>
</head>

<body>
  <?php 
    session_start();
    if(isset($_POST["singIn"])){
     
      $_SESSION["email"]= trim(strtolower($_POST["email"]));
      $passWord = md5($_POST["pass"]);
      
      include './includes/database.php';
      $checkQuery = "SELECT * FROM users WHERE email = '{$_SESSION["email"]}' AND password = '$passWord";
      $loginResult = $con -> query($checkQuery); 
      if ($loginResult -> num_rows >0){
        $user = $loginResult -> fetch_assoc();
        $_SESSION["fullName"] = $user["fullName"];
        $_SESSION["userId"] = $user["userId"];
        $_SESSION["userphoto"]= $user["photoname"];
        header('location: ./profile.php');
      }else {
        $_SESSION["loginError"] = " The email or password you enteres is incorrect.";
      }
      $con -> close();
    }
  
  ?>
    <main >
      <section class="sngupBox">
      <img class="index" src="./img/login.jpg">
      

      <form id="login_form">
        <h1 class="ftitle">Log In</h1>
  <input type="text" name="email" placeholder="Email.." />
  <input type="text" name="pass" placeholder="Password.." />
  <fieldset>
  <input type="checkbox" id="check"/>
  <label id="checklabel" for="check"></label><span>Remember me</span></fieldset>
  <input type="submit" id="logIn" value="Log in.."/><br><br>
  <p> Not a member? <a href="signup.php" id="singIn">Sign up</a></p>
</form>


</section>
    </main>
    
</body>
</html>