<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List | Beautiful To-Do App</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #dba49b;
            --primary-light: #f4e0dc;
            --dark: #57403d;
            --light: #f8f5f2;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            color: var(--dark);
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        header {
            padding: 25px 0;
            border-bottom: 1px solid rgba(87, 64, 61, 0.1);
        }
        
        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 600;
            color: var(--primary);
            display: flex;
            align-items: center;
        }
        
        .logo i {
            margin-right: 10px;
        }
        
        .hero {
            padding: 80px 0;
            text-align: center;
        }
        
        h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            margin-bottom: 20px;
            color: var(--dark);
        }
        
        .hero p {
            max-width: 600px;
            margin: 0 auto 40px;
            font-size: 1.1rem;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 0 10px;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--dark);
            transform: translateY(-3px);
        }
        
        .btn-outline {
            border: 2px solid var(--primary);
            color: var(--primary);
        }
        
        .btn-outline:hover {
            background-color: var(--primary);
            color: white;
        }
        
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin: 60px 0;
        }
        
        .feature-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
        }
        
        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 20px;
        }
        
        .feature-card h3 {
            font-family: 'Playfair Display', serif;
            margin-bottom: 15px;
        }
        
        footer {
            background-color: var(--dark);
            color: var(--light);
            padding: 40px 0;
            text-align: center;
            margin-top: 80px;
        }
        
        @media (max-width: 768px) {
            h1 {
                font-size: 2.2rem;
            }
            
            .btn {
                display: block;
                margin: 10px auto;
                max-width: 200px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <img src="../php/img/logo.png" style="width:50px">
                <span class="sparkle">✦</span>
                <span>To-Do List</span>
                <span class="sparkle">✦</span>
            </div>
        </div>
    </header>
    
    <main>
        <section class="hero">
            <div class="container">
                <h1>Organize Your Life Beautifully</h1>
                <p>A simple, elegant to-do app that helps you stay productive without the stress. To-Do List makes managing your tasks a pleasure.</p>
                <div class="cta-buttons">
                    <a href="register.php" class="btn btn-primary">Get Started</a>
                    <a href="login.php" class="btn btn-outline">Log In</a>
                </div>
            </div>
        </section>
        
        <section class="container">
            <div class="features">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <h3>Simple Tasks</h3>
                    <p>Add, organize, and complete your tasks with our intuitive interface designed for clarity.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h3>Smart Reminders</h3>
                    <p>Never miss a deadline with customizable reminders that keep you on track.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-palette"></i>
                    </div>
                    <h3>Beautiful Design</h3>
                    <p>Enjoy using an app that's as beautiful as it is functional, with calming colors and typography.</p>
                </div>
            </div>
        </section>
    </main>
    
    <footer>
        <div class="container">            
            <p>&copy; To-Do List . All rights reserved.</p>
        </div>
    </footer>
</body>
</html>