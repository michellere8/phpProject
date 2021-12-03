<?php 
require_once('./process/component.php');
include './includes/database.php';
include './includes/headercontent.php'; ?>
<main>
    <div class="container">
        <div class="row text-center py-5">
           <?php
         $result = $database -> getData();
         while($row = mysqli_fetch_assoc($result)){
             component($row['pin_name'], $row['pin_image'], $row['id']);
         }

          if(isset($_POST['pin'])){
              
             if(isset($_SESSION['posted'])){

               $item_array_id= array_column($_SESSION['posted'], column: 'pin_id');
               print_r($item_array_id);

               if(in_array($_POST['pin_id'], $item_array_id)){
                   echo "<script>alert('Pin is already added to your board!) </script>";
                   echo "<script>window.location ='' </script>";
               } else {
                   $count = count($_SESSION['posted']);
                   $item_array = array(
                    'pin_id'=> $_POST['pin_id']
                );
                $_SESSION['posted'][$count]= $item_array;
                print_r($_SESSION['posted']);
               }

             }else{
                 $item_array = array(
                     'pin_id'=> $_POST['pin_id']
                 );
                 $_SESSION['posted'][0] = $item_array;
                 print_r($_SESSION['posted']);
             }
          }
           ?>

          

           
        </div>
    </div>

</main>
<?php include './includes/footer.php';?>