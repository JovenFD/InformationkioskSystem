<!-- Upload Video Form-->
<div class="modal fade" id="uploadFileModal" tabindex="-1" aria-labelledby="uploadFileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="uploadFileModalLabel">Upload File Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addReportFiles">
          <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
            <div class="md:flex">
              <div class="w-full p-3">
                  <div class="relative border-dotted h-48 rounded-lg border-dashed border-2 border-blue-700 bg-gray-100 flex justify-center items-center">
                      <div class="absolute">
                          <div class="flex flex-col items-center"> <i class="fas fa-file fa-4x text-blue-700"></i> <span class="block text-gray-400 font-normal">Attach Files Here</span> </div>
                      </div> 
                      <input type="file" class="h-full w-full opacity-0" name="file" id="inputFile">
                      <input type="text" name="type_file" value="type_file" class="hidden" />
                      <input type="hidden" required name="folder_id" value="<?php echo isset($_GET['folderId']) ? $_GET['folderId'] : '';?>">
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
<!-- Upload Video Form-->