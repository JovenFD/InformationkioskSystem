<!--School Year Form-->
<div class="modal fade" id="subjectAddModal" tabindex="-1" aria-labelledby="subjectAddModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="subjectAddModalLabel">Subject Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
                <form id="subjectAddForm">
                    <div class="form-group floating-label">
                        <input type="text" name="sbjFormVal[]" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2" required>
                        <label for="">Subject Name</label>
                    </div>

                    <div class="form-group floating-label">
                        <input type="text" name="sbjFormVal[]" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2" required>
                        <label for="">Description</label>
                    </div>

                    <div class="form-group floating-label">
                        <select name="sbjFormVal[]" id="listLevel" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2">
                            <option value=""></option>
                        </select>
                        <label for="">Year Level</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex flex-row-reverse">
                    <div class="p-2">
                        <button data-toggle="tooltip" data-placement="top" title="Reset" class="hover:border-red-600 hover:bg-gray-100 hover:text-red-600 tracking-wide text-lg text-white bg-red-400 px-9 py-2 rounded-3xl border-red-500 border-2" type="reset">Reset</button>
                    </div>
                    <div class="p-2">
                        <input id="subject-btn" data-toggle="tooltip" data-placement="top" title="Add New Subject Subject" type="submit" value="Save" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
<!--School Year Form-->

<!--School Update Year Form-->
<div class="modal fade" id="subjectUpdateModal" tabindex="-1" aria-labelledby="subjectUpdateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="subjectUpdateModalLabel">Update Subject Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
                <form id="subjectUpdateForm">
                    <div class="form-group floating-label">
                        <input type="text" id="sbjid" name="sbjNewFormVal[]" class="hidden">
                        <input type="text" id="sbjName" name="sbjNewFormVal[]" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2" required>
                        <label for="">Subject Name</label>
                    </div>

                    <div class="form-group floating-label">
                        <input type="text" id="sbjDesc" name="sbjNewFormVal[]" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2" required>
                        <label for="">Description</label>
                    </div>

                    <div class="form-group floating-label">
                        <select name="sbjNewFormVal[]" id="listNewSubject" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2 sbjDpList">
                            <option value=""></option>
                        </select>
                        <label for="">Year subject</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex flex-row-reverse">
                    <div class="p-2">
                        <button data-toggle="tooltip" data-placement="top" title="Reset" class="hover:border-red-600 hover:bg-gray-100 hover:text-red-600 tracking-wide text-lg text-white bg-red-400 px-9 py-2 rounded-3xl border-red-500 border-2" type="reset">Reset</button>
                    </div>
                    <div class="p-2">
                        <input id="newsubject-btn" data-toggle="tooltip" data-placement="top" title="Update Subject" type="submit" value="Update" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
<!--School Update Year Form-->

<!--Unactive Modal-->
<div class="modal fade" id="subjectUnActModal" tabindex="-1" aria-labelledby="subjectUnActModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="subjectUnActModalLabel">Unactive List Year Subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="container rounded-lg border-2 border-gray-200">
            <div class="card">
                <div class="card-header">
                    <?php 
                        $title = 'UNACTIVE SUBJECT DATA';
                        require('tableHeader.php');
                    ?>
                </div>
                    <div class="card-body">
                        <form id="subjectUnactForm">
                            <div class="row">
                                <div class="col-0 ml-1">
                                    <button type="submit"  data-toggle="tooltip" data-placement="top" title="Restore Data" class="h-16 w-16 hover:border-green-600 hover:bg-green-100 hover:text-green-600 tracking-wide text-lg text-white bg-green-400  py-2 rounded-full border-green-500 border-2">
                                        <i class="fas fa-recycle"></i>
                                    </button>
                                </div>
                                
                                <div class="col flex flex-row-reverse relative">
                                    <div class="relative"> <input type="search" id="searchSbjUnact" class="h-16 border-2 border-gray-200 text-lg w-96 pr-8 pl-5 rounded-full focus:shadow focus:outline-none text-black text-center" placeholder="Search here...">
                                    <div class="absolute top-5 left-6"> <i class="fa fa-search text-black z-20 hover:text-black text-2xl"></i> </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th><input class="w-5 h-5" type="checkbox" id="sbjUnactcheckAll">
                                            </th>
                                            <th>#</th>
                                            <th>Subject Name</th>
                                            <th>Description</th>
                                            <th>Year Level</th>
                                        </tr> 
                                    </thead>
                                    <tbody id="tbodyUnactsubject">
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