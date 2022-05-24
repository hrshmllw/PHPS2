<?php
session_start();

if(isset($_SESSION["email"])){
    $email = $_SESSION["email"];
} else{
    echo "<script>window.location.href='../';</script>";
}

include("../connections.php");
include("nav.php");

$check = $checkErr = "";

if(isset($_POST["btn_submit"])){
    if(empty($_POST["check"])){
        $checkErr = "Select at least one (1).";
    } else{
        $check = $_POST["check"];
    }

    if($check){
        echo "<br><br>";
        foreach($check as $new_check){
            echo $new_check . "<br>";
        }
    }
}
?>

<br>
<hr>

<form method="POST">
    <span class="error"><?php echo $checkErr; ?></span>
    <br>
    <input type="checkbox" name="check[]" value="Pale Pilsen">Pale Pilsen
    <br>
    <input type="checkbox" name="check[]" value="San Mig Super Dry ">San Mig Super Dry
    <br>
    <input type="checkbox" name="check[]" value="Red Horse">Red Horse
    <br>
    <input type="checkbox" name="check[]" value="Colt 45">Colt 45
    <br>
    <input type="checkbox" name="check[]" value="Tiger Black">Tiger Black
    <br>
    <input type="checkbox" name="check[]" value="Jim Bean">Jim Beam
    <br>
    <input type="checkbox" name="check[]" value="Glenfiddich">Glenfiddich
    <br>
    <input type="checkbox" name="check[]" value="Black Label">Black Label
    <br>
    <input type="checkbox" name="check[]" value="Chivas Regal">Chivas Regal
    <br>
    <input type="checkbox" name="check[]" value="Hennessy">Hennessy
    <br>
    <input type="submit" name="btn_submit" value="Submit">
</form>

<hr>

<script type="text/javascript">
    var Category = {
        "Car": ["Toyota", "Hyundai", "Ford", "Kia", "Honda", "Subaru", "Jeep", "Lexus", "Mazda", "Nissan"],
        "Motorcycle": ["Honda", "Yamaha", "Suzuki", "Kawasaki", "BMW", "Ducati", "Triumph", "KTM", "Harley Davidson", "Aprilia"],
        "Food": ["Spaghetti", "Tortilla", "Croissant", "Tofu", "Ramen", "Taco", "Burger", "Sushi", "Hotdog", "Pizza"],
        "Juice": ["Orange", "Apple", "Mango", "Cranberry", "Watermelon", "Calamansi", "Grape", "Pineapple", "Coconut", "Iced tea"],
        "Beer": ["Pale Pilsen", "Red Horse", "Colt 45", "Tiger Black", "Corona", "Budweiser", "Heineken", "Asahi", "Guinness", "Stella Artois"],
        "Liquor": ["Johnnie Walker", "Smirnoff", "Hennessy", "Jack Daniel's", "Bacardi", "Absolut", "Captain Morgan", "Chivas Regal", "Grey Goose", "Jagermeister"],
        "Shoes": ["Nike", "Reebok", "Adidas", "Puma", "Skechers", "New Balance", "Vans", "ASICS", "Fila", "Converse"],
        "Sports": ["Football", "Badminton", "Hockey", "Volleyball", "Basketball", "America Football", "Tennis", "Golf", "Baseball", "Table Tennis"],
        "Clothes": ["Louis Vuitton", "Hermes", "Gucci", "Zalando", "Tiffany & Co.", "Zara", "H&M", "Cartier", "Moncler", "Chanel"],
        "Phone": ["Apple", "Samsung", "Google", "Huawei", "OnePlus", "Xiaomi", "LG", "Oppo", "Vivo", "Nokia"]
    }

    function category(value){
        if(value.length == 0){
            document.getElementById("choice").innerHTML = "<option>---</option>";
        } else{
            var category_options = "";

            for(category_name in Category[value]){
                category_options += "<option name='choice' value='" + Category[value][category_name] +"'>" + Category[value][category_name] + "</option>";
            }

            document.getElementById("choice").innerHTML = category_options;
        }
    }
</script>

<select name="category" id="category" onchange="category(this.value);">
    <option name="category" value="">Click to select category</option>
    <option name="category" value="Car">Car</option>
    <option name="category" value="Motorcycle">Motorcycle</option>
    <option name="category" value="Food">Food</option>
    <option name="category" value="Juice">Juice</option>
    <option name="category" value="Beer">Beer</option>
    <option name="category" value="Liquor">Liquor</option>
    <option name="category" value="Shoes">Shoes</option>
    <option name="category" value="Sports">Sports</option>
    <option name="category" value="Clothes">Clothes</option>
    <option name="category" value="Phone">Phone</option>
</select>

<select name="choice" id="choice">
    <option name="choice" value="">Select Category</option>
</select>