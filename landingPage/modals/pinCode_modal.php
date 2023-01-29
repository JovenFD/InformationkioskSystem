<!--PinCode Form-->
<div class="modal fade" id="pinModal" tabindex="-1" aria-labelledby="yearAddModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title" id="yearAddModalLabel">Pin Code Form</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <div class="modal-body">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="forget-tab" data-toggle="tab" href="#forget" role="tab" aria-controls="forget" aria-selected="false">Get Pin Code</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Pin Code</a>
                    </li>
                </ul>
                <div class="tab-content border-gray-400 border-2 rounded-xl" id="myTabContent">
                    <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <?php require('landingPage/pincode.php');?>
                    </div>

                    <div class="tab-pane fade show active" id="forget" role="tabpanel" aria-labelledby="forget-tab">
                        <?php require('landingPage/forget.php');?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!--PinCode Form-->