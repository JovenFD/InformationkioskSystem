<!--School Add Teacher Advisory Form-->
<div class="modal fade" id="tchrAdvAddModal" tabindex="-1" aria-labelledby="tchrAdvAddModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tchrAdvAddModalLabel">Teacher Advisory Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
                <form id="tchrAdvAddForm">
                    <div class="form-group floating-label">
                        <input type="text" name="search" id="searchdplist" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2 dropdown-toggle" data-toggle="dropdown" aria-expanded="false" placeholder="Select Teacher">

                        <div class="dropdown-menu w-full">
                            <div class="table-responsive max-h-48 dropdown-item">
                                <table class="table table-bordered text-lg">
                                    <tbody id="dpListTeacher"></tbody>
                                </table>
                            </div>
                        </div>
                        <input type="hidden" id="tchrId" name="tchrAdvFormVal[]">
                        <label for="">Teacher</label>
                    </div>

                    <div class="form-group floating-label">
                        <select name="tchrAdvFormVal[]" id="listclass" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2">
                            <option value=""></option>
                        </select>
                        <label for="">Class</label>
                    </div>

                    <div class="form-group floating-label">
                        <select name="tchrAdvFormVal[]" id="listsubject" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2">
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
                        <input id="tchrAdv-btn" data-toggle="tooltip" data-placement="top" title="Add New Teacher Advisory" type="submit" value="Save" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
<!--School Add Teacher Advisory Form-->

<!--School Update Teacher Advisory Form-->
<div class="modal fade" id="tchrUpdatevAddModal" tabindex="-1" aria-labelledby="tchrUpdatevAddModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tchrUpdatevAddModalLabel">Update Teacher Advisory Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
                <form id="tchrAdvUpdateForm">
                    <input type="text" id="tchrAdvid" class="hidden" name="tchrAdvNewFormVal[]">
    
                    <div class="form-group floating-label">
                        <input type="text" name="search"  id="newSearchdplist" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2 dropdown-toggle" data-toggle="dropdown" aria-expanded="false" placeholder="Select Teacher">

                        <div class="dropdown-menu w-full">
                            <div class="table-responsive max-h-48 dropdown-item">
                                <table class="table table-bordered text-lg">
                                    <tbody id="newDpListTeacher"></tbody>
                                </table>
                            </div>
                        </div>
                        <input type="hidden" id="newTchrId" name="tchrAdvNewFormVal[]">
                        <label for="">Teacher</label>
                    </div>

                    <div class="form-group floating-label">
                        <select name="tchrAdvNewFormVal[]" id="newlistclass" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2">
                            <option value=""></option>
                        </select>
                        <label for="">Class</label>
                    </div>

                    <div class="form-group floating-label">
                        <select name="tchrAdvNewFormVal[]" id="newlistsubject" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2">
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
                        <input id="newtchrAdv-btn" data-toggle="tooltip" data-placement="top" title="Update Teacher Advisory" type="submit" value="Update" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
<!--School Update Teacher Advisory Form-->

<!--Unactive Modal-->
<div class="modal fade" id="unactTchAdvisoryModal" tabindex="-1" aria-labelledby="unactTchAdvisoryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="unactTchAdvisoryModalLabel">Unactive List Teachers Advisory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="container rounded-lg border-2 border-gray-200">
            <div class="card">
                <div class="card-header">
                    <?php 
                        $title = 'UNACTIVE TEACHER ADVISORY CLASS DATA';
                        require('tableHeader.php');
                    ?>
                </div>
                    <div class="card-body">
                        <form id="tchrAdvisoryUnactForm">
                            <div class="row">
                                <div class="col-0 ml-2">
                                    <button type="submit"  data-toggle="tooltip" data-placement="top" title="Restore Data" class="h-16 w-16 hover:border-green-600 hover:bg-green-100 hover:text-green-600 tracking-wide text-lg text-white bg-green-400  py-2 rounded-full border-green-500 border-2">
                                        <i class="fas fa-recycle"></i>
                                    </button>
                                </div>
                                
                                <div class="col flex flex-row-reverse relative">
                                    <div class="relative"> <input type="search" id="searchtchrUnactAdvisory" class="h-16 border-2 border-gray-200 text-lg w-96 pr-8 pl-5 rounded-full focus:shadow focus:outline-none text-black text-center" placeholder="Search here...">
                                    <div class="absolute top-5 left-6"> <i class="fa fa-search text-black z-20 hover:text-black text-2xl"></i> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th><input class="w-5 h-5" type="checkbox" id="tchrAdvUnactcheckAll">
                                            </th>
                                            <th>#</th>
                                            <th>Profile</th>
                                            <th>Adviser Name's</th>
                                            <th>Class</th>
                                            <th>Subjects</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyUnactTchrAdvisory">
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