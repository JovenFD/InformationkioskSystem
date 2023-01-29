<div class="container rounded-lg border-2 border-gray-200">
    <div class="card">
        <div class="card-header">
            <?php 
                $title = 'UPLOAD HEADER VIDEO';
                require('tableHeader.php');
            ?>
        </div>
            <div class="card-body">
            <form id="sliderDelForm">
                <div class="float-right mb-3">
                  <button type="button" data-placement="top" title="Upload Video" class="w-16 h-16 hover:border-blue-600 hover:bg-blue-100 hover:text-blue-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2" data-toggle="modal" data-target="#uploadVideoModal">
                    <i class="fas fa-upload text-2xl"></i>
                  </button>
                </div>   
                    <div class="table-responsive">

                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>VIDEO HEADER</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyVidoe">
                   
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
        
<!--/Slider Modal-->
<?php require('modals/videoHeader_modal.php');?>
  <!-- sweetalert -->
<script src="../assets/js/sweetAlert.js"></script>