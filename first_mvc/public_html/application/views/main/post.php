<?php
	include $_SERVER['DOCUMENT_ROOT'].'/first_mvc/public_html/application/lib/helpers.inc.php';
?>
<header class="masthead" style="background-image: url('/first_mvc/public_html/public/materials/<?php echo $data['id']; ?>.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="page-heading">
                    <h1><?php htmlout($data['name']); ?></h1>
                    <span class="subheading"><?phphtmlout($data['description']); ?></span>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p><?php htmlout($data['text']); ?></p>
        </div>
    </div>
</div>