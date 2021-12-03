<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href ="./assets/styles.css" rel = "stylesheet">
    <script defer src="./assets/script.js"></script>
</head>

<body>
  <?php 
   if(isset($_POST["signUp"])){
    $_SESSION["fullName"]= trim(strtolower($_POST["name"]));
    $_SESSION["email"]= trim(strtolower($_POST["email"]));
    $passWord = md5($_POST["pass"]);
    
    include './includes/database.php';

    $selectQuery = "SELECT email FROM users WHERE email = '{$_SESSION["email"]}' ";
    $result = $con -> query($selectQuery);
    if($result -> num_rows > 0){
      $_SESSION["signUpError"] = "This email has been already registered";
    } else {
    $insertQuery = "INSERT INTO users (userID, fullName, email, password) 
    VALUES (null, '{$_SESSION["fullName"]}', '{$_SESSION["email"]}', '$passWord' ) ";
     if ( $con -> query($insertQuery) === true){ 
      header('Location: ./profile.php');
      die();
    }
    }
    $con -> close();
} 
  ?>
    <main >
      <section class="sngupBox">
      <img class="index" src="./img/login.jpg">
      <img class="index2" src="./img/login2.jpg">
      <form id="login_form">
        <h1 class="ftitle">Sign Up</h1>
      <input type="text" name="name" placeholder="Full Name.." />     
      <input type="text" name="email" placeholder="Email.." />
      <input type="text" name="pass" placeholder="Password.." />
    <fieldset>
     <input type="checkbox" id="check"/>
      <label id="checklabel" for="check"></label><span>Remember me</span></fieldset>
     <input type="submit" id="signUp" value="Sign Up.."/><br><br>
     <p> Already a member? <a href="login.php" id="signUp">Log In</a></p>
</form>


</section>
    </main>
    
</body>
</html>