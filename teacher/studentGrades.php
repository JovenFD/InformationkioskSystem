<div class="container rounded-lg border-2 border-gray-200">
    <div class="card">
        <div class="card-header">
            <?php 
                $title = 'SUMMARY OF QUARTERLY GRADES';
                require_once('tableHeader.php'); 
            ?>
        </div>
            <div class="card-body">
                <form id="stdGradesDelForm">
                    <div class="container mb-4">
                        <div class="row">
                            <div class="col-sm">
                                <div class="flex flex-row mt-4">
                                    <div>
                                        <select id="limitatStdGrades" class="border-2 border-gray-200 h-16 w-16 rounded-full text-lg focus:shadow focus:outline-none text-black">
                                            <option value="5">5</option>
                                            <?php 
                                                for ($i=1; $i < 11; $i++) { 
                                                    echo '<option value="'.($i*10).'">'.($i*10).'</option>';
                                                }
                                            ?>
                                        </select>   
                                    </div>
                                    <div class="ml-2">      
                                        <button type="submit" data-toggle="tooltip" data-placement="top" title="Set Unactive Student Grades" class="w-16 h-16 hover:border-red-600 hover:bg-red-100 hover:text-red-600 tracking-wide text-lg text-white bg-red-400 rounded-full border-red-500 border-2">
                                            <i class="fas fa-archive text-2xl"></i>
                                        </button> 
                                    </div>
                                    <div class="ml-2">      
                                        <button type="button" data-toggle="modal" data-target="#AddGradesModal" data-placement="top" title="Add New Student  Grades" class="w-16 h-16 hover:border-green-600 hover:bg-green-100 hover:text-red-600 tracking-wide text-lg text-white bg-green-400 rounded-full border-green-500 border-2">
                                            <i class="fa fa-plus text-2xl"></i>
                                        </button> 
                                    </div>

                                    <div class="ml-2">      
                                        <button type="button" data-toggle="modal" data-target="#gradesUnActModal" data-placement="top" title="View Unactive Student Grades" class="w-16 h-16 hover:border-green-600 hover:bg-green-100 hover:text-red-600 tracking-wide text-lg text-white bg-green-400 rounded-full border-green-500 border-2">
                                            <i class="fas fa-history text-2xl"></i>
                                        </button> 
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm">    
                                <div class="relative mt-2"> 
                                    <small class="text-black font-bold">Select Class</small>
                                    <select id="listClass" class="h-16 border-2  border-gray-200 text-lg w-full pr-8 pl-5 rounded-full focus:shadow focus:outline-none text-black">
                          
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="relative mt-2"> 
                                    <small class="text-black font-bold">Select School Year</small>
                                    <select id="listYear" class="h-16 border-2  border-gray-200 text-lg w-full pr-8 pl-5 rounded-full focus:shadow focus:outline-none text-black" disabled>
                 
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="relative mt-2"> 
                                    <small class="text-black font-bold">Select Subject</small>
                                    <select id="listSubject" class="h-16 border-2  border-gray-200 text-lg w-full pr-8 pl-5 rounded-full focus:shadow focus:outline-none text-black">
                                   
                                    </select disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered text-center text-lg">
                            <thead>
                                <tr>
                                    <th class="px-5 py-5"><input class="w-5 h-5" type="checkbox" id="gradeCheckBox">
                                    </th>
                                    <th class="transform -rotate-45  px-5 py-5">#</th>
                                    <th class="transform -rotate-45  px-5 py-5">Learner's Name</th>
                                    <th class="transform -rotate-45  px-5 py-5">1st Quarter</th>
                                    <th class="transform -rotate-45  px-5 py-5">2nd Quarter</th>
                                    <th class="transform -rotate-45  px-5 py-5">3rd Quarter</th>
                                    <th class="transform -rotate-45  px-5 py-5">4th Quarter</th>
                                    <th class="transform -rotate-45  px-5 py-5">Final Grade</th>
                                    <th class="transform -rotate-45  px-5 py-5">Remarks</th>
                                    <th class="transform -rotate-45  px-5 py-5">Action</th>
                                </tr>   
                            </thead>
                            <tbody id="tbodystdgrades">
                            </tbody>
                        </table>

                    </div>
                </form>

                <div class="justify-center max-w-full mt-3">

                <div class="flex justify-center space-x-1 mr-2 ml-5">
                    <div id="prevstdGrades" class="flex items-center px-4 py-2 text-gray-500 bg-gray-300 rounded-md hover:bg-blue-100 border-solid border-2  border-gray-400">
                        <i class="fas fa-angle-double-left text-xl"></i>
                    </div>
                    
                    <div class="flex overflow-x-auto max-w-7xl">
                        <div id="stdGrades-btn-pages" class="parent flex max-w-7xl"></div>
                    </div>

                    <div id="nextstdGrades" class="flex items-center px-4 py-2 text-gray-500 bg-gray-300 rounded-md hover:bg-blue-100 border-solid border-2  border-gray-400">
                        <i class="fas fa-angle-double-right text-xl"></i>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
        
<!--/School Student Result Modal-->
<?php require('modals/AddGrades_modal.php');?>
  <!-- sweetalert -->
<script src="../assets/js/sweetAlert.js"></script>
<script src="../assets/js/teacherAccountStudentGrades.js"></script>