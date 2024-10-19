<?php 

session_start();
// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
require 'conndb.php';


//requete sql de selection de tout le tableau    
$sql="SELECT r.*, v.*
FROM rubriques r
JOIN valeur v ON r.id = v.id_rubrique
WHERE v.id_annee = 3;
";
$result=$conn->query($sql);

if($result->num_rows>0){
    //en tete du tableau 
    echo"<table border='1'>";
    echo"<tr><th>rubrique</th><th id='intitule'>intitule rubrique</th><th>dotation 2024</th><th>rallonge</th><th>depenses janvier</th><th>depenses fevrier</th><th>depenses mars</th><th>depenses avril</th><th>depenses mai</th><th>depenses juin</th><th>depenses juillet</th><th>depenses aout</th><th>depenses septembre</th><th>depenses octobre</th><th>depnses novembre</th><th>depnses decmbre</th><th>total depenses</th><th>reliquat</th></tr>";
    $index = 1; 
  
    while ($row = $result->fetch_assoc()) {
    //envoie des donnees a lautre fichier pour la mise a jour de la bd
        echo "<form action='update.php' method='post'>";
        if($row["RUBRIQUE"] =='0'){
            echo "<tr style='display: none;'>";
           }
       
       else {
       
        echo "<tr>";}
        //si le type est sr on doit avoir un input dans la case si le type est r on doit pas
        if($row["type"]=='SR'){
        //les cases du tableau
        echo "<td  name='rub[$index]'>" . $row["RUBRIQUE"] . "</td>";
        echo "<td id='intitule'>" . $row["INTITULE_RUBRIQUE"] . "</td>";
        echo "<td><input  type='number' id='D[$index]' name='D[$index]' value='" . $row["d"] . "'></td>";
        echo "<td><input type='number' id='r[$index]' name='r[$index]' value='" . $row["ra"] . "'></td>";
        echo "<td><input type='number' id='d1[$index]' name='d1[$index]' value='" . $row["d1"] . "'></td>";
        echo "<td><input type='number' name='d2[$index]' id='d2[$index]' value='" . $row["d2"] . "'></td>";
        echo "<td><input type='number' name='d3[$index]' id='d3[$index]' value='" . $row["d3"] . "'></td>";
        echo "<td><input type='number' name='d4[$index]' id='d4[$index]' value='" . $row["d4"] . "'></td>";
        echo "<td><input type='number' name='d5[$index]' id='d5[$index]' value='" . $row["d5"] . "'></td>";
        echo "<td><input type='number' id='d6[$index]' name='d6[$index]' value='" . $row["d6"] . "'></td>";
        echo "<td><input type='number' id='d7[$index]' name='d7[$index]' value='" . $row["d7"] . "'></td>";
        echo "<td><input type='number' id='d8[$index]' name='d8[$index]' value='" . $row["d8"] . "'></td>";
        echo "<td><input type='number' id='d9[$index]' name='d9[$index]' value='" . $row["d9"] . "'></td>";
        echo "<td><input type='number' id='d10[$index]' name='d10[$index]' value='" . $row["d10"] . "'></td>";
        echo "<td><input type='number' id='d11[$index]' name='d11[$index]' value='" . $row["d11"] . "'></td>";
        echo "<td><input type='number' id='d12[$index]' name='d12[$index]' value='" . $row["d12"] . "'></td>";
        echo "<td>". $row["dt"] ."</td>";
        echo "<td>". $row["re"] ."</td>";
        echo "<td style='display: none;'><input  type='number' id='rub[$index]' name='rub[$index]' value='" . $row["RUBRIQUE"] . "'></td>";
        echo "<td  style='display: none;'><input  type='text' id='type[$index]' name='type[$index]' value='" . $row["type"] . "'></td>";
        
    }
    else{
        echo "<td style='background-color: yellow;' name='rub[$index]'>" . $row["RUBRIQUE"] . "</td>";
        echo "<td style='background-color: yellow;' id='intitule'>" . $row["INTITULE_RUBRIQUE"] . "</td>";
        echo "<td style='background-color: yellow;'><input style='background-color: yellow;' type='number' id='D[$index]' name='D[$index]' value='" . $row["d"] . "' readonly></td>";
        echo "<td style='background-color: yellow;'><input style='background-color: yellow;' type='number' id='r[$index]' name='r[$index]' value='" . $row["ra"] . "' readonly></td>";
        echo "<td style='background-color: yellow;'><input style='background-color: yellow;' type='number' id='d1[$index]' name='d1[$index]' value='" . $row["d1"] . "' readonly></td>";
        echo "<td style='background-color: yellow;'><input style='background-color: yellow;' type='number' name='d2[$index]' id='d2[$index]' value='" . $row["d2"] . "' readonly></td>";
        echo "<td style='background-color: yellow;'><input style='background-color: yellow;' type='number' name='d3[$index]' id='d3[$index]' value='" . $row["d3"] . "' readonly></td>";
        echo "<td style='background-color: yellow;'><input style='background-color: yellow;' type='number' name='d4[$index]' id='d4[$index]' value='" . $row["d4"] . "' readonly></td>";
        echo "<td style='background-color: yellow;'><input style='background-color: yellow;' type='number' name='d5[$index]' id='d5[$index]' value='" . $row["d5"] . "' readonly></td>";
        echo "<td style='background-color: yellow;'><input style='background-color: yellow;' type='number' id='d6[$index]' name='d6[$index]' value='" . $row["d6"] . "' readonly></td>";
        echo "<td style='background-color: yellow;'><input style='background-color: yellow;' type='number' id='d7[$index]' name='d7[$index]' value='" . $row["d7"] . "' readonly></td>";
        echo "<td style='background-color: yellow;'><input style='background-color: yellow;' type='number' id='d8[$index]' name='d8[$index]' value='" . $row["d8"] . "'readonly></td>";
        echo "<td style='background-color: yellow;'><input style='background-color: yellow;' type='number' id='d9[$index]' name='d9[$index]' value='" . $row["d9"] . "' readonly></td>";
        echo "<td style='background-color: yellow;'><input style='background-color: yellow;' type='number' id='d10[$index]' name='d10[$index]' value='" . $row["d10"] . "' readonly></td>";
        echo "<td style='background-color: yellow;'><input style='background-color: yellow;' type='number' id='d11[$index]' name='d11[$index]' value='" . $row["d11"] . "' readonly></td>";
        echo "<td style='background-color: yellow;'><input style='background-color: yellow;' type='number' id='d12[$index]' name='d12[$index]' value='" . $row["d12"] . "' readonly></td>";
        echo "<td style='background-color: yellow;'>". $row["dt"] ."</td>";
        echo "<td style='background-color: yellow;'>". $row["re"] ."</td>";
        echo "<td  style='display: none;'><input  type='number' id='rub[$index]' name='rub[$index]' value='" . $row["RUBRIQUE"] . "'></td>";
        echo "<td  style='display: none;'><input  type='text' id='type[$index]' name='type[$index]' value='" . $row["type"] . "'></td>";
    }
        echo "</tr>";
        echo "<input type='hidden' name='index' value='$index'>"; 
       
        $index++; 
    }
    echo "<button id='submit' class='btn' type='submit'>Envoyer</button>";
    echo "</form>";
}
    


