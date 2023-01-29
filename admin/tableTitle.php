<div class="container rounded-lg border-2 border-gray-200">
    <div class="card">
        <div class="card-header">
            <?php 
                $title = 'CHANGE SYSTEM TABLE TITLE HEADER';
                require('tableHeader.php');
            ?>
        </div>
            <div class="card-body">
            <form id="titleTableForm">
                <div class="float-right mb-3">
                    <button type="submit" data-placement="top" title="Save Changes" class="w-16 h-16 hover:border-blue-600 hover:bg-blue-100 hover:text-blue-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2" data-toggle="tooltip">
                        <i class="fa fa-save text-2xl"></i>
                    </button>
                </div> 
                    <div class="table-responsive">
                        <table class="table table-bordered text-center text-lg">
                            <thead>
                                <tr>
                                    <th>SYSTEM TABLE TITLE</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="hidden" id="idTableTitle" name="idTableTitle">
                                        <textarea name="tableTitle" id="tableTitle" class="w-full text-center text-2xl border-2 border-gray-400 rounded-lg font-mono" rows="3"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th>REGION</th>
                                </tr>
                                <tr>
                                    <td>
                                        <textarea name="region" id="region" class="w-full text-center text-2xl border-2 border-gray-400 rounded-lg font-mono" rows="3"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th>DIVISION</th>
                                </tr>
                                <tr>
                                    <td>
                                        <textarea name="division" id="division" class="w-full text-center text-2xl border-2 border-gray-400 rounded-lg font-mono" rows="3"></textarea>
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
<script src="../assets/dynamic/titleTableForm.js"></script>