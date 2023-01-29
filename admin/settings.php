<div class="border-2 border-gray-200 rounded-xl font-bold">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="videoHeader-tab" data-toggle="tab" href="#videoHeader" role="tab" aria-controls="videoHeader" aria-selected="true">Video Header<i class="fas fa-photo-video ml-2 text-blue-500 text-lg"></i></a>
        </li>  
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="slideShowSection-tab" data-toggle="tab" href="#slideShowSection" role="tab" aria-controls="slideShowSection" aria-selected="true">System Slideshow<i class="fas fa-images ml-2 text-blue-500 text-lg"></i></a>
        </li>   
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="gallerySection-tab" data-toggle="tab" href="#gallerySection" role="tab" aria-controls="gallerySection" aria-selected="false">School Gallery <i class="fas fa-image ml-2 text-blue-500 text-lg"></i></a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="logoSection-tab" data-toggle="tab" href="#logoSection" role="tab" aria-controls="logoSection" aria-selected="false">System Logo <i class="fas fa-image ml-2 text-blue-500 text-lg"></i></a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="titleSection-tab" data-toggle="tab" href="#titleSection" role="tab" aria-controls="titleSection" aria-selected="false">System Title <i class="fas fa-pen ml-2 text-blue-500 text-lg"></i></a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="titleTableSection-tab" data-toggle="tab" href="#titleTableSection" role="tab" aria-controls="titleTableSection" aria-selected="false">Table Title <i class="fas fa-table ml-2 text-blue-500 text-lg"></i></a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade show active" id="videoHeader" role="tabpanel" aria-labelledby="videoHeader-tab">        
            <?php require_once('videoHeader.php');?>
        </div>

        <div class="tab-pane fade show" id="gallerySection" role="tabpanel" aria-labelledby="gallerySection-tab">        
            <?php require_once('schoolGallery.php');?>
        </div>

        <div class="tab-pane fade show" id="slideShowSection" role="tabpanel" aria-labelledby="slideShowSection-tab">        
            <?php require_once('slideShow.php');?>
        </div>

        <div class="tab-pane fade" id="logoSection" role="tabpanel" aria-labelledby="logoSection-tab">
            <?php require_once('logo.php');?>
        </div>

        <div class="tab-pane fade" id="titleSection" role="tabpanel" aria-labelledby="titleSection-tab">
            <?php require_once('title.php');?>
        </div>  
        <div class="tab-pane fade" id="titleTableSection" role="tabpanel" aria-labelledby="titleTableSection-tab">
            <?php require_once('tableTitle.php');?>
        </div>  
    </div>

</div>
