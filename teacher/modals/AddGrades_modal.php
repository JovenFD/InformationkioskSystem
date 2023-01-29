<!--Year Add Student Grades Form-->
<div class="modal fade" id="AddGradesModal" tabindex="-1" aria-labelledby="AddGradesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AddGradesModalLabel">Add New Student Grades Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
                <form id="addStudentGradesForm">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group floating-label">
                                <select name="addGradeValForm[]" id="addListYear" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>

                                </select>
                                <label for="">School Year</label>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group floating-label">
                                <select name="addGradeValForm[]" id="addListClass" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required >

                                </select>
                                <label for="">Class</label>
                            </div>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group floating-label">
                                <select name="addGradeValForm[]" id="addListStudent" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>

                                </select>
                                <label for="">Learner's Name</label>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group floating-label">
                                <select name="addGradeValForm[]" id="addListSubject" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>

                                </select>
                                <label for="">Subject Tittle</label>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-4">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group floating-label">
                                    <input type="number" name="addGradeValForm[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg text-center text-bold text-2xl" required />
                                <label for="">1st Quarter</label>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group floating-label">
                                <input type="number" name="addGradeValForm[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg text-center text-bold text-2xl" required />
                                <label for="">2nd Quarter</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group floating-label">
                                    <input type="number" name="addGradeValForm[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg text-center text-bold text-2xl" required />
                                <label for="">3rd Quarter</label>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group floating-label">
                                <input type="number" name="addGradeValForm[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg text-center text-bold text-2xl" required />
                                <label for="">4th Quarter</label>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex flex-row-reverse">
                    <div class="p-2">
                        <button data-toggle="tooltip" data-placement="top" title="Reset" class="hover:border-red-600 hover:bg-gray-100 hover:text-red-600 tracking-wide text-lg text-white bg-red-400 px-9 py-2 rounded-3xl border-red-500 border-2" type="reset">Reset</button>
                    </div>
                    <div class="p-2">
                        <input id="stdGrades-btn" data-toggle="tooltip" data-placement="top" title="Add New Student Grades" type="submit" value="Save" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
<!--Year Add Student Grades Form-->

<!--Year Update Student Grades Form-->
<div class="modal fade" id="studentGradesUpdateModal" tabindex="-1" aria-labelledby="AddGradesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AddGradesModalLabel">Update Student Grades Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
                <form id="updateStudentGradesForm">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="newStudentGradesVal[]" class="hidden" id="sgid">
                                <label for="">School Year</label>
                                <input type="text" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg text-center text-bold text-2xl" id="newschoolyear" disabled require>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Class</label>
                                <input type="text" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg text-center text-bold text-2xl" id="newclass" disabled require>
                            </div>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Learner's Name</label>
                                <input type="text" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg text-center text-bold text-2xl" id="stdname" disabled require>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Subject Tittle</label>
                                <input type="text" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg text-center text-bold text-2xl" id="newsubject" disabled require>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-4">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group floating-label">
                                    <input type="number" id="firstQ" name="newStudentGradesVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg text-center text-bold text-2xl" required />
                                <label for="">1st Quarter</label>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group floating-label">
                                <input type="number" id="secondQ" name="newStudentGradesVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg text-center text-bold text-2xl" required />
                                <label for="">2nd Quarter</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group floating-label">
                                    <input type="number" id="thirdQ"    name="newStudentGradesVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg text-center text-bold text-2xl" required />
                                <label for="">3rd Quarter</label>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group floating-label">
                                <input type="number" id="fourthQ" name="newStudentGradesVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg text-center text-bold text-2xl" required />
                                <label for="">4th Quarter</label>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex flex-row-reverse">
                    <div class="p-2">
                        <button data-toggle="tooltip" data-placement="top" title="Reset" class="hover:border-red-600 hover:bg-gray-100 hover:text-red-600 tracking-wide text-lg text-white bg-red-400 px-9 py-2 rounded-3xl border-red-500 border-2" type="reset">Reset</button>
                    </div>
                    <div class="p-2">
                        <input id="newstdGrades-btn" data-toggle="tooltip" data-placement="top" title="Update Student Grades" type="submit" value="Update" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>


<!--Unactive Modal-->
<div class="modal fade" id="gradesUnActModal" tabindex="-1" aria-labelledby="gradesUnActModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="gradesUnActModalLabel">Unactive List Student Grades</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="container rounded-lg border-2 border-gray-200" id="loading">
            <div class="card">
                <div class="card-header">            
                   <?php 
                        $title = 'UNACTIVE STUDENT GRADES DATA';
                        require('tableHeader.php');
                   ?>
                </div>
                    <div class="card-body">
                        <form id="gradesUnactForm">
                        <div class="container mb-4">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="flex flex-row mt-4">
                                        <div class="mt-1">      
                                            <button type="submit" data-toggle="top" title="Set Active Student Grades" class="w-16 h-16 hover:border-green-600 hover:bg-green-100 hover:text-red-600 tracking-wide text-lg text-white bg-green-400 rounded-full border-green-500 border-2">
                                                <i class="fa fa-recycle text-2xl"></i>
                                            </button> 
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm">    
                                    <div class="relative mt-2"> 
                                        <small>1st Select Class</small>
                                        <select id="listUnactClass" class="h-14 border-2  border-gray-200 text-lg w-full pr-8 pl-5 rounded-full focus:shadow focus:outline-none">
                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="relative mt-2"> 
                                        <small>2nd Select School Year</small>
                                        <select id="listUnactYear" class="h-14 border-2  border-gray-200 text-lg w-full pr-8 pl-5 rounded-full focus:shadow focus:outline-none" disabled>
                    
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="relative mt-2"> 
                                        <small>3rd Select Subject</small>
                                        <select id="listUnactSubject" class="h-14 border-2  border-gray-200 text-lg w-full pr-8 pl-5 rounded-full focus:shadow focus:outline-none">
                                    
                                        </select disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th class="px-5 py-5"><input class="w-5 h-5" type="checkbox" id="gradeUnactCheckBox">
                                            </th>
                                            <th class="transform -rotate-45  px-5 py-5">#</th>
                                            <th class="transform -rotate-45  px-5 py-5">Learner's Name</th>
                                            <th class="transform -rotate-45  px-5 py-5">1st Quarter</th>
                                            <th class="transform -rotate-45  px-5 py-5">2nd Quarter</th>
                                            <th class="transform -rotate-45  px-5 py-5">3rd Quarter</th>
                                            <th class="transform -rotate-45  px-5 py-5">4th Quarter</th>
                                            <th class="transform -rotate-45  px-5 py-5">Final Grade</th>
                                            <th class="transform -rotate-45  px-5 py-5">Remarks</th>
                                        </tr>   
                                    </thead>
                                    <tbody id="tbodyUnactGrades">
                                    </tbody>
                                </table>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
      </div>  
           
        </div>
    </div>
</div>
<!--Unactive Modal-->