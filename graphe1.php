<?php 
session_start();
// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
require 'menu.php';
require 'conndb.php';

if(isset($_POST["annee"])){

    $a = $_POST["annee"];
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style> body {
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
        
        select {
            width: 200px;
            height: 50px;
            font-size: large;
            border-radius: 10px;
            text-align: center;
        }
        
        .btn {
            height: 50px;
            width:100%;
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
        }
        
        .btn:hover {
            background-color: #002a5d;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        </style>
    </head>
    <body>
        
        <div class="container">
            <?php 
           
            $query = $conn->query("SELECT INTITULE_RUBRIQUE FROM rubriques");
            echo "<h1>Choisissez une rubrique pour afficher son graphe</h1>";
            echo "<form action='graphe2.php' method='post'>";
            echo "<select name='INTITULE_RUBRIQUE'>";
            foreach($query as $data){
                if($data['INTITULE_RUBRIQUE'] == 'SOMME'){
                    echo "<option style='display: none;' value='$data[INTITULE_RUBRIQUE]'>$data[INTITULE_RUBRIQUE]</option>";
                } else {
                    echo "<option value='$data[INTITULE_RUBRIQUE]'>$data[INTITULE_RUBRIQUE]</option>";
                }
            }
            echo "</select>";
            echo "<input type='hidden' name='annee' value='$a'>";
            echo "<button class='btn' type='submit'>Etat de consommation du budget</button>";
            echo "</form>";
            echo "<form action='graphe2.php' method='post'>";
            echo "<input type='hidden' name='annee' value='$a'>";
            echo "<button  class='btn' name='INTITULE_RUBRIQUE' value='SOMME'>Etat de consommation du budget global</button>";
            echo "</form>";
            ?>
        </div>
        
       
        
        
    </body>
    </html>
    <?php 
   
    
}
else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <style>
       body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            
        }

      
h1{
    text-align: center;
}


        .container {
            padding: 60px 20px;
            max-width: 1200px;
            margin: auto;
            margin-top: 60px; /* Adjust for fixed header */
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

      
        /* Accessibility improvements */
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
    <div class="container">
        <?php
        $query = $conn->query("SELECT annee FROM annees");
        ?>
        <h1>Choisissez l'année</h1><br>
        <form action='graphe1.php' method='post'>
            <select name='annee' id='annee'>
                <?php foreach ($query as $data): ?>
                    <option value='<?php echo htmlspecialchars($data['annee']); ?>'><?php echo htmlspecialchars($data['annee']); ?></option>
                <?php endforeach; ?>
            </select><br>
            <button style="height: 40px;" id='submit' class='btn' type='submit'>Envoyer</button>
        </form>
    </div>
   
   
</body>
</html>
<?php 
}
}else {
    header("location:login.php");
}
?>