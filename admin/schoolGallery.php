<div class="container rounded-lg border-2 border-gray-200">
    <div class="card">
        <div class="card-header">
            <?php 
                $title = 'UPLOAD SCHOOL IMAGE';
                require('tableHeader.php');
            ?>
        </div>
            <div class="card-body">
            <form id="galleryForm">
                <div class="float-right mb-3">
                  <button type="submit" data-toggle="tooltip" data-placement="top" title="Remove All" class="w-16 h-16 hover:border-red-600 hover:bg-red-100 hover:text-red-600 tracking-wide text-lg text-white bg-red-400  py-2 rounded-full border-red-500 border-2">
                    <i class="far fa-trash-alt text-2xl"></i>
                  </button>

                  <button type="button" data-placement="top" title="Add New Images" class="w-16 h-16 hover:border-green-600 hover:bg-green-100 hover:text-green-600 tracking-wide text-lg text-white bg-green-400 py-2 rounded-full border-green-500 border-2" data-toggle="modal" data-target="#galleryAddModal">
                    <i class="fa fa-plus text-2xl"></i>
                  </button>
                </div> 

                <div class="float-left mb-3">
                    <select id="limitgallery" class="border-2 border-gray-200 w-16 h-16 w-16 rounded-full text-lg focus:shadow focus:outline-none text-black">
                        <option value="5">5</option>
                        <?php 
                            for ($i=1; $i < 11; $i++) { 
                                echo '<option value="'.($i*10).'">'.($i*10).'</option>';
                            }
                        ?>
                    </select>
                </div>  
                    <div class="table-responsive">

                        <table class="table table-bordered text-center text-lg">
                            <thead>
                                <tr>
                                    <th><input class="w-5 h-5" type="checkbox" id="imgCheckAll">
                                    </th>
                                    <th>#</th>
                                    <th>Filename</th>
                                    <th>Images</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbodygallery">
                            </tbody>
                        </table>

                    </div>
                </form>

                <div class="justify-center max-w-full mt-3">

                <div class="flex justify-center space-x-1 mr-2 ml-5">
                    <div id="prevgallery" class="flex items-center px-4 py-2 text-gray-500 bg-gray-300 rounded-md hover:bg-blue-100 border-solid border-2  border-gray-400">
                        <i class="fas fa-angle-double-left text-xl"></i>
                    </div>

                    <div class="flex overflow-x-auto max-w-7xl">
                        <div id="gallery-btn-pages" class="parent flex max-w-7xl"></div>
                    </div>

                    <div id="nextgallery" class="flex items-center px-4 py-2 text-gray-500 bg-gray-300 rounded-md hover:bg-blue-100 border-solid border-2  border-gray-400">
                        <i class="fas fa-angle-double-right text-xl"></i>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
        
<!--/gallery Modal-->
<?php require('modals/gallery_modal.php');?>
  <!-- sweetalert -->
<script src="../assets/js/sweetAlert.js"></script>
<script src="../assets/js/galleryForm.js"></script>