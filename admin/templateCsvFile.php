<div class="container rounded-lg border-2 border-gray-200">
    <div class="card">
        <div class="card-header">
            <?php 
                $title = 'STUDENT RESULT TEMPLATE';
                require_once('tableHeader.php'); 
            ?>
        </div>
            <div class="card-body">
                <div class="container mb-4">
                    <div class="row">
                        <div class="col-sm">
                            <div class="relative text-black"> 
                                <small>School Year</small>
                                <select id="listyear" class="h-16 border-2  border-gray-200 text-xl w-full pr-8 pl-5 rounded-full focus:shadow focus:outline-none">
                                    <option value="">Select Year</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="relative text-black"> 
                                <small>Subject</small>
                                <select disabled id="listsubject" class="h-16 border-2  border-gray-200 text-xl w-full pr-8 pl-5 rounded-full focus:shadow focus:outline-none">
                                    <option value="">Select Subject</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="relative text-black"> 
                                <small>Teacher</small>
                                <select disabled id="listteacher" class="h-16 border-2  border-gray-200 text-xl w-full pr-8 pl-5 rounded-full focus:shadow focus:outline-none">
                                    <option value="">Select Teacher</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="relative text-black"> 
                                <small>Class</small>
                                <select disabled id="listclass" class="h-16 border-2 border-gray-200 text-xl w-full pr-8 pl-5 rounded-full focus:shadow focus:outline-none">
                                    <option value="">Select Class</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-0 mr-3">
                            <button type="button"  data-toggle="tooltip" data-placement="top" id="btnFilecsv" title="Download Csv File" class="w-16 h-16 mt-3 float-right hover:border-blue-600 hover:bg-blue-100 hover:text-blue-600 tracking-wide text-lg text-white bg-blue-400 rounded-full border-blue-500 border-2">
                                <i class="fas fa-download text-2xl"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered text-center text-black text-lg">
                        <thead>
                            <tr>
                                <th class="transform -rotate-45  px-5 py-5">#</th>
                                <th class="transform -rotate-45  px-5 py-5">Learner's Name</th>
                                <th class="transform -rotate-45 px-5 py-5">First Quarter</th>
                                <th class="transform -rotate-45 px-5 py-5">Second Quarter</th>
                                <th class="transform -rotate-45 px-5 py-5">Thirth Quarter</th>
                                <th class="transform -rotate-45 px-5 py-5">Fourth Quarter</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyCsvFile">
                            <tr>
                                <td colspan="12" class="font-5xl text-center font-extrabold animate-bounce">Data Not Found...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div>

                </div>
            </div>
        </div>

    </div>
</div>
<!-- sweetalert -->
<script src="../assets/js/sweetAlert.js"></script>
<script src="../assets/js/templateCsvFileForm.js"></script>