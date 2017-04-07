<?php

// $name = $title = $article = $required = "";

// $name = $_POST['name'];
// $title = $_POST['title'];
// $article = $_POST['article'];

//CONNEXION DE LA BASE DE DONNEES AVEC LE FORMULAIRE

try {
  $bdd = new PDO('mysql:host=localhost; dbname=gazette; charset=utf8', 'phpmyadmin', 'simplon');
}
catch (Exception $e) {
  print "Erreur!:" .$e->getMessage() . "<br";
  die();
}


//INSERTION D'UN NOUVEL ARTICLE DANS LA BDD

$req = $bdd->prepare('INSERT INTO post_articles (name, title, article) VALUES(:name, :title, :article)');




if (isset($_POST['button']) and strlen($_POST['article']) > 500 and !empty($_POST['title']) ){
  if(isset($_POST['name'], $_POST['title'], $_POST['article'] )){

  $req->execute(array(
    //DECLARATION DES VARIABLES RECUPEREES PAR POST DANQS LE FORMULAIRE

    'name'=>$_POST['name'],
    'title'=>$_POST['title'],
    'article'=>$_POST['article']
  ));

  echo 'Ton article a bien été envoyé.';
}
}else {
  echo "Le titre est requis ";
}

if(isset($_POST['button']) and strlen($_POST['article']) < 500 ){
  if(isset($_POST['name'], $_POST['article'] )){
  $req->execute(array(
  //DECLARATION DES VARIABLES RECUPEREES PAR POST DANQS LE FORMULAIRE

  'name'=>$_POST['name'],
  'title'=>$_POST['title'],
  'article'=>$_POST['article']
));
echo 'Ta brève a bien été envoyée!';
}
}


// if(empty($title)){
//   $required = "Un titre est requis pour ton article.";
// }


// else {
//   echo "Ta brève a bien été envoyée";
// }


?>

<!DOCTYPE html>
<html ng-app="artApp" ng-controller="testCtrl">
<head>
  <meta charset="utf-8">
  <title>Formulaire et BDD</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="">
  <form class="" action="" method="post">
    <fieldset>
      <legend>Formulaire</legend>
      <label for="name">Prénom Nom : </label>

      <input id="name" type="text" name="name" value="" placeholder="Prénom Nom" required>
      <label for="title">Titre : </label>
      <input id="title" type="text" name="title" value="" placeholder="Titre">
      <!-- <span> <?php echo $required; ?></span> -->
      <textarea maxlength="2000" name="article" rows="8" cols="80" placeholder="Écris ton article ici :" ></textarea>
      <button type="submit" name="button">Envoyer</button>


    </fieldset>

  </form>

</body>
</html>
