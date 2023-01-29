<!--Add Modal-->
<div class="modal fade" id="teacherAddModal" tabindex="-1" aria-labelledby="teacherAddModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="teacherAddModalLabel">Add New Teacher Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
                <form id="tchrAddForm">
                    <div class="w-full p-10 mt-2">
                        <div class="relative mx-auto w-32 h-32 rounded-full border-gray-600 border-4">
                            <img id="avatartchr" class="w-full h-full rounded-full"
                                src="../assets/images/account.png" />
                            <div id="cameratchr"
                                class="cursor-pointer absolute bottom-0 h-10 w-full bg-white p-1 opacity-25 hover:opacity-75">
                                <img src="../assets/images/camera.png" class="h-8 w-8 mx-auto" />
                            </div>
                        </div>
                        <input id="fileChoosertchr" class="hidden" name="file" type="file" accept="image/*" />
                    </div>
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group floating-label">
                                    <input type="text" name="formVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">First name</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group floating-label">
                                    <input type="text" name="formVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">Middle name</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group floating-label">
                                    <input type="text" name="formVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">Last name</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group floating-label">
                                    <input class="date-picker form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2 rounded-lg" value="<?php echo date('Y-m-d');?>" type="text" required="required" name="formVal[]" 
                                    onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="tchrObj.dateFormatTeacher(this)">
                                    <label for="">Date of birth</label>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group floating-label">
                                    <input type="text" name="formVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">Address</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group floating-label">
                            <select name="formVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                <option value=""></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <label for="">Gender</label>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group floating-label">
                                    <input type="email" name="formVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">Email</label>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group floating-label">
                                    <input type="number" name="formVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">Contact Number</label>
                                </div>
                            </div>
                        </div>   
                
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group floating-label">
                                <input type="password" name="formVal[]" id="password" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2" required>
                                <div class="absolute top-4 right-3"> 
                                    <i class="fas fa-eye cursor-pointer hover:text-gray-700" id="toggleTPassword"></i> 
                                </div> 
                                <label for="">Password</label>
                            </div>
                        </div>
                            
                        <div class="col-sm-6">
                            <div class="form-group floating-label">
                                <input type="password" name="formVal[]" id="CPassword" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2" required>
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
                        <input id="btnTeacher" data-toggle="tooltip" data-placement="top" title="Add New Teacher" type="submit" value="Save" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
<!--Add Modal-->

<!--Update Teacher Modal-->
<div class="modal fade" id="teacherUpdateModal" tabindex="-1" aria-labelledby="teacherUpdateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="teacherUpdateModalLabel">Update Teacher Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
                <form id="tchrUpdateForm">
                    <div class="w-full p-10 mt-2">
                        <div class="relative mx-auto w-32 h-32 rounded-full border-gray-600 border-4">
                            <img id="avatarnewteacher" class="w-full h-full rounded-full"
                                src="../assets/images/account.png" />
                            <div id="tchrnewcameras"
                                class="cursor-pointer absolute bottom-0 h-10 w-full bg-white p-1 opacity-25 hover:opacity-75">
                                <img src="../assets/images/camera.png" class="h-8 w-8 mx-auto" />
                            </div>
                        </div>
                        <input id="tchrnewfileChooser" class="hidden" name="file" type="file" accept="image/*" />
                        <input type="text" class="hidden" id="tchrcurrentavatar" name="formNewVal[]">
                        <input type="text" id="tchrid" class="hidden" name="formNewVal[]">
                    </div>
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group floating-label">
                                    <input type="text" id="tchrfname" name="formNewVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">First name</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group floating-label">
                                    <input type="text" id="tchrmname" name="formNewVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">Middle name</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group floating-label">
                                    <input type="text" id="tchrlname" name="formNewVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">Last name</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group floating-label">
                                    <input id="tchrdob" class="date-picker form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2 rounded-lg" value="<?php echo date('Y-m-d');?>" type="text" required="required" name="formNewVal[]" 
                                    onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="tchrObj.dateFormatTeacher(this)">
                                    <label for="">Date of birth</label>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group floating-label">
                                    <input type="text" id="tchraddress" name="formNewVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">Address</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group floating-label">
                            <select name="formNewVal[]" id="tchrgender" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                <option value=""></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <label for="">Gender</label>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group floating-label">
                                    <input type="email" id="tchremail" name="formNewVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">Email</label>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group floating-label">
                                    <input type="number" id="tchrcontactno" name="formNewVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
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
                        <input id="btnNewTeacher" data-toggle="tooltip" data-placement="top" title="Update Teacher" type="submit" value="Update" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
<!--Update Teacher Modal-->

