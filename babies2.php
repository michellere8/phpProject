<?php 
require_once('./process/component.php');
include './includes/database.php';
include './includes/headercontent.php'; ?>
<main>
    <div class="container">
        <div class="row text-center py-5">
           <?php
          component("Handleing Sick days", "./imgcontent/babyimg4.jpg");
          component("Simptoms to look for", "./imgcontent/babyimg5.jpg");
          component("When Baby is At Hospital", "./imgcontent/babyimg6.jpg");      

           ?>

          

           
        </div>
    </div>

</main>
<?php include './includes/footer.php';?>