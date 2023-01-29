<!--Slider slider Form-->
<div class="modal fade" id="sliderAddModal" tabindex="-1" aria-labelledby="sliderAddModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sliderAddModalLabel">Upload Images Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
                <form id="sliderAddForm">
                <div class="w-full p-10 mt-2">
                    <div class="relative mx-auto w-32 h-32 rounded-full border-gray-600 border-4">
                            <img id="slideravatar" class="w-full h-full rounded-full"
                                src="../assets/slideShowImg/defaultImg.jpg" />
                            <div id="slidercameras"
                                class="cursor-pointer absolute bottom-0 h-10 w-full bg-white p-1 opacity-25 hover:opacity-75">
                                <img src="../assets/images/camera.png" class="h-8 w-8 mx-auto" />
                            </div>
                        </div>
                        <input type="text" name="type" value="type_upload_slider" class="hidden">
                        <input id="sliderfileChooser" class="hidden" name="file" type="file" accept="image/*" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex flex-row-reverse">
                    <div class="p-2">
                        <input id="slider-btn" data-toggle="tooltip" data-placement="top" title="Add New Images" type="submit" value="Upload" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
<!--Slider slider Form-->

<!--Slider update slider Form-->
<div class="modal fade" id="sliderUpdateModal" tabindex="-1" aria-labelledby="sliderUpdateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sliderUpdateModalLabel">Update Images Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
                <form id="sliderNewUpdateForm">
                <div class="w-full p-10 mt-2">
                    <div class="relative mx-auto w-32 h-32 rounded-full border-gray-600 border-4">
                            <img id="newslideravatar" class="w-full h-full rounded-full"
                                src="../assets/slideShowImg/defaultImg.jpg" />
                            <div id="newslidercameras"
                                class="cursor-pointer absolute bottom-0 h-10 w-full bg-white p-1 opacity-25 hover:opacity-75">
                                <img src="../assets/images/camera.png" class="h-8 w-8 mx-auto" />
                            </div>
                        </div>
                        <input type="text" id="idSlider" name="sliderVal[]" class="hidden">
                        <input type="text" id="currentVal" name="sliderVal[]" class="hidden">
                        <input id="newsliderfileChooser" class="hidden" name="file" type="file" accept="image/*" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex flex-row-reverse">
                    <div class="p-2">
                        <input id="newslider-btn" data-toggle="tooltip" data-placement="top" title="Update Images" type="submit" value="Upload" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
<!--Slider update slider Form-->