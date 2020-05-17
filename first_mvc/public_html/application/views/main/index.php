<?php
	include $_SERVER['DOCUMENT_ROOT'].'/first_mvc/public_html/application/lib/helpers.inc.php';
?>

<header class="masthead" style="background-image: url('/first_mvc/public_html/public/images/home.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>Блог студента из Екатеринбурга </h1>
                    <span class="subheading">простой блог на PHP - ООП - MVC</span>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <?php if (empty($list)): ?>
                <p>Список постов пуст</p>
            <?php else: ?>
                <?php foreach ($list as $val): ?>
                    <div class="post-preview">
                        <a href="/first_mvc/public_html/post/<?php echo $val['id']; ?>">
                            <h2 class="post-title"><?php htmlout($val['name']); ?></h2>
                            <h5 class="post-subtitle"><?php htmlout($val['description']); ?></h5>
                        </a>
                        <p class="post-meta">Идентфикатор этого поста <?php echo $val['id']; ?></p>
                    </div>
                    <hr>
                <?php endforeach; ?>
                <div class="clearfix">
                    <?php echo $pagination; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>