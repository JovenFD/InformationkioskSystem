<!--Preview Message-->
<div class="modal fade" id="previewMsgModal" tabindex="-1" aria-labelledby="previewMsgModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="previewMsgModalLabel">Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <div class="modal-body">
            <div class="container border-2 border-gray-500 rounded-xl text-black p-5 text-lg">
                <h2>Name: <b id="name"></b></h2>
                <h2>Grade & Section: <b id="yearLevel"></b></h2>
                <h2>Create On: <b id="date"></b></h2>
                <hr>
                <p class="mt-2" id="msg"></p>
            </div>
        </div>
           
        </div>
    </div>
</div>
<!--Preview Message-->

<!--All Message-->
<div class="modal fade" id="allMsgModal" tabindex="-1" aria-labelledby="allMsgModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="allMsgModalLabel">All Messages</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <div class="modal-body">
          <div class="container border-2 border-gray-500 rounded-xl text-black text-lg">

            <div class="card">
              <div class="card-header">
                  <h2 class="text-center">All MESSAGES</h2>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col">
                      <div class="relative float-right mb-3"> <input type="search" id="searchAllMessages" class="h-16 border-2 border-gray-200 text-lg w-96 pr-8 pl-5 rounded-full focus:shadow focus:outline-none text-black text-center" placeholder="Search here...">
                      <div class="absolute top-5 left-6"> <i class="fa fa-search text-black z-20 hover:text-black text-2xl"></i> </div>
                      </div>
                  </div>
                </div>

              <div class="container" id="msgList"></div>
                
              </div>
            </div>


          </div>

        </div>
           
        </div>
    </div>
</div>
<!--All Message-->