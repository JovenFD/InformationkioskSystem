<div class="container rounded-lg border-2 border-gray-200">
    <div class="card">
        <div class="card-header">
            <h1 class="text-lg text-center text-black">VISITORS LOG</h1>
        </div>
            <div class="card-body">
                    <div class="row p-2">
                        <div class="col-0 ml-2">
                            <select id="limitvisitorlogsnum" class="border-2 border-gray-200 h-16 w-16 rounded-full text-lg focus:shadow focus:outline-none text-black">
                            <option value="5">5</option>
                            <?php 
                                for ($i=1; $i < 11; $i++) { 
                                    echo '<option value="'.($i*10).'">'.($i*10).'</option>';
                                }
                            ?>
                            </select>
                        </div>
                        <div class="col-md">
                            <button type="button" id="btnPrintVisitorsLogsData" data-toggle="tooltip" data-placement="top" title="Print All Data" class="h-16 w-16 hover:border-blue-600 hover:bg-blue-100 hover:text-red-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2">
                                <i class="fa fa-print"></i>
                            </button>
                        </div>

                        <div class="col-md -top-5">    
                            <div class="relative text-black">
                                <small>Date From</small>
                                <input type="date" value="<?php echo date('Y-m-d');?>" id="datevisitorform" class="h-16 border-2 border-gray-200 text-lg w-full rounded-full focus:shadow focus:outline-none text-black pr-8 pl-8">
                            </div>  
                        </div>

                        <div class="col-md -top-5">    
                            <div class="relative text-black"> 
                                <small>Date To</small>
                                <input disabled type="date" value="<?php echo date('Y-m-d');?>" id="datevisitorto" class="h-16 border-2 border-gray-200 text-lg w-full rounded-full focus:shadow focus:outline-none text-black pr-8 pl-8">
                            </div>
                        </div>

                        <div class="col-md">
                            <div class="relative"> <input type="search" id="searchVisitorLogsData" class="h-16 border-2 border-gray-200 text-lg w-full pr-8 pl-5 rounded-full focus:shadow focus:outline-none text-black text-center" placeholder="Search here...">
                            <div class="absolute top-5 left-6"> <i class="fa fa-search text-black z-20 hover:text-black text-2xl"></i> </div>
                            </div>
                        </div>
                    </div>
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Picture</th>
                                <th>Name</th>
                                <th>User Type</th>
                                <th>Log Type</th>
                                <th>Log Date & Time</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyvisitorlogs">
                        </tbody>
                    </table>
                </div>
                
                <div>

                </div>

                <div class="justify-center max-w-full mt-3">
                    <div class="flex justify-center space-x-1">
                    <div id="logsVisitorPrev" class="flex items-center px-4 py-2 text-gray-500 bg-gray-300 rounded-md hover:bg-blue-100 border-solid border-2  border-gray-400">
                        <i class="fas fa-angle-double-left text-xl"></i>
                    </div>
                
                    <div class="flex overflow-x-auto max-w-7xl">
                        <div id="logs-btn-visitor-pages" class="parent flex max-w-7xl"></div>
                    </div>

                    <div id="logsVisitorNext" class="flex items-center px-4 py-2 text-gray-500 bg-gray-300 rounded-md hover:bg-blue-100 border-solid border-2  border-gray-400">
                        <i class="fas fa-angle-double-right text-xl"></i>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<!-- sweetalert -->
<script src="../assets/js/sweetAlert.js"></script>
<script src="../assets/js/logVisitorForm.js"></script>