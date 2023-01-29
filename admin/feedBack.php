<li role="presentation" class="nav-item dropdown open mr-3">
    <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
    <span class="far fa-envelope text-2xl"></span>
    <span class="badge bg-green text-lg" id="countNewMsg"></span>
    </a>
    <ul class="dropdown-menu list-unstyled msg_list overflow-auto max-h-96" role="menu" aria-labelledby="navbarDropdown1" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 17px, 0px);">
    <li class="nav-item">
        <div class="text-center">
            <strong>New Message</strong>
        </div>
    </li>
        <div id="feedBackData"></div>
    <li class="nav-item">
        <div class="text-center">
        <a id="ShowAllMsg" class="dropdown-item">
            <strong>See All Message</strong>
            <i class="fa fa-angle-right"></i>
        </a>
        </div>
    </li>
    </ul>
</li>

<?php require_once('./modals/feedBack_Modal.php')?>

<script src="../assets/js/feedBackForm.js"></script>