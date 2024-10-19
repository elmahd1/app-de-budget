<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();
// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
 
$email=$_SESSION['email'];
$nom=$_SESSION['username'];
$userid=$_SESSION['user_id'];

require 'conndb.php';


require 'C:/xampp/htdocs/gestion de budget/PHPMailer/src/Exception.php';
require 'C:/xampp/htdocs/gestion de budget/PHPMailer/src/PHPMailer.php';
require 'C:/xampp/htdocs/gestion de budget/PHPMailer/src/SMTP.php';

$rub;
$TYPE;
function eemail($dot, $rm, $r,$rub,$TYPE,$email) {
if($TYPE!=='R'){
    $m = $dot / 12;
    $mr = $r / $rm;
    if ($mr < $m) {
      $dif=$m - $mr;
     
$mail = new PHPMailer(true);

try {
    // Paramètres SMTP pour Gmail
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = $email;  // Remplacez par votre email
    $mail->Password   = 'kgzq zvuk teya wknm';  // Remplacez par votre mot de passe
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Paramètres de l'email
    $mail->setFrom($email, 'nom');
    $mail->addAddress('elmehdielmhadri@gmail.com');  // Ajouter le destinataire

    $mail->isHTML(true);
    $mail->Subject = 'budget insufisant';
    $mail->Body    = 'le budget est insufisan pour le reste des mois veuillez ajouter le valeur '.$dif.' au rallonge de la rubrique '.$rub.'';

    $mail->send();
    echo '<script type="text/javascript">';
          echo 'alert("l email a ete bien envoye")';
          echo '</script>';
} catch (Exception $e) {
    echo "L'envoi de l'email a échoué. Erreur : {$mail->ErrorInfo}";
}

    }} 
  }

 
