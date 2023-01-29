<!--School Add Student Class Form-->
<div class="modal fade" id="stdClassAddModal" tabindex="-1" aria-labelledby="stdClassAddModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="stdClassAddModalLabel">Shool StudentClass Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
                <form id="stdClassAddForm">
                    <div class="form-group floating-label">
                        <input autofocus type="text" name="search" id="searchdplist" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2 dropdown-toggle" data-toggle="dropdown" aria-expanded="false" placeholder="Select Student">

                        <div class="dropdown-menu w-full">
                            <div class="table-responsive max-h-48 dropdown-item">
                                <table class="table table-bordered text-lg">
                                    <tbody id="dpListStudent"></tbody>
                                </table>
                            </div>
                        </div>
                        <label for="">Student</label>
                    </div>

                    <div class="form-group floating-label">
                        <select name="stdClassFormVal[]" id="listclass" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2">
                            <option value=""></option>
                        </select>
                        <label for="">Class</label>
                        <input type="hidden" id="stdId" name="stdClassFormVal[]">
                    </div>

                    <div class="form-group floating-label">
                        <select name="stdClassFormVal[]" id="listsubject" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2">
                            <option value=""></option>
                        </select>
                        <label for="">Subject</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex flex-row-reverse">
                    <div class="p-2">
                        <button data-toggle="tooltip" data-placement="top" title="Reset" class="hover:border-red-600 hover:bg-gray-100 hover:text-red-600 tracking-wide text-lg text-white bg-red-400 px-9 py-2 rounded-3xl border-red-500 border-2" type="reset">Reset</button>
                    </div>
                    <div class="p-2">
                        <input id="stdclass-btn" data-toggle="tooltip" data-placement="top" title="Add New Student Class" type="submit" value="Save" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
<!--School Add Student Class Form-->

<!--School Update Student Class Form-->
<div class="modal fade" id="stdClassUpdateModal" tabindex="-1" aria-labelledby="stdClassUpdateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="stdClassUpdateModalLabel">Shool StudentClass Update Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
                <form id="stdClassUpdateForm">
                    <input type="text" class="hidden" id="stdclassid" name="stdClassNewFormVal[]">

                    <div class="form-group floating-label">
                        <input autofocus type="text" id="newSearchdplist" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2 dropdown-toggle" name="search" data-toggle="dropdown" aria-expanded="false" placeholder="Select Student">

                        <div class="dropdown-menu w-full">
                            <div class="table-responsive max-h-48 dropdown-item">
                                <table class="table table-bordered text-lg">
                                    <tbody id="newDpListStudent"></tbody>
                                </table>
                            </div>
                        </div>
                        <label for="">Student</label>
                    </div>

                    <div class="form-group floating-label">
                        <select name="stdClassNewFormVal[]" id="listnewclass" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2">
                            <option value=""></option>
                        </select>
                        <label for="">Class</label>
                        <input type="hidden" id="newStdId" name="stdClassNewFormVal[]">
                    </div>

                    <div class="form-group floating-label">
                        <select name="stdClassNewFormVal[]" id="listnewsubject" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2">
                            <option value=""></option>
                        </select>
                        <label for="">Subject</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex flex-row-reverse">
                    <div class="p-2">
                        <button data-toggle="tooltip" data-placement="top" title="Reset" class="hover:border-red-600 hover:bg-gray-100 hover:text-red-600 tracking-wide text-lg text-white bg-red-400 px-9 py-2 rounded-3xl border-red-500 border-2" type="reset">Reset</button>
                    </div>
                    <div class="p-2">
                        <input id="newstdclass-btn" data-toggle="tooltip" data-placement="top" title="Update Student Class" type="submit" value="Update" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
<!--School Update Student Class Form-->

<!--Unactive Modal-->
<div class="modal fade" id="unactiveStdModal" tabindex="-1" aria-labelledby="unactiveStdModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="unactiveStdModalLabel">Unactive List Student Class</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="container rounded-lg border-2 border-gray-200">
            <div class="card">
                <div class="card-header">
                    <?php 
                        $title = 'UNACTIVE STUDENT CLASS DATA';
                        require('tableHeader.php');
                    ?>
                </div>
                    <div class="card-body">
                        <form id="studentClassUnactiveForm">
                            <div class="row">
                                <div class="col-0 ml-2">
                                    <button type="submit"  data-toggle="tooltip" data-placement="top" title="Restore Data" class="h-16 w-16 hover:border-green-600 hover:bg-green-100 hover:text-green-600 tracking-wide text-lg text-white bg-green-400  py-2 rounded-xl border-green-500 border-2">
                                        <i class="fas fa-recycle"></i>
                                    </button>
                                </div>
                                
                                <div class="col flex flex-row-reverse relative">
                                    <div class="relative"> <input type="search" id="searchStdClassUnactive" class="h-16 border-2 border-gray-200 text-lg w-96 pr-8 pl-5 rounded-full focus:shadow focus:outline-none text-black text-center" placeholder="Search here...">
                                    <div class="absolute top-5 left-6"> <i class="fa fa-search text-black z-20 hover:text-black text-2xl"></i> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center text-lg">
                                    <thead>
                                        <tr>
                                            <th><input class="w-5 h-5" type="checkbox" id="stdclsunactivecheckAll">
                                            </th>
                                            <th>#</th>
                                            <th>Profile</th>
                                            <th>Class Name</th>
                                            <th>Learners Name</th>
                                            <th>Subjects</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyStdClassUncative">
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