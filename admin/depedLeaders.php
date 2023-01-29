<div class="card">
    <div class="card-header">
        <?php
            $title = 'UPDATE DEPED LEADERS';

            require_once('./tableHeader.php');
        ?>
    </div>
    <div class="container text-center justify-center items-center mt-5 mb-5">
        <div class="row mb-5">
            <div class="col flex justify-center items-center">
                <div class="card w-60 hover:border-2 hover:border-gray-500 focus:outline-none cursor-pointer">
                    <div onclick="depedObj.modalValue(1)" data-toggle="modal" data-target="#depedLeadersModal" class="border-8 border-double rounded-lg border-red-900">
                        <img id="imgPosition1" class="card-img-top rounded max-w-full h-48 align-middle">
                        <div class="card-body">
                            <h5 class="card-title" id="namePosition1"></h5>
                            <p class="card-title" id="rolePosition1"></p>
                        </div>  
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col flex justify-center items-center">
                <div class="card w-60 hover:border-2 hover:border-gray-500  focus:outline-none cursor-pointer">
                    <div onclick="depedObj.modalValue(2)" data-toggle="modal" data-target="#depedLeadersModal" class="border-8 border-double rounded-lg border-red-900">
                        <img id="imgPosition2" class="card-img-top rounded max-w-full max-h-48 align-middle">
                        <div class="card-body">
                            <h5 class="card-title" id="namePosition2"></h5>
                            <p class="card-title" id="rolePosition2"></p>
                        </div>  
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col flex justify-center items-center">
                <div class="card w-60 hover:border-2 hover:border-gray-500  focus:outline-none cursor-pointer">
                    <div onclick="depedObj.modalValue(3)" data-toggle="modal" data-target="#depedLeadersModal" class="border-8 border-double rounded-lg border-red-900">
                        <img id="imgPosition3" class="card-img-top rounded max-w-full h-48 align-middle">
                        <div class="card-body">
                            <h5 class="card-title" id="namePosition3"></h5>
                            <p class="card-title" id="rolePosition3"></p>
                        </div>  
                    </div>
                </div>
            </div>

            <div class="col flex justify-center items-center">
                <div class="card w-60 hover:border-2 hover:border-gray-500  focus:outline-none cursor-pointer">
                    <div onclick="depedObj.modalValue(4)" data-toggle="modal" data-target="#depedLeadersModal" class="border-8 border-double rounded-lg border-red-900">
                        <img id="imgPosition4" class="card-img-top rounded max-w-full h-48 align-middle">
                        <div class="card-body">
                            <h5 class="card-title" id="namePosition4"></h5>
                            <p class="card-title" id="rolePosition4"></p>
                        </div>  
                    </div>
                </div>
            </div>

            <div class="col flex justify-center items-center">
                <div class="card w-60 hover:border-2 hover:border-gray-500  focus:outline-none cursor-pointer">
                    <div onclick="depedObj.modalValue(5)" data-toggle="modal" data-target="#depedLeadersModal" class="border-8 border-double rounded-lg border-red-900">
                        <img id="imgPosition5" class="card-img-top rounded max-w-full h-48 align-middle">
                        <div class="card-body">
                            <h5 class="card-title" id="namePosition5"></h5>
                            <p class="card-title" id="rolePosition5"></p>
                        </div>  
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col flex justify-center items-center">
                <div class="card w-60 hover:border-2 hover:border-gray-500  focus:outline-none cursor-pointer">
                    <div onclick="depedObj.modalValue(6)" data-toggle="modal" data-target="#depedLeadersModal" class="border-8 border-double rounded-lg border-red-900">
                        <img id="imgPosition6" class="card-img-top rounded max-w-full h-48 align-middle">
                        <div class="card-body">
                            <h5 class="card-title" id="namePosition6"></h5>
                            <p class="card-title" id="rolePosition6"></p>
                        </div>  
                    </div>
                </div>
            </div>

            <div class="col flex justify-center items-center">
                <div class="card w-60 hover:border-2 hover:border-gray-500  focus:outline-none cursor-pointer">
                    <div onclick="depedObj.modalValue(7)" data-toggle="modal" data-target="#depedLeadersModal" class="border-8 border-double rounded-lg border-red-900">
                        <img id="imgPosition7" class="card-img-top rounded max-w-full h-48 align-middle">
                        <div class="card-body">
                            <h5 class="card-title" id="namePosition7"></h5>
                            <p class="card-title" id="rolePosition7"></p>
                        </div>  
                    </div>
                </div>
            </div>

            <div class="col flex justify-center items-center">
                <div class="card w-60 hover:border-2 hover:border-gray-500  focus:outline-none cursor-pointer">
                    <div onclick="depedObj.modalValue(8)" data-toggle="modal" data-target="#depedLeadersModal" class="border-8 border-double rounded-lg border-red-900">
                        <img id="imgPosition8" class="card-img-top rounded max-w-full h-48 align-middle">
                        <div class="card-body">
                            <h5 class="card-title" id="namePosition8"></h5>
                            <p class="card-title" id="rolePosition8"></p>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<!--/Class Modal-->
<?php require('modals/depedLeaders_modal.php');?>
  <!-- sweetalert -->
<script src="../assets/js/sweetAlert.js"></script>
<script src="../assets/js/depedLeaderForm.js"></script>