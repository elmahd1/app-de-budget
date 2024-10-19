<?php 
session_start();
// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
   

require 'conndb.php';
require 'menu.php';

$intitule = $_POST["intitule"];
$selected_options = $_POST['options']; 
$index = 0;
$amount = [];
$amount2 = [];
$dot = [];

foreach ($selected_options as $option) {
    $index++;
    $annee = $option; // Option value used directly

    // Construct the query for fetching monthly sums
    $query = $conn->query("
        
SELECT 'January' AS monthname, 
       SUM(v.d1) AS amount, 
       1 AS monthnum 
FROM valeur v
JOIN rubriques r ON v.id_rubrique = r.id
JOIN annees a ON v.id_annee = a.id
WHERE r.INTITULE_RUBRIQUE = '$intitule'
AND a.annee = '$annee'
UNION ALL

SELECT 'February' AS monthname, 
       SUM(v.d2) AS amount, 
       2 AS monthnum 
FROM valeur v
JOIN rubriques r ON v.id_rubrique = r.id
JOIN annees a ON v.id_annee = a.id
WHERE r.INTITULE_RUBRIQUE = '$intitule'
AND a.annee = '$annee'
UNION ALL

SELECT 'march' AS monthname, 
       SUM(v.d3) AS amount, 
       3 AS monthnum 
FROM valeur v
JOIN rubriques r ON v.id_rubrique = r.id
JOIN annees a ON v.id_annee = a.id
WHERE r.INTITULE_RUBRIQUE = '$intitule'
AND a.annee = '$annee'
UNION ALL

SELECT 'April' AS monthname, 
       SUM(v.d4) AS amount, 
       4 AS monthnum 
FROM valeur v
JOIN rubriques r ON v.id_rubrique = r.id
JOIN annees a ON v.id_annee = a.id
WHERE r.INTITULE_RUBRIQUE = '$intitule'
AND a.annee = '$annee'
UNION ALL

SELECT 'mai' AS monthname, 
       SUM(v.d5) AS amount, 
       5 AS monthnum 
FROM valeur v
JOIN rubriques r ON v.id_rubrique = r.id
JOIN annees a ON v.id_annee = a.id
WHERE r.INTITULE_RUBRIQUE = '$intitule'
AND a.annee = '$annee'
UNION ALL

SELECT 'June' AS monthname, 
       SUM(v.d6) AS amount, 
       6 AS monthnum 
FROM valeur v
JOIN rubriques r ON v.id_rubrique = r.id
JOIN annees a ON v.id_annee = a.id
WHERE r.INTITULE_RUBRIQUE = '$intitule'
AND a.annee = '$annee'
UNION ALL

SELECT 'Jully' AS monthname, 
       SUM(v.d7) AS amount, 
       7 AS monthnum 
FROM valeur v
JOIN rubriques r ON v.id_rubrique = r.id
JOIN annees a ON v.id_annee = a.id
WHERE r.INTITULE_RUBRIQUE = '$intitule'
AND a.annee = '$annee'
UNION ALL

SELECT 'August' AS monthname, 
       SUM(v.d8) AS amount, 
       8 AS monthnum 
FROM valeur v
JOIN rubriques r ON v.id_rubrique = r.id
JOIN annees a ON v.id_annee = a.id
WHERE r.INTITULE_RUBRIQUE = '$intitule'
AND a.annee = '$annee'
UNION ALL

SELECT 'September' AS monthname, 
       SUM(v.d9) AS amount, 
       9 AS monthnum 
FROM valeur v
JOIN rubriques r ON v.id_rubrique = r.id
JOIN annees a ON v.id_annee = a.id
WHERE r.INTITULE_RUBRIQUE = '$intitule'
AND a.annee = '$annee'
UNION ALL

SELECT 'October' AS monthname, 
       SUM(v.d10) AS amount, 
       10 AS monthnum 
FROM valeur v
JOIN rubriques r ON v.id_rubrique = r.id
JOIN annees a ON v.id_annee = a.id
WHERE r.INTITULE_RUBRIQUE = '$intitule'
AND a.annee = '$annee'
UNION ALL

SELECT 'November' AS monthname, 
       SUM(v.d11) AS amount, 
       11 AS monthnum 
FROM valeur v
JOIN rubriques r ON v.id_rubrique = r.id
JOIN annees a ON v.id_annee = a.id
WHERE r.INTITULE_RUBRIQUE = '$intitule'
AND a.annee = '$annee'
UNION ALL

SELECT 'december' AS monthname, 
       SUM(v.d12) AS amount, 
       12 AS monthnum 
FROM valeur v
JOIN rubriques r ON v.id_rubrique = r.id
JOIN annees a ON v.id_annee = a.id
WHERE r.INTITULE_RUBRIQUE = '$intitule'
AND a.annee = '$annee'

ORDER BY monthnum;
    ");
    
    // Query to fetch DOTATION value
    $s = "SELECT d FROM valeur v
JOIN rubriques r ON v.id_rubrique = r.id
WHERE r.INTITULE_RUBRIQUE = '$intitule'";
    $result = $conn->query($s);
    
    if ($result) {
        $row = $result->fetch_assoc(); // Fetch associative array from result
        $dot[$index] = $row['DOTATION_' . $a] ?? null; // Avoid undefined index error
    } else {
        echo "Error fetching DOTATION for $a: " . $conn->error;
    }

    $amount[$index] = [];
    $amount2[$index] = [];
    
    foreach ($query as $data) {
        $amount[$index][] = $data['amount'];
    }

    // Calculate remaining amounts (amount2)
    $amount2[$index][] = $dot[$index];
    for ($i = 0; $i < 12; $i++) {
        if ($i == 0) {
            $amount2[$index][] = ($amount[$index][$i] == 0) ? null : $dot[$index] - $amount[$index][$i];
        } else {
            $amount2[$index][] = ($amount[$index][$i] == 0) ? null : $amount2[$index][$i] - $amount[$index][$i];
        }
    }

    array_unshift($amount[$index], ''); // Add empty string to the beginning of $amount
}
$bordercolor =['rgba(255, 99, 132, 0.5)','chartreuse','forestgreen ','mediumblue','cyan'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
    <br><br>
<div id="container" style="width: 800px;">
    <canvas id="myChart"></canvas>
    <br><br>
</div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const labels = ['', 'janvier', 'fevrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'aout', 'septembre', 'octobre', 'novembre', 'decembre'];
const data = {
    labels: labels,
    datasets: [
        <?php 
            $i=0;
            foreach ($selected_options as $index => $option) { ?> 
        {
            type: 'bar',
            label: 'Depenses des mois pour <?php echo $option; ?>',
            data: <?php echo json_encode($amount[$index + 1]); ?>,
            backgroundColor: <?php echo json_encode($bordercolor[$i]); ?>,
            borderColor: <?php echo json_encode($bordercolor[$i]); ?>,
            borderWidth: 1,
            barThickness: 20,
            categoryPercentage: 0.8,
        },
     
        {
            type: 'line',
            label: 'Ligne pour le reste de la dotation pour <?php echo $option; ?>',
            data: <?php echo json_encode($amount2[$index + 1]); ?>,
            borderColor: <?php echo json_encode($bordercolor[$i]); ?>,
            backgroundColor:  <?php echo json_encode($bordercolor[$i]); ?>,
            fill: false,
            tension: 0.1,
            pointStyle: 'circle',
            pointRadius: 5,
            pointBackgroundColor: 'rgb(54, 162, 235)',
            pointBorderColor: 'rgb(54, 162, 235)',
            order: 1
        },
        <?php 
    $i++;
    } ?>
    ]
};

const config = {
    data: data,
    options: {
        scales: {
            x: {
                stacked: false,
            },
            y: {
                beginAtZero: true
            }
        }
    }
};

var myChart = new Chart(
    document.getElementById('myChart'),
    config
);
</script>
<?php 
} else {
    header("location:login.php");
}
?>