<!--Print & Download Qrcode Modal-->
<div class="modal fade" id="teacherQrcodeModal" tabindex="-1" aria-labelledby="teacherModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="teacherModalLabel">Teacher QrCode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            <div class="row space-x-4">
                <div class=" col justify-center border-2 border-gray-200 rounded-lg">
                    <canvas id="teacherQr"></canvas>
                    <img class="hidden" src="" alt="" id="teacherQrimg" />
                </div>

                <div class="col">
               <div class="justify-center border-2 border-gray-200 rounded-lg">
                <div class="m-2">
                    <video poster="../assets/images/poster.png" class="rounded-2xl w-full" id="preview"></video> 
                </div>
                    <div class="flex justify-center m-2">
                        <input type="button" id="testQrBtn" class=" h-12 w-full hover:border-blue-600 hover:bg-blue-100 hover:text-blue-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-xl border-blue-500 border-2" value="Test QrCode" />
                    </div>
                </div>
           </div>
        </div>
      </div>  
            <div class="modal-footer">
            <input type="text" id="filenameQr" class="hidden">
                <div class="d-flex flex-row-reverse">
                    <div class="p-2">
                        <button data-toggle="tooltip" data-placement="top" title="Print Qrcode" class="w-12 h-12 hover:border-blue-600 hover:bg-blue-100 hover:text-blue-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-xl border-blue-500 border-2" onclick="qrcode.toImage(), tchrObj.printTeacherQrCode()" type="button">
                            <i class="fas fa-print"></i>
                        </button>
                    </div>
                    <div class="p-2">
                        <button id="dlPrintQr" data-toggle="tooltip" data-placement="top" title="Download Qrcode" type="submit" class="w-12 h-12 hover:border-green-600 hover:bg-green-100 hover:text-green-600 tracking-wide text-lg text-white bg-green-400 py-2 rounded-xl border-green-500 border-2">
                            <i class="fas fa-file-download text-2xl"></i>
                        </button>
                        <script>
                            dlPrintQr.onclick = async(e) => {
                                let fname = document.querySelector('#filenameQr').value;
                                let current = new Date();
                                let cDate = current.getFullYear() + '-' + (current.getMonth() + 1) + '-' + current.getDate();
                                let cTime = current.getHours() + ":" + current.getMinutes() + ":" + current.getSeconds();
                                let filename = 
                                '(TEACHER) ' +
                                fname  + ' ' +
                                 cDate + ' ' + cTime;

                                qrcode.downloadImage(filename);
                            }
                        </script>
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
<!--Print & Download Qrcode Modal-->

<!--Unactive Modal-->
<div class="modal fade" id="unactiveTeacherModal" tabindex="-1" aria-labelledby="unactiveTeacherModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="unactiveTeacherModalLabel">Unactive List Teachers</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="container rounded-lg border-2 border-gray-200">
            <div class="card">
                <div class="card-header">
                    <?php 
                        $title = 'UNACTIVE TEACHERS DATA';
                        require('tableHeader.php');
                    ?>
                </div>
                    <div class="card-body">
                        <form id="tchrUnactForm">
                            <div class="row">
                                <div class="col-0 ml-2">
                                    <button type="submit"  data-toggle="tooltip" data-placement="top" title="Restore Data" class="h-16 w-16 hover:border-green-600 hover:bg-green-100 hover:text-green-600 tracking-wide text-lg text-white bg-green-400  py-2 rounded-full border-green-500 border-2">
                                        <i class="fas fa-recycle"></i>
                                    </button>
                                </div>
                                
                                <div class="col flex flex-row-reverse relative">
                                    <div class="relative"> <input type="search" id="searchtchrUnact" class="h-16 border-2 border-gray-200 text-lg w-96 pr-8 pl-5 rounded-full focus:shadow focus:outline-none text-black text-center" placeholder="Search here...">
                                    <div class="absolute top-5 left-6"> <i class="fa fa-search text-black z-20 hover:text-black text-2xl"></i> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th>
                                            <input class="w-5 h-5" type="checkbox" id="checkAllUnActTeacher">
                                        </th>
                                        <th>#</th>
                                        <th>Picture</th>
                                        <th>Qrcode</th>
                                        <th>Teacher's Name</th>
                                        <th>Date of Birth</th>
                                        <th>Gender</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Contact Number</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbodyunactteacher">
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


<!-- Upload Template Csv File Form-->
<div class="modal fade" id="teacherUploadCsvModal" tabindex="-1" aria-labelledby="teacherUploadCsvModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="teacherUploadCsvModalLabel">Upload Template Csv File Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form id="uploadSudentCsvFileForm">
          <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
            <div class="md:flex">
              <div class="w-full p-3">
                  <div class="relative border-dotted h-48 rounded-lg border-dashed border-2 border-blue-700 bg-gray-100 flex justify-center items-center">
                      <div class="absolute">
                        <div class="flex flex-col items-center"> <i class="fas fa-file-csv fa-4x text-blue-700"></i> <span class="block text-gray-400 font-normal">Attach Csv Files Here</span> 
                        </div>
                      </div> <input type="file" class="h-full w-full opacity-0" name="file" name="excel" id="excelParser">
                      <button type="submit" class="hidden" id="btnSubmit"></button>
                      </form>
                  </div>
              </div>
            </div>
          </div>

        <div class="relative pt-1">
          <div class="overflow-hidden h-10 text-xs flex rounded bg-purple-200">
              <div id="progressUploadbar"
                  class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"><h1 class="ml-1" id="percentUpload">0%</h1>
              </div>
          </div>
        </div>

      </div>
    </div>
  </div>
<!-- Upload Template Csv File Form-->