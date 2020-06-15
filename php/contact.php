<?php
$array = array("firstname" => "", "name" => "", "email" => "", "telephone" => "",  "message" => "",  "firstnameError" => "",  "nameError" => "",  "emailError" => "",  "telephoneError" => "",  "messageError" => "", "isSuccess" => false);
$isSuccess = false;
$emailTo = "yvanta3@gmail.com"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $array["firstname"] = verifyInputs($_POST["firstname"]);
    $array["name"] = verifyInputs($_POST["name"]);
    $array["email"] = verifyInputs($_POST["email"]);
    $array["telephone"] = verifyInputs($_POST["telephone"]);
    $array["message"] = verifyInputs($_POST["message"]);
    $array["isSuccess"] = true;
    $emailText = "";

    if (empty($array["firstname"])) {
        $array["firstnameError"] = "Un pseudo ou un prénom d'usage peut aussi faire l'affaire :)";
        $isSuccess = false;
    } else
        $emailText .= "Firstname: {$array["firstname"]}\n";

    if (empty($array["name"])) {
        $array["nameError"] = "Un pseudo ou un nom d'usage sinon peut-être ?";
        $array["isSuccess"] = false;
    } else
        $emailText .= "Name: {$array["name"]}\n";

    if (!isEmail($array["email"])) {
        $array["emailError"] = "Avec un email valide, je pourrais te répondre !";
        $array["isSuccess"] = false;
    } else
        $emailText .= "Email: {$array["email"]}\n";

    if (!isPhone($array["telephone"])) {
        $array["telephoneError"] = "Non valide : chiffres et espaces seulement !";
        $array["isSuccess"] = false;
    } else
        $emailText .= "Telephone: {$array["telephone"]}\n";

    if (empty($array["message"])) {
        $array["messageError"] = "Rien à dire finalement... ?";
        $array["isSuccess"] = false;
    } else
        $emailText .= "Message: {$array["message"]}\n";


    if ($array["isSuccess"]) {
        $headers = "From: {$array["firstname"]} {$array["name"]} <{$array["email"]}> \r\nReply-To: {$array["email"]}";
        mail($emailTo, "Un message de votre site", $emailText, $headers);
    }

    echo json_encode($array); 
}

function isEmail($var)
{
    return filter_var($var, FILTER_VALIDATE_EMAIL);
}

function isPhone($var)
{
    return preg_match("/^[0-9 ]*$/", $var);
}

function verifyInputs($var)
{
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);
    return $var;
}
