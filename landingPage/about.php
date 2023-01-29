<?php
    $title = 'ABOUT';

    require_once('./landingPage/topHeader.php');
?>

<style>
    #moreMission {display: none;}
    #moreVision {display: none;}
</style>

<div class="container-fluid z-30 relative -top-60">
    <div class="row text-center p-2">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-8  border-double">
                    <h2 class="font-sans">DEPED VISION</h2>
                </div>
                <div class="card-body border-8 border-double border-red-900">

                    <p class="text-2xl text-center m-2">We dream of Filipinos
                    who passionately love their country
                    and whose values and competencies
                    enable them to realize their full potential
                    and contribute meaningfully<span id="dotsVision">...</span><span id="moreVision"> to building the nation.
                    As a learner-centered public institution,
                    the Department of Education
                    continuously improves itself
                    to better serve its stakeholders.</span></p>

                </div>
                <div class="card-footer">
                    <button id="vissionBtn">Read more...</button>
                </div>
            </div>

        </div>
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-8 border-double">
                    <h2 class="font-sans">CORE VALUES</h2>
                </div>
                <div class="card-body border-8 border-double border-red-900">

                <p class="text-2xl text-center m-2">Maka-Diyos</p>
                <p class="text-2xl text-center m-2">Maka-tao</p>
                <p class="text-2xl text-center m-2">Makakalikasan</p>
                <p class="text-2xl text-center m-2">Makabansa</p>
                                    
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-8  border-double">
                    <h2 class="font-sans ">DEPED MISSION</h2>
                </div>
                <div class="card-body border-8 border-double border-red-900">
                    
                <p class="text-2xl text-center m-2">To protect and promote the right of every Filipino to quality, equitable, culture-based, and complete basic education where:
                Students learn in a child-friendly, gender-sensitive,<span id="dotsMission">...</span><span id="moreMission">safe, and motivating environment.
                Teachers facilitate learning and constantly nurture every learner.
                Administrators and staff, as stewards of the institution, ensure an enabling and supportive environment for effective learning to happen.
                Family, community, and other stakeholders are actively engaged and share responsibility for developing life-long learners.</span></p>

                </div>
                <div class="card-footer">
                    <button id="missionBtn">Read more...</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col">

                <div class="card">
                    <div class="card-header border-8 border-double text-center">
                        <h2>Feedback Form</h2>
                    </div>
                    <div class="card-body border-8 border-double">
                        <form id="addFeedbackForm">
                        <div class="relative w-full">
                            <div class="bg-blue max-w-full pb-10 rounded-3xl bg-red-900 border-gray-400 border-2 p-9">

                            <div class="form-row">
                            <div class="col">
                                <div class="form-group floating-label">
                                    <input type="text" id="fullname" name="fullname" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2" required>
                                    <label for="fullname">FullName</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group floating-label">
                                    <select require name="yearLevel" class="form-control h-12 rounded w-full mb-8 border-gray-500 border-2" id="yearLevel"></select>
                                </div>
                            </div>
                        </div>

                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="anonymous">
                            <label class="custom-control-label text-white" for="anonymous">Anonymous</label>
                        </div>

                            <div class="form-group floating-label">
                            <textarea required cols="40" rows="10" class="form-control rounded w-full mb-8 border-gray-500 border-2" name="message"></textarea>
                            <label class="mb-2">Message</label>
                        </div>

                        <input type="submit" id="btnFeedback" class="h-12 w-full hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2" value="SUBMIT" />

                            </div>
                        </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
</div>

<script src="./assets/js/aboutLandingPage.js"></script>
