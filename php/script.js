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