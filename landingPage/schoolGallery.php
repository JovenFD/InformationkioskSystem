<link rel="stylesheet" href="./assets/lightbox/style.css">
<link href="./assets/css/gallery.css" rel="stylesheet">

<div class="container-fluid gallery-container">
    <h1 class="text-center">School Gallery</h1>
    <div class="tz-gallery">
        <div class="row">
            <?php require_once('./php/init.php'); GalleryView();?>
        </div>
    </div>

</div>

</div>
<script src="./assets/lightbox/main.js"></script>
<script>
    baguetteBox.run('.tz-gallery');
</script> 
