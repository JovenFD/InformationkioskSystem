<?php 
    session_start();
    if(!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']
    ){
        header('Location: ./login.php');
        die();  
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once('../header.php');?>
    <title>Print Records</title>
</head>
<body class="bg-white">

<?php
    $year = ''; 
    $name = '';
    $subject = '';

    if (isset($_SESSION['printRecords']) 
    ) { 
        $result=$_SESSION['printRecords'];

        foreach ($result as $row) {
            $year = $row['schoolyear'];
            $name = $row['tname'];
            $subject = $row['subject_name'];
        }
    }
?>

<table class="border-collapse border-2 border-gray-300 text-center w-full">
    <thead>
        <tr>
            <th colspan="8">
                <?php
                    $title = 'SUMMARY OF QUARTERLY GRADES';
                    require('tableHeader.php');
                ?>
            </th>
        </tr>
        <tr>
            <th rowspan="3" class="transform -rotate-45 border border-gray-400 px-4 py-4 text-gray-800">#</th>
            <th rowspan="3" class="transform -rotate-45 border border-gray-400 px-4 py-4 text-gray-800">LEARNER'S NAMES</th>
            <th colspan="2" class="border border-gray-400 px-4 py-4 text-gray-800">GRADES & SECTION:</th>
            <td class="border border-gray-400 px-4 py-4 text-gray-800"><?php echo (isset($_SESSION['gradeLevel']) && isset($_SESSION['section'])) ?$_SESSION['gradeLevel'].' - '.$_SESSION['section'] : ''?></td>
            <th colspan="2" class="border border-gray-400 px-4 py-4 text-gray-800">SCHOOL YEAR:</th>
            <td class="border border-gray-400 text-gray-800"><?php echo $year;?></td>  
        </tr>
        <tr>
            <th colspan="2" class="border border-gray-400 px-4 py-4 text-gray-800">TEACHER:</th>
            <td class="border border-gray-400 px-4 py-4 text-gray-800"><?php echo $name;?></td>
            <th colspan="2" class="border border-gray-400 px-4 py-4 text-gray-800">SUBJECT:</th>
            <td class="border border-gray-400 px-4 py-4 text-gray-800"><?php echo $subject;?></td>
        </tr>
        <tr>
            <th class="transform -rotate-45 border border-gray-400 px-4 py-4 text-gray-800">1st Quarter</th>
            <th class="transform -rotate-45 border border-gray-400 px-4 py-4 text-gray-800">2nd Quarter</th>
            <th class="transform -rotate-45 border border-gray-400 px-4 py-4 text-gray-800">3rd Quarter</th>
            <th class="transform -rotate-45 border border-gray-400 px-4 py-4 text-gray-800">4th Quarter</th>
            <th class="transform -rotate-45 border border-gray-400 px-4 py-4 text-gray-800">Final Grade</th>
            <th class="transform -rotate-45 border border-gray-400 px-4 py-4 text-gray-800">Remarks</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    $inc = 1;

    if (isset($_SESSION['printRecords']) 
    ) { 
        $result=$_SESSION['printRecords'];
            foreach ($result as $row) {?>
                <tr>
                    <td class="border border-gray-400 px-5 py-5"><?php echo $inc++; ?></td>
                    <td class="border border-gray-400 px-5 py-5"><?php echo $row['sname']?></td>
                    <td class="border border-gray-400 px-5 py-5"><?php echo $row['firstquarter']?></td>
                    <td class="border border-gray-400 px-5 py-5"><?php echo $row['secondquarter']?></td>
                    <td class="border border-gray-400 px-5 py-5"><?php echo $row['thirthquarter']?></td>
                    <td class="border border-gray-400 px-5 py-5"><?php echo $row['fourthquarter']?></td>
                    <td class="border border-gray-400 px-5 py-5"><?php echo $row['gradeaverage']?></td>
                    <td class="border border-gray-400 px-5 py-5">
                        <?php
                        
                            echo (($row['remarks'] == 'PASSED') 
                            ? $remarks =  '<label class="text-green-500 text-bold">'.$row['remarks'].'</label>'
                            : (($row['remarks'] == 'FAILED')
                            ? $remarks =  '<label class="text-red-500 text-bold">'.$row['remarks'].'</label>'
                            : $remarks =  '<label class="text-red-500 text-bold">No Final Remarks</label>'));
                        ?>
                    </td>
                </tr>
           <?php }
        } else {
            echo '<tr><td colspan="8" class="text-center font-extrabold">Data Not Found...</td></tr>';
        }
    ?>
    </tbody>
</table>
<!-- Laoding Components -->
<script src="../assets/js/loading.js"></script>
</body>
</html>