<!-- Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="profileModalLabel">PROFILE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mb-2">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Update</a>
                </li>
            </ul>
            <div class="tab-content border-gray-400 border-2 rounded-xl" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                <div class="card hovercard">

                    <div class="info">
                        <table class="table table-bordered text-lg">
                            <tbody id="tbodyguard"></tbody>
                        </table>
                    </div>
                </div>
            </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                <div class="card hovercard">
                <form id="profileGuardForm">
                    <div class="w-full p-10 mt-2">
                        <div class="relative mx-auto w-32 h-32 rounded-full border-gray-600 border-4">
                            <img id="avatarguardprofile" class="w-full h-full rounded-full"
                                src="../assets/images/account.png" />
                            <div id="guardcameraprofile"
                                class="cursor-pointer absolute bottom-0 h-10 w-full bg-white p-1 opacity-25 hover:opacity-75">
                                <img src="../assets/images/camera.png" class="h-8 w-8 mx-auto" />
                            </div>
                        </div>
                        <input id="guardfileChooserprofile" class="hidden" name="file" type="file" accept="image/*" />
                        <hr>
                    </div>

                    <div class="info">
                            <div class="form-row">
                                <div class="col-md-4">
                                <input type="text" id="guarid" class="hidden" name="formGuardProfileVal[]">
                                <input type="text" id="currentAvatar" class="hidden" name="formGuardProfileVal[]">
                                    <div class="form-group floating-label">
                                        <input type="text" id="guardfname" name="formGuardProfileVal[]" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2">
                                        <label for="">First name</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group floating-label">
                                        <input type="text" id="guardmname" name="formGuardProfileVal[]" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2" required>
                                        <label for="">Middle name</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group floating-label">
                                        <input type="text" id="guardlname" name="formGuardProfileVal[]" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2"  required>
                                        <label for="">Last name</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group floating-label">
                                <input class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2" id="guardemail" name="formGuardProfileVal[]" type="email" required>
                                <label for="">Email</label>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group floating-label">
                                        <input id="guarddob" class="date-picker form-control h-12 rounded w-full mb-8 border-gray-500 border-2 rounded" value="<?php echo date('Y-m-d');?>" type="text" required="required" name="formGuardProfileVal[]" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="profGuadObj.profileguardDateForm(this)">
                                        <label for="">Date of birth</label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group floating-label">
                                        <input type="number" id="guardcontactno" name="formGuardProfileVal[]" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2" required>
                                        <label for="">Contact no.</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group floating-label">
                                <select id="guardgender" name="formGuardProfileVal[]" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2" required>
                                    <option value=""></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <label for="" class="mt-1">Gender</label>
                            </div>

                            <div class="form-group floating-label">
                                <textarea required rows="5" cols="10" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2" id="guardaddress" name="formGuardProfileVal[]"></textarea>
                                <label for="" class="mt-1">Address</label>
                            </div>
                
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group floating-label">
                                        <input type="password" name="formGuardProfileVal[]" id="password" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2" required>
                                        <div class="absolute top-4 right-3"> 
                                            <i class="fas fa-eye cursor-pointer hover:text-gray-700" id="togglePassword"></i> 
                                        </div> 
                                        <label for="">Password</label>
                                    </div>
                                </div>
                                    
                                <div class="col-sm-6">
                                    <div class="form-group floating-label">
                                        <input type="password" name="formGuardProfileVal[]" id="CPassword" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2" required>
                                        <div class="absolute top-4 right-3"> 
                                            <i class="fas fa-eye cursor-pointer hover:text-gray-700" id="CTogglePassword"></i> 
                                        </div> 
                                        <label for="">Confirm Password</label>
                                    </div>
                                </div>                     
                            </div>
                        </div>

                         <div class="ln_solid"></div>
                            <div class="d-flex flex-row-reverse">
                                <div class="p-2">
                                    <button data-toggle="tooltip" data-placement="top" title="Reset" class="hover:border-red-600 hover:bg-gray-100 hover:text-red-600 tracking-wide text-lg text-white bg-red-400 px-9 py-2 rounded-3xl border-red-500 border-2" type="reset">Reset</button>
                                </div>
                                <div class="p-2">
                                    <input id="profileGuardBtn" data-toggle="tooltip" data-placement="top" title="Update" type="submit" value="Update" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                                </div>
                            </div>

                        </form>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>
  </div>
  <script src="../assets/js/guardProfileForm.js"></script>
</div>