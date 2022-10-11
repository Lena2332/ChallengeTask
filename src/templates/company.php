<?php include_once  __DIR__.'/blocks/header.php'; ?>

<div class="container pb-10">
    <?php include_once  __DIR__.'/blocks/menu.php'; ?>

    <?php   if ( isset($_SESSION['success']) && $_SESSION['success'] !== '') { ?>
        <div class="alert alert-success alert-dismissible mt-5" role="alert">
            <?php echo $_SESSION['success']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php   } ?>

    <?php   if ( isset($_SESSION['warning']) && $_SESSION['warning'] !== '') { ?>
        <div class="alert alert-warning alert-dismissible mt-5" role="alert">
            <?php echo $_SESSION['warning']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php   } ?>

    <div class="container mt-5">
        <h1 class="text-center"><i class="fa-solid fa-briefcase"></i> <?php echo $data['title']; ?></h1>
        <div class="row mt-5">

            <?php include_once  __DIR__.'/blocks/'.$blockTemplate.'.php'; ?>

        </div>
    </div>
</div>
<div class="clearfix"></div>
<?php include_once  __DIR__.'/blocks/footer.php'; ?>

