<?php

require_once "db.php";
require_once "app.php";

if(!empty($_POST))

{


    $status = array();
    $errors = array();

    if(emptyArray($_POST))

    {

        $errors['code_incomplet'] = "Votre code de validation est incomplet ou vide.";

    }

    if(!isNumber($_POST))

    {

        $errors['code_non_integer'] = "Votre code de validation doit contenir des nombres.";

    }


    if(empty($errors))

    {

            $inputCode = implode($_POST);

            $stmt = $db -> prepare("SELECT id FROM ho_confirmationcode WHERE confirmation_code = :inputCode");
            $stmt -> execute(array("inputCode" => $inputCode));
    
            $codeId = $stmt -> fetch();

            if ($codeId  === false)

            {

                $errors['code_invalide'] = "Votre code de validation est invalide.";
                $status['Failed'] = $errors;

                die(json_encode($status));

            }
    

            $stmt2 = $db -> prepare("UPDATE ho_users SET confirmed_email = 1 WHERE token_codeconfirmation = :token ");
            $stmt2 -> execute(array("token" => $codeId['id']));
    
            $stmt3 = $db -> prepare("DELETE FROM ho_confirmationcode WHERE id = :token");
            $stmt3 -> execute(array("token" => $codeId['id']));

            $status['Succes'] = "Votre code de validation est correct.";

            die(json_encode($status));

    }

    $status['Failed'] = $errors;

    echo(json_encode($status));
    
}