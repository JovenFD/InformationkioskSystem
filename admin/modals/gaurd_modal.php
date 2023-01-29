<!--Add Modal-->
<div class="modal fade" id="gaurdAddModal" tabindex="-1" aria-labelledby="gaurdAddModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="gaurdAddModalLabel">Add New Security Personel Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
                <form id="gaurdAddForm">
                    <div class="w-full p-10 mt-2">
                        <div class="relative mx-auto w-32 h-32 rounded-full border-gray-600 border-4">
                            <img id="avatargaurd" class="w-full h-full rounded-full"
                                src="../assets/images/account.png" />
                            <div id="cameragaurd"
                                class="cursor-pointer absolute bottom-0 h-10 w-full bg-white p-1 opacity-25 hover:opacity-75">
                                <img src="../assets/images/camera.png" class="h-8 w-8 mx-auto" />
                            </div>
                        </div>
                        <input id="fileChoosergaurd" class="hidden" name="file" type="file" accept="image/*" />
                    </div>
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group floating-label">
                                    <input type="text" name="formGuardVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">First name</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group floating-label">
                                    <input type="text" name="formGuardVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">Middle name</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group floating-label">
                                    <input type="text" name="formGuardVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">Last name</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group floating-label">
                                    <input class="date-picker form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2 rounded-lg" value="<?php echo date('Y-m-d');?>" type="text" required="required" name="formGuardVal[]" 
                                    onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="gaurdObj.dateFormatGaurd(this)">
                                    <label for="">Date of birth</label>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group floating-label">
                                    <input type="text" name="formGuardVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">Address</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group floating-label">
                            <select name="formGuardVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                <option value=""></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <label for="">Gender</label>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group floating-label">
                                    <input type="email" name="formGuardVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">Email</label>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group floating-label">
                                    <input type="number" name="formGuardVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">Contact Number</label>
                                </div>
                            </div>
                        </div>   
                
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group floating-label">
                                <input type="password" name="formGuardVal[]" id="password" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2" required>
                                <div class="absolute top-4 right-3"> 
                                    <i class="fas fa-eye cursor-pointer hover:text-gray-700" id="toggleTPassword"></i> 
                                </div> 
                                <label for="">Password</label>
                            </div>
                        </div>
                            
                        <div class="col-sm-6">
                            <div class="form-group floating-label">
                                <input type="password" name="formGuardVal[]" id="CPassword" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2" required>
                                <div class="absolute top-4 right-3"> 
                                    <i class="fas fa-eye cursor-pointer hover:text-gray-700" id="CTTogglePassword"></i> 
                                </div> 
                                <label for="">Confirm Password</label>
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
                        <input id="btnGuard" data-toggle="tooltip" data-placement="top" title="Add New Security Personel" type="submit" value="Save" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
<!--Add Modal-->

<!--Add Update-->
<div class="modal fade" id="gaurdUpdateModal" tabindex="-1" aria-labelledby="gaurdUpdateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="gaurdUpdateModalLabel">Update Security Personel Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
                <form id="gaurdUpdateForm">
                    <div class="w-full p-10 mt-2">
                        <div class="relative mx-auto w-32 h-32 rounded-full border-gray-600 border-4">
                            <img id="newavatargaurd" class="w-full h-full rounded-full"
                                src="../assets/images/account.png" />
                            <div id="newcameragaurd"
                                class="cursor-pointer absolute bottom-0 h-10 w-full bg-white p-1 opacity-25 hover:opacity-75">
                                <img src="../assets/images/camera.png" class="h-8 w-8 mx-auto" />
                            </div>
                        </div>
                        <input id="newFileChoosergaurd" class="hidden" name="file" type="file" accept="image/*" />
                        <input type="text" class="hidden" id="gaurdid" name="formNewVal[]">
                        <input type="text" class="hidden" id="gaurdcurrentavatar" name="formNewVal[]">
                    </div>
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group floating-label">
                                    <input type="text" id="gaurdfname" name="formNewVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">First name</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group floating-label">
                                    <input type="text" id="gaurdmname" name="formNewVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">Middle name</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group floating-label">
                                    <input type="text" id="gaurdlname" name="formNewVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">Last name</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group floating-label">
                                    <input id="gaurddob" class="date-picker form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2 rounded-lg" value="<?php echo date('Y-m-d');?>" type="text" required="required" name="formNewVal[]" 
                                    onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="gaurdObj.dateFormatGaurd(this)">
                                    <label for="">Date of birth</label>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group floating-label">
                                    <input type="text" id="gaurdaddress" name="formNewVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">Address</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group floating-label">
                            <select name="formNewVal[]" id="gaurdgender" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                <option value=""></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <label for="">Gender</label>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group floating-label">
                                    <input type="email" id="gaurdemail" name="formNewVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">Email</label>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group floating-label">
                                    <input type="number" id="gaurdcontactno" name="formNewVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">Contact Number</label>
                                </div>
                            </div>
                        </div>   
                
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group floating-label">
                                <input type="password" name="formNewVal[]" id="UPassword" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2" required>
                                <div class="absolute top-4 right-3"> 
                                    <i class="fas fa-eye cursor-pointer hover:text-gray-700" id="toggleUPassword"></i> 
                                </div> 
                                <label for="">Password</label>
                            </div>
                        </div>
                            
                        <div class="col-sm-6">
                            <div class="form-group floating-label">
                                <input type="password" name="formNewVal[]" id="CUPassword" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2" required>
                                <div class="absolute top-4 right-3"> 
                                    <i class="fas fa-eye cursor-pointer hover:text-gray-700" id="CUTogglePassword"></i> 
                                </div> 
                                <label for="">Confirm Password</label>
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
                        <input id="newBtnGuard" data-toggle="tooltip" data-placement="top" title="Update Security Personel" type="submit" value="Update" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
<!--Update Modal-->

<!--Unactive Modal-->
<div class="modal fade" id="inactiveGaurdModal" tabindex="-1" aria-labelledby="inactiveGaurdModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="inactiveGaurdModalLabel">Inactive List Security Gaurds</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="container rounded-lg border-2 border-gray-200">
            <div class="card">
                <div class="card-header">
                    <?php 
                        $title = "INACTIVE SECURITY GAURD'S DATA";
                        require('tableHeader.php');
                    ?>
                </div>
                    <div class="card-body">
                        <form id="gaurdInactForm">
                            <div class="row">
                                <div class="col-0 ml-2">
                                    <button type="submit"  data-toggle="tooltip" data-placement="top" title="Restore Data" class="h-16 w-16 hover:border-green-600 hover:bg-green-100 hover:text-green-600 tracking-wide text-lg text-white bg-green-400  py-2 rounded-full border-green-500 border-2">
                                        <i class="fas fa-recycle"></i>
                                    </button>
                                </div>
                                
                                <div class="col flex flex-row-reverse relative">
                                    <div class="relative"> <input type="search" id="searchInactGuard" class="h-16 border-2 border-gray-200 text-lg w-96 pr-8 pl-5 rounded-full focus:shadow focus:outline-none text-black text-center" placeholder="Search here...">
                                    <div class="absolute top-5 left-6"> <i class="fa fa-search text-black z-20 hover:text-black text-2xl"></i> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th>
                                            <input class="w-5 h-5" type="checkbox" id="checkAllInactGaurd">
                                        </th>
                                        <th>#</th>
                                        <th>Picture</th>
                                        <th>Name's</th>
                                        <th>Date of Birth</th>
                                        <th>Gender</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Contact Number</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbodyinactivegaurd"></tbody>
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