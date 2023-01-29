<!-- component -->
<div class="w-full max-w-10xl">
    <div class="-mx-2 md:flex">
        
        <div class="w-full md:w-1/3 px-2">
            <div class="rounded-lg shadow-sm mb-3 border-2 border-gray-200">
                <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                    <div class="px-3 pt-9 pb-10 text-center relative z-10">
                        <div class="flex">
                            <div class="flex-1">
                                <h3 id="tchrstdDom" class="text-5xl text-gray-700 font-semibold leading-tight my-3">
                                    
                                </h3> 
                                <h4 class="font-bold text-black uppercase leading-tight">My Students</h4>
                            </div>
                            <div class="flex-1">
                                <a href="./teacher.php?page=studentList">
                                    <i class="fas fa-user-graduate text-7xl mt-2 hover:text-red-700"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="loading" class="w-full md:w-1/3 px-2">
            <div class="rounded-lg shadow-sm mb-3 border-2 border-gray-200">
                <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                    <div class="px-3 pt-8 pb-10 text-center relative z-10">
                        <div class="flex">
                            <div class="flex-1">
                                <h3 id="stdGradesDom" class="text-5xl text-gray-700 font-semibold leading-tight my-3">
                                 
                                </h3> 
                                <h4 class="font-bold text-black uppercase leading-tight">Student Grades</h4>
                            </div>
                            <div class="flex-1">
                                <a href="./teacher.php?page=studentGrades">
                                    <i class="fas fa-chalkboard-teacher text-7xl mt-2 hover:text-red-700"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="loading" class="w-full md:w-1/3 px-2">
            <div class="rounded-lg shadow-sm mb-3 border-2 border-gray-200">
                <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                    <div class="px-3 pt-8 pb-10 text-center relative z-10">
                         <div class="flex">
                            <div class="flex-1">
                                <h3 id="attLogsDom" class="text-5xl text-gray-700 font-semibold leading-tight my-3">

                                </h3> 
                                <h4 class="font-bold text-black uppercase leading-tight">Attendance Log</h4>
                            </div>
                            <div class="flex-1">
                                <a href="./teacher.php?page=attendanceLog">
                                    <i class="fas fa-users text-7xl mt-2 hover:text-red-700"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="conatiner-fluid text-center rounded-lg border-gray-200 border-2">
        <div class="row">
            <div class="col-8">
                <div class="border-t-4 border-red-900 m-4 rounded-xl"></div>
                <h3 class="mb-3 text-center text-2xl text-black">NEWS</h3>
                <?php require_once('news.php');?>
            </div>
            <div class="col">
                <div class="border-t-4 border-red-900 m-4 rounded-xl"></div>
                <h3 class="mb-3 text-center text-2xl text-black">UPCOMING EVENTS</h3>
                <?php require_once('events.php');?>
            </div>
        </div>
    </div>
    </div>
        <script src="../assets/js/teacherAccountWidgets.js"></script>
    </div>
</div>