<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontrol LED IoT</title>
    <style>
        :root {
            --primary-color: #4CAF50;
            --primary-dark: #45a049;
            --danger-color: #f44336;
            --danger-dark: #da190b;
            --text-color: #2c3e50;
            --card-bg: rgba(255, 255, 255, 0.95);
            --shadow-color: rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-color);
        }

        .container {
            max-width: 1000px;
            width: 100%;
            background-color: var(--card-bg);
            padding: 40px;
            border-radius: 30px;
            box-shadow: 0 20px 60px var(--shadow-color);
            backdrop-filter: blur(10px);
            transform: translateY(0);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 70px var(--shadow-color);
        }

        h1 {
            text-align: center;
            color: var(--text-color);
            margin-bottom: 50px;
            font-size: clamp(2em, 5vw, 3em);
            text-shadow: 2px 2px 4px var(--shadow-color);
            position: relative;
            padding-bottom: 20px;
        }

        h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--danger-color));
            border-radius: 3px;
        }

        .button-group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            margin: 20px 0;
            padding: 20px;
        }

        .control-card {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px var(--shadow-color);
            text-align: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .control-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s;
        }

        .control-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px var(--shadow-color);
        }

        .control-card:hover::before {
            transform: translateX(100%);
        }

        h3 {
            color: var(--text-color);
            margin-bottom: 30px;
            font-size: clamp(1.2em, 3vw, 1.5em);
            position: relative;
            display: inline-block;
        }

        h3::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, var(--primary-color), transparent);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .control-card:hover h3::after {
            transform: scaleX(1);
        }

        .switch-container {
            position: relative;
            width: 140px;
            height: 70px;
            margin: 20px auto;
            perspective: 1000px;
        }

        .switch {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #e0e0e0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 35px;
            box-shadow: inset 0 2px 5px var(--shadow-color);
            transform-style: preserve-3d;
        }

        .switch:before {
            position: absolute;
            content: "";
            height: 62px;
            width: 62px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 50%;
            box-shadow: 0 2px 5px var(--shadow-color);
        }

        .switch.on {
            background-color: var(--primary-color);
            transform: rotateY(180deg);
        }

        .switch.on:before {
            transform: translateX(70px) rotateY(180deg);
        }

        .button {
            padding: 15px 30px;
            font-size: clamp(0.9em, 2vw, 1em);
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: bold;
            box-shadow: 0 5px 15px var(--shadow-color);
            position: relative;
            overflow: hidden;
        }

        .button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .button:hover::before {
            left: 100%;
        }

        .button-on {
            background: linear-gradient(45deg, var(--primary-color), var(--primary-dark));
            color: white;
        }

        .button-off {
            background: linear-gradient(45deg, var(--danger-color), var(--danger-dark));
            color: white;
        }

        .button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px var(--shadow-color);
        }

        .button:active {
            transform: translateY(1px);
        }

        .status {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
            border-radius: 15px;
            animation: slideIn 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .status::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s;
        }

        .status:hover::before {
            transform: translateX(100%);
        }

        .success {
            background: linear-gradient(45deg, #dff0d8, #c3e6cb);
            color: #3c763d;
            border-left: 4px solid var(--primary-color);
        }

        .error {
            background: linear-gradient(45deg, #f2dede, #f8d7da);
            color: #a94442;
            border-left: 4px solid var(--danger-color);
        }

        @keyframes slideIn {
            from { 
                opacity: 0; 
                transform: translateY(-20px);
            }
            to { 
                opacity: 1; 
                transform: translateY(0);
            }
        }

        .led-indicator {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #e0e0e0;
            margin: 20px auto;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .led-indicator::before {
            content: '';
            position: absolute;
            top: -5px;
            left: -5px;
            right: -5px;
            bottom: -5px;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.8), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .led-indicator.on {
            background-color: var(--primary-color);
            box-shadow: 0 0 30px var(--primary-color);
        }

        .led-indicator.on::before {
            opacity: 1;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
                margin: 10px;
            }

            .button-group {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .control-card {
                padding: 20px;
            }

            .switch-container {
                width: 120px;
                height: 60px;
            }

            .switch:before {
                height: 52px;
                width: 52px;
            }

            .switch.on:before {
                transform: translateX(60px) rotateY(180deg);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Kontrol LED IoT</h1>
        
        <div class="button-group">
            <div class="control-card">
                <h3>LED Kelas</h3>
                <div class="led-indicator" id="led-kelas"></div>
                <div class="switch-container">
                    <div class="switch" id="switch-kelas"></div>
                </div>
                <form action="control.php" method="post" id="form-kelas">
                    <button type="submit" name="action" value="kelas_on" class="button button-on">ON</button>
                    <button type="submit" name="action" value="kelas_off" class="button button-off">OFF</button>
                </form>
            </div>
            
            <div class="control-card">
                <h3>LED Kelompok</h3>
                <div class="led-indicator" id="led-kelompok"></div>
                <div class="switch-container">
                    <div class="switch" id="switch-kelompok"></div>
                </div>
                <form action="control.php" method="post" id="form-kelompok">
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

    <script>
        // Fungsi untuk mengupdate tampilan LED dengan animasi
        function updateLEDState(ledId, switchId, isOn) {
            const ledIndicator = document.getElementById(ledId);
            const switchElement = document.getElementById(switchId);
            
            if (isOn) {
                ledIndicator.classList.add('on');
                switchElement.classList.add('on');
                // Tambahkan efek pulse
                ledIndicator.style.animation = 'pulse 1s infinite';
            } else {
                ledIndicator.classList.remove('on');
                switchElement.classList.remove('on');
                ledIndicator.style.animation = 'none';
            }
        }

        // Tambahkan style untuk animasi pulse
        const style = document.createElement('style');
        style.textContent = `
            @keyframes pulse {
                0% { box-shadow: 0 0 30px var(--primary-color); }
                50% { box-shadow: 0 0 50px var(--primary-color); }
                100% { box-shadow: 0 0 30px var(--primary-color); }
            }
        `;
        document.head.appendChild(style);

        // Event listener untuk switch dengan efek ripple
        function createRipple(event) {
            const button = event.currentTarget;
            const ripple = document.createElement('span');
            const rect = button.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = event.clientX - rect.left - size/2;
            const y = event.clientY - rect.top - size/2;
            
            ripple.style.width = ripple.style.height = `${size}px`;
            ripple.style.left = `${x}px`;
            ripple.style.top = `${y}px`;
            ripple.className = 'ripple';
            
            button.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
        }

        document.getElementById('switch-kelas').addEventListener('click', function(e) {
            createRipple(e);
            const form = document.getElementById('form-kelas');
            const isOn = this.classList.contains('on');
            const action = isOn ? 'kelas_off' : 'kelas_on';
            
            const button = document.createElement('button');
            button.type = 'submit';
            button.name = 'action';
            button.value = action;
            form.appendChild(button);
            button.click();
        });

        document.getElementById('switch-kelompok').addEventListener('click', function(e) {
            createRipple(e);
            const form = document.getElementById('form-kelompok');
            const isOn = this.classList.contains('on');
            const action = isOn ? 'kelompok_off' : 'kelompok_on';
            
            const button = document.createElement('button');
            button.type = 'submit';
            button.name = 'action';
            button.value = action;
            form.appendChild(button);
            button.click();
        });

        // Update LED state berdasarkan status
        <?php
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            if ($status === 'success') {
                $action = $_GET['action'] ?? '';
                if (strpos($action, 'kelas') !== false) {
                    echo "updateLEDState('led-kelas', 'switch-kelas', '" . (strpos($action, 'on') !== false ? 'true' : 'false') . "');";
                } else if (strpos($action, 'kelompok') !== false) {
                    echo "updateLEDState('led-kelompok', 'switch-kelompok', '" . (strpos($action, 'on') !== false ? 'true' : 'false') . "');";
                }
            }
        }
        ?>
    </script>
</body>
</html> 