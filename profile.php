 <?php 
     session_start();
     if(!isset($_SESSION["email"])){
        $_SESSION["profileError"]= "You need to sign up or log in first";
        header('Location:./index.php');
         die();
     }
     if(isset($_POST["upload"])){
         $folder = "./userPhoto/";
         $_SESSION["userphoto"] = strtolower($folder . basename($_FILES["userpic"]["name"]));
       
         move_uploaded_file($_FILES["userpic"]["tmp_name"], $targetPath);
    
         include './includes/database.php';
         $updateuser = "UPDATE users SET photoname = '{$_SESSION["userphoto"]}' WHERE userid ={$_SESSION["userid"]}";
         $con -> query($updateuser);
     }
     require_once('./process/component.php');

     
     $selectmsg = "SELECT * FROM contacts WHERE userId = {$_SESSION['userId']}";
    
     $db = new CreateDb(dbname:'Pindb', tablename:'posttb');

     if(isset($_POST['remove'])){
        if($_GET['action']=='remove'){
            foreach($_SESSION['posted'] as $key => $value){
                if($value['pin_id']== $_GET['id']){
                    unset($_SESSION['posted'][$key]);
                    echo "<script>alert('Pin has been removed!')</script>";
                    echo "<script>window.location = 'profile.php'</script>";
                }
            }
        }
     }
     $con -> close();
     include './includes/header.php';
    ?>

<main class="box1">
    <section class="profileInf">
        <img id="userphoto" src="<?php 
            if (isset( $_SESSION["userphoto"])){
                echo  $_SESSION["userphoto"];
            }else{
                echo "./img/userphoto.png";
            }
          ?>" width="150 px">
        <form id="photoForm" action="./profile.php" method="post" enctype="multipart/form-data">
            <input type="file" name="userpic">
            <input class="btn btn-primary " type="submit" value="upload photo" name="upload">
        </form>
    <h1>Welcome to your profile <?php echo ucfirst($_SESSION["fulltName"]);?></h1>
</section>

    <!-- -----------Profile Content ------------- -->
    <section class="clips">
    <div class="container">
        <div class="row text-center py-5">
           <?php
          if(isset($_SESSION['posted'])){ 
              $pin_id = array_colum($_SESSION['posted'], column:'pin_id');
          $result = $db -> getData();
          while ($row = mysqli_fetch_assoc($result)){
              foreach($product_id as $id){
                  if($row['id']==$id){
                    pinboard($row['pin_image'],$row['pin_name']);
                  }
              }
          }
        }else{
            echo "<h5>You dont have any pins saved yet!</h5>";
        }
           ?>
           
        </div>
    </div>
    </section>

    <!-- ----------Profile contacts ------------- -->
    <section class="contact">
        <h1>Contacts</h1>
        <form id="searchBr" method="post" action="search.php">
            <input type="text" name="search">
            <input type="submit" name="submit" value=" Search "> 
        </form>
        <?php 
         include "database.php";
         $search = $_POST["search"];

        $query = "SELECT * FROM users Where email like '%$search%' OR fullName like '%$search%' 
        ORDER BY last ASC";
        if ($result = mysqli_query($connection, $query)){
            $count = mysqli_num_rows($result);
            $pageTitle = "Search Results";

            echo " <h2> search results</h2>
                    <h3> $count results found searching for '{$search}'</h3>
                    <table sellpadding = '15'>";
        
        while($row= mysqli_fetch_array($result)){
            $img = $row["img"];
            $fullName = $row["fullName"];
            $email = $row["email"];

            echo "<tr><td>
                        <form method='post' action='Add'>
                        <input type= 'hidden' name='' value=''>
                        <input type= 'submit' name='add' value='Add'>
                        </form>    
                        </td></tr>" ;
        }
    } else {
        echo "There was a problem with the search!";
    }
    $con -> close();
        ?>

    </section>
   
</main>
<?php include './includes/footer.php';?>