<div class="container rounded-lg border-2 border-gray-200">
    <div class="card">
        <div class="card-header">
            <?php 
                $title = 'SCHOOL FILES REPORTS';
                require_once('tableHeader.php'); 
            ?>
        </div>
            <div class="card-body">
                <form id="levelDelForm">
                    <div class="row p-2">
                        <div class="col-md">
                            <button type="button" data-placement="top" title="Add New Foler" class="h-16 w-16 hover:border-green-600 hover:bg-green-100 hover:text-red-600 tracking-wide text-lg text-white bg-green-400 py-2 rounded-full border-green-500 border-2" data-toggle="modal" data-target="#addNewFolderModal">   
                                <i class="fa fa-folder-plus"></i>
                            </button>
                        </div>

                        <div class="col-md">
                            <div class="relative"> <input type="search" id="searchFolderName" class="h-16 border-2 border-gray-200 text-lg w-full pr-8 pl-5 rounded-full focus:shadow focus:outline-none text-black text-center" placeholder="Search here...">
                            <div class="absolute top-5 left-6"> <i class="fa fa-search text-black z-20 hover:text-black text-2xl"></i> </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <div class="card">
                            <div class="card-header">
                                Folder List
                            </div>
                            <div class="card-body">
                                <div class="grid grid-cols-3 gap-4" id="folderList"></div>
                            </div>
                        </div>
                    </div>
                </form>

        </div>
    </div>
</div>

<?php include('modals/addFolder_modal.php');?>
        
<script src="../assets/js/sweetAlert.js"></script>
<script src="../assets/js/teacherAccountFilesReport.js"></script>