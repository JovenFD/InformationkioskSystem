<!--Add Modal-->
<div class="modal fade" id="studentAddModal" tabindex="-1" aria-labelledby="studentAddModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="studentAddModalLabel">Add New Student Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
                <form id="stdAddForm" enctype="multipart/form-data">
                    <div class="w-full p-10 mt-2">
                        <div class="relative mx-auto w-32 h-32 rounded-full border-gray-600 border-4">
                            <img id="avatarstudent" class="w-full h-full rounded-full"
                                src="../assets/images/account.png" />
                            <div id="camerastudent"
                                class="cursor-pointer absolute bottom-0 h-10 w-full bg-white p-1 opacity-25 hover:opacity-75">
                                <img src="../assets/images/camera.png" class="h-8 w-8 mx-auto" />
                            </div>
                        </div>
                        <input id="fileChooserstudent" class="hidden" name="file" type="file" accept="image/*" />
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

                        <div class="form-group floating-label">
                            <input class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" name="formVal[]" type="text" required>
                            <label for="">Student No.</label>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group floating-label">
                                    <input class="date-picker form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2 rounded-lg" value="<?php echo date('Y-m-d');?>" type="text" required="required" name="formVal[]" 
                                    onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="stdObj.dateFormatStudent(this)">
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
                    </div>

                </div>
            <div class="modal-footer">
                <div class="d-flex flex-row-reverse">
                    <div class="p-2">
                        <button data-toggle="tooltip" data-placement="top" title="Reset" class="hover:border-red-600 hover:bg-gray-100 hover:text-red-600 tracking-wide text-lg text-white bg-red-400 px-9 py-2 rounded-3xl border-red-500 border-2" type="reset">Reset</button>
                    </div>
                    <div class="p-2">
                        <input id="btnStudent" data-toggle="tooltip" data-placement="top" title="Add New Student" type="submit" value="Save" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
<!--Add Modal-->

<!--Update Modal-->
<div class="modal fade" id="studentUpdateModal" tabindex="-1" aria-labelledby="studentUpdateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="studentUpdateModalLabel">Update Student Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
                <form id="stdNewUpdateForm">
                    <div class="w-full p-10 mt-2">
                        <div class="relative mx-auto w-32 h-32 rounded-full border-gray-600 border-4">
                            <img id="stdnewavatar" class="w-full h-full rounded-full"
                                src="../assets/images/account.png" />
                            <div id="stdnewcameras"
                                class="cursor-pointer absolute bottom-0 h-10 w-full bg-white p-1 opacity-25 hover:opacity-75">
                                <img src="../assets/images/camera.png" class="h-8 w-8 mx-auto" />
                            </div>
                        </div>
                        <input id="stdnewfileChooser" class="hidden" name="file" type="file" accept="image/*" />
                    </div>
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group floating-label">
                                    <input type="text" name="formNewVal[]" id="stdid" class="hidden">
                                    <input type="text" name="formNewVal[]" id="stdcurrentavatar" class="hidden">
                                    <input type="text" name="formNewVal[]" id="stdfname" name="formNewVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">First name</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group floating-label">
                                    <input type="text" id="stdmname" name="formNewVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">Middle name</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group floating-label">
                                    <input type="text" id="stdlname" name="formNewVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">Last name</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group floating-label">
                            <input class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" id="stdstudentno" name="formNewVal[]" type="text" required>
                            <label for="">Student No.</label>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group floating-label">
                                    <input class="date-picker form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2 rounded-lg" id="stddob" value="<?php echo date('Y-m-d');?>" type="text" required="required" name="formNewVal[]" 
                                    onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="stdObj.dateFormatStudent(this)">
                                    <label for="">Date of birth</label>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group floating-label">
                                    <input type="text" id="stdaddress" name="formNewVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">Address</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group floating-label">
                            <select id="stdgender" name="formNewVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                <option value=""></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <label for="">Gender</label>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group floating-label">
                                    <input type="email" id="stdemail" name="formNewVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">Email</label>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group floating-label">
                                    <input type="number" id="stdcontactno" name="formNewVal[]" class="form-control h-12 w-full mb-8 border-gray-500 border-2 rounded-lg" required>
                                    <label for="">Contact Number</label>
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
                        <input id="btnNewStudent" data-toggle="tooltip" data-placement="top" title="Update Student" type="submit" value="Update" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
<!--Update Modal-->

<!--Print & Download Qrcode Modal-->
<div class="modal fade" id="studentQrcodeModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="profileModalLabel">Student QrCode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="row space-x-4">

           <div class="col flex justify-center border-2 border-gray-200 rounded-lg">
                <canvas id="studentQr"></canvas>
                <img class="hidden" src="" alt="" id="studentQrimg" />
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
                        <button data-toggle="tooltip" data-placement="top" title="Print Qrcode" class="w-12 h-12 hover:border-blue-600 hover:bg-blue-100 hover:text-blue-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-xl border-blue-500 border-2" onclick="qrcode.toImage(), stdObj.printStudentQrCode()" type="button">
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
                                '(STUDENT) ' +
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
<div class="modal fade" id="unactiveStudentModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="profileModalLabel">Inactive List Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="container rounded-lg border-2 border-gray-200">
            <div class="card">
                <div class="card-header">
                    <?php 
                        $title = 'INACTIVE STUDENT DATA';
                        require('tableHeader.php');
                    ?>
                </div>
                    <div class="card-body">
                        <form id="studentUnactiveForm">
                            <div class="row">
                                <div class="col-0 ml-2">
                                    <button type="submit"  data-toggle="tooltip" data-placement="top" title="Restore Data" class="h-16 w-16 hover:border-green-600 hover:bg-green-100 hover:text-green-600 tracking-wide text-lg text-white bg-green-400 py-2 rounded-full border-green-500 border-2">
                                        <i class="fas fa-recycle"></i>
                                    </button>
                                </div>
                                
                                <div class="col flex flex-row-reverse relative">
                                    <div class="relative"> <input type="search" id="searchStdUnactive" class="h-16 border-2 border-gray-200 text-lg w-96 pr-8 pl-5 rounded-full focus:shadow focus:outline-none text-black text-center" placeholder="Search here...">
                                    <div class="absolute top-5 left-6"> <i class="fa fa-search text-black z-20 hover:text-black text-2xl"></i> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center text-lg">
                                    <thead>
                                        <tr>
                                            <th><input class="w-5 h-5" type="checkbox" id="checkAllUnactive">
                                            </th>
                                            <th>#</th>
                                            <th>Picture</th>
                                            <th>Qrcode</th>
                                            <th>Student No.</th>
                                            <th>Learner Name</th>
                                            <th>Date of Birth</th>
                                            <th>Gender</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th>Contact Number</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyStudentUncative">
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
<div class="modal fade" id="studentUploadCsvModal" tabindex="-1" aria-labelledby="studentUploadCsvModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="studentUploadCsvModalLabel">Upload Template Csv File Form</h5>
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


