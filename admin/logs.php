<div class="container rounded-lg border-2 border-gray-200">
    <div class="card">
        <div class="card-header">
            <?php 
                $title = 'SCHOOL LOGS RECORDS';
                require_once('tableHeader.php'); 
            ?>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="studentLog-tab" data-toggle="tab" href="#studentLog" role="tab" aria-controls="studentLog" aria-selected="true">Students Log<i class="fas fa-check ml-2 text-blue-500 text-lg"></i></a>
                </li>  
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="teacherLog-tab" data-toggle="tab" href="#teacherLog" role="tab" aria-controls="teacherLog" aria-selected="true">Teachers Log<i class="fas fa-check ml-2 text-blue-500 text-lg"></i></a>
                </li>   
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="visitorLog-tab" data-toggle="tab" href="#visitorLog" role="tab" aria-controls="visitorLog" aria-selected="false">Visitors <i class="fas fa-check ml-2 text-blue-500 text-lg"></i></a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="studentLog" role="tabpanel" aria-labelledby="studentLog-tab">        
                    <?php require_once('./studentLog.php');?>
                </div>
                <div class="tab-pane fade show" id="teacherLog" role="tabpanel" aria-labelledby="teacherLog-tab">        
                    <?php require_once('./teacherLog.php');?>
                </div>
                <div class="tab-pane fade show" id="visitorLog" role="tabpanel" aria-labelledby="visitorLog-tab">        
                    <?php require_once('./visitorLog.php');?>
                </div>
            </div>
        </div>
    </div>
</div>