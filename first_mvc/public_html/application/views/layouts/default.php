<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php echo $title; ?></title>
        <link href="/first_mvc/public_html/public/styles/bootstrap.css" rel="stylesheet">
        <link href="/first_mvc/public_html/public/styles/main.css" rel="stylesheet">
        <link href="/first_mvc/public_html/public/styles/font-awesome.css" rel="stylesheet">
        <script src="/first_mvc/public_html/public/scripts/jquery.js"></script>
        <script src="/first_mvc/public_html/public/scripts/form.js"></script>
        <script src="/first_mvc/public_html/public/scripts/popper.js"></script>
        <script src="/first_mvc/public_html/public/scripts/bootstrap.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="/first_mvc/public_html/index.php">Я есть блог</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/first_mvc/public_html/about">Обо мне</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/first_mvc/public_html/contact">Обратная связь</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <?php echo $content; ?>
        <hr>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        <ul class="list-inline text-center">                            
                            <li class="list-inline-item">
                                <a href="https://vk.com/ilya20029" target="_blank">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-vk fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="/" target="_blank">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <p class="copyright text-muted">&copy; 2020, Курсовой проект MVC</p>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>