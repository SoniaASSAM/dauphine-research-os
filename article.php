<?php
  if (session_status() == PHP_SESSION_NONE)
      session_start();

    if (empty($_GET)) {
      header('Location: index.php');
      exit();
    }
    if (!isset($_GET['article_id']) || $_GET['article_id'] == "") {
      header('Location: index.php');
      exit();
    }

  $article_id = $_GET['article_id'];
    $db = new PDO('mysql:host=localhost;dbname=dauphine_research_os;charset=utf8', 'root', '');
    
    function print_main_article($db,$article_id) {
      $sql_query = "SELECT title, discipline, article_owner, content
              FROM articles
              WHERE article_id=?";
      $query = $db->prepare($sql_query);
      $query->bindParam(1,$article_id);
      $query->execute();
      $result_articles = $query->fetch(PDO::FETCH_OBJ);
      $sql_query = "SELECT first_name, last_name
              FROM users
              WHERE user_id=?";
      $query = $db->prepare($sql_query);
      $query->bindParam(1,$result_articles->article_owner);
      $query->execute();
      $result_owner = $query->fetch(PDO::FETCH_OBJ);
      echo "<h4>".$result_articles->title."</h4>";
      echo "<h5>Discipline ".$result_articles->discipline."</h4>";
      echo "<h4>Par ".$result_owner->last_name." ".$result_owner->first_name."</h4>";
      $sql_query = "SELECT description FROM mainarticle WHERE article_id=?";
    }

    function print_hypothesis($db,$article_id) {
      $sql_query = "SELECT content
              FROM hypothesis
              WHERE article_id=?";
      $query = $db->prepare($sql_query);
      $query->bindParam(1,$article_id);
      $query->execute();
      $result_articles = $query->fetch(PDO::FETCH_OBJ);

      echo $result_articles['content'];
    }

    function print_experiences($db,$article_id) {
      $sql_query = "SELECT content
              FROM workflow
              WHERE article_id=?";
      $query = $db->prepare($sql_query);
      $query->bindParam(1,$article_id);
      $query->execute();
      $result_articles = $query->fetch(PDO::FETCH_OBJ);
      echo $result_articles['content'];
    }

     function print_results($db,$article_id) {
      $sql_query = "SELECT content
              FROM results
              WHERE article_id=?";
      $query = $db->prepare($sql_query);
      $query->bindParam(1,$article_id);
      $query->execute();
      $result_articles = $query->fetch(PDO::FETCH_OBJ);
      echo $result_articles['content'];
    }
?>

<!DOCTYPE html>
<html>
  <header>
    <head>
      <meta charset="UTF-8">
      <title>Article</title>
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css">
      <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Overpass:300,400,600,800'>
      
    </head>
  </header>

  <body>

    <div>
    <ul>
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="load.php">Chargements d'artciles </a></li>
        <li><a href="search.php">Rechercher un article</a></li>
        <li><a href="add_article.php">Publication d'articles</a></li>

    </ul>

</div>

<div class="container-index100" style=" background-image: url('images/bg-01.jpg'); " >

    <img src="images/logo.png" class="logo">
    <h1> Dauphine Research Academy</h1>
    <a href="index.html"><button class="DeconnexionB"> Déconnexion </button></a>

</div>
    <div class="tabset" name="tabsetDiv">
        <!-- Tab 1 -->
        <input type="radio" name="tabset" id="article" aria-controls="Article" checked>
        <label for="article">Article</label>
        <!-- Tab 2 -->
        <input type="radio" name="tabset" id="hypotheses" aria-controls="Hypothèses">
        <label for="hypotheses">Hypothèses</label>
        <!-- Tab 3 -->
        <input type="radio" name="tabset" id="experiences" aria-controls="Expérience">
        <label for="experiences">Expériences</label>
        <!-- Tab 4 -->
        <input type="radio" name="tabset" id="donnees" aria-controls="Données">
        <label for="donnees">Données</label>
        <!-- Tab 5 -->
        <input type="radio" name="tabset" id="conclusions" aria-controls="Conclusions">
        <label for="conclusions">Conclusions</label>
      
      <div class="tab-panels">
        <section id="Article" class="tab-panel">
          <h2>Article principal</h2>
          <?php print_main_article($db, $article_id);?>
        </section>
        <section id="hypotheses" class="tab-panel">
          <h2>Hypothèses</h2>
          <?php print_hypothesis($db, $article_id);?>
        </section>
      <section id="experiences" class="tab-panel">
        <h2>Expériences</h2>
        <?php print_experiences($db, $article_id);?>
      </section>
      <section id="donnes" class="tab-panel">
        <h2>Jeux de données</h2>
      </section>
      <section id="conclusions" class="tab-panel">
        <h2>Résultats et conclusions</h2>
        <?php print_results($db, $article_id);?>
      </section>
    </div>
  </body>
</html>