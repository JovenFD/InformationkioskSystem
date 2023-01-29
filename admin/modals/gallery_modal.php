<!--Slider gallery Form-->
<div class="modal fade" id="galleryAddModal" tabindex="-1" aria-labelledby="galleryAddModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="galleryAddModalLabel">Upload School Image Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
                <form id="galleryAddForm">
                <div class="w-full p-10 mt-2">
                    <div class="relative mx-auto w-32 h-32 rounded-full border-gray-600 border-4">
                            <img id="galleryavatar" class="w-full h-full rounded-full"
                                src="../assets/slideShowImg/defaultImg.jpg" />
                            <div id="gallerycameras"
                                class="cursor-pointer absolute bottom-0 h-10 w-full bg-white p-1 opacity-25 hover:opacity-75">
                                <img src="../assets/images/camera.png" class="h-8 w-8 mx-auto" />
                            </div>
                        </div>
                        <input type="text" name="type_gallery" value="type_gallery" class="hidden">
                        <input id="galleryfileChooser" class="hidden" name="file" type="file" accept="image/*" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex flex-row-reverse">
                    <div class="p-2">
                        <input id="gallery-btn" data-toggle="tooltip" data-placement="top" title="Add New Images" type="submit" value="Upload" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
<!--Slider gallery Form-->

<!--Slider gallery update Form-->
<div class="modal fade" id="galleryUpdateModal" tabindex="-1" aria-labelledby="galleryUpdateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="galleryUpdateModalLabel">Update School Image Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
                <form id="newGalleryUpdateForm">
                <div class="w-full p-10 mt-2">
                    <div class="relative mx-auto w-32 h-32 rounded-full border-gray-600 border-4">
                            <img id="NewGalleryavatar" class="w-full h-full rounded-full"
                                src="../assets/slideShowImg/defaultImg.jpg" />
                            <div id="NewGalleryCameras"
                                class="cursor-pointer absolute bottom-0 h-10 w-full bg-white p-1 opacity-25 hover:opacity-75">
                                <img src="../assets/images/camera.png" class="h-8 w-8 mx-auto" />
                            </div>
                        </div>
                        <input id="NewGalleryfileChooser" class="hidden" name="file" type="file" accept="image/*" />
                        <input type="text" class="hidden" id="galleryId" name="updateGalleryValForm[]">
                        <input type="text" class="hidden" id="currentGalleryVal" name="updateGalleryValForm[]">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex flex-row-reverse">
                    <div class="p-2">
                        <input id="newGallery-btn" data-toggle="tooltip" data-placement="top" title="Add New Images" type="submit" value="Upload" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
<!--Slider gallery update Form-->