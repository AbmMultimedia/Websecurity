<!DOCTYPE html>
<?php
$myConnection = new mysqli("localhost", "root", "", "websecurity");
$myConnection->set_charset("utf8");

if ($myConnection->connect_errno) {
    echo "Connecting to the database faild: " . $myConnection->connect_error . ". Error number: " . $myConnection->connect_errno;
}

function getUserDiscount($myConnection)
{
    $strSql = "SELECT discount FROM users WHERE id = 1";

    $result = $myConnection->query($strSql);
    $row = $result->fetch_row();
    $discount = $row[0];
    return $discount;
}

if ($_POST) {
   

    $strSql = "SELECT productPrice FROM products WHERE id = 1 ";
    $result = $myConnection->query($strSql);
    $row = $result->fetch_row();

    $price = $row[0];
    $discountPercent = getUserDiscount($myConnection);
    $totalPrice = $_POST["quantity"] * $price;
    $discount = $totalPrice * ($discountPercent/100);
    $discountPrice = $totalPrice - $discount;
    
    echo "<p>"
            ."<div>Normal price: $". $totalPrice ."</div>"
            ."<div>Discount: $". $discount ."</div>"
            ."<div>Your price $:". $discountPrice ."</div>"
        ."</p>";
} else {
    $discount = getUserDiscount($myConnection);
    
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title></title>
        </head>
        <body>
            <p>Buy phones for $400 </p>
            <form method="POST">
                <div>
                    <label>Numbers of phones</label>
                    <input name="quantity" type="number" />
                </div>
                <div>
                    <label>Discount in %</label>
                    <input type="number" name="discount" disabled value="<?php echo $discount ?>"/>
                </div>
                <input type="submit" value="buy" />
                <input name="price" type="hidden" value="400" />
            </form>
        </body>
    </html>
    <?php
}
?>