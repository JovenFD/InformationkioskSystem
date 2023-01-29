<!--Student Grades-->
<div class="modal fade" id="gradesModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="infoModalLabel">STUDENT VIEW GRADES</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

          <div class="modal-body">
          <div class="bg-white w-full pb-9 rounded-xl bg-white border-gray-400 border-2 p-9 text-lg text-gray-400">
            <div class="card">

              <div class="card-header">
                  <?php
                    $title = 'VIEW STUDENT GRADES';

                    require_once('./landingPage/mapHeader.php');
                  ?>
                </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead>
                                  <tr>
                                    <th colspan="3">Learner's Name: </th>
                                    <td colspan="6"><u id="studentName">none</u></td>
                                  </tr>
                                  <tr>
                                    <th colspan="3">School Year: </th>
                                    <td colspan="6"><u id="sy">none</u></td>
                                  </tr>
                                    <tr>
                                        <th class="transform -rotate-45 px-5 py-5">#</th>
                                        <th class="transform -rotate-45 px-5 py-5">Subject</th> 
                                        <th class="transform -rotate-45 px-5 py-5">First Quarter</th>
                                        <th class="transform -rotate-45 px-5 py-5">Second Quarter</th>
                                        <th class="transform -rotate-45 px-5 py-5">Thirth Quarter</th>
                                        <th class="transform -rotate-45 px-5 py-5">Fourth Quarter</th>
                                        <th class="transform -rotate-45 px-5 py-5">Average</th>
                                        <th class="transform -rotate-45 px-5 py-5">Remarks</th>    
                                        <th class="transform -rotate-45 px-5 py-5">Adviser</th>  
                                    </tr>
                                </thead>
                                <tbody id="tbodyGrades">
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>

              </div>
          </div>

        </div>
    </div>
</div>

<!--Student Grades-->
