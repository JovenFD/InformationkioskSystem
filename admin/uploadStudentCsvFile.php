<div class="container rounded-lg border-2 border-gray-200">
    <div class="card">
        <div class="card-header">
            <?php 
                $title = 'UPLOAD STUDENT RECORD';
                require_once('tableHeader.php'); 
            ?>
        </div>
            <div class="card-body">

            <div class="float-right mb-3">
                    <button type="button" id="saveAllChecked" data-toggle="tooltip" data-placement="top" title="Save All Check" class="w-16 h-16 hover:border-green-600 hover:bg-green-100 hover:text-red-600 tracking-wide text-lg text-white bg-green-400 py-2 rounded-full border-green-500 border-2">
                        <i class="far fa-save text-2xl"></i> 
                    </button>

                    <button type="button" data-toggle="modal" data-target="#studentUploadCsvModal" data-placement="top" title="Upload File" class="w-16 h-16 hover:border-blue-600 hover:bg-blue-100 hover:text-red-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2">
                        <i class="fas fa-upload text-2xl"></i>
                    </button>
                </div>

                    <div class="table-responsive">
                        <table class="table table-bordered text-center text-lg" id="importTable">
                        <thead>
                                <tr>
                                    <th><input class="w-5 h-5" type="checkbox" id="checkBox">
                                    </th>
                                    <th>#</th>
                                    <th>Picture</th>
                                    <th>Student No.</th>
                                    <th>Learner's Name</th>
                                    <th>Date of Birth</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th>Contact Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="10" class="text-center font-extrabold animate-bounce">Data Not Found...</td>`
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </form>

            </div>
        </div>

    </div>
</div>

<!--/School Student List Modal-->
<?php require('modals/student_modal.php');?>
  <!-- sweetalert -->
<script src="../assets/js/sweetAlert.js"></script>
<script src="../assets/js/papaparse.min.js"></script>
<script src="../assets/js/UploadStudentRecordsForm.js"></script>