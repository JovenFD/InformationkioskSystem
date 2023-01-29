<!--School Year Form-->
<div class="modal fade" id="classAddModal" tabindex="-1" aria-labelledby="classAddModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="classAddModalLabel">Class Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
                <form id="classAddForm">
                    <div class="form-group floating-label">
                        <input type="text" name="clsFormVal[]" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2" required>
                        <label for="">class Name</label>
                    </div>


                    <div class="form-group floating-label">
                        <select name="clsFormVal[]" id="listYear" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2">
                            <option value=""></option>
                        </select>
                        <label for="">School Year</label>
                    </div>

                    <div class="form-group floating-label">
                        <select name="clsFormVal[]" id="listLevel" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2">
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
                        <input id="class-btn" data-toggle="tooltip" data-placement="top" title="Add New Class" type="submit" value="Save" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
<!--School Year Form-->

<!--School Year Update Form-->
<div class="modal fade" id="classUpdateModal" tabindex="-1" aria-labelledby="classUpdateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="classUpdateModalLabel">Class Update Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
                <form id="classUpdateForm">
                    <div class="form-group floating-label">
                        <input type="text" id="clsid" name="clsNewFormVal[]" class="hidden">
                        <input type="text" id="classnewname" name="clsNewFormVal[]" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2" required>
                        <label for="">class Name</label>
                    </div>

                    <div class="form-group floating-label">
                        <select name="clsNewFormVal[]" id="listnewYear" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2">
 
                        </select>
                        <label for="">School Year</label>
                    </div>

                    <div class="form-group floating-label">
                        <select name="clsNewFormVal[]" id="listnewLevel" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2">
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
                        <input id="newclass-btn" data-toggle="tooltip" data-placement="top" title="Update Class class" type="submit" value="Update" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
<!--School Year Update Form-->

<!--Unactive Modal-->
<div class="modal fade" id="classUnActModal" tabindex="-1" aria-labelledby="classUnActModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="classUnActModalLabel">Unactive List Class</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="container rounded-lg border-2 border-gray-200" id="loading">
            <div class="card">
                <div class="card-header">
                    <?php 
                        $title = 'UNACTIVE CLASS DATA';
                        require('tableHeader.php');
                    ?>
                </div>
                    <div class="card-body">
                        <form id="classUnactForm">
                            <div class="row">
                                <div class="col-0 ml-2">
                                    <button type="submit"  data-toggle="tooltip" data-placement="top" title="Restore Data" class="h-16 w-16 hover:border-green-600 hover:bg-green-100 hover:text-green-600 tracking-wide text-lg text-white bg-green-400  py-2 rounded-full border-green-500 border-2">
                                        <i class="fas fa-recycle"></i>
                                    </button>
                                </div>
                                
                                <div class="col flex flex-row-reverse relative">
                                    <div class="relative"> <input type="search" id="searchClsUnact" class="h-16 border-2 border-gray-200 text-lg w-96 pr-8 pl-5 rounded-full focus:shadow focus:outline-none text-black text-center" placeholder="Search here...">
                                    <div class="absolute top-5 left-6"> <i class="fa fa-search text-black z-20 hover:text-black text-2xl"></i> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th><input class="w-5 h-5" type="checkbox" id="clsUnactcheckAll">
                                            </th>
                                            <th>#</th>
                                            <th>Class Name</th>
                                            <th>School Year</th>
                                            <th>Year Level</th>
                                        </tr>  
                                    </thead>
                                    <tbody id="tbodyUnactClass">
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