$D=0;
$r=0;
$d1=0;
$d2=0;
$d3=0;
$d4=0;
$d5=0;
$d6=0;
$d7=0;
$d8=0;
$d9=0;
$d10=0;
$d11=0;
$d12=0;
$T=0;
$R=0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    foreach ($_POST['D'] as $index => $value) {

$rub[$index]=$_POST["rub"][$index];
if($rub[$index]!=='0'){
$dotation_2024[$index] = $_POST['D'][$index];
$rallonge[$index] = $_POST['r'][$index];
$depenses_janvier[$index] = $_POST['d1'][$index];
$depenses_fevrier[$index] = $_POST['d2'][$index];
$depenses_mars[$index] = $_POST['d3'][$index];
$depenses_avril[$index] = $_POST['d4'][$index];
$depenses_mai[$index] = $_POST['d5'][$index];
$depenses_juin[$index] = $_POST['d6'][$index];
$depenses_juillet[$index] = $_POST['d7'][$index];
$depenses_aout[$index] = $_POST['d8'][$index];
$depenses_septembre[$index] = $_POST['d9'][$index];
$depenses_octobre[$index] = $_POST['d10'][$index]; 
$depenses_novembre[$index] = $_POST['d11'][$index];
$depenses_decembre[$index] = $_POST['d12'][$index];
$TYPE[$index]=$_POST['type'][$index];
$total_depenses[$index]=$depenses_janvier[$index] + $depenses_fevrier[$index] +$depenses_mars[$index] +$depenses_avril[$index]+$depenses_mai[$index]+$depenses_juin[$index]+$depenses_juillet[$index]+$depenses_aout[$index]+$depenses_septembre[$index]+$depenses_octobre[$index]+$depenses_novembre[$index]+$depenses_decembre[$index];
$reliquat[$index] =  $dotation_2024[$index]- $total_depenses[$index];

if($TYPE[$index]=='SR'){
$D+=$dotation_2024[$index];
$r+=$rallonge[$index];
$d1+=$depenses_janvier[$index];
$d2+=$depenses_fevrier[$index];
$d3+=$depenses_mars[$index];
$d4+=$depenses_avril[$index];
$d5+=$depenses_mai[$index];
$d6+=$depenses_juin[$index];
$d7+=$depenses_juillet[$index];
$d8+=$depenses_aout[$index];
$d9+=$depenses_septembre[$index];
$d10+=$depenses_octobre[$index];
$d11+=$depenses_novembre[$index];
$d12+=$depenses_decembre[$index];
$T+=$total_depenses[$index];
$R+=$reliquat[$index];
}
        $sql = "UPDATE `valeur` v
        JOIN `rubriques` r ON v.id_rubrique = r.id
        SET 
          v.d = '$dotation_2024[$index]', v.ra = '$rallonge[$index]', v.d1 ='$depenses_janvier[$index]', 
          v.d2 = ' $depenses_fevrier[$index]', v.d3 = '$depenses_mars[$index]', v.d4 ='$depenses_avril[$index]', 
          v.d5 = ' $depenses_mai[$index]', v.d6 = '$depenses_juin[$index]', v.d7 = '$depenses_juillet[$index] ', 
          v.d8 = '  $depenses_aout[$index]', v.d9 = '$depenses_septembre[$index]', v.d10 = '$depenses_octobre[$index] ', 
          v.d11 = '$depenses_novembre[$index]', v.d12 = '$depenses_decembre[$index]', 
          v.dt = '$total_depenses[$index]', v.re = '$reliquat[$index]',
          v.id_user='$userid'
        WHERE v.id_rubrique = '$index'";
        
$result=$conn->query($sql); 
 
 if($depenses_janvier[$index] && !$depenses_fevrier[$index] && !$depenses_mars[$index] && !$depenses_avril[$index] && !$depenses_mai[$index] &&  !$depenses_juin[$index] &&  !$depenses_juillet[$index] &&  !$depenses_aout[$index] &&  !$depenses_septembre[$index] &&  !$depenses_octobre[$index] &&  !$depenses_novembre[$index] &&  !$depenses_decembre[$index] ){
  eemail( $dotation_2024[$index],11,$reliquat[$index],$rub[$index],$TYPE[$index],$email);
  }
  if($depenses_janvier[$index] && $depenses_fevrier[$index] && !$depenses_mars[$index] && !$depenses_avril[$index] && !$depenses_mai[$index] &&  !$depenses_juin[$index] &&  !$depenses_juillet[$index] &&  !$depenses_aout[$index] &&  !$depenses_septembre[$index] &&  !$depenses_octobre[$index] &&  !$depenses_novembre[$index] &&  !$depenses_decembre[$index] ){
    eemail( $dotation_2024[$index],10,$reliquat[$index],$rub[$index],$TYPE[$index],$email); 
  }
  if($depenses_janvier[$index] && $depenses_fevrier[$index] && $depenses_mars[$index] && !$depenses_avril[$index] && !$depenses_mai[$index] &&  !$depenses_juin[$index] &&  !$depenses_juillet[$index] &&  !$depenses_aout[$index] &&  !$depenses_septembre[$index] &&  !$depenses_octobre[$index] &&  !$depenses_novembre[$index] &&  !$depenses_decembre[$index] ){
    eemail( $dotation_2024[$index],9,$reliquat[$index],$rub[$index],$TYPE[$index],$email);
  }
  
  if($depenses_janvier[$index] && $depenses_fevrier[$index] && $depenses_mars[$index] && $depenses_avril[$index] && !$depenses_mai[$index] &&  !$depenses_juin[$index] &&  !$depenses_juillet[$index] &&  !$depenses_aout[$index] &&  !$depenses_septembre[$index] &&  !$depenses_octobre[$index] &&  !$depenses_novembre[$index] &&  !$depenses_decembre[$index] ){
    eemail( $dotation_2024[$index],8,$reliquat[$index],$rub[$index],$TYPE[$index],$email);
  }
  if($depenses_janvier[$index] && $depenses_fevrier[$index] && $depenses_mars[$index] && $depenses_avril[$index] && $depenses_mai[$index] &&  !$depenses_juin[$index] &&  !$depenses_juillet[$index] &&  !$depenses_aout[$index] &&  !$depenses_septembre[$index] &&  !$depenses_octobre[$index] &&  !$depenses_novembre[$index] &&  !$depenses_decembre[$index] ){
    eemail( $dotation_2024[$index],7,$reliquat[$index],$rub[$index],$TYPE[$index],$email);
  }
  if($depenses_janvier[$index] && $depenses_fevrier[$index] && $depenses_mars[$index] && $depenses_avril[$index] && $depenses_mai[$index] &&  $depenses_juin[$index] &&  !$depenses_juillet[$index] &&  !$depenses_aout[$index] &&  !$depenses_septembre[$index] &&  !$depenses_octobre[$index] &&  !$depenses_novembre[$index] &&  !$depenses_decembre[$index] ){
    eemail( $dotation_2024[$index],6,$reliquat[$index],$rub[$index],$TYPE[$index],$email);
  }
  if($depenses_janvier[$index] && $depenses_fevrier[$index] && $depenses_mars[$index] && $depenses_avril[$index] && $depenses_mai[$index] &&  $depenses_juin[$index] &&  $depenses_juillet[$index] &&  !$depenses_aout[$index] &&  !$depenses_septembre[$index] &&  !$depenses_octobre[$index] &&  !$depenses_novembre[$index] &&  !$depenses_decembre[$index] ){
    eemail( $dotation_2024[$index],5,$reliquat[$index],$rub[$index],$TYPE[$index],$email);
  }
  if($depenses_janvier[$index] && $depenses_fevrier[$index] && $depenses_mars[$index] && $depenses_avril[$index] && $depenses_mai[$index] &&  $depenses_juin[$index] &&  $depenses_juillet[$index] &&  $depenses_aout[$index] &&  !$depenses_septembre[$index] &&  !$depenses_octobre[$index] &&  !$depenses_novembre[$index] &&  !$depenses_decembre[$index] ){
    eemail( $dotation_2024[$index],4,$reliquat[$index],$rub[$index],$TYPE[$index],$email);
  }
  if($depenses_janvier[$index] && $depenses_fevrier[$index] && $depenses_mars[$index] && $depenses_avril[$index] && $depenses_mai[$index] &&  $depenses_juin[$index] &&  $depenses_juillet[$index] &&  $depenses_aout[$index] &&  $depenses_septembre[$index] &&  !$depenses_octobre[$index] &&  !$depenses_novembre[$index] &&  !$depenses_decembre[$index] ){
    eemail( $dotation_2024[$index],3,$reliquat[$index],$rub[$index],$TYPE[$index],$email);
  }
  if($depenses_janvier[$index] && $depenses_fevrier[$index] && $depenses_mars[$index] && $depenses_avril[$index] && $depenses_mai[$index] &&  $depenses_juin[$index] &&  $depenses_juillet[$index] &&  $depenses_aout[$index] &&  $depenses_septembre[$index] &&  $depenses_octobre[$index] &&  !$depenses_novembre[$index] &&  !$depenses_decembre[$index] ){
    eemail( $dotation_2024[$index],2,$reliquat[$index],$rub[$index],$TYPE[$index],$email);
  }
  if($depenses_janvier[$index] && $depenses_fevrier[$index] && $depenses_mars[$index] && $depenses_avril[$index] && $depenses_mai[$index] &&  $depenses_juin[$index] &&  $depenses_juillet[$index] &&  $depenses_aout[$index] &&  $depenses_septembre[$index] &&  $depenses_octobre[$index] &&  $depenses_novembre[$index] &&  !$depenses_decembre[$index] ){
    eemail( $dotation_2024[$index],1,$reliquat[$index],$rub[$index],$TYPE[$index],$email);
    $m=$dotation_2024[$index]/12;
    if($reliquat[$index]>$m&&$TYPE[$index]=='SR'){
      
$dif=$reliquat[$index]-$m;

      $mail = new PHPMailer(true);
      $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    
      try {
          // Server settings
          $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = $email;  // Remplacez par votre email
    $mail->Password   = 'kgzq zvuk teya wknm';  // Remplacez par votre mot de passe
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

      
          // Recipients
          $mail->setFrom('elmhadrielmahdi@gmail.com', 'elmahdi');
          $mail->addAddress('elmehdielmhadri@gmail.com', 'elmahdi2');
      $r=$rub[$index];
          // Content
          $mail->isHTML(true);
          $mail->Subject = 'Alert Email';
          $mail->Body    = 'la valeur restante POUR LA rubrique '.$r.' est superieure que la moyenne dune valeur de '.$dif.'';
      
          $mail->send();
          echo '<script type="text/javascript">';
          echo 'alert("l email a ete bien envoye")';
          echo '</script>';
      } catch (Exception $e) { 
      echo '<script type="text/javascript">';
      echo 'alert("erreur pour lemail. Mailer Error: {$mail->ErrorInfo}")';
      echo '</script>';
      }
    }
  }
}
else {
  $sql = "UPDATE `valeur` v
  JOIN `rubriques` r ON v.id_rubrique = r.id
  SET 
    v.d = '$D', v.ra = '$r', v.d1 =' $d1', 
    v.d2 = '$d2', v.d3 =' $d3', v.d4 =' $d4', 
    v.d5 = '$d5', v.d6 = '$d6', v.d7 =' $d7', 
    v.d8 = '$d8', v.d9 = '$d9', v.d10 = '$d10', 
    v.d11 = '$d11', v.d12 =' $d12', 
    v.dt = '$T', v.re =' $R'
  WHERE r.rubrique = '0'";
  
  $result=$conn->query($sql);



}}
$D=0;
$r=0;
$d1=0;
$d2=0;
$d3=0;
$d4=0;
$d5=0;
$d6=0;
$d7=0;
$d8=0;
$d9=0;
$d10=0;
$d11=0;
$T=0;
$R=0;
$rs=['1','3','5','7','9','11','14','17','20','24','27','35','37','39','42','46','49'];
$sr=['1','1','1','1','1','2','2','2','3','2','7','1','1','2','3','2','3'];
for($i=0;$i<17;$i++){
for($j=$rs[$i]+1;$j<=$sr[$i]+$rs[$i];$j++){
  $D+=$dotation_2024[$j];
  $r+=$rallonge[$j];
  $d1+=$depenses_janvier[$j];
  $d2+=$depenses_fevrier[$j];
  $d3+=$depenses_mars[$j];
  $d4+=$depenses_avril[$j];
  $d5+=$depenses_mai[$j];
  $d6+=$depenses_juin[$j];
  $d7+=$depenses_juillet[$j];
  $d8+=$depenses_aout[$j];
  $d9+=$depenses_septembre[$j];
  $d10+=$depenses_octobre[$j];
  $d11+=$depenses_novembre[$j];
  $d12+=$depenses_decembre[$j];
  $T+=$total_depenses[$j];
  $R+=$reliquat[$j];
}
$s = "UPDATE `valeur` v
JOIN `rubriques` r ON v.id_rubrique = r.id
SET 
  v.d = '$D', v.ra = '$r', v.d1 =' $d1', 
  v.d2 = '$d2', v.d3 =' $d3', v.d4 =' $d4', 
  v.d5 = '$d5', v.d6 = '$d6', v.d7 =' $d7', 
  v.d8 = '$d8', v.d9 = '$d9', v.d10 = '$d10', 
  v.d11 = '$d11', v.d12 =' $d12', 
  v.dt = '$T', v.re =' $R'
WHERE v.id_rubrique = '$rs[$i]'";


$result1=$conn->query($s);
$D=0;
$r=0;
$d1=0;
$d2=0;
$d3=0;
$d4=0;
$d5=0;
$d6=0;
$d7=0;
$d8=0;
$d9=0;
$d10=0;
$d11=0;
$T=0;
$R=0;
}
   


 }
 if($conn->query($s)=== true){
  $operation="INSERT INTO `operations`(`user_id`, `operation`, `dateheur`) VALUES ('$_SESSION[user_id]','$session[username] a modifier le tableau',NOW())";
  $resop=$conn->query($operation);
 header("location:insert.php");
 }

 


  $conn->close();
 
} else {
header("location:login.php");
}
?>
