<!--Year Upload Student Grades Form-->
<div class="modal fade" id="uploadStudentGradesModal" tabindex="-1" aria-labelledby="uploadStudentGradesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="uploadStudentGradesModalLabel">Upload Student Grades Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
          <div class="md:flex">
            <div class="w-full p-3">
                <div class="relative border-dotted h-48 rounded-lg border-dashed border-2 border-blue-700 bg-gray-100 flex justify-center items-center">
                    <div class="absolute">
                        <div class="flex flex-col items-center"> <i class="fas fa-file-csv fa-4x text-blue-700"></i> <span class="block text-gray-400 font-normal">Attach Csv Files Here</span> </div>
                    </div> <input type="file" class="h-full w-full opacity-0" name="excel" id="excelParser">
                </div> 
            </div> 
          </div>
        </div>

        <div class="relative pt-1">
          <div class="overflow-hidden h-10 text-xs flex rounded bg-purple-200">
              <div id="progressbar"
                  class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"><h1 class="ml-1" id="percent">0%</h1>
              </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  </div>
<!--Year Upload Student Grades Form-->