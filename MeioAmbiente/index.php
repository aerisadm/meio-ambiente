<?php
include("path.php");
include(ROOT_PATH . "/app/controllers/topics.php");

$posts = array();
$postsTitle = 'Postagens recentes';

if (isset($_GET['t_id'])) {
  $posts = getPostsByTopicId($_GET['t_id']);

  $postsTitle = "Postagens com o tópico '" . $_GET['name'] . " '";
} else if (isset($_POST['search-term'])) {
  $postsTitle = "Você pesquisou por '" . $_POST['search-term'] . "'";
  $posts = searchPosts($_POST['search-term']);
} else {
  $posts = getPublishedPosts();
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Candal|Lora" rel="stylesheet">

  <!-- Custom Styling -->
  <link rel="stylesheet" href="assets/css/style.css">

  <title>Meio Ambiente</title>
</head>

<body>

  <?php include(ROOT_PATH . "/app/includes/header.php"); ?>
  <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>

  <div class="page-wrapper">

    <?php if (!isset($_GET['t_id']) && !isset($_POST['search-term'])) : ?>

      <div class="post-slider">

        <h1 class="slider-title">Notícias Populares</h1>
        <i class="fas fa-chevron-left prev"></i>
        <i class="fas fa-chevron-right next"></i>

        <div class="post-wrapper">

          <?php foreach ($posts as $post) : ?>
            <div class="post">
              <img src="<?php echo BASE_URL . '/assets/images/' . $post['image']; ?>" alt="" class="slider-image">
              <div class="post-info">
                <h4><a href="single.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h4>
                <i class="far fa-user"> <?php echo $post['username']; ?></i>
                &nbsp;
                <i class="far fa-calendar"> <?php echo date('j F, Y', strtotime($post['created_at'])); ?></i>
              </div>
            </div>
          <?php endforeach; ?>

        </div>

      </div>

    <?php endif; ?>

    <div class="content clearfix">

      <div class="main-content">
        <h1 class="recent-post-title"><?php echo $postsTitle ?></h1>

        <?php foreach ($posts as $post) : ?>
          <div class="post clearfix">
            <img src="<?php echo BASE_URL . '/assets/images/' . $post['image']; ?>" alt="" class="post-image">
            <div class="post-preview">
              <h2><a href="single.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
              <i class="far fa-user"> <?php echo $post['username']; ?></i>
              &nbsp;
              <i class="far fa-calendar"> <?php echo date('j F, Y', strtotime($post['created_at'])); ?></i>
              <p class="preview-text">
                <?php echo html_entity_decode(substr($post['body'], 0, 160) . '...'); ?>
              </p>
              <a href="single.php?id=<?php echo $post['id']; ?>" class="btn read-more">Ler Mais</a>
            </div>
          </div>
        <?php endforeach; ?>

      </div>
      <div class="sidebar">

        <div class="section search">
          <h2 class="section-title">Pesquisar</h2>
          <form action="index.php" method="post">
            <input type="text" name="search-term" class="text-input" placeholder="Pesquisar...">
          </form>
        </div>


        <div class="section topics">
          <h2 class="section-title">Tópicos</h2>
          <ul>
            <?php foreach ($topics as $topic) : ?>
              <li><a href="<?php echo BASE_URL . '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name'] ?>"><?php echo $topic['name']; ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>

      </div>

    </div>

  </div>


  <?php include(ROOT_PATH . "/app/includes/footer.php"); ?>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

  <script src="assets/js/scripts.js"></script>

</body>

</html>