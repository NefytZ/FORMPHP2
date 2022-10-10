<?php

$subjects = [
    'Votre Compte' => 'Mon Compte',
    'Méthode de paiement' => 'Méthode de Paiement',
    'demande de remboursement' => 'Demande de Remboursement',
    'Information De livraison' => 'Information de livraison',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nettoyage

    // foreach($_POST as $key => $value) {
    //     $contact[$key] = trim($value);
    // }

    $contact = array_map('trim', $_POST);
//echo htmlentities($contact['firstname']);

    $confirm = ($_POST['firstname']) . ($_POST['lastname']) . (" Merci de nous avoir contacté a propos de ") . ($_POST['subject']) . (" Un de nos conseiller vous contactera soit à l’adresse ") . ($_POST['email']) . (" ou par téléphone au ") . ($_POST['number']) . (" dans les plus brefs délais pour traiter votre demande : ") . ($_POST['message'] );
    $notConfirm = 'le format n\'est pas valide';
    // Validation, gestion des erreurs
    $errors = [];

    if (empty($contact['firstname'])) {
        $errors[] = 'Le prénom est obligatoire';
    }

    $maxFirstnameLength = 80;
    if (strlen($contact['firstname']) > $maxFirstnameLength) {
        $errors[] = 'Le prénom doit faire moins de ' . $maxFirstnameLength . ' caractères';
    }
    if (empty($contact['lastname'])) {
        $errors[] = 'Le nom est obligatoire';
    }
    if (empty($contact['email'])) {
        $errors[] = 'L\'email est obligatoire';
    }

    if (!filter_var($contact['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Le format d\'email est incorrect';
    }

    $maxEmailLength = 255;
    if (strlen($contact['firstname']) > $maxEmailLength) {
        $errors[] = 'L\'email doit faire moins de ' . $maxEmailLength . ' caractères';
    }

    if (empty($contact['message'])) {
        $errors[] = 'Le message est obligatoire';
    }

    if(!key_exists($contact['subject'], $subjects)) {
        $errors[] = 'Le sujet est incorrect';
    }

 if (empty($contact['number'])) {
        $errors[] = 'Votre Numéro est obligatoire';
    }
if (!preg_match ("/^[0-9]*$/", $contact['number']) ){  
    $errors[] = "Only numeric value is allowed.";  
   


 if (empty($errors)) {


// traitement de mon form
// par ex: envoi d'un email
// ou insertion en BDD

// une fois le traitement terminé, redirection en GET
header("Location : info.php");
}

}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>Contact</h1>

    <form action="thanks.php" method="POST">
        <?php if (!empty($errors)) : ?>
            <ul class="error">
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <label for="my-firstname">Prénom</label>
        <input type="text" id="my-firstname" name="firstname" required value="<?= $contact['firstname'] ?? '' ?>">
        <label for="my-lastname">Nom</label>
        <input type="text" id="my-lastname" name="lastname" required value="<?= $contact['lastname'] ?? '' ?>">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required value="<?= $contact['email'] ?? '' ?>">
        <label for="number">Numéro de Portable</label>
        <input type="number" id="number" name="number" required value="<?= $contact['number'] ?? '' ?>">
        <label for="subject">Sujet</label>
        <select id="subject" name="subject">
            <?php foreach ($subjects as $subject => $subjectMessage) : ?>
                <option 
                    value="<?= $subject ?>"
                    <?php if(isset($contact['subject']) && $contact['subject'] === $subject) : ?>
                        selected
                    <?php endif; ?>                    
                >
                <?= $subjectMessage ?>
                </option>
            <?php endforeach; ?>
        </select>
        <label for="message">Message</label>
        <textarea name="message" id="message" cols="30" rows="10" required><?= $contact['message'] ?? '' ?></textarea>
        <button type="submit" name="submit">Submit</button>
    </form>
</body>

</html>






