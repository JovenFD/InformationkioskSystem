<div class="container rounded-lg border-2 border-gray-200">
    <div class="card">
        <div class="card-header">
            <?php
                $title = 'PRINT SUMMARY OF QUARTERLY GRADES';
                require_once('tableHeader.php'); 
            ?>
        </div>
            <div class="card-body">
                <div class="container mb-4">
                    <div class="row">

                        <div class="col-sm">    
                            <div class="relative mt-2"> 
                                <small>Select Class</small>
                                <select id="listPrintClass" class="h-16 border-2  border-gray-200 text-lg w-full pr-8 pl-5 rounded-full focus:shadow focus:outline-none text-black" disabled>
                        
                                </select>   
                            </div>
                        </div>

                        <div class="col-sm">    
                            <div class="relative mt-2"> 
                                <small>Select Subject</small>
                                <select id="listPrintSubject" class="h-16 border-2  border-gray-200 text-lg w-full pr-8 pl-5 rounded-full focus:shadow focus:outline-none text-black" disabled>
                        
                                </select>
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="relative mt-2"> 
                                <small>Select Year Level</small>
                                <select id="listPrintYear" class="h-16 border-2  border-gray-200 text-lg w-full pr-8 pl-5 rounded-full focus:shadow focus:outline-none text-black" disabled>
                
                                </select>
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="relative mt-4 float-right">
                                <button type="button" id="printRecords" data-toggle="tooltip" data-placement="top" title="Print Records" class="w-16 h-16 hover:border-blue-600 hover:bg-blue-100 hover:text-red-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2">
                                    <i class="fas fa-print text-2xl"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered text-center text-lg">
                        <thead>
                            <tr>
                                <th rowspan="3" class="transform -rotate-45 border border-gray-400 px-5 py-5">#</th>
                                <th rowspan="3" class="transform -rotate-45 px-5 py-5">LEARNER'S NAMES</th>
                                <th colspan="2">GRADE & SECTION:</th>
                                <td><div id="gradeSec">none</div></td>
                                <th colspan="2">SCHOOL YEAR:</th>
                                <td><div id="year">none</div></td>  
                            </tr>
                            <tr>
                                <th colspan="2">TEACHER:</th>
                                <td ><div id="teacherName">none</div></td>
                                <th colspan="2">SUBJECT:</th>
                                <td><div id="subjectName">none</div></td>
                            </tr>
                            <tr>
                                <th class="transform -rotate-45 px-4 py-4">1st Quarter</th>
                                <th class="transform -rotate-45 px-4 py-4">2nd Quarter</th>
                                <th class="transform -rotate-45 px-4 py-4">3rd Quarter</th>
                                <th class="transform -rotate-45 px-4 py-4">4th Quarter</th>
                                <th class="transform -rotate-45 px-4 py-4">Final Grade</th>
                                <th class="transform -rotate-45 px-4 py-4">Remarks</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyPrintRecords">
                            <tr>
                                <td colspan="8" class="text-center font-extrabold animate-bounce">Data Not Found...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>

<script src="../assets/js/teacherPrintRecords.js"></script>
