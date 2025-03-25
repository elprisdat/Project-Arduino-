<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontrol LED IoT</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .button-group {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 20px 0;
        }
        .button {
            padding: 15px 30px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .button-on {
            background-color: #4CAF50;
            color: white;
        }
        .button-off {
            background-color: #f44336;
            color: white;
        }
        .button:hover {
            opacity: 0.9;
        }
        .status {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
        }
        .success {
            background-color: #dff0d8;
            color: #3c763d;
        }
        .error {
            background-color: #f2dede;
            color: #a94442;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Kontrol LED IoT</h1>
        
        <div class="button-group">
            <div>
                <h3>LED Kelas</h3>
                <form action="control.php" method="post">
                    <button type="submit" name="action" value="kelas_on" class="button button-on">ON</button>
                    <button type="submit" name="action" value="kelas_off" class="button button-off">OFF</button>
                </form>
            </div>
            
            <div>
                <h3>LED Kelompok</h3>
                <form action="control.php" method="post">
                    <button type="submit" name="action" value="kelompok_on" class="button button-on">ON</button>
                    <button type="submit" name="action" value="kelompok_off" class="button button-off">OFF</button>
                </form>
            </div>
        </div>

        <?php
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            $message = $_GET['message'] ?? '';
            $class = ($status === 'success') ? 'success' : 'error';
            echo "<div class='status {$class}'>{$message}</div>";
        }
        ?>
    </div>
</body>
</html> 