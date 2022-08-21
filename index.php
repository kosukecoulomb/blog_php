<?php
include 'lib/connect.php';
include 'lib/queryArticle.php';
include 'lib/article.php';

$limit = 5;
$page = 1;

if (!empty($_GET['page']) && intval($_GET['page']) > 0) {
    $page = intval($_GET['page']);
}

$queryArticle = new QueryArticle();
$pager = $queryArticle->getPager($page, $limit);
?>

<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            padding-top: 5rem;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

    <!-- Custom styles for this template -->
    <link href="./css/blog.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/blog/">My Blog</a>
        </div>
    </nav>

    <main class="container">
        <div class="row">
            <div class="col-md-8">

                <?php if ($pager['articles']) : ?>
                    <?php foreach ($pager['articles'] as $article) : ?>
                        <article class="blog-post">
                            <h2 class="blog-post-title">
                                <a href="view.php?id=<?php echo $article->getId() ?>">
                                    <?php echo $article->getTitle() ?>
                                </a>
                            </h2>
                            <p class="blog-post-meta"><?php echo $article->getCreatedAt() ?></p>
                            <?php echo nl2br($article->getBody()) ?>
                        </article>
                    <?php endforeach ?>
                <?php else : ?>
                    <div class=" alert alert-success">
                        <p>記事はありません。</p>
                    </div>
                <?php endif ?>

                <?php if (!empty($pager['total'])) : ?>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php for ($i = 1; $i <= ceil($pager['total'] / $limit); $i++) : ?>
                                <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                            <?php endfor ?>
                        </ul>
                    </nav>
                <?php endif ?>
            </div>

            <div class="col-md-4">
                <div class="p-4 mb-3 bg-light rounded">
                    <h4>ブログについて</h4>
                    <p class="mb-0">毎日のなんてことない日常を書いていきます。</p>
                </div>

                <div class="p-4">
                    <h4>アーカイブ</h4>
                    <ol class="list-unstyled mb-0">
                        <li><a href="#">2021/06</a></li>
                        <li><a href="#">2021/05</a></li>
                        <li><a href="#">2021/04</a></li>
                    </ol>
                </div>
            </div>

        </div><!-- /.row -->
    </main><!-- /.container -->

</body>

</html>
