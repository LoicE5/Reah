<?php 

if(!empty($_POST) && isset($_POST))

{

    require_once "db.php";
    require_once "app.php";

    $status = array();
    $errors = array();

    if($_POST['cgu'] !== 'accepted')

    {

        $errors['cgu'] = "Vos ne pouvez utiliser l'application sans accepter les cgu.";

    }

    if(empty($_POST['birth_year']) || empty($_POST['birth_month']) || empty($_POST['birth_day']))

    {

        $errors['birthday'] = "Votre anniversaire n'est pas valide car un des champs date n'a pas été rempli.";

    }

    $birth_year = $_POST['birth_year'];
    $birth_month = $_POST['birth_month'];
    $birth_day = $_POST['birth_day'];
    

    $birthday = "$birth_year-$birth_month-$birth_day";

    if(!checkdate($birth_month, $birth_day, $birth_year))

    {

        $errors['birthday'] = "Votre anniversaire n'est pas valide.";

    }


    if(empty($_POST['last_name']))

    {
        
        $errors['last_name'] = "Votre nom de famille n'est pas renseigné.";

    }

    if(empty($_POST['first_name']))

    {

        $errors['first_name'] = "Votre prénom n'est pas renseigné.";

    }



    if(empty($_POST['username']))

    {

        $errors['username'] = "Votre pseudo n'est pas renseigné.";

    }

    else

    {

        $stmt = $db -> prepare("SELECT id FROM ho_users WHERE username = :username");
        $stmt -> execute(array(
            
            "username" => $_POST['username']
        
        ));

        $user = $stmt -> fetch();

        if($user)

        {

            $errors['username'] = "Votre pseudo est déjà utilisé.";

        }

    }

    if(empty($_POST['email']))

    {

        $errors['email'] = "Votre email n'est pas renseigné.";

    }

    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))

    {

        $errors['email'] = "Votre email n'est pas valide.";

    }

    else

    {

        $stmt = $db -> prepare("SELECT id FROM ho_users WHERE email = :email");
        $stmt -> execute(array(
            
            "email" => $_POST['email']
        
        ));

        $user = $stmt -> fetch();

        if($user)

        {

            $errors['email'] = "Votre email est déjà utilisé.";

        }

    }

    if(empty($_POST['pswd']))

    {

        $errors['pswd'] = "Votre mot de passe n'est pas renseigné.";

    }

    if(!preg_match('/(?=.*[A-Za-z])(?=.*[A-Z])[A-Za-z\d@$!%*#?&\/\\\]{8,}$/', $_POST['pswd']))

    {

        $errors['pswd'] = "Votre mot de passe est invalide.";

    }

    if( $_POST['pswd'] !== $_POST['pswd_confirm'])

    {

        $errors['pswd'] = "Veuillez à ce que ces 2 champs soient identiques.";

    }

    if(empty($errors)) 
    
    {

        $password = password_hash($_POST['pswd'], PASSWORD_BCRYPT);
        $token = bin2hex(random_bytes (30));
        $code = generateCode();

        $stmt = $db -> prepare("INSERT INTO ho_users(last_name, first_name, username, birthday, email, password, cgu, token_codeconfirmation) VALUES (:last_name, :first_name, :username, :birthday, :email, :password, :cgu, :token_codeconfirmation)");
        $stmt2 = $db -> prepare("INSERT INTO ho_confirmationcode(id, confirmation_code) VALUES (:id, :confirmation_code)");

        $stmt -> execute(array(
            "last_name" => $_POST['last_name'],
            "first_name" => $_POST['first_name'],
            "username" => $_POST['username'],
            "birthday" => $birthday,
            "email" => $_POST['email'],
            "password" => $password,
            "cgu" => 1,
            "token_codeconfirmation" => $token
            
        ));
        $stmt2 -> execute(array(

            "id" => $token,
            "confirmation_code" => $code 

        ));

        $status['Success'] = "Votre compte a été crée avec succès.";
        $status['mail'] = strval($_POST['email']);

        mail($_POST['email'], 'Code de confirmation', 'Voici votre code de confirmation : '. $code.'.');

        die(json_encode($status));

    }

    $status['Failed'] = $errors;

    echo json_encode($status);

}

