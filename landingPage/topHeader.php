<?php require_once('./php/init.php'); ?>

<div class="relative flex items-center justify-center h-screen mb-12 overflow-hidden bg-opacity-50 bg-black">

    <div class="container-fluid h-screen text-center bg-opacity-50 bg-black relative z-30 p-10" style="background:rgba(0,0,0,0.5);">
        <div class="row pt-20">
            <div class="col-sm-2">
                <span class="inline-block align-middle mt-3">
                    <a href="index.php">
                        <img class="bg-opacity-25 img-responsive inline w-44 h-42 rounded-full" src="<?php echo tableHeader()[0];?>" />
                    </a>
                </span>
            </div>
            <div class="col-sm-8 text-white font-shadow grid grid-flow-row auto-rows-max md:auto-rows-min mt-5 text-center display-3">
                <?php echo (isset($title)) ? $title : '';?>
            </div>
            <div class="col-sm-2 mb-3">
                <span class="inline-block align-middle mt-3">
                    <a href="index.php">
                        <img class="bg-opacity-25 img-responsive inline w-44 h-42 rounded-full" src="<?php echo tableHeader()[1];?>" />
                    </a>
                </span>       
            </div>
        </div>
    </div>
           
  <img class="absolute z-10 w-auto min-w-full min-h-full max-w-none" id="imgSlideshow" />
    </div>


<script src="./assets/dynamic/slideshow.js"></script>