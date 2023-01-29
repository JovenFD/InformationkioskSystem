<!--Year Level Form-->
<div class="modal fade" id="levelAddModal" tabindex="-1" aria-labelledby="levelAddModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="levelAddModalLabel">Year Level Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
                <form id="lvlAddForm">
                    <div class="form-group floating-label">
                        <select name="lvlValForm[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                            <option value="''">Select Year Level</option>
                            <option value="Grade-7">Grade-7</option>
                            <option value="Grade-8">Grade-8</option>
                            <option value="Grade-9">Grade-9</option>
                            <option value="Grade-10">Grade-10</option>
                            <option value="Grade-11">Grade-11</option>
                            <option value="Grade-12">Grade-12</option>
                        </select>
                        <label for="">Year Level</label>
                    </div>

                    <div class="form-group floating-label">
                        <input type="text" name="lvlValForm[]" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2" required>
                        <label for="">Section</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex flex-row-reverse">
                    <div class="p-2">
                        <button data-toggle="tooltip" data-placement="top" title="Reset" class="hover:border-red-600 hover:bg-gray-100 hover:text-red-600 tracking-wide text-lg text-white bg-red-400 px-9 py-2 rounded-3xl border-red-500 border-2" type="reset">Reset</button>
                    </div>
                    <div class="p-2">
                        <input id="lvl-btn" data-toggle="tooltip" data-placement="top" title="Add New Year Level" type="submit" value="Save" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
<!--Year Level Form-->

<!--Year Level Upate Form-->
<div class="modal fade" id="levelUpdateModal" tabindex="-1" aria-labelledby="levelAddModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="levelAddModalLabel">Update Year Level Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
                <form id="lvlUpdateForm">
                    <div class="form-group floating-label">
                        <input type="text" id="lvlid" name="lvlNewValForm[]" class="hidden">
                        <select id="lvlyear" name="lvlNewValForm[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                            <option value="''">Select Year Level</option>
                            <option value="Grade-7">Grade-7</option>
                            <option value="Grade-8">Grade-8</option>
                            <option value="Grade-9">Grade-9</option>
                            <option value="Grade-10">Grade-10</option>
                            <option value="Grade-11">Grade-11</option>
                            <option value="Grade-12">Grade-12</option>
                        </select>
                        <label for="">Year Level</label>
                    </div>

                    <div class="form-group floating-label">
                        <input type="text" id="lvldesc" name="lvlNewValForm[]" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2" required>
                        <label for="">Section</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex flex-row-reverse">
                    <div class="p-2">
                        <button data-toggle="tooltip" data-placement="top" title="Reset" class="hover:border-red-600 hover:bg-gray-100 hover:text-red-600 tracking-wide text-lg text-white bg-red-400 px-9 py-2 rounded-3xl border-red-500 border-2" type="reset">Reset</button>
                    </div>
                    <div class="p-2">
                        <input id="newlvl-btn" data-toggle="tooltip" data-placement="top" title="Update Year Level" type="submit" value="Update" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
<!--Year Level Upate Form-->

<!--Unactive Modal-->
<div class="modal fade" id="levelUnActModal" tabindex="-1" aria-labelledby="levelUnActModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="levelUnActModalLabel">Unactive List Year Level</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="container rounded-lg border-2 border-gray-200">
            <div class="card">
                <div class="card-header">
                    <?php 
                        $title = 'UNACTIVE YEAR LEVEL DATA';
                        require('tableHeader.php');
                    ?>
                </div>
                    <div class="card-body">
                        <form id="levelUnactForm">
                              <div class="row">
                                <div class="col-0 ml-2">
                                    <button type="submit"  data-toggle="tooltip" data-placement="top" title="Restore Data" class="h-16 w-16 hover:border-green-600 hover:bg-green-100 hover:text-green-600 tracking-wide text-lg text-white bg-green-400  py-2 rounded-full border-green-500 border-2">
                                        <i class="fas fa-recycle text-2xl"></i>
                                    </button>
                                </div>
                                
                                <div class="col flex flex-row-reverse relative">
                                    <div class="relative"> <input type="search" id="searchlvlUnact" class="h-16 border-2 border-gray-200 text-lg w-96 pr-8 pl-5 rounded-full focus:shadow focus:outline-none text-black text-center" placeholder="Search here...">
                                    <div class="absolute top-5 left-6"> <i class="fa fa-search text-black z-20 hover:text-black text-2xl"></i> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center text-lg">
                                    <thead>
                                        <tr>
                                            <th><input class="w-5 h-5" type="checkbox" id="lvlUnactcheckAll">
                                            </th>
                                            <th>#</th>
                                            <th>Grade Level's</th>
                                            <th>Description</th>
                                        </tr>   
                                    </thead>
                                    <tbody id="tbodyUnactLevel">
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

