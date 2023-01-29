<!--School news Form-->
<div class="modal fade" id="newsAddModal" tabindex="-1" aria-labelledby="newsAddModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newsAddModalLabel">Add News Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
                <form id="newsAddForm">
                <div class="w-full p-10 mt-2">
                        <div class="relative mx-auto w-32 h-32 rounded-full border-gray-600 border-4">
                            <img id="avatarNews" class="w-full h-full rounded-full"
                                src="../assets/slideShowImg/defaultImg.jpg" />
                            <div id="cameraNews"
                                class="cursor-pointer absolute bottom-0 h-10 w-full bg-white p-1 opacity-25 hover:opacity-75">
                                <img src="../assets/images/camera.png" class="h-8 w-8 mx-auto" />
                            </div>
                        </div>
                        <input id="fileChooserNews" class="hidden" name="file" type="file" accept="image/*" />
                    </div>
                    <div class="form-group floating-label">
                        <input type="text" name="newsFormVal[]" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2" required>
                        <label for="">Title</label>
                    </div>

                    <div class="form-group floating-label">
                        <textarea type="text" name="newsFormVal[]" class="form-control rounded-lg w-full mb-8 border-gray-500 border-2" rows="5" cols="50" required></textarea>
                        <label for="">Summary</label>
                    </div>

                    <div class="form-group floating-label">
                        <textarea type="text" name="newsFormVal[]" class="form-control rounded-lg w-full mb-8 border-gray-500 border-2" rows="10" cols="50" required></textarea>
                        <label for="">Text</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex flex-row-reverse">
                    <div class="p-2">
                        <button data-toggle="tooltip" data-placement="top" title="Reset" class="hover:border-red-600 hover:bg-gray-100 hover:text-red-600 tracking-wide text-lg text-white bg-red-400 px-9 py-2 rounded-3xl border-red-500 border-2" type="reset">Reset</button>
                    </div>
                    <div class="p-2">
                        <input id="news-btn" data-toggle="tooltip" data-placement="top" title="Add School News" type="submit" value="Save" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
<!--School news Form-->

<!--School news update Form-->
<div class="modal fade" id="newsUpdateModal" tabindex="-1" aria-labelledby="newsUpdateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newsUpdateModalLabel">Update News Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
                <form id="newsUpdateForm">
                <div class="w-full p-10 mt-2">
                        <div class="relative mx-auto w-32 h-32 rounded-full border-gray-600 border-4">
                            <img id="newavatarNews" class="w-full h-full rounded-full"
                                src="../assets/slideShowImg/defaultImg.jpg" />
                            <div id="newcameraNews"
                                class="cursor-pointer absolute bottom-0 h-10 w-full bg-white p-1 opacity-25 hover:opacity-75">
                                <img src="../assets/images/camera.png" class="h-8 w-8 mx-auto" />
                            </div>
                        </div>
                        <input id="newfileChooserNews" class="hidden" name="file" type="file" accept="image/*" />
                        <input type="text" id="newsid" class="hidden" name="newsUpdateFormVal[]">
                        <input type="text" id="newpath" class="hidden" name="newsUpdateFormVal[]">
                    </div>
                    <div class="form-group floating-label">
                        <input type="text" id="title" name="newsUpdateFormVal[]" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2" required>
                        <label for="">Title</label>
                    </div>

                    <div class="form-group floating-label">
                        <textarea type="text" id="summary" name="newsUpdateFormVal[]" class="form-control rounded-lg w-full mb-8 border-gray-500 border-2" rows="5" cols="50" required></textarea>
                        <label for="">Summary</label>
                    </div>

                    <div class="form-group floating-label">
                        <textarea type="text" id="text" name="newsUpdateFormVal[]" class="form-control rounded-lg w-full mb-8 border-gray-500 border-2" rows="10" cols="50" required></textarea>
                        <label for="">Text</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex flex-row-reverse">
                    <div class="p-2">
                        <button data-toggle="tooltip" data-placement="top" title="Reset" class="hover:border-red-600 hover:bg-gray-100 hover:text-red-600 tracking-wide text-lg text-white bg-red-400 px-9 py-2 rounded-3xl border-red-500 border-2" type="reset">Reset</button>
                    </div>
                    <div class="p-2">
                        <input id="news-update-btn" data-toggle="tooltip" data-placement="top" title="Update School News" type="submit" value="Update" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
<!--School news update Form-->