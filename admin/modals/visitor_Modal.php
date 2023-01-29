<!--Visitors Form-->
<div class="modal fade" id="visitorsModal" tabindex="-1" aria-labelledby="visitorsAddModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
        
      <div class="modal-header">
        <h5 class="modal-title" id="visitorsAddModalLabel">Visitors Date Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
                <form id="vipVisitorsAddForm">
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group floating-label">
                                <input type="text" name="vipVisitorForm[]" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2" required>
                                <label for="">First name</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group floating-label">
                                <input type="text" name="vipVisitorForm[]" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2" required>
                                <label for="">Middle name</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group floating-label">
                                <input type="text" name="vipVisitorForm[]" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2"  required>
                                <label for="">Last name</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group floating-label">
                                <input class="date-picker form-control h-12 rounded w-full mb-8 border-gray-500 border-2 rounded" value="<?php echo date('Y-m-d');?>" type="text" required="required" name="vipVisitorForm[]" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="vstrsObj.visitorsDateFormat(this)">
                                <label for="">Date of birth</label>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group floating-label">
                                <input type="number"  name="vipVisitorForm[]" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2" required>
                                <label for="">Contact no.</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group floating-label">
                        <select name="vipVisitorForm[]" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2" required>
                            <option value=""></option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <label for="" class="mt-1">Gender</label>
                    </div>

                    <div class="form-group floating-label">
                        <input type="text" name="vipVisitorForm[]" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2" required>
                        <label for="">QrCode/IdPass</label>
                    </div>

                    <div class="form-group floating-label">
                        <textarea required rows="5" cols="10" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2" name="vipVisitorForm[]"></textarea>
                        <label for="" class="mt-1">Address</label>
                    </div>

                    <div class="form-group floating-label">
                        <textarea required rows="5" cols="10" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2" name="vipVisitorForm[]"></textarea>
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
<!--Visitors Form-->

<!--Print & Download Qrcode Modal-->
<div class="modal fade" id="visitorsQrcodeModal" tabindex="-1" aria-labelledby="visitorsQrcodeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="visitorsQrcodeModalLabel">Visitors Qrcode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="row space-x-4">

           <div class="col flex justify-center border-2 border-gray-200 rounded-lg">
                <canvas id="visitorsQr"></canvas>
                <img class="hidden" src="" alt="" id="visitorsQrimg" />
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
                        <button data-toggle="tooltip" data-placement="top" title="Print Qrcode" class="w-12 h-12 hover:border-blue-600 hover:bg-blue-100 hover:text-blue-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-xl border-blue-500 border-2" onclick="qrcode.toImage(), vstrsObj.printVisitorsQrCode()" type="button">
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
                                '(VISITORS) ' +
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
<div class="modal fade" id="visitorUnActModal" tabindex="-1" aria-labelledby="visitorUnActModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="visitorUnActModalLabel">Unactive Visitors List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="container rounded-lg border-2 border-gray-200">
            <div class="card">
                <div class="card-header">
                    <?php 
                        $title = 'UNACTIVE VISITORS DATA';
                        require('tableHeader.php');
                    ?>
                </div>
                    <div class="card-body">
                        <form id="visitorUnactForm">
                            <div class="row">
                                <div class="col-0 ml-2">
                                    <button type="submit"  data-toggle="tooltip" data-placement="top" title="Restore Data" class="h-16 w-16 hover:border-green-600 hover:bg-green-100 hover:text-green-600 tracking-wide text-lg text-white bg-green-400  py-2 rounded-full border-green-500 border-2">
                                        <i class="fas fa-recycle"></i>
                                    </button>
                                </div>
                                
                                <div class="col flex flex-row-reverse relative">
                                    <div class="relative"> <input type="search" id="searchUnactVstrs" class="h-16 border-2 border-gray-200 text-lg w-96 pr-8 pl-5 rounded-full focus:shadow focus:outline-none text-black text-center" placeholder="Search here...">
                                    <div class="absolute top-5 left-6"> <i class="fa fa-search text-black z-20 hover:text-black text-2xl"></i> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center text-lg">
                                    <thead>
                                        <tr>
                                            <th><input class="w-5 h-5" type="checkbox" id="vstrsUnactcheckAll">
                                            </th>
                                            <th>#</th>
                                            <th>Picture</th>
                                            <th>Qrcode</th>
                                            <th>Visitors's Name</th>
                                            <th>Date of Birth</th>
                                            <th>Gender</th>
                                            <th>Address</th>
                                            <th>Contact Number</th>
                                            <th>Porpose</th>
                                        </tr>  
                                    </thead>
                                    <tbody id="tbodyUnactVstrs">
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

