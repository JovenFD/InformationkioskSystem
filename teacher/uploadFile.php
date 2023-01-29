<div class="container rounded-lg border-2 border-gray-200">
    <div class="card">
        <div class="card-header">
            <?php
                $title = 'FILE LIST REPORTS';
                require_once('tableHeader.php'); 
            ?>
        </div>
            <div class="card-body">
                <form id="fileReportRemoveForm">
                    <div class="row p-2">
                        <div class="col">
                            <button type="submit" data-placement="top" title="Remove File" class="w-16 h-16 hover:border-red-600 hover:bg-red-100 hover:text-red-600 tracking-wide text-lg text-white bg-red-400 py-2 rounded-full border-red-500 border-2" data-toggle="title">
                                <i class="fa fa-trash"></i>
                            </button>&nbsp;&nbsp;
                            <button type="button" data-placement="top" data-toggle="modal" data-target="#uploadFileModal" title="Upload New File" class="w-16 h-16 hover:border-green-600 hover:bg-green-100 hover:text-green-600 tracking-wide text-lg text-white bg-green-400 py-2 rounded-full border-green-500 border-2" data-toggle="title">
                                <i class="fa fa-upload"></i>
                            </button>
                        </div>

                        <div class="col">
                            <div class="relative"> <input type="search" id="searchReportFile" class="h-16 border-2 border-gray-200 text-lg w-96 pr-8 pl-5 rounded-full focus:shadow focus:outline-none text-black text-center" placeholder="Search here...">
                            <div class="absolute top-5 left-6"> <i class="fa fa-search text-black z-20 hover:text-black text-2xl"></i> </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered text-center text-lg">
                            <thead>
                                <tr>
                                    <th><input class="w-5 h-5" type="checkbox" id="checkAllFileReport">
                                    </th>
                                    <th>#</th>
                                    <th>Filename</th>
                                    <th>Size</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyFileList">
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
        
<?php require('modals/file_modal.php');?>
  <!-- sweetalert -->
<script src="../assets/js/sweetAlert.js"></script>
<script src="../assets/js/fileListForm.js"></script>
<script>
    let listObj = new FileList(
        '<?php echo $_GET['folderId'];?>'
        );
    listObj.fetchFileList();
    listObj.searchFileList();
    listObj.uploadFile();
    listObj.checkAllFile();
    listObj.removeReportFile();
</script>