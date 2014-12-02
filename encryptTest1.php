<?php
include 'dbConnect.php';

$key = hash("md5", "use this key");
$encryptAlgo = "blowfish";
$encryptMethode = "ecb";

function storeMessage($encryptedMessage, $iv, $myConnection) {

    $base64Message = base64_encode($encryptedMessage);
    $base64Iv = base64_encode($iv);
    $strSql = "INSERT INTO encryption (message, iv) VALUES ('" . $base64Message . "','". $base64Iv ."')";
    $myConnection->query($strSql);
    return $myConnection->insert_id;
}
?>
<h1>Encrypt message</h1>
<a href="decryptTest1.php">Read messages</a>
<form method="POST" style="margin: 10px 0px">
    <label>Message</label>
    <input type="text" name="message" />
    <input type="submit" value="Encrypt message" />
</form>
<?php
if($_POST)
{
    $td = mcrypt_module_open($encryptAlgo, "", $encryptMethode, "");
    $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_DEV_URANDOM);
    mcrypt_generic_init($td, $key, $iv);

    $message = $_POST["message"];
    $encryptedMessage = mcrypt_generic($td, $message);

    $messageId = storeMessage($encryptedMessage, $iv, $myConnection);

    mcrypt_generic_deinit($td);
    mcrypt_module_close($td);

    echo "Message: ". $message. "<br />";
    echo "Encrypted message: ". $encryptedMessage;
}
?>