$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      #submit{
        margin-top: 100px;
        margin-left: 450px;
        height: 40px;
      }
        body {
    font-family: 'Roboto', sans-serif;
    color: #333;
    background-color: #f4f4f4;
  
}
        input{
            height: 15px;
            width: 50px;
            border: none;
            font-size: 10px;
            box-sizing: border-box; 
            border-radius:unset;
        }
        td{
            height: 15px;
            font-size: 10px;
            width: 50px;
          
           
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            margin: 30px;
          
        }

        #intitule{
width: 200px;
font-size: 10px;

        }
        th{
            background-color: blue;
            font-size: 10px;
            width: 200px;
            width: 50px;
            color: azure;
         
        }
        tr{
            height: 20px;
            
        }
        
        button{
            height: 30px;
            width: 200px;
            font-size: large;
          text-align: center;
            border-radius: 10px;
        
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        
        .container {
            padding: 60px 20px;
            max-width: 1200px;
            margin: auto;
        }
        
        .btn {
            background-color: #003d7a;
            color: #ffffff;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s, box-shadow 0.3s;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .btn:hover {
            background-color: #002a5d;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        
       
        /* Améliorations pour l’accessibilité */
        a {
            color: #003d7a;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        a:hover {
            color: #002a5d;
        }
        
        button:focus {
            outline: 3px solid #003d7a;
            outline-offset: 2px;
        }
        
        input:focus, textarea:focus {
            border-color: #003d7a;
            box-shadow: 0 0 4px rgba(0, 61, 122, 0.5);
        }
        
    </style>
</head>
<body>

</body>
</html>
<?php 
} else {
    header("location:login.php");
}
?>