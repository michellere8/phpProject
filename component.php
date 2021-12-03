<?php

function component($pinName, $pinImage, $pinId){
    $element =" <div class='col-md-3 col-sm-6 my-3 my-md-0'>
    <form action='' method='post'>
            <div class='card shadow'>
                <img src='$pinImage' alt='image1' class='img-fluid card-img-top'>
            <div class='card-body'>
                <h2 class='title'>$pinName</h2>
                <button type='submit' name='pin' class='btn btn-danger'><i class='fas fa-thumbtack'></i></button>
                <input type='hidden' name='pin_id' value='$pinId'>
            </div>
            </div>
        </form>
    </div>";
    echo $element;
}

function pinboard($pinName, $pinImage, $pinId){
    $element= "  <div class='col-md-3 col-sm-6 my-3 my-md-0'>
    <form action='' method='post'>
            <div class='card shadow'>
                <img src='$pinImage' alt='image1' class='img-fluid card-img-top'>
            <div class='card-body'>
                <h2 class='title'>$pinName</h2>
                <button type='submit' class='btn btn-warning mx-2' name='remove'>Remove<i class='fas fa-thumbtack'></i></button>
                <input type='hidden' name='pin_id' value='$pinId'>
            </div>
            </div>
        </form>
    </div>";
    echo $element;
}


?>