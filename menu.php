
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            line-height: 1.6;
           
        }

        header {
            background-color: #003d7a;
            color: #ffffff;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .navbar {
            max-width: 1200px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .navbar a {
            color: #ffffff;
            text-decoration: none;
            padding: 12px 20px;
            font-size: 16px;
            display: inline-block;
            transition: background-color 0.3s, color 0.3s;
            border-radius: 5px;
        }

        .navbar a:hover, .navbar .dropdown:hover .dropbtn {
            background-color: #002a5d;
            color: #ffffff;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #ffffff;
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            z-index: 1000;
            top: 100%;
            left: 0;
        }

        .dropdown-content a {
            color: #003d7a;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

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


        .footer {
            background-color: #003d7a;
            color: #ffffff;
            padding: 15px 0;
            text-align: center;
            position: fixed;
            width: 100%;
            bottom: 0;
            box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.1);
        }

        .footer p {
            margin: 0;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <a style=" height: 20px; width: 30px; background-size: cover; background-image: url(logo.png);" href="https://www.onda.ma/"></a>
            </div>
            <div class="menu">
                <a href="index.php">Home</a>
                <a href="insert.php">Insertion</a>
                <a href="graphe1.php">Graphs</a>
                <a href="comparaison.php">comparer</a>
                <div class="dropdown">
                    <a href="#" class="dropbtn">More</a>
                    <div class="dropdown-content">
                       
                 <a href="user.php">votre compte</a>
                        <a href="logout.php">logout</a>
                       
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <footer class="footer">
        <p>&copy; 2024 ONDA. All rights reserved.</p>
    </footer>
</body>
</html>