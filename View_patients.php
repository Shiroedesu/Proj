<?php
include("config.php");
session_start();
$admin_id = $_SESSION['admin_id'];
    if(!isset($admin_id)){
        header('location:index.php');
    }
$id = $_GET['id'];
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>health information system</title>
        <!-- ======= Styles ====== -->
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="assets/css/Add-Patients_now.css">
        <link rel="stylesheet" href="aaa.css">
        <script src="js.js"></script>
    </head>

    <body>
        <?php
                $select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$admin_id'") or die('query failed');
                if(mysqli_num_rows($select) > 0){
                  $fetch = mysqli_fetch_assoc($select);
                }
            ?>
        <!-- =============== Header ================ -->
        <header class="header">

            <img class="img" src="assets/imgs/flogo.png"><a
                class="health"><strong>Health </strong>Data Management System </a>

            <div id="menu-btn" class="fas fa-bars"></div>

            <div class="topbar">

                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>

                </div>

                <div class="user">
                        <a href="admin_profile_logged_in.php">
                            <?php
                                 if ($fetch['image'] == ''){
                                      echo '<img src="uploaded_img/pic2.jpg">';
                                    }else {
                                      echo '<img src= "uploaded_img/'.$fetch['image'].'">';
                                    }
                            ?>
                        </a>
                </div>
            </div>
        </header>
        <!-- =============== Navigation ================ -->
        <div class="container">
            <div class="navigation">
                <ul>
                    <li>
                    </li>
                    <li>
                        <a href="dashboard.php">
                            <span class="icon">
                                <ion-icon name="home-outline"></ion-icon>
                            </span>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="Records_now.php" class="dashboard">
                            <span class="icon">
                                <ion-icon name="receipt-outline" style="color: #227C67;"></ion-icon>
                            </span>
                            <span class="title" style="color: #227C67;">Records</span>
                        </a>
                    </li>
                    <li>
                        <a href="admin_issuance.php">
                            <span class="icon">
                                <ion-icon name="print-outline"></ion-icon>
                            </span>
                            <span class="title">Issuance</span>
                        </a>
                    </li>
                    <li>
                        <a href="user.php">
                            <span class="icon">
                                <ion-icon name="person-outline"></ion-icon>
                            </span>
                            <span class="title">User</span>
                        </a>
                    </li>
                    <li>
                        <a id="triggerBtn" onclick="showModal()">
                            <span class="icon">
                                <ion-icon name="log-out-outline"></ion-icon>
                            </span>
                            <span class="title">Sign Out</span>
                        </a>
                    </li>
                </ul>
            </div>
                    <div id="logoutPrompt" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeModal()">&times;</span>
                            <p>Do you want to log out?</p>
                            <button onclick="logout()">Yes</button>
                            <button onclick="closeModal()">No</button>
                        </div>
                    </div>
            <!-- ========================= Main ==================== -->
            <?php
                         $sql2 = "SELECT * FROM patients WHERE id = $id";
                         $result = mysqli_query($conn, $sql2);
                         $row = mysqli_fetch_assoc($result);

                         $form1 = explode(',', $row['form1']);
                         $form2 = explode(',', $row['form2']);
                    ?>
            <div class="main">
                <h1 class="heading"> <span>PERSONAL</span> RECORD </h1>
                    <a href="Edit-Patients.php? id=<?php echo $row['id'];?>" class="back">Edit</a>
                    <a href="Records_now.php" class="back">Back</a>
                <br></br>
                <br></br>
                    
                    <form action="" method="post" enctype="multipart/form-data">
                                <?php
                                        if(isset($message)){
                                          foreach($message as $message){
                                          echo '<div class="message">'.$message.'</div>';
                                          }
                                        }
                                    ?>
                                    <?php
                                        if(isset($messageSuc)){
                                          foreach($messageSuc as $messageSuc){
                                          echo '<div class="messageSuc">'.$messageSuc.'</div>';
                                          }
                                        }
                                    ?>
                        <div class="form">
                            <input type="hidden" name="update_id" value="<?php echo $id; ?>">
                                <div class="left">
                                    <div class="img2">  
                                            <?php
                                                    if ($row['image'] == ''){
                                              echo '<img src="patients_image/pic2.jpg">';
                                            }else {
                                              echo '<img src= "patients_image/'.$row['image'].'">';
                                            }
                                            ?>
                                    </div>
                                    <table class="table3">
                                        <tbody>
                                            <tr>
                                                <td class="br">Upload Image:</td>
                                                <td><input type="file" name="update_img" accept="image/jpg, image/jpeg, image/png"></td>
                                            </tr>
                                            <tr>
                                                <td class="br">Birth Reference No.</td>
                                                <td><input type="text" name="update_birth_ref_no" value="<?php echo $row['birth_ref_no']; ?>" ></td>
                                            </tr>
                                            <tr>
                                                <td>Household No.</td>
                                                <td><input type="text" name="update_house_no" value="<?php echo $row['house_no']; ?>" ></td>
                                            </tr>
                                            <tr>
                                                <td>Line No.</td>
                                                <td><input type="text" name="update_line_no" value="<?php echo $row['line_no']; ?>" ></td>
                                            </tr>
                                            <tr>
                                                <td>Family No.</td>
                                                <td><input type="text" name="update_family_no" value="<?php echo $row['family_no']; ?>" ></td>
                                            </tr>
                                            <tr>
                                                <td>Blood Type:</td>
                                                <td><input type="text" name="update_bloodtype" value="<?php echo $row['blood_type']; ?>" ></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div  class="right">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td id="dt">SURNAME/LASTNAME:</td>
                                                <td id="dt"><input type="text" name="update_lastname" value="<?php echo $row['lastname']; ?>" ></td>
                                            </tr>
                                            <tr>
                                                <td id="dt">GIVEN NAME:</td>
                                                <td id="dt"><input type="text" name="update_givenname" value="<?php echo $row['givenname']; ?>" ></td>
                                            </tr>
                                            <tr>
                                                <td id="dt">MIDDLE NAME:</td>
                                                <td id="dt"><input type="text" name="update_middlename" value="<?php echo $row['middlename']; ?>" ></td>
                                            </tr>
                                            <tr>
                                                <td id="dt">DATE OF BIRTH:</td>
                                                <td id="dt"><input type="date" name="update_dob" value="<?php echo $row['dob']; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td id="dt">AGE:</td>
                                                <td id="dt"><input type="text" name="update_age" value="<?php echo $row['age']; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td id="dt">PLACE OF BIRTH:</td>
                                                <td id="dt"><input type="text" name="update_place_of_birth" value="<?php echo $row['place_of_birth']; ?>" ></td>
                                            </tr>
                                            <tr>
                                                <td id="dt">ADDRESS:</td>
                                                <td id="dt"><input type="text" name="update_address" value="<?php echo $row['address']; ?>" ></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <table class="table2">
                                        <tbody>
                                            <tr>
                                                <td id="dt2">Religion:</td>
                                                <td id="dt2"><input type="text" name="update_religion" value="<?php echo $row['religion']; ?>" ></td>
                                                <td id="dt2">Nationality:</td>
                                                <td id="dt2"><input type="text" name="update_nationality" value="<?php echo $row['nationality']; ?>" ></td>
                                            </tr>
                                            <tr>
                                                <td id="dt3">Gender:</td>
                                                <td id="dt3">
                                                <input type="radio" name="update_gender" id="Male" value="Male" <?php if($row['gender']=='Male'){echo "checked";} ?>>
                                                <label for="Male">Male</label>
                                                <input type="radio" name="update_gender" id="Female" value="Female"<?php if($row['gender']=='Female'){echo "checked";} ?>>
                                                <label for="Female">Female</label>
                                                </td>
                                                <td id="dt3">Height:</td>
                                                <td id="dt3"><input type="text"  name="update_height" value="<?php echo $row['height']; echo "cm"?>"></td>
                                            </tr>
                                            <tr>
                                                <td id="dt3">Civil Status:</td>
                                                <td id="dt3">
                                                <input type="radio" name="update_civilstatus" id="Single" value="Single" <?php if($row['civilstatus']=='Single'){echo "checked";} ?>>
                                                <label for="Single">Single</label>
                                                <input type="radio" name="update_civilstatus" id="Married" value="Married" <?php if($row['civilstatus']=='Married'){echo "checked";} ?>>
                                                <label for="Married">Married</label>
                                                </td>
                                                <td id="dt3">Weight:</td>
                                                <td id="dt3"><input type="text" name="update_weight" value="<?php echo $row['weight']; echo "kg"; ?>"></td>
                                            </tr>
                                        </tbody>
                                    </table>    
                                </div>
                            </div>
                            <h1 class="heading"> <span>MEDICAL</span> HISTORY </h1>
                            <div class="form1">
                                <h4>HAVE YOU EVER HAD, DO YOU NOW HAVE, OR EVER DECLARE THAT YOU HAVE/HAD ANY OF THE FOLLOWING CONDITION</h4>
                            <table class="fillup">
                                <tbody>
                                    <tr>
                                        <td><input type="checkbox" value="EYES(pterygiums?)" <?php if(in_array('EYES(pterygiums?)', $form1)) {echo 'checked';} ?> name="form1[]"></td>
                                        <td id="blank"><p>EYES(pterygiums?)</p></td>
                                        <td><input type="checkbox" value="EXTREMITY ABNOMALITY" <?php if(in_array('EXTREMITY ABNOMALITY', $form1)) {echo 'checked';} ?> name="form1[]"></td>
                                        <td id="blank"><p>EXTREMITY ABNOMALITY</p></td>
                                    </tr>

                                    <tr>
                                        <td><input type="checkbox" value="EAR DRUMS / HEARING" <?php if(in_array('EAR DRUMS / HEARING', $form1)) {echo 'checked';} ?> name="form1[]"></td>
                                        <td id="blank"><p>EAR DRUMS / HEARING</p></td>
                                        <td><input type="checkbox" value="REFLEX ABNOMALITY" <?php if(in_array('REFLEX ABNOMALITY', $form1)) {echo 'checked';} ?> name="form1[]"></td>
                                        <td id="blank"><p>REFLEX ABNOMALITY</p></td>
                                    </tr>
                                    <tr>                                        
                                        <td><input type="checkbox" value="NOSE" <?php if(in_array('NOSE', $form1)) {echo 'checked';} ?> name="form1[]"></td>
                                        <td id="blank"><p>NOSE</p></td>
                                        <td><input type="checkbox" value="SKIN ABNORMALITY" <?php if(in_array('SKIN ABNORMALITY', $form1)) {echo 'checked';} ?> name="form1[]"></td>
                                        <td id="blank"><p>SKIN ABNORMALITY</p></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" value="THROAT/MOUTH" <?php if(in_array('THROAT/MOUTH', $form1)) {echo 'checked';} ?> name="form1[]"></td>
                                        <td id="blank"><p>THROAT/MOUTH</p></td>
                                        <td><input type="checkbox" value="HERNIA" <?php if(in_array('HERNIA', $form1)) {echo 'checked';} ?> name="form1[]"></td>
                                        <td id="blank"><p>HERNIA</p></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" value="NECK" <?php if(in_array('NECK', $form1)) {echo 'checked';} ?> name="form1[]"></td>
                                        <td id="blank"><p>NECK</p></td>
                                        <td><input type="checkbox" value="BACK ABNORMALITY" <?php if(in_array('BACK ABNORMALITY', $form1)) {echo 'checked';} ?> name="form1[]"></td>
                                        <td id="blank"><p>BACK ABNORMALITY</p></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" value="HEART MURMURS/RYTHM" <?php if(in_array('HEART MURMURS/RYTHM', $form1)) {echo 'checked';} ?> name="form1[]"></td>
                                        <td id="blank"><p>HEART MURMURS/RYTHM</p></td>
                                        <td><input type="checkbox" value="VARICOSE VEINS/VASCULAR SYSTEM" <?php if(in_array('VARICOSE VEINS/VASCULAR SYSTEM', $form1)) {echo 'checked';} ?> name="form1[]"></td>
                                        <td id="blank"><p>VARICOSE VEINS/VASCULAR SYSTEM</p></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" value="LUNGS AND CHEST" <?php if(in_array('LUNGS AND CHEST', $form1)) {echo 'checked';} ?> name="form1[]"></td>
                                        <td id="blank"><p>LUNGS AND CHEST</p></td>
                                        <td><input type="checkbox" value="DEFORMITIES/LIMITATION OF MOTION" <?php if(in_array('DEFORMITIES/LIMITATION OF MOTION', $form1)) {echo 'checked';} ?> name="form1[]"></td>
                                        <td id="blank"><p>DEFORMITIES/LIMITATION OF MOTION</p></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" value="ABDOMEN.ORGAN ENLARGEMENT" <?php if(in_array('ABDOMEN.ORGAN ENLARGEMENT', $form1)) {echo 'checked';} ?> name="form1[]"></td>
                                        <td id="blank"><p>ABDOMEN.ORGAN ENLARGEMENT</p></td>
                                        <td><input type="checkbox" value="FOOT ABNORMALITY/BUNIONS" <?php if(in_array('FOOT ABNORMALITY/BUNIONS', $form1)) {echo 'checked';} ?> name="form1[]"></td>
                                        <td id="blank"><p>FOOT ABNORMALITY/BUNIONS</p></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" value="PSYCHIATRIC BEHAVIOR" <?php if(in_array('PSYCHIATRIC BEHAVIOR', $form1)) {echo 'checked';} ?> name="form1[]"></td>
                                        <td id="blank"><p>PSYCHIATRIC BEHAVIOR</p></td>
                                        <td><input type="checkbox" value="SCARS ON BACK/KNEES/ELSEWHRE" <?php if(in_array('SCARS ON BACK/KNEES/ELSEWHRE', $form1)) {echo 'checked';} ?> name="form1[]"></td>
                                        <td id="blank"><p>SCARS ON BACK/KNEES/ELSEWHRE</p></td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                            <br>
                            <br>
                            <h1 class="heading"> <span>MEDICAL</span> HISTORY </h1>
                                <div class="form1">
                                <h4>HAVE YOU EVER HAD, DO YOU NOW HAVE, OR EVER DECLARE THAT YOU HAVE/HAD ANY OF THE FOLLOWING CONDITION</h4>
                                <table class="fillup">
                                    <tbody>
                                        <tr>
                                            <td><input type="checkbox" value="Epilepsy/Seizures/Fainting" <?php if(in_array('Epilepsy/Seizures/Fainting', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Epilepsy/Seizures/Fainting</p></td>
                                            <td><input type="checkbox" value="Rheumatic Fever/Typhoid Fever" <?php if(in_array('Rheumatic Fever/Typhoid Fever', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Rheumatic Fever/Typhoid Fever</p></td>
                                        </tr>

                                        <tr>
                                            <td><input type="checkbox" value="Sever Headaches" <?php if(in_array('Sever Headaches', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Sever Headaches</p></td>
                                            <td><input type="checkbox" value="Malaria" <?php if(in_array('Malaria', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Malaria</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Heart Problem" <?php if(in_array('Heart Problem', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Heart Problem</p></td>
                                            <td><input type="checkbox" value="Allergies to any food or any other substances" <?php if(in_array('Allergies to any food or any other substances', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Allergies to any food or any other substances</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="High or Low Blood Pressure" <?php if(in_array('High or Low Blood Pressure', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>High or Low Blood Pressure</p></td>
                                            <td><input type="checkbox" value="Elbow / Ankle / Foot Pain/Injury" <?php if(in_array('Elbow / Ankle / Foot Pain/Injury', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Elbow, Ankle or Foot Pain/Injury</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Chest Pain/Shortness of Breath" <?php if(in_array('Chest Pain/Shortness of Breath', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Chest Pain/Shortness of Breath</p></td>
                                            <td><input type="checkbox" value="Shoulder or Hip Pain/Injury" <?php if(in_array('Shoulder or Hip Pain/Injury', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Shoulder or Hip Pain/Injury</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Asthma/Hay Fever/Allergies" <?php if(in_array('Shoulder or Hip Pain/Injury', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Asthma/Hay Fever/Allergies</p></td>
                                            <td><input type="checkbox" value="Amputations / Prosthetics" <?php if(in_array('Amputations / Prosthetics', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Amputations / Prosthetics</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Frequent Cold / Sore Throat" <?php if(in_array('Frequent Cold / Sore Throat', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Tuberculosis</p></td>
                                            <td><input type="checkbox" value="Arthritis / Hand or Wrist Problems or Pain" <?php if(in_array('Arthritis / Hand or Wrist Problems or Pain', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Arthritis / Hand or Wrist Problems or Pain</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Frequent Colds/Sore Throat" <?php if(in_array('Frequent Colds/Sore Throat', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Frequent Colds/Sore Throat</p></td>
                                            <td><input type="checkbox" value="Sprains/Dislocations/Fractures" <?php if(in_array('Sprains/Dislocations/Fractures', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Sprains/Dislocations/Fractures</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Pneumonia/Influenza/Bronchitis" <?php if(in_array('Pneumonia/Influenza/Bronchitis', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Pneumonia/Influenza/Bronchitis</p></td>
                                            <td><input type="checkbox" value="Sciatica/Scoliosis/Rheumatism" <?php if(in_array('Sciatica/Scoliosis/Rheumatism', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Sciatica/Scoliosis/Rheumatism</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Lung Problems or Disease" <?php if(in_array('Lung Problems or Disease', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Lung Problems or Disease</p></td>
                                            <td><input type="checkbox" value="Bone or Joint Injury or Problems" <?php if(in_array('Bone or Joint Injury or Problems', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Bone or Joint Injury or Problems</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Abdominal Pain/Ulcer/Stomach Problems" <?php if(in_array('Abdominal Pain/Ulcer/Stomach Problems', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Abdominal Pain/Ulcer/Stomach Problems</p></td>
                                            <td><input type="checkbox" value="Degenerative Condition/Disease of the Back" <?php if(in_array('Degenerative Condition/Disease of the Back', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Degenerative Condition/Disease of the Back</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Heptitis/Gallbladder Stones/Liver Stones" <?php if(in_array('Heptitis/Gallbladder Stones/Liver Stones', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Heptitis/Gallbladder Stones/Liver Stones</p></td>
                                            <td><input type="checkbox" value="Neck Muscles/Joints" <?php if(in_array('Neck Muscles/Joints', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Neck Muscles/Joints</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Kidney Stones/Kidney Problems or Disease" <?php if(in_array('Kidney Stones/Kidney Problems or Disease', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Kidney Stones/Kidney Problems or Disease</p></td>
                                            <td><input type="checkbox" value="Knee Problems/Leg Injury/Varicose Veins or Leg Swelling" <?php if(in_array('Knee Problems/Leg Injury/Varicose Veins or Leg Swelling', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Knee Problems/Leg Injury/Varicose Veins or Leg Swelling</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Diabetes/Thyroid Disease/Other Endocrine" <?php if(in_array('Diabetes/Thyroid Disease/Other Endocrine', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Diabetes/Thyroid Disease/Other Endocrine</p></td>
                                            <td><input type="checkbox" value="Muscular Weakness" <?php if(in_array('Muscular Weakness', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Muscular Weakness</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Rashes/Skin Problems or Disease" <?php if(in_array('Rashes/Skin Problems or Disease', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Rashes/Skin Problems or Disease</p></td>
                                            <td><input type="checkbox" value="Neck or Back Pain/Injury" <?php if(in_array('Neck or Back Pain/Injury', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Neck or Back Pain/Injury</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Head Injury/Stroke/Concussion" <?php if(in_array('Head Injury/Stroke/Concussion', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Head Injury/Stroke/Concussion</p></td>
                                            <td><input type="checkbox" value="Drug useage/Excessive drinking/Failed drug test" <?php if(in_array('Drug useage/Excessive drinking/Failed drug test', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Drug useage/Excessive drinking/Failed drug test</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Vision/Eye Problems or Disease" <?php if(in_array('Vision/Eye Problems or Disease', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Vision/Eye Problems or Disease</p></td>
                                            <td><input type="checkbox" value="Hospitalization/Surgical Operation/Serioes Injury-illness" <?php if(in_array('Hospitalization/Surgical Operation/Serioes Injury-illness', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Hospitalization/Surgical Operation/Serioes Injury-illness</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Nose Throat Problems or Disease" <?php if(in_array('Nose Throat Problems or Disease', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Nose Throat Problems or Disease</p></td>
                                            <td><input type="checkbox" value="Psychiatric illness/Counselling/Mental Disorder(s)" <?php if(in_array('Psychiatric illness/Counselling/Mental Disorder(s)', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Psychiatric illness/Counselling/Mental Disorder(s)</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Ear Problems or Deafness" <?php if(in_array('Ear Problems or Deafness', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Ear Problems or Deafness</p></td>
                                            <td><input type="checkbox" value="Have you ever been signed off sick/repatriated from ship" <?php if(in_array('Have you ever been signed off sick/repatriated from ship', $form2)) {echo 'checked';} ?> name="form2[]"></td>
                                            <td id="blank"><p>Have you ever been signed off sick/repatriated from ship</p></td>
                                        </tr>
                                    </tbody>    
                                </table>
                            </div>
                            <div class="form1"> 
                                <h4>OTHERS</h4>
                                <input type="text" name="others" value="<?php echo $row['others']; ?>" style="width:100%; padding: 10px 10px 30px 10px;border: 1px solid; margin: 0px 200px; font-size: 18px; background-color: #f4f4f4; border-radius: 8px;">
                            </div>
                            <br>
                        </form>
            </div>
        </div>
        <!-- =========== Scripts =========  -->
        <script src="assets/js/main.js"></script>
        <!-- ====== ionicons ======= -->
        <script type="module"
            src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule
            src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>
