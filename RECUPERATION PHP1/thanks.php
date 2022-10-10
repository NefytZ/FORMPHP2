<?php require 'info.php' ?>
<?php
    if(isset($_POST['submit'])) {
echo ($_POST['firstname']) . ' ' . ($_POST['lastname']) . (" Merci de nous avoir contacté a propos de ") . ($_POST['subject']) . (" un de nos conseiller vous contactera soit à l’adresse ") . ($_POST['email']) . (" ou par téléphone au ") . ($_POST['number']) . (" dans les plus brefs délais pour traiter votre demande : ") . ($_POST['message'] ) ;       
}
?>