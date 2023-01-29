<!--Add Events Form-->
<div class="modal fade" id="ModalAdd" tabindex="-1" aria-labelledby="AddModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="AddModalLabel">Add Event Form</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>

            <div class="modal-body">
            <form id="eventAddForm">
                <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
                    <div class="form-group floating-label">
                        <textarea rows="4" cols="10" id="title" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2" name="title" maxlength="300" value="" required></textarea>
                        <label for="">Title</label>
                    </div>

                    <div class="form-group floating-label">
                        <select name="color" id="color" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2">
                            <option style="color:#FF0000;" value="#FF0000">&#9724; URGENT MEETING</option>
                            <option style="color:#008000;" value="#008000">&#9724; PERSONAL SCHEDULE</option>
                            <option style="color:#FF8C00;" value="#FF8C00">&#9724; Executives Schedule</option>
                            <option style="color:#0071c5;" value="#0071c5">&#9724; ETC</option>
                        </select>
                        <label for="">Type of Activiy</label>
                    </div>

                    <div class="row">
                        <div class="col form-group floating-label">
                            <input type="date" name="start" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2" id="start" required>
                            <label for="">Start</label>
                        </div>

                        <div class="col form-group floating-label">
                            <input type="time" name="startTime" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2" id="startTime" required>
                            <label for="">Time</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col form-group floating-label">
                            <input type="date" name="end" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2" id="end" required>
                            <label for="">End</label>
                        </div>

                        <div class="col form-group floating-label">
                            <input type="time" name="endTime" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2" id="endTime" required>
                            <label for="">Time</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex flex-row-reverse">
                    <div class="p-2">
                        <button data-toggle="tooltip" data-placement="top" title="Reset" class="hover:border-red-600 hover:bg-gray-100 hover:text-red-600 tracking-wide text-lg text-white bg-red-400 px-9 py-2 rounded-3xl border-red-500 border-2" type="reset">Reset</button>
                    </div>
                    <div class="p-2">
                        <input id="events-btn" data-toggle="tooltip" data-placement="top" title="Add update events" type="submit" value="Save" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
<!--Add Events Form-->


<!--Update Events Form-->
<div class="modal fade" id="ModalEdit" tabindex="-1" aria-labelledby="AddModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="AddModalLabel">Update Event Form</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>

            <div class="modal-body">
            <form id="eventUpdateForm">   
                <input type="hidden" name="evenst_id" id="evenst_id">
                <div class="mt-1 mb-4 p-3 border-2 border-gray-200 rounded-xl">
                    <div class="form-group floating-label">
                        <textarea rows="4" cols="10" id="title" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2" name="updateTitle" maxlength="300" value="" required></textarea>
                        <label for="">Title</label>
                    </div>

                    <div class="form-group floating-label">
                        <select name="updateColor" id="color" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2">
                            <option style="color:#FF0000;" value="#FF0000">&#9724; URGENT MEETING</option>
                            <option style="color:#008000;" value="#008000">&#9724; PERSONAL SCHEDULE</option>
                            <option style="color:#FF8C00;" value="#FF8C00">&#9724; Executives Schedule</option>
                            <option style="color:#0071c5;" value="#0071c5">&#9724; ETC</option>
                        </select>
                        <label for="">Type of Activiy</label>
                    </div>

                    <div class="row">
                        <div class="col form-group floating-label">
                            <input type="date" name="updateStart" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2" id="start" required>
                            <label for="">Start</label>
                        </div>

                        <div class="col form-group floating-label">
                            <input type="time" name="updateStartTime" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2" id="startTime" required>
                            <label for="">Time</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col form-group floating-label">
                            <input type="date" name="updateEnd" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2" id="end" required>
                            <label for="">End</label>
                        </div>

                        <div class="col form-group floating-label">
                            <input type="time" name="updateEndTime" class="form-control h-12 rounded-lg w-full mb-8 border-gray-500 border-2" id="endTime" required>
                            <label for="">Time</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label class="text-danger text-lg"><input type="checkbox" name="delete"> Delete event</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex flex-row-reverse">
                    <div class="p-2">
                        <button data-toggle="tooltip" data-placement="top" title="Reset" class="hover:border-red-600 hover:bg-gray-100 hover:text-red-600 tracking-wide text-lg text-white bg-red-400 px-9 py-2 rounded-3xl border-red-500 border-2" type="reset">Reset</button>
                    </div>
                    <div class="p-2">
                        <input id="updateevents-btn" data-toggle="tooltip" data-placement="top" title="Update events" type="submit" value="Update" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2">
                    </div>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
<!--Update Events Form-->
