<div class="container rounded-lg border-2 border-gray-200">
    <div class="card">
        <div class="card-header">
            <?php 
                $title = 'UPLOAD SYSTEM LOGO';
                require('tableHeader.php');
            ?>
        </div>
            <div class="card-body">
            <form id="logoForm">
                <div class="float-right mb-3">
                    <button type="submit" data-placement="top" title="Save Changes" class="w-16 h-16 hover:border-blue-600 hover:bg-blue-100 hover:text-blue-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2" data-toggle="tooltip">
                        <i class="fa fa-save text-2xl"></i>
                    </button>
                </div> 
                    <div class="table-responsive">
                        <table class="table table-bordered text-center text-lg">
                            <thead>
                                <tr>
                                    <th>LEFT LOGO</th>
                                    <th>RIGHT LOGO</th>
                                </tr>
                                <tr>
                                    <th>
                                    <div class="w-full p-10 mt-2">
                                        <div class="relative mx-auto w-32 h-32 rounded-full border-gray-600 border-4">
                                            <img id="leftlogoavatar" class="w-full h-full rounded-full"
                                                src="../assets/slideShowImg/defaultImg.jpg" />
                                            <div id="leftlogocameras"
                                                class="cursor-pointer absolute bottom-0 h-10 w-full bg-white p-1 opacity-25 hover:opacity-75">
                                                <img src="../assets/images/camera.png" class="h-8 w-8 mx-auto" />
                                            </div>
                                        </div>
                                        <input id="leftlogofileChooser" class="hidden" name="fileL" type="file" accept="image/*" />
                                        <input type="text" class="hidden"  name="idleftlogo" id="idleftlogo">
                                    </div>
                                    <small class="text-center">Filename</small>
                                        <div id="leftfname" class="text-center text-md"></div>
                                    </th>
                                    <th>
                                        <div class="w-full p-10 mt-2">
                                            <div class="relative mx-auto w-32 h-32 rounded-full border-gray-600 border-4">
                                                <img id="rightlogoavatar" class="w-full h-full rounded-full"
                                                    src="../assets/slideShowImg/defaultImg.jpg" />
                                                <div id="rightlogocameras"
                                                    class="cursor-pointer absolute bottom-0 h-10 w-full bg-white p-1 opacity-25 hover:opacity-75">
                                                    <img src="../assets/images/camera.png" class="h-8 w-8 mx-auto" />
                                                </div>
                                            </div>
                                            <input id="rightlogofileChooser" class="hidden" name="fileR" type="file" accept="image/*" />
                                            <input type="text" class="hidden" name="idrightlogo" id="idrightlogo">
                                        </div>
                                        <small class="text-center">Filename</small>
                                        <div id="rightfname" class="text-center text-md"></div>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </form>

            </div>
        </div>
</div>
        
  <!-- sweetalert -->
<script src="../assets/js/sweetAlert.js"></script>
<script src="../assets/dynamic/logoForm.js"></script>