<!doctype html>

<Title>My Blog</Title>
<link rel="stylesheet" href="/app.css">

<body>
    <?php foreach ($posts as $post) : ?>
      <article>
         <?= $post; ?>
      </article>
    <?php endforeach; ?>
</body>