<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/map/style.css">
    <script src="./assets/map/jquery.rwdImageMaps.js"></script>
    <script src="./assets/map/jquery.rwdImageMaps.min.js"></script>
    <title>School | Map</title>
</head>
<body class="bg-gray-300">
    <div class="container p-20">
        <div class="card rounded-lg shadow">
            <div class="card-header">
                <?php 
                    $title = 'SCHOOL MAP';
                    
                    require_once('mapHeader.php');

                    $gate = "mapObj.showSceneryBox('./assets/imagemap/IMG_4577.JPG', 'SCHOOL ENTRANCE/EXIT', '(Movable barrier; an opening permitting passage : )', 743, -170)";

                    $gauardHouse = "mapObj.showSceneryBox('./assets/imagemap/IMG_4577.JPG', 'Guard House', '(Is a building used to house personnel and security equipment.! : )', 733, -160)";

                    $frontRoom = "mapObj.showSceneryBox('./assets/imagemap/IMG_4577.JPG', 'Room 1', '(This is a Room 1 )', 710, -58)";

                    $canteenFront = "mapObj.showSceneryBox('./assets/imagemap/IMG_4577.JPG', 'SCHOOL CANTEEN', '(This canteen in front of school )', 710, -18)";

                    $flagPaul = "mapObj.showSceneryBox('./assets/imagemap/IMG_4582.JPG', 'FLAG POLE', '(A pole on which to raise a flag! : )', 660, -10)";

                    $comlab = "mapObj.showSceneryBox('./assets/imagemap/IMG_4581.JPG', 'COMPUTER LAB', '(Space which provides computer services to a defined community. )', 700, 72)";

                    $principalOffice = "mapObj.showSceneryBox('./assets/imagemap/IMG_4580.JPG', 'PRINCIPAL OFFICE', '(Means the office, in or out of this state. )', 650, 72)";

                    $stuffOffice = "mapObj.showSceneryBox('./assets/imagemap/IMG_4571.JPG', 'FACULTY ROOM', '(Is a space for faculty and administrators at postsecondary institutions. )', 592, 50)";

                    $washSection = "mapObj.showSceneryBox('./assets/imagemap/IMG_4570.JPG', 'HAND WASH AREA', '(Washed hands is part of the process as wet and moist hands. )', 615, -60)";

                    $gym = "mapObj.showSceneryBox('./assets/imagemap/IMG_4583.JPG', 'GYMNASIUM', '(This is gymnasium of school )', 615, -140)";

                    $restRoom = "mapObj.showSceneryBox('./assets/imagemap/IMG_4589.JPG', 'Rest Room', '(This is a rest room for girls and boys )', 507, -120)";

                    $lake = "mapObj.showSceneryBox('./assets/imagemap/IMG_4579.JPG', 'FISH POND', 'Flooded area during heavy rainfall.', 342, -93)";

                    $rightZero = "mapObj.showSceneryBox('./assets/imagemap/IMG_4588.JPG', 'Room 10', '(This building have 2nd floor and 4 rooms )', 480, -215)";

                    $rightOne = "mapObj.showSceneryBox('./assets/imagemap/IMG_4585.JPG', 'Room 5', '(This a room 5 )', 690, -250)";

                    $backCanteen = "mapObj.showSceneryBox('./assets/imagemap/Canteen.JPG', 'SCHOOL CANTEEN BACK', '(This is where you buy your foods and eat it! : )', 37, 55)";

                    $rightThree = "mapObj.showSceneryBox('./assets/imagemap/IMG_4587.JPG', 'Room 9', '(This is a room 9)', 538, -240)";

                    $rightTwo = "mapObj.showSceneryBox('./assets/imagemap/IMG_4586.JPG', 'Room 7', '(This is a room 7 )', 593, -230)";

                    $thirdBulding = "mapObj.showSceneryBox('./assets/imagemap/IMG_4573.JPG', 'FIRST TWO STORY BUILDING', '(This is building have 8 rooms. )', 446, 70)";

                    $secondBuilding = "mapObj.showSceneryBox('./assets/imagemap/IMG_4577.JPG', 'THREE STORY BUILDING', '(This is building have 8 rooms. : )', 180, 100)";

                    $lastBuilding = "mapObj.showSceneryBox('./assets/imagemap/IMG_4578.JPG', 'SECOND TWO STORY BUILDING', '(This is building have 8 rooms.)', 5, -115)";
                ?>
            </div>
            <div class="card-body row">
                <div class="col">
                    <main id="conatiner">
                        <span class="z-30 relative" id="display"></span>
                            <img class="img-thumbnail w-full" src="./assets/imagemap/NewMap.png" usemap="#image-map">

                            <map name="image-map">
                                <area coords="924, 173, 14" shape="circle" onmouseenter="<?php echo $gate; ?>">

                                <area coords="913, 209, 10" shape="circle" onmouseenter="<?php echo $gauardHouse; ?>">

                                <area coords="888, 299, 10" shape="circle" onmouseenter="<?php echo $frontRoom; ?>">

                                <area coords="888, 342, 12" shape="circle" onmouseenter="<?php echo $canteenFront; ?>">

                                <area coords="831, 355, 14" shape="circle" onmouseenter="<?php echo $flagPaul; ?>">

                                <area coords="875, 439, 11" shape="circle" onmouseenter="<?php echo $comlab; ?>">

                                <area coords="821, 440, 14" shape="circle" onmouseenter="<?php echo $principalOffice; ?>">

                                <area coords="755, 437, 12" shape="circle" onmouseenter="<?php echo $stuffOffice; ?>">

                                <area coords="780, 319, 12" shape="circle" onmouseenter="<?php echo $washSection; ?>">

                                <area coords="779, 195, 10" shape="circle" onmouseenter="<?php echo $gym; ?>">

                                <area coords="661, 255, 42" shape="circle" onmouseenter="<?php echo $restRoom; ?>">

                                <area coords="478, 257, 12" shape="circle" onmouseenter="<?php echo $lake; ?>">

                                <area coords="632, 121, 14" shape="circle" onmouseenter="<?php echo $rightZero; ?>">

                                <area coords="694, 72, 14" shape="circle" onmouseenter="<?php echo $rightThree; ?>">

                                <area coords="756, 85, 12" shape="circle" onmouseenter="<?php echo $rightTwo; ?>">

                                <area coords="864, 55, 8" shape="circle" onmouseenter="<?php echo $rightOne; ?>">

                                <area coords="136, 420, 13" shape="circle" onmouseenter="<?php echo $backCanteen; ?>">

                                <area coords="593, 444, 13" shape="circle" onmouseenter="<?php echo $thirdBulding; ?>">
                                
                                <area coords="296, 476, 13" shape="circle" onmouseenter="<?php echo $secondBuilding; ?>">

                                <area coords="101, 259, 52" shape="circle" onmouseenter="<?php echo $lastBuilding; ?>">
                            </map>  
                        </main>
                    </div>
                <div class="col-2 bg-white shadow rounded-lg mr-3" >
                    <div style="overflow-x:auto; height: 480px;">
                        <button type="button" onclick="<?php echo $gate;?>" data-toggle="tooltip" data-placement="top" title="SCHOOL ENTRANCE/EXIT" class="w-full h-12 hover:border-red-900 hover:bg-red-100 hover:text-red-900 tracking-wide text-lg text-white bg-red-900 py-2 rounded-lg border-white border-2">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <small>Gate</small>
                        </button>
                        <button type="button" onclick="<?php echo $gauardHouse; ?>" data-toggle="tooltip" data-placement="top" title="Button Label" class="w-full h-12 hover:border-red-900 hover:bg-red-100 hover:text-red-900 tracking-wide text-lg text-white bg-red-900 py-2 rounded-lg border-white border-2">
                            <i class="fas fa-map-marker-alt"></i>
                            <small>Guard House</small>
                        </button> 
                        <button type="button" onclick="<?php echo $frontRoom;?>" data-toggle="tooltip" data-placement="top" title="Room 1" class="w-full h-12 hover:border-red-900 hover:bg-red-100 hover:text-red-900 tracking-wide text-lg text-white bg-red-900 py-2 rounded-lg border-re-500 border-2">
                            <i class="fas fa-map-marker-alt"></i>
                            <small>Room 1</small>
                        </button> 
                        <button type="button" onclick="<?php echo $canteenFront;?>" data-toggle="tooltip" data-placement="top" title="Canteen 1" class="w-full h-12 hover:border-red-900 hover:bg-red-100 hover:text-red-900 tracking-wide text-lg text-white bg-red-900 py-2 rounded-lg border-white border-2">
                            <i class="fas fa-map-marker-alt"></i>
                            <small>Canteen 1</small>
                        </button> 
                        <button type="button" onclick="<?php echo $flagPaul; ?>" data-toggle="tooltip" data-placement="top" title="Flag Paul" class="w-full h-12 hover:border-red-900 hover:bg-red-100 hover:text-red-900 tracking-wide text-lg text-white bg-red-900 py-2 rounded-lg border-white border-2">
                            <i class="fas fa-map-marker-alt"></i>
                            <small>Flag Pole</small>
                        </button> 
                        <button type="button" onclick="<?php echo $comlab; ?>" data-toggle="tooltip" data-placement="top" title="Computer Labaratory" class="w-full h-12 hover:border-red-900 hover:bg-red-100 hover:text-red-900 tracking-wide text-lg text-white bg-red-900 py-2 rounded-lg border-white border-2">
                            <i class="fas fa-map-marker-alt"></i>
                            <small>Comlab</small>
                        </button> 
                        <button type="button" onclick="<?php echo $principalOffice; ?>" data-toggle="tooltip" data-placement="top" title="Principal Office" class="w-full h-12 hover:border-red-900 hover:bg-red-100 hover:text-red-900 tracking-wide text-lg text-white bg-red-900 py-2 rounded-lg border-white border-2">
                            <i class="fas fa-map-marker-alt"></i>
                            <small>Principal Office</small>
                        </button> 
                        <button type="button" onclick="<?php echo $stuffOffice; ?>" data-toggle="tooltip" data-placement="top" title="Faculty Room" class="w-full h-12 hover:border-red-900 hover:bg-red-100 hover:text-red-900 tracking-wide text-lg text-white bg-red-900 py-2 rounded-lg border-white border-2">
                            <i class="fas fa-map-marker-alt"></i>
                            <small>Faculty Room</small>
                        </button> 
                        <button type="button" onclick="<?php echo $washSection; ?>" data-toggle="tooltip" data-placement="top" title="Wash Area" class="w-full h-12 hover:border-red-900 hover:bg-red-100 hover:text-red-900 tracking-wide text-lg text-white bg-red-900 py-2 rounded-lg border-white border-2">
                            <i class="fas fa-map-marker-alt"></i>
                            <small>Wash Area</small>
                        </button> 
                        <button type="button" onclick="<?php echo $gym; ?>" data-toggle="tooltip" data-placement="top" title="Gymnasium" class="w-full h-12 hover:border-red-900 hover:bg-red-100 hover:text-red-900 tracking-wide text-lg text-white bg-red-900 py-2 rounded-lg border-white border-2">
                            <i class="fas fa-map-marker-alt"></i>
                            <small>Gymnasium</small>
                        </button> 
                        <button type="button" onclick="<?php echo $restRoom;?>" data-toggle="tooltip" data-placement="top" title="Rest Room" class="w-full h-12 hover:border-red-900 hover:bg-red-100 hover:text-red-900 tracking-wide text-lg text-white bg-red-900 py-2 rounded-lg border-white border-2">
                            <i class="fas fa-map-marker-alt"></i>
                            <small>Rest Room</small>
                        </button> 
                        <button type="button" onclick="<?php echo $lake; ?>" data-toggle="tooltip" data-placement="top" title="Fish Pond" class="w-full h-12 hover:border-red-900 hover:bg-red-100 hover:text-red-900 tracking-wide text-lg text-white bg-red-900 py-2 rounded-lg border-white border-2">
                            <i class="fas fa-map-marker-alt"></i>
                            <small>Fish Pond</small>
                        </button>    
                        <button type="button" onclick="<?php echo $rightZero; ?>" data-toggle="tooltip" data-placement="top" title="Room 10" class="w-full h-12 hover:border-red-900 hover:bg-red-100 hover:text-red-900 tracking-wide text-lg text-white bg-red-900 py-2 rounded-lg border-white border-2">
                            <i class="fas fa-map-marker-alt"></i>
                            <small>Room 10</small>
                        </button> 
                        <button type="button" onclick="<?php echo $backCanteen; ?>" data-toggle="tooltip" data-placement="top" title="School Canteen 2" class="w-full h-12 hover:border-red-900 hover:bg-red-100 hover:text-red-900 tracking-wide text-lg text-white bg-red-900 py-2 rounded-lg border-white border-2">
                            <i class="fas fa-map-marker-alt"></i>
                            <small>Canteen 2</small>
                        </button> 
                        <button type="button" onclick="<?php echo $rightThree; ?>" data-toggle="tooltip" data-placement="top" title="Room 9" class="w-full h-12 hover:border-red-900 hover:bg-red-100 hover:text-red-900 tracking-wide text-lg text-white bg-red-900 py-2 rounded-lg border-white border-2">
                            <i class="fas fa-map-marker-alt"></i>
                           <small>Room 9</small>
                        </button> 
                        <button type="button" onclick="<?php echo $rightTwo; ?>" data-toggle="tooltip" data-placement="top" title="Room 7" class="w-full h-12 hover:border-red-900 hover:bg-red-100 hover:text-red-900 tracking-wide text-lg text-white bg-red-900 py-2 rounded-lg border-white border-2">
                            <i class="fas fa-map-marker-alt"></i>
                            <small>Room 7</small>
                        </button> 
                        <button type="button" onclick="<?php echo $rightOne; ?>" data-toggle="tooltip" data-placement="top" title="Room 5" class="w-full h-12 hover:border-red-900 hover:bg-red-100 hover:text-red-900 tracking-wide text-lg text-white bg-red-900 py-2 rounded-lg border-white border-2">
                            <i class="fas fa-map-marker-alt"></i>
                            <small>Room 5</small>
                        </button>
                        <button type="button" onclick="<?php echo $thirdBulding; ?>" data-toggle="tooltip" data-placement="top" title="1st Building" class="w-full h-12 hover:border-red-900 hover:bg-red-100 hover:text-red-900 tracking-wide text-lg text-white bg-red-900 py-2 rounded-lg border-white border-2">
                            <i class="fas fa-map-marker-alt"></i>
                            <small>1st Building</small>
                        </button> 
                        <button type="button" onclick="<?php echo $secondBuilding; ?>" data-toggle="tooltip" data-placement="top" title="Three Story Building" class="w-full h-12 hover:border-red-900 hover:bg-red-100 hover:text-red-900 tracking-wide text-lg text-white bg-red-900 py-2 rounded-lg border-white border-2">
                            <i class="fas fa-map-marker-alt"></i>
                            <small>2nd Building</small>
                        </button> 
                        <button type="button" onclick="<?php echo $lastBuilding; ?>" data-toggle="tooltip" data-placement="top" title="3rd Building" class="w-full h-12 hover:border-red-900 hover:bg-red-100 hover:text-red-900 tracking-wide text-lg text-white bg-red-900 py-2 rounded-lg border-white border-2">
                            <i class="fas fa-map-marker-alt"></i>
                            <small>3rd Building</small>
                        </button> 
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <script src="./assets/map/main.js"></script>
</body>
</html>