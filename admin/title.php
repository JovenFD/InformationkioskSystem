<div class="container rounded-lg border-2 border-gray-200">
    <div class="card">
        <div class="card-header">
            <?php 
                $title = 'CHNAGE SYSTEM TITLE';
                require('tableHeader.php');
            ?>
        </div>
            <div class="card-body">
            <form id="titleSystemForm">
                <div class="float-right mb-3">
                    <button type="submit" data-placement="top" title="Save Changes" class="w-16 h-16 hover:border-blue-600 hover:bg-blue-100 hover:text-blue-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2" data-toggle="tooltip">
                        <i class="fa fa-save text-2xl"></i>
                    </button>
                </div> 
                    <div class="table-responsive">
                        <table class="table table-bordered text-center text-lg">
                            <thead>
                                <tr>
                                    <th>SYSTEM TITLE</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="hidden" id="idTitle" name="idTitle">
                                        <textarea name="titleInput" id="titleInput" class="w-full text-center text-2xl border-2 border-gray-400 rounded-lg font-mono" rows="5"></textarea>
                                    </td>
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
<script src="../assets/dynamic/titleForm.js"></script>