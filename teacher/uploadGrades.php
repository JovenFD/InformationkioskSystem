<div class="container rounded-lg border-2 border-gray-200">
    <div class="card">
        <div class="card-header">
            <?php 
                $title = 'UPLOAD GRADES RECORDS';
                require_once('tableHeader.php'); 
            ?>
        </div>
            <div class="card-body">
                <div class="float-right mb-3">
                    <button type="button" id="saveAllChecked" data-toggle="tooltip" data-placement="top" title="Save All Check" class="w-16 h-16 hover:border-green-600 hover:bg-green-100 hover:text-red-600 tracking-wide text-lg text-white bg-green-400 py-2 rounded-full border-green-500 border-2">
                        <i class="far fa-save"></i> 
                    </button>

                    <button type="button" data-toggle="modal" data-target="#uploadStudentGradesModal" data-placement="top" title="Upload File" class="w-16 h-16 hover:border-blue-600 hover:bg-blue-100 hover:text-red-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2">
                        <i class="fas fa-upload"></i>
                    </button>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-bordered text-center text-lg" id="importTable">
                        <thead>
                            <tr>
                                <th class="px-5 py-5"><input class="w-5 h-5" type="checkbox" id="checkBox">
                                </th>
                                <th class="transform -rotate-45  px-5 py-5">#</th>
                                <th class="transform -rotate-45  px-5 py-5">Learner's Name</th>
                                <th class="transform -rotate-45  px-5 py-5">1st Quarter</th>
                                <th class="transform -rotate-45  px-5 py-5">2nd Quarter</th>
                                <th class="transform -rotate-45  px-5 py-5">3rd Quarter</th>
                                <th class="transform -rotate-45  px-5 py-5">4th Quarter</th>  
                            </tr>    
                        </thead>
                    <tbody>
                        <tr>
                            <td colspan="7" class="text-center font-extrabold animate-bounce">Empty Upload Data...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>   
<!--/School Student List Modal-->
<?php require('modals/uploadGrades_modal.php');?>
<!-- sweetalert -->
<script src="../assets/js/sweetAlert.js"></script>
<script src="../assets/js/papaparse.min.js"></script>
<script src="../assets/js/teacherAccountUploadGradesForm.js"></script>