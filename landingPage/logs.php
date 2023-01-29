<?php
    $title = 'SCHOOL LOG';

    require_once('./landingPage/topHeader.php');
?>

<div class="container z-30 relative h-1/2 flex justify-center items-center -top-80">
    <div class="bg-white w-8/12 pb-5 rounded-3xl bg-white border-gray-400 border-2 p-9 -top-64 shadow">
    <div class="border-gray-200 border-2 rounded-b-3xl">
        <div class="alert alert-info text-center"><i class="fa fa-info"></i> <large><b>Scan your QrCode</large></div>
            <video width="400" 
           height="10" poster="./assets/images/poster.png" class="rounded-2xl w-full h-1/4" id="preview"></video> 
        </div>
            <div class="flex">
                <div class="w-full mt-4">
                    <button id="stopBtn" class="h-12 w-full hover:border-red-600 hover:bg-red-100 hover:text-red-900 tracking-wide text-lg text-white bg-red-900 py-2 rounded-xl border-red-900 border-2">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->
    <button type="button" id="btn-modal-visitors" class="hidden" data-toggle="modal" data-target="#visitorsModal">
    </button>

    <button type="button" id="btn-modal-info" class="hidden" data-toggle="modal" data-target="#infoModal">
    </button>

    <?php 
        require_once('modals/visitors_modal.php'); 
        require_once('modals/info_modal.php'); 
    ?>
    <script src="./assets/qr/main.js"></script>