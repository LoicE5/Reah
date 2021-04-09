<?php
// Modifier son profil
if (isset($_POST["modify_btn"])) {

    var_dump($_FILES["image"]['tmp_name']);
if ($_FILES["image"]['error'] == 0) {
echo "dog";
}
    // $content_dir = 'database/profile_pictures/';
    // $tmp_file = $_FILES['image']['tmp_name'];
    // var_dump($tmp_file);
    // if(!is_uploaded_file($tmp_file)) {
    //     exit("Le fichier est introuvable.");
    // }

    // $name_file = basename($_FILES['image']['name']);
    // var_dump($name_file);

    // if(!move_uploaded_file($tmp_file, $content_dir. $name_file)){
    //         exit("Impossible de copier le fichier dans notre dossier.");
    //     }
    //     echo"coucou";
        // $id = $_COOKIE['userid'];
        // // $profile_picture = $_POST['profile_picture'];
        // $banner = $_POST['banner'];
        // $name = addslashes($_POST['name']);
        // $website = $_POST['website'];
        // $bio = addslashes($_POST['bio']);
    
        // if (isset($_POST["profile_picture"]) && isset($_POST["banner"])) {
        //     $sql = "UPDATE users SET user_profile_picture2='$name_file', user_banner='$banner', user_name='$name', user_website='$website', user_bio='$bio' WHERE user_id='$id'";
        // } else if (isset($_POST["profile_picture"])) {
        //     $sql = "UPDATE users SET user_profile_picture2='$name_file', user_name='$name', user_website='$website', user_bio='$bio' WHERE user_id='$id'";
        // } else if (isset($_POST["banner"])) {
        //     $sql = "UPDATE users SET user_banner='$banner', user_name='$name', user_website='$website', user_bio='$bio' WHERE user_id='$id'";
        // } else {
        //     $sql = "UPDATE users SET user_name='$name', user_website='$website', user_bio='$bio' WHERE user_id='$id'";
        // }
    
        // $stmt = $db->prepare($sql);
    
        // $stmt->execute();
    
        // header('Location: profil.php');
}

?>

<form action="" method="post" enctype='multipart/form-data'>
    <input type="file" accept=".png,.jpeg,.jpg" class="" name="image">

    <input type="submit" name="modify_btn" value="Envoyer">
</form>
