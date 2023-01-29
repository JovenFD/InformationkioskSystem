<div class="container rounded-lg border-2 border-gray-200">
    <div class="card">
        <div class="card-header">
            <?php 
                $title = 'TEACHER ADVISORY RECORDS';
                require_once('tableHeader.php'); 
            ?>
        </div>
            <div class="card-body">
                <form id="tchrAdvisoryDelForm">
                    <div class="row p-2">
                        <div class="col-0">
                            <select id="limittchrAdvisory" class="border-2 border-gray-200 h-16 w-16 rounded-full text-lg text-black focus:shadow focus:outline-none">
                            <option value="5">5</option>
                            <?php 
                                for ($i=1; $i < 11; $i++) { 
                                    echo '<option value="'.($i*10).'">'.($i*10).'</option>';
                                }
                            ?>
                            </select>
                        </div>
                        <div class="col-1">
                            <button type="button" id="btnPrintTeacherAdvisoryData" data-toggle="tooltip" data-placement="top" title="Print All Data" class="w-16 h-16 hover:border-blue-600 hover:bg-blue-100 hover:text-red-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2">
                                <i class="fa fa-print text-2xl"></i>
                            </button>
                        </div>

                        <div class="col-1">
                            <button type="submit"  data-toggle="tooltip" data-placement="top" title="Remove All" class="w-16 h-16 hover:border-red-600 hover:bg-red-100 hover:text-red-600 tracking-wide text-lg text-white bg-red-400  py-2 rounded-full border-red-500 border-2">
                                <i class="fas fa-archive text-2xl"></i>
                            </button>
                        </div>

                        <div class="col-1">
                            <button type="button" data-placement="top" title="Add New Teacher Advisory" class="w-16 h-16 hover:border-green-600 hover:bg-green-100 hover:text-green-600 tracking-wide text-lg text-white bg-green-400 py-2 rounded-full border-green-500 border-2" data-toggle="modal" data-target="#tchrAdvAddModal">
                                <i class="fa fa-plus text-2xl"></i>
                            </button>
                        </div>

                        <div class="col-md">
                            <button type="button" data-placement="top" title="View Unactive Teachers Advisory" class="w-16 h-16 hover:border-green-600 hover:bg-green-100 hover:text-green-600 tracking-wide text-lg text-white bg-green-400 py-2 rounded-full border-green-500 border-2" data-toggle="modal" data-target="#unactTchAdvisoryModal">
                                <i class="fas fa-history text-2xl"></i>
                            </button>
                        </div>

                        <div class="col">
                            <div class="relative"> <input type="search" id="searchtchrAdvisory" class="h-16 border-2 border-gray-200 text-lg w-96 pr-8 pl-5 rounded-full focus:shadow focus:outline-none text-black text-center" placeholder="Search here...">
                            <div class="absolute top-5 left-6"> <i class="fa fa-search text-black z-20 hover:text-black text-2xl"></i> </div>
                            </div>
                        </div>

                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered text-center text-lg">
                            <thead>
                                <tr>
                                    <th><input class="w-5 h-5" type="checkbox" id="tchrAdvcheckAll">
                                    </th>
                                    <th>#</th>
                                    <th>Profile</th>
                                    <th>Adviser Name</th>
                                    <th>Class</th>
                                    <th>Subject</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbodytchrAdvisory">
                            </tbody>
                        </table>

                    </div>
                </form>

                <div class="justify-center max-w-full mt-3">

                <div class="flex justify-center space-x-1 mr-2 ml-5">
                    <div id="prevtchrAdvisory" class="flex items-center px-4 py-2 text-gray-500 bg-gray-300 rounded-md hover:bg-blue-100 border-solid border-2 border-gray-400">
                        <i class="fas fa-angle-double-left text-xl"></i>
                    </div>
                    
                    <div class="flex overflow-x-auto max-w-7xl">
                        <div id="tchrAdvisory-btn-pages" class="parent flex max-w-7xl"></div>
                    </div>

                    <div id="nexttchrAdvisory" class="flex items-center px-4 py-2 text-gray-500 bg-gray-300 rounded-md hover:bg-blue-100 border-solid border-2 border-gray-400">
                        <i class="fas fa-angle-double-right text-xl"></i>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
        
<!--/School tchrAdvisory Modal-->
<?php require('modals/tchrAdvisory_modal.php');?>
  <!-- sweetalert -->
<script src="../assets/js/sweetAlert.js"></script>
<script src="../assets/js/tchrAdvisoryForm.js"></script>