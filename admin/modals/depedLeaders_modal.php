<!--Deped Leaders Form-->
<div class="modal fade" id="depedLeadersModal" tabindex="-1" aria-labelledby="depedLeadersModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="depedLeadersModalLabel">Deped Leaders Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
                <form id="leadersAddForm">
                <div class="w-full p-10 mt-2">
                        <div class="relative mx-auto w-32 h-32 rounded-full border-gray-600 border-4">
                            <img id="avatarDepedLeaders" class="w-full h-full rounded-full"
                                src="../assets/images/account.png" />
                            <div id="cameraDepedLeaders"
                                class="cursor-pointer absolute bottom-0 h-10 w-full bg-white p-1 opacity-25 hover:opacity-75">
                                <img src="../assets/images/camera.png" class="h-8 w-8 mx-auto" />
                            </div>
                        </div>
                        <input id="fileChooserDepedLeaders" class="hidden" name="file" type="file" accept="image/*" />
                        <input type="text" name="depedLeadersFormVal[]" id="userLeaderId" class="hidden">
                        <input type="text" id="avatarValDepedLeaders" class="hidden" name="depedLeadersFormVal[]">
                    </div>

                    <div class="form-group floating-label">
                        <input type="text" id="fnameDepedLeaders" name="depedLeadersFormVal[]" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2" required>
                        <label for="">First Name</label>
                    </div>
                    
                    <div class="form-group floating-label">
                        <input type="text" id="mnameDepedLeaders" name="depedLeadersFormVal[]" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2" required>
                        <label for="">Middle Name</label>
                    </div>
                    
                    <div class="form-group floating-label">
                        <input type="text" id="lnameDepedLeaders" name="depedLeadersFormVal[]" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2" required>
                        <label for="">Last Name</label>
                    </div>

                    <div class="form-group floating-label">
                        <input type="text" id="numpos" name="depedLeadersFormVal[]" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2" required>
                        <label for="">Position</label>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex flex-row-reverse">
                    <div class="p-2">
                        <button data-toggle="tooltip" data-placement="top" title="Reset" class="hover:border-red-600 hover:bg-gray-100 hover:text-red-600 tracking-wide text-lg text-white bg-red-400 px-9 py-2 rounded-3xl border-red-500 border-2" type="reset">Reset</button>
                    </div>
                    <div class="p-2">
                        <input id="leaders-btn" data-toggle="tooltip" data-placement="top" title="Add New Class" type="submit" value="Save" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
<!--Deped Leaders Form-->