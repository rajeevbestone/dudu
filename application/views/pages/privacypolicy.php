<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Privacy Policy</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            color: #333;
        }
        
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        
        
        
        /* Footer */
        footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ccc;
        }
        
        footer p {
            font-size: 0.9rem;
            color: #777;
        }
    </style>
    
    
    <div class="container">
        <header>
            <h1>Privacy Policy</h1>
        </header>

        <section class="terms-section">
            <?php echo $mainData[0]["page_data"];?>
        </section>

        <footer>
            <p>© 2024 Dial Up Delta. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
