<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deped | Leaders</title>
</head>
<body class="bg-gray-200">
    <?php
        $title = 'VIEW TEACHER';

        require_once('./landingPage/topHeader.php');
    ?>

    <div class="container relative z-30 -top-64">
       <div class="row">
            <div class="col">
                <div class="relative text-black text-2xl"> <input type="search" id="searchCheckListTeacher" class="h-14 w-full pr-8 pl-5 rounded-full z-0 focus:shadow focus:outline-none text-center border-2 border-gray-300" placeholder="Search Teacher Here...">
                    <div class="absolute top-3 left-5"> <i class="fa fa-search z-20 hover:text-gray-500 text-2xl"></i> </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col py-10 p-10" id="listTeacherLogs">
            </div>
        </div>


        <div class="flex flex-col items-center my-12">
            <div class="flex text-gray-700">
                <div class="h-16 w-16 mr-1 flex justify-center items-center hover:border-blue-600 hover:bg-blue-100 hover:text-blue-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2 cursor-pointer" id="prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left w-6 h-6 text-2xl">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </div>

                <div class="flex h-16 font-medium rounded-full bg-blue-400 text-lg text-white" id="viewListTeacherBtn">
                    
                </div>

                <div class="h-16 w-16 ml-1 flex justify-center items-center hover:border-blue-600 hover:bg-blue-100 hover:text-blue-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2 cursor-pointer" id="next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right w-6 h-6 text-2xl">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </div>
            </div>
        </div>

    </div>

    <script src="./assets/js/viewTeachersLogs.js"></script>
    
</body>
</html>
