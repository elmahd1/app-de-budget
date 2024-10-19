<?php 
session_start();
// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gestion de budget</title>
      <style>
       
        .container {
            padding: 80px 20px; /* Adjust for header */
            max-width: 1200px;
            margin: auto;
            display: flex;
            justify-content: space-around;
            align-items: center;
            min-height: 70vh; /* To fill the screen */
        }

        .btn {
            position: relative;
            width: 200px;
            height: 200px;
            background-size: cover;
            background-position: center;
            border: none;
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn::before {
            content: attr(data-title); /* Display title */
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            color: #ffffff;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent overlay */
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .btn:hover::before {
            opacity: 1; /* Show title on hover */
        }

        .btn:hover {
            transform: translateY(-5px); /* Lift effect */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        #insert {
            background-image: url(pics/inserttab.PNG); /* Path to your image */
        }

        #graphe {
            background-image: url(pics/graphe.PNG); /* Path to your image */
        }
        #user{
            background-image: url(pics/profil.png);
        }
        
    </style>
</head>
<body>
    
    
    <div class="container">
        <button id="insert" class="btn" data-title="Insert Data"></button>
        <button id="graphe" class="btn" data-title="Graphs"></button>
        <button id="user" class="btn" data-title="user"></button>
    </div>

</body>
</html>
<script>
    let insert=document.getElementById("insert");
    insert.addEventListener('click',function(){
        window.location.href="insert.php";
    })
    let graphe=document.getElementById("graphe");
    graphe.addEventListener('click',function(){
        window.location.href="graphe1.php";
    })
    let user=document.getElementById("user");
    user.addEventListener('click',function(){
        window.location.href="user.php";
    })
</script>
<?php 
}
else {
   if(isset($_POST["login"])){
require 'conndb.php';
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$password = $_POST["mot_de_passe"];
$email=$_POST["email"];

$sql="SELECT * FROM users where nom='$nom'";
$result=$conn->query($sql);

if($result->num_rows>0){
   while( $row = $result->fetch_assoc()){
    $hp = $row['mot_de_passe'];     
    if (password_verify($password, $hp)) {
       
        $_SESSION['username'] = $nom;
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['prenom'] = $row['prenom'];
        $_SESSION['email']=$row['email'];
        $_SESSION['user_role']=$row['role'];
        $_SESSION['annee']='';
        header("location:index.php");
    } 
        else{
            header("location:login.php");
            exit;
        }}
    }else{
         // If the account does not exist, create one
$hp = password_hash($password, PASSWORD_BCRYPT);


$sql = "INSERT INTO `users`(`nom`, `prenom`, `email`, `mot_de_passe`, `role`,`etat`) VALUES ('$nom','$prenom','$email','$hp','user','active')";
$result=$conn->query($sql);

if ($conn->query($sql)==true) {
    $operation="INSERT INTO `operations`(`user_id`, `operation`, `dateheur`) VALUES ('0','$session[username] a cree son compte',NOW())";
    $resop=$conn->query($operation);
    header("Location: login.php");  // Redirect to login page after account creation
    exit();
} else {
   
}
    }}else{
        header("location:login.php");
        exit;
    }
}

?>