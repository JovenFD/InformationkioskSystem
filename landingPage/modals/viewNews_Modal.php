<div class="modal fade" id="newsModal" tabindex="-1" aria-labelledby="newsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newsModalLabel">News</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="modal-body">
             <div class="card">
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <tbody id="tbodyLandingNews"></tbody>
                    </table>
                    </div>
                </div>
             </div>
          </div>

          <div class="modal-footer">
            <div class="flex justify-center space-x-1 mr-2 ml-5">
                <div id="prevLandingPageNews" class="px-4 py-2 text-gray-500 bg-gray-300 rounded-md mr-2 hover:bg-blue-100 border-solid border-2 border-gray-400">
                    <i class="fas fa-arrow-left text-xl"></i>
                </div>

                <div class="flex overflow-x-auto max-w-7xl mr-3 mt-2">
                    <div class="parent flex max-w-7xl"><h5 id="btnCounter">1</h5> <h4>/</h4> <h5 id="totalCounter"></h5></div>
                </div>

                <div id="nextLandingPageNews" class="flex items-center px-4 py-2 text-gray-500 bg-gray-300 rounded-md hover:bg-blue-100 border-solid border-2  border-gray-400">
                    <i class="fas fa-arrow-right text-xl"></i>
                </div>
            </div>
        </div>

        </div>
    </div>
</div>
<script src="./assets/js/newsLandingForm.js"></script>