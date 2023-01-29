<!--Visitors Scan Form-->
<div class="modal fade" id="visitorsModal" tabindex="-1" aria-labelledby="visitorsAddModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="visitorsAddModalLabel">Visitors Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            <div class="bg-white w-full pb-9 rounded-xl bg-white border-gray-400 border-2 p-9 text-lg text-gray-400">
                    <form id="addLogVisitors">
                        <input type="text" id="idpass" name="scanFormVisitors[]" class="hidden"/>
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group floating-label">
                                    <input type="text" name="scanFormVisitors[]" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2" required>
                                    <label for="">First name</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group floating-label">
                                    <input type="text" name="scanFormVisitors[]" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2" required>
                                    <label for="">Middle name</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group floating-label">
                                    <input type="text" name="scanFormVisitors[]" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2"  required>
                                    <label for="">Last name</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group floating-label">
                                    <input class="date-picker form-control h-12 rounded w-full mb-8 border-gray-500 border-2 rounded" value="<?php echo date('Y-m-d');?>" type="text" required="required" name="scanFormVisitors[]" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="visitorObj.visitorsDateFormat(this)">
                                    <label for="">Date of birth</label>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group floating-label">
                                    <input type="number"  name="scanFormVisitors[]" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2" required>
                                    <label for="">Contact no.</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group floating-label">
                            <select name="scanFormVisitors[]" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2" required>
                                <option value=""></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <label for="" class="mt-1">Gender</label>
                        </div>

                        <div class="form-group floating-label">
                            <textarea required rows="5" cols="10" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2" name="scanFormVisitors[]"></textarea>
                            <label for="" class="mt-1">Address</label>
                        </div>

                        <div class="form-group floating-label">
                            <textarea required rows="5" cols="10" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2" name="scanFormVisitors[]"></textarea>
                            <label for="" class="mt-1">Porpose</label>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex flex-row-reverse">
                    <div class="p-2">
                        <button data-toggle="tooltip" data-placement="top" title="Reset" class="hover:border-red-600 hover:bg-gray-100 hover:text-red-600 tracking-wide text-lg text-white bg-red-400 px-9 py-2 rounded-3xl border-red-500 border-2" type="reset">Reset</button>
                    </div>
                    <div class="p-2">
                        <input id="visitors-btn" data-toggle="tooltip" data-placement="top" title="Add New Visitors" type="submit" value="Save" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
<!--Visitors Scan Form-->
<script src="./assets/js/visitorsScanForm.js"></script>