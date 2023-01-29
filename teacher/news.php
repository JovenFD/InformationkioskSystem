<div class="container mb-2 text-black">
<div class="row">
    <div class="col">
        <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
            <?php require_once('../php/init.php'); newsTeacherPage();?>
            </div>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col">
            <a class="float-left" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                <i class="fas fa-caret-left text-4xl text-red-900 hover:text-red-500"></i>
            </a>
        </div>

        <div class="col">
            <a class="text-red-900 font-semibold hover:text-black w-full" href="" data-toggle="modal" data-target="#newsModal">
                <p class="text-center mt-1">Show All News</p>
            </a>
        </div>

        <div class="col">
            <a class="float-right" href="#carouselExampleIndicators2" role="button" data-slide="next">
                <i class="fas fa-caret-right text-4xl text-red-900 hover:text-red-500"></i>
            </a>
        </div>
    </div>
</div>

<?php require_once('modals/viewNews_Modal.php');?>

<script>
    const div = document.getElementById('item');
    div.classList.add('active');
</script>