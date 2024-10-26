<?php
include("config.php");
session_start();
$admin_id = $_SESSION['admin_id'];
    if(!isset($admin_id)){
        header('location:index.php');
    }
/*Patient registration*/
if(isset($_POST['submit'])){ 
  $givenname = mysqli_real_escape_string($conn, $_POST['givenname']);
  $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
  $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
  $dob = mysqli_real_escape_string($conn, $_POST['dob']);
  $place_of_birth = mysqli_real_escape_string($conn, $_POST['place_of_birth']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $religion = mysqli_real_escape_string($conn, $_POST['religion']);
  $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
  $height = mysqli_real_escape_string($conn, $_POST['height']);
  $weight = mysqli_real_escape_string($conn, $_POST['weight']);
  $birth_ref_no = mysqli_real_escape_string($conn, $_POST['birth_ref_no']);
  $house_no = mysqli_real_escape_string($conn, $_POST['house_no']);
  $line_no = mysqli_real_escape_string($conn, $_POST['line_no']);
  $family_no = mysqli_real_escape_string($conn, $_POST['family_no']);
  $bloodtype = mysqli_real_escape_string($conn, $_POST['bloodtype']);
  $gender = mysqli_real_escape_string($conn, $_POST['gender']);
  $civilstatus = mysqli_real_escape_string($conn, $_POST['status']);
  $age = mysqli_real_escape_string($conn, $_POST['age']);
  $others = mysqli_real_escape_string($conn, $_POST['others']);
  $form1 = implode(',', $_POST['form1']);
  $form2 = implode(',', $_POST['form2']);
  
  $image = $_FILES['img']['name'];
  $file_size = $_FILES['img']['size'];
  $tmp_name = $_FILES['img']['tmp_name'];
  $folder = 'patients_image/'.$image;

  if($file_size > 2000000){
      $message[] = 'Image size is too large!';
    }else {
        $insert = mysqli_query($conn,"INSERT INTO patients(givenname,lastname,middlename,dob,place_of_birth,address,religion,nationality,height,weight,birth_ref_no,house_no,line_no,family_no,blood_type,gender,civilstatus,image,form1,form2,age, others) VALUES('$givenname','$lastname','$middlename','$dob','$place_of_birth','$address','$religion','$nationality','$height','$weight','$birth_ref_no.','$house_no','$line_no','$family_no','$bloodtype','$gender','$civilstatus','$image','$form1','$form2','$age','$others')") or die("Error Occured");

        if($insert){
          move_uploaded_file($tmp_name, $folder);
        $messageSuc[] = 'Record Uploaded Successfully!';
        } else {
          $message[] = 'Record Uploaded Failed!';
        }
     }
  }
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
        <script src="back.js"></script>
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
                    <div id="backPromt" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="close_Modal()">&times;</span>
                            <p>Are you sure? your data will not be save</p>
                            <button onclick="back()">Yes</button>
                            <button onclick="close_Modal()">No</button>
                        </div>
                    </div>
            <div class="main">
                <h1 class="heading"> <span>PERSONAL</span> RECORD </h1>
                    <a id="backBtn" onclick="show_Modal()" class="back">Back</a>
                <br></br>
                <br></br>
                    <form action="#" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="form">
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

                                    <div class="left">
                                        <div class="img2">  
                                                <img src="uploaded_img/pic2.jpg">
                                        </div>
                                        <table class="table3">
                                            <tbody>
                                                <tr>
                                                    <td class="br">Upload Image:</td>
                                                    <td><input type="file" name="img" accept="image/jpg, image/jpeg, image/png"></td>
                                                </tr>
                                                <tr>
                                                    <td class="br">Birth Reference No.</td>
                                                    <td><input type="text" name="birth_ref_no" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Household No.</td>
                                                    <td><input type="text" name="house_no" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Line No.</td>
                                                    <td><input type="text" name="line_no" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Family No.</td>
                                                    <td><input type="text" name="family_no" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Blood Type:</td>
                                                    <td><input type="text" name="bloodtype" required></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div  class="right">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td id="dt">SURNAME/LASTNAME:</td>
                                                    <td id="dt"><input type="text" name="lastname" title="Pls input a Surname/Lastname!!" required></td>
                                                </tr>
                                                <tr>
                                                    <td id="dt">GIVEN NAME:</td>
                                                    <td id="dt"><input type="text" name="givenname" required></td>
                                                </tr>
                                                <tr>
                                                    <td id="dt">MIDDLE NAME:</td>
                                                    <td id="dt"><input type="text" name="middlename" required></td>
                                                </tr>
                                                <tr>
                                                    <td id="dt">DATE OF BIRTH:</td>
                                                    <td id="dt"><input type="date" name="dob" required></td>
                                                </tr>
                                                <tr>
                                                    <td id="dt">AGE:</td>
                                                    <td id="dt"><input type="text" name="age" required></td>
                                                </tr>
                                                <tr>
                                                    <td id="dt">PLACE OF BIRTH:</td>
                                                    <td id="dt"><input type="text" name="place_of_birth" required></td>
                                                </tr>
                                                <tr>
                                                    <td id="dt">ADDRESS:</td>
                                                    <td id="dt"><input type="text" name="address" required></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <br>
                                        <table class="table2">
                                            <tbody>
                                                <tr>
                                                    <td id="dt2">Religion:</td>
                                                    <td id="dt2"><input type="text" name="religion" required></td>
                                                    <td id="dt2">Nationality:</td>
                                                    <td id="dt2"><input type="text" name="nationality" required></td>
                                                </tr>
                                                <tr>
                                                    <td id="dt3">Gender:</td>
                                                    <td id="dt3"><input type="radio" name="gender" value="Male" required>
                                                    <label>Male</label>
                                                    <input type="radio" name="gender" value="Female">
                                                    <label>Female</label>
                                                    </td>
                                                    <td id="dt3">Height:</td>
                                                    <td id="dt3"><input type="text" placeholder="cm" name="height" required></td>
                                                </tr>
                                                <tr>
                                                    <td id="dt3">Civil Status:</td>
                                                    <td id="dt3">
                                                    <input type="radio" name="status" value="Single" >
                                                    <label>Single</label>
                                                    <input type="radio" name="status" value="Married">
                                                    <label>Married</label>
                                                    </td>
                                                    <td id="dt3">Weight:</td>
                                                    <td id="dt3"><input type="text" placeholder="kg" name="weight" required></td>
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
                                        <td><input type="checkbox" value="EYES(pterygiums?)" name="form1[]"></td>
                                        <td id="blank"><p>EYES(pterygiums?)</p></td>
                                        <td><input type="checkbox" value="EXTREMITY ABNOMALITY" name="form1[]"></td>
                                        <td id="blank"><p>EXTREMITY ABNOMALITY</p></td>
                                    </tr>

                                    <tr>
                                        <td><input type="checkbox" value="EAR DRUMS / HEARING" name="form1[]"></td>
                                        <td id="blank"><p>EAR DRUMS / HEARING</p></td>
                                        <td><input type="checkbox" value="REFLEX ABNOMALITY" name="form1[]"></td>
                                        <td id="blank"><p>REFLEX ABNOMALITY</p></td>
                                    </tr>
                                    <tr>                                        
                                        <td><input type="checkbox" value="NOSE" name="form1[]"></td>
                                        <td id="blank"><p>NOSE</p></td>
                                        <td><input type="checkbox" value="SKIN ABNORMALITY" name="form1[]"></td>
                                        <td id="blank"><p>SKIN ABNORMALITY</p></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" value="THROAT/MOUTH" name="form1[]"></td>
                                        <td id="blank"><p>THROAT/MOUTH</p></td>
                                        <td><input type="checkbox" value="HERNIA" name="form1[]"></td>
                                        <td id="blank"><p>HERNIA</p></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" value="NECK" name="form1[]"></td>
                                        <td id="blank"><p>NECK</p></td>
                                        <td><input type="checkbox" value="BACK ABNORMALITY" name="form1[]"></td>
                                        <td id="blank"><p>BACK ABNORMALITY</p></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" value="HEART MURMURS/RYTHM" name="form1[]"></td>
                                        <td id="blank"><p>HEART MURMURS/RYTHM</p></td>
                                        <td><input type="checkbox" value="VARICOSE VEINS/VASCULAR SYSTEM" name="form1[]"></td>
                                        <td id="blank"><p>VARICOSE VEINS/VASCULAR SYSTEM</p></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" value="LUNGS AND CHEST" name="form1[]"></td>
                                        <td id="blank"><p>LUNGS AND CHEST</p></td>
                                        <td><input type="checkbox" value="DEFORMITIES/LIMITATION OF MOTION" name="form1[]"></td>
                                        <td id="blank"><p>DEFORMITIES/LIMITATION OF MOTION</p></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" value="ABDOMEN.ORGAN ENLARGEMENT" name="form1[]"></td>
                                        <td id="blank"><p>ABDOMEN.ORGAN ENLARGEMENT</p></td>
                                        <td><input type="checkbox" value="FOOT ABNORMALITY/BUNIONS" name="form1[]"></td>
                                        <td id="blank"><p>FOOT ABNORMALITY/BUNIONS</p></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" value="PSYCHIATRIC BEHAVIOR" name="form1[]"></td>
                                        <td id="blank"><p>PSYCHIATRIC BEHAVIOR</p></td>
                                        <td><input type="checkbox" value="SCARS ON BACK/KNEES/ELSEWHRE" name="form1[]"></td>
                                        <td id="blank"><p>SCARS ON BACK/KNEES/ELSEWHRE</p></td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                            <h1 class="heading"> <span>MEDICAL</span> HISTORY </h1>
                            <div class="form1">
                                <h4>HAVE YOU EVER HAD, DO YOU NOW HAVE, OR EVER DECLARE THAT YOU HAVE/HAD ANY OF THE FOLLOWING CONDITION</h4>
                                <table class="fillup">
                                    <tbody>
                                        <tr>
                                            <td><input type="checkbox" value="Epilepsy/Seizures/Fainting" name="form2[]"></td>
                                            <td id="blank"><p>Epilepsy/Seizures/Fainting</p></td>
                                            <td><input type="checkbox" value="Rheumatic Fever/Typhoid Fever" name="form2[]"></td>
                                            <td id="blank"><p>Rheumatic Fever/Typhoid Fever</p></td>
                                        </tr>

                                        <tr>
                                            <td><input type="checkbox" value="Sever Headaches" name="form2[]"></td>
                                            <td id="blank"><p>Sever Headaches</p></td>
                                            <td><input type="checkbox" value="Malaria" name="form2[]"></td>
                                            <td id="blank"><p>Malaria</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Heart Problem" name="form2[]"></td>
                                            <td id="blank"><p>Heart Problem</p></td>
                                            <td><input type="checkbox" value="Allergies to any food or any other substances" name="form2[]"></td>
                                            <td id="blank"><p>Allergies to any food or any other substances</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="High or Low Blood Pressure" name="form2[]"></td>
                                            <td id="blank"><p>High or Low Blood Pressure</p></td>
                                            <td><input type="checkbox" value="Elbow / Ankle / Foot Pain/Injury" name="form2[]"></td>
                                            <td id="blank"><p>Elbow, Ankle or Foot Pain/Injury</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Chest Pain/Shortness of Breath" name="form2[]"></td>
                                            <td id="blank"><p>Chest Pain/Shortness of Breath</p></td>
                                            <td><input type="checkbox" value="Shoulder or Hip Pain/Injury" name="form2[]"></td>
                                            <td id="blank"><p>Shoulder or Hip Pain/Injury</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Asthma/Hay Fever/Allergies" name="form2[]"></td>
                                            <td id="blank"><p>Asthma/Hay Fever/Allergies</p></td>
                                            <td><input type="checkbox" value="Amputations / Prosthetics" name="form2[]"></td>
                                            <td id="blank"><p>Amputations / Prosthetics</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Frequent Cold / Sore Throat" name="form2[]"></td>
                                            <td id="blank"><p>Tuberculosis</p></td>
                                            <td><input type="checkbox" value="Arthritis / Hand or Wrist Problems or Pain" name="form2[]"></td>
                                            <td id="blank"><p>Arthritis / Hand or Wrist Problems or Pain</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Frequent Colds/Sore Throat" name="form2[]"></td>
                                            <td id="blank"><p>Frequent Colds/Sore Throat</p></td>
                                            <td><input type="checkbox" value="Sprains/Dislocations/Fractures" name="form2[]"></td>
                                            <td id="blank"><p>Sprains/Dislocations/Fractures</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Pneumonia/Influenza/Bronchitis" name="form2[]"></td>
                                            <td id="blank"><p>Pneumonia/Influenza/Bronchitis</p></td>
                                            <td><input type="checkbox" value="Sciatica/Scoliosis/Rheumatism" name="form2[]"></td>
                                            <td id="blank"><p>Sciatica/Scoliosis/Rheumatism</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Lung Problems or Disease" name="form2[]"></td>
                                            <td id="blank"><p>Lung Problems or Disease</p></td>
                                            <td><input type="checkbox" value="Bone or Joint Injury or Problems" name="form2[]"></td>
                                            <td id="blank"><p>Bone or Joint Injury or Problems</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Abdominal Pain/Ulcer/Stomach Problems" name="form2[]"></td>
                                            <td id="blank"><p>Abdominal Pain/Ulcer/Stomach Problems</p></td>
                                            <td><input type="checkbox" value="Degenerative Condition/Disease of the Back" name="form2[]"></td>
                                            <td id="blank"><p>Degenerative Condition/Disease of the Back</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Heptitis/Gallbladder Stones/Liver Stones" name="form2[]"></td>
                                            <td id="blank"><p>Heptitis/Gallbladder Stones/Liver Stones</p></td>
                                            <td><input type="checkbox" value="Neck Muscles/Joints" name="form2[]"></td>
                                            <td id="blank"><p>Neck Muscles/Joints</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Kidney Stones/Kidney Problems or Disease" name="form2[]"></td>
                                            <td id="blank"><p>Kidney Stones/Kidney Problems or Disease</p></td>
                                            <td><input type="checkbox" value="Knee Problems/Leg Injury/Varicose Veins or Leg Swelling" name="form2[]"></td>
                                            <td id="blank"><p>Knee Problems/Leg Injury/Varicose Veins or Leg Swelling</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Diabetes/Thyroid Disease/Other Endocrine" name="form2[]"></td>
                                            <td id="blank"><p>Diabetes/Thyroid Disease/Other Endocrine</p></td>
                                            <td><input type="checkbox" value="Muscular Weakness" name="form2[]"></td>
                                            <td id="blank"><p>Muscular Weakness</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Rashes/Skin Problems or Disease" name="form2[]"></td>
                                            <td id="blank"><p>Rashes/Skin Problems or Disease</p></td>
                                            <td><input type="checkbox" value="Neck or Back Pain/Injury" name="form2[]"></td>
                                            <td id="blank"><p>Neck or Back Pain/Injury</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Head Injury/Stroke/Concussion" name="form2[]"></td>
                                            <td id="blank"><p>Head Injury/Stroke/Concussion</p></td>
                                            <td><input type="checkbox" value="Drug useage/Excessive drinking/Failed drug test" name="form2[]"></td>
                                            <td id="blank"><p>Drug useage/Excessive drinking/Failed drug test</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Vision/Eye Problems or Disease" name="form2[]"></td>
                                            <td id="blank"><p>Vision/Eye Problems or Disease</p></td>
                                            <td><input type="checkbox" value="Hospitalization/Surgical Operation/Serioes Injury-illness" name="form2[]"></td>
                                            <td id="blank"><p>Hospitalization/Surgical Operation/Serioes Injury-illness</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Nose Throat Problems or Disease" name="form2[]"></td>
                                            <td id="blank"><p>Nose Throat Problems or Disease</p></td>
                                            <td><input type="checkbox" value="Psychiatric illness/Counselling/Mental Disorder(s)" name="form2[]"></td>
                                            <td id="blank"><p>Psychiatric illness/Counselling/Mental Disorder(s)</p></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" value="Ear Problems or Deafness" name="form2[]"></td>
                                            <td id="blank"><p>Ear Problems or Deafness</p></td>
                                            <td><input type="checkbox" value="Have you ever been signed off sick/repatriated from ship" name="form2[]"></td>
                                            <td id="blank"><p>Have you ever been signed off sick/repatriated from ship</p></td>
                                        </tr>
                                    </tbody>    
                                </table>
                            </div>
                            <br>
                            <br>
                            <div class="form1"> 
                                <h4>OTHERS</h4>
                                <input type="text" name="others" style="width:100%; padding: 10px 10px 30px 10px;border: 1px solid; margin: 0px 200px; font-size: 18px; background-color: #f4f4f4; border-radius: 8px;">
                            </div>
                                <input type="submit" name="submit" class="submit" value="Save">
                       
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
