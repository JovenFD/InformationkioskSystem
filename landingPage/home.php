<div class="relative flex items-center justify-center h-screen overflow-hidden bg-opacity-50 bg-black">

    <div id="loading" class="container-fluid h-screen text-center bg-opacity-50 bg-black relative z-30 p-10" style="background:rgba(0,0,0,0.5);">
        <div class="row pt-48">
            <div class="col-sm-2">
                <span class="inline-block align-middle mt-3">
                    <a href="index.php">
                        <img class="bg-opacity-25 img-responsive inline w-44 h-42 rounded-full" id="Flogo" />
                    </a>
                </span>
            </div>
            <div class="col-sm-8 text-white font-shadow grid grid-flow-row auto-rows-max md:auto-rows-min mt-5 text-center display-3" id="titleHeader">
    
            </div>
            <div class="col-sm-2 mb-3">
                <span class="inline-block align-middle mt-3">
                    <a href="index.php">
                        <img class="bg-opacity-25 img-responsive inline w-44 h-42 rounded-full" id="Slogo" />
                    </a>
                </span>       
            </div>
        </div>
    </div>
           
  <video
    autoplay
    loop
    muted
    class="absolute z-10 w-auto min-w-full min-h-full max-w-none"
    id="videoHeader"
  >
  </video>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-8">
            <div class="border-t-4 border-red-900 m-4 rounded-xl"></div>
            <h3 class="mb-3 text-center">NEWS</h3>
            <?php require_once('news.php');?>
        </div>
        <div class="col">
            <div class="border-t-4 border-red-900 m-4 rounded-xl"></div>
            <h3 class="mb-3 text-center">SCHOOL EVENTS</h3>
            <?php require_once('events.php');?>
        </div>
    </div>
</div>

<?php require_once('schoolGallery.php');?>

<script src="./assets/js/displayVideoHeader.js"></script>
<script src="./assets/dynamic/logo.js"></script>
<script src="./assets/dynamic/title.js"></script> 