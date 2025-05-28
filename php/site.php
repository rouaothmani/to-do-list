<?php
require_once 'db.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $sql = "SELECT * FROM users WHERE username ='$username'";
    
    $result = $conn->query($sql);

    if ($result === false) {
        die("Error in SQL query: " . $conn->error);
    }

    if ($result->num_rows >0) {
      $_SESSION['username'] = $user['username'];
    }
}

$username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : '<3';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>To-Do List</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;700&family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    :root {
      --primary-color: #5e72e4;
      --secondary-color: #f7fafc;
      --accent-color: #f687b3;
      --dark-color: #2d3748;
      --light-color: #f8f9fa;
      --text-color: #4a5568;
      --border-radius: 12px;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f5f2;
      color: var(--text-color);
      min-height: 100vh;
      position: relative;
      overflow-x: hidden;
    }

    #dotNetwork {
      position: fixed;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      z-index: -1;
      pointer-events: none;
    }

    .dot {
      position: absolute;
      width: 6px;
      height: 6px;
      background: white;
      border-radius: 50%;
      animation: move 20s infinite alternate;
      opacity: 0.4;
    }

    .line {
      position: absolute;
      height: 2px;
      background: rgba(255, 255, 255, 0.2);
      animation: move 10s infinite alternate;
    }

    @keyframes move {
      0% {
        transform: translateY(0px);
      }

      100% {
        transform: translateY(100px);
      }
    }

    .navbar-chic {
      background: linear-gradient(135deg, #e6c9c1 0%, #dba49b 100%);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      padding: 1rem 2rem;
    }

    .navbar-brand {
      font-family: 'Playfair Display', serif;
      font-weight: 700;
      color: #57403d;
      font-size: 1.5rem;
      display: flex;
      align-items: center;
    }

    .navbar-brand img {
      margin-right: 12px;
      transition: transform 0.3s ease;
    }

    .navbar-brand:hover img {
      transform: rotate(-15deg);
    }

    .sparkle {
      font-size: 1.2rem;
      margin: 0 8px;
      color: #57403d;
      opacity: 0.8;
    }

    .welcome-card {
      background: white;
      border-radius: var(--border-radius);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
      border: none;
      margin-top: 120px;
      padding: 2.5rem;
      max-width: 600px;
      position: relative;
      overflow: hidden;
    }

    .welcome-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 8px;
      background: linear-gradient(90deg, #e6c9c1 0%, #dba49b 100%);
    }

    .welcome-title {
      font-family: 'Playfair Display', serif;
      color: #57403d;
      font-weight: 700;
      margin-bottom: 0.5rem;
    }

    .username-display {
      font-family: 'Montserrat', sans-serif;
      color: #b6938d;
      font-weight: 500;
      font-size: 1.25rem;
      margin-bottom: 2rem;
    }

    .task-form {
      margin-bottom: 2rem;
    }

    .form-control {
      border-radius: 50px;
      padding: 0.75rem 1.5rem;
      border: 1px solid #e2e8f0;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #dba49b;
      box-shadow: 0 0 0 0.25rem rgba(219, 164, 155, 0.25);
    }

    .btn-primary {
      background-color: #dba49b;
      border-color: #dba49b;
      border-radius: 50px;
      padding: 0.75rem 1.75rem;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #c2938b;
      border-color: #c2938b;
      transform: translateY(-2px);
    }

    .task-list {
      list-style: none;
      padding: 0;
    }

    .task-item {
      background: white;
      border-radius: 8px;
      padding: 1rem 1.5rem;
      margin-bottom: 0.75rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
      transition: all 0.3s ease;
      border-left: 4px solid #dba49b;
    }

    .task-item:hover {
      transform: translateX(5px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .task-actions {
      display: flex;
      gap: 0.5rem;
    }

    .task-action-btn {
      background-color: var(--light-color);
      border: 1px solid #e2e8f0;
      border-radius: var(--border-radius);
      padding: 0.5rem;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
      width: 45px;
      height: 45px;
    }

    .task-action-btn:hover {
      background-color: #f4eadf;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .task-action-btn i {
      color: var(--dark-color);
      font-size: 1.2rem;
    }

    .logout-btn {
      background-color: #f4eadf;
      color: #57403d;
      border-radius: 50px;
      padding: 0.5rem 1.5rem;
      font-weight: 500;
      transition: all 0.3s ease;
      border: none;
    }

    .logout-btn:hover {
      background-color: #57403d;
      color: white;
      transform: translateY(-2px);
    }

    .decoration {
      position: absolute;
      width: 300px;
      height: 300px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(219,164,155,0.1) 0%, rgba(219,164,155,0) 70%);
      z-index: -1;
    }

    .decoration-1 {
      top: -100px;
      right: -100px;
    }

    .decoration-2 {
      bottom: -150px;
      left: -150px;
      width: 400px;
      height: 400px;
    }

    @media (max-width: 768px) {
      .welcome-card {
        margin-top: 100px;
        padding: 1.5rem;
      }
    }
  </style>
</head>

<body>
  <div id="dotNetwork"></div>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-chic fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <img src="../php/img/logo.png" alt="Logo" width="40">
        <span class="sparkle">✦</span>
        <span>To-Do List</span>
        <span class="sparkle">✦</span>
      </a>
      <div class="d-flex align-items-center">
        <a href="logout.php" class="logout-btn">
          <i class="fas fa-sign-out-alt me-2"></i>Logout
        </a>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="container d-flex justify-content-center">
    <div class="welcome-card">
      <h1 class="welcome-title">WELCOME,</h1>
      <h4 class="username-display"><?php echo $username; ?></h4>

      <form id="task-form" class="task-form">
        <div class="input-group mb-3">
          <input type="text" id="task-input" class="form-control" placeholder="Add a new task..." required>
          <button class="btn btn-primary" type="submit">Add Task</button>
        </div>
      </form>

      <ul id="task-list" class="list-group"></ul>

    </div>


  </div>
  <br>

  <!-- Decorative elements -->
  <div class="decoration decoration-1"></div>
  <div class="decoration decoration-2"></div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Dot and line background
    document.addEventListener('DOMContentLoaded', function () {
      const container = document.getElementById('dotNetwork');
      const dotCount = 100;
      const lineCount = 50;

      for (let i = 0; i < dotCount; i++) {
        const dot = document.createElement('div');
        dot.className = 'dot';
        dot.style.left = `${Math.random() * 100}vw`;
        dot.style.top = `${Math.random() * 100}vh`;
        dot.style.animationDelay = `${Math.random() * 15}s`;
        container.appendChild(dot);
      }

      for (let i = 0; i < lineCount; i++) {
        const line = document.createElement('div');
        line.className = 'line';
        line.style.left = `${Math.random() * 100}vw`;
        line.style.top = `${Math.random() * 100}vh`;
        line.style.width = `${Math.random() * 100 + 50}px`;
        line.style.transform = `rotate(${Math.random() * 360}deg)`;
        line.style.animationDelay = `${Math.random() * 5}s`;
        container.appendChild(line);
      }
    });

    // To-Do List Logic
    const form = document.getElementById('task-form');
    const taskInput = document.getElementById('task-input');
    const taskList = document.getElementById('task-list');

    window.onload = () => {
      const savedTasks = JSON.parse(localStorage.getItem('tasks')) || [];
      savedTasks.forEach(task => addTask(task));
    };

    function addTask(taskText) {
      const li = document.createElement('li');
      li.className = "task-item";

      const textSpan = document.createElement('span');
      textSpan.textContent = taskText;

      const editBtn = document.createElement('button');
      editBtn.className = "task-action-btn";
      editBtn.innerHTML = '<i class="fas fa-edit"></i>';
      editBtn.onclick = () => {
        const newText = prompt("Edit your task:", textSpan.textContent);
        if (newText) {
          textSpan.textContent = newText;
          saveTasks();
        }
      };

      const finishBtn = document.createElement('button');
      finishBtn.className = "task-action-btn";
      finishBtn.innerHTML = '<i class="fas fa-check"></i>';
      finishBtn.onclick = () => {
        textSpan.style.textDecoration = 'line-through';
        textSpan.style.opacity = '0.6';
        saveTasks();
      };

      const removeBtn = document.createElement('button');
      removeBtn.className = "task-action-btn";
      removeBtn.innerHTML = '<i class="fas fa-trash-alt"></i>';
      removeBtn.onclick = () => {
        li.remove();
        saveTasks();
      };

      const actionDiv = document.createElement('div');
      actionDiv.className = "task-actions";
      actionDiv.append(editBtn, finishBtn, removeBtn);

      li.appendChild(textSpan);
      li.appendChild(actionDiv);
      taskList.appendChild(li);
      saveTasks();
    }

    function saveTasks() {
      const tasks = [];
      taskList.querySelectorAll('li').forEach(li => {
        tasks.push(li.querySelector('span').textContent);
      });
      localStorage.setItem('tasks', JSON.stringify(tasks));
    }

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      const taskText = taskInput.value.trim();
      if (taskText === '') return;
      addTask(taskText);
      taskInput.value = '';
    });

  </script>
</body>

</html>