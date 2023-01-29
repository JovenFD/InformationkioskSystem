<?php require_once('../php/init.php'); ?>
<div class="text-center mt-1">
    <div class="row">
        <div class="col-sm-2">
            <span class="inline-block align-middle mt-4">
                <a href="admin.php">
                    <img src="<?php echo '.'.tableHeader()[0];?>" class="img-responsive inline w-36 h-30 rounded-full" />
                </a>
            </span>
        </div>
        <div class="col-sm-8 mt-16 grid grid-flow-row auto-rows-max md:auto-rows-min">
            <h1 class="text-5xl text-black"><?php echo (isset($title)) ? $title : '';?></h1>
            <h1 class="text-3xl mt-2 text-black"><?php echo tableHeader()[2];?></h1>
            <div class="flex mb-4 mt-2">
            <div class="w-1/2 border-2 h-10 block text-center px-4 py-2 text-black "><?php echo tableHeader()[3];?></div>
            <div class="w-1/2 border-2 h-10 block text-center px-4 py-2 text-black "><?php echo tableHeader()[4];?></div>
            </div>
        </div>
        <div class="col-sm-2 mb-4">
            <span class="inline-block align-middle mt-4"> 
                <a href="admin.php">
                    <img src="<?php echo '.'.tableHeader()[1];?>" class="img-responsive inline w-32 h-30 rounded-full"/>
                </a>
            </span>       
        </div>
    </div>
</div>
<!-- Synamic Logo -->