<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Table des Étudiants</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/table.css">
  <link rel="stylesheet" href="assets/css/form.css">
  <style>
   

/* General styles */
body {
margin: 0;
font-family: Arial, sans-serif;
display: flex;
height: 100vh;
}

/* Section Title for Menu */
.menu-section-title, .module-section-title {
font-size: 0.9rem;
color: #a3a3a3;
text-transform: uppercase;
padding: 0 20px;
margin-bottom: 10px;
}

/* Sidebar styles */
.sidebar {
width: 250px;
background-color: #1c1f36;
color: #ffffff;
display: flex;
flex-direction: column;
padding: 20px 0;
}

.sidebar-header {
text-align: center;
margin-bottom: 20px;
font-size: 1rem;
font-weight: bold;
}

.menu {
list-style: none;
padding: 0;
}

.menu li {
position: relative;
}

.menu a {
display: flex;
align-items: center;
text-decoration: none;
color: #ffffff;
padding: 10px 20px;
border-radius: 4px;
transition: background 0.3s;
}

.menu a span {
margin-right: 10px;
font-size: 1.2rem;
}

.menu a:hover,
.menu a.active {
background-color: #3b82f6;
}

.submenu {
list-style: none;
padding-left: 30px;
display: none;
}

.menu li:hover .submenu {
display: block;
}

.support-section {
margin-top: auto;
padding: 20px;
border-top: 1px solid #ffffff33;
}

.support-section p {
font-size: 0.9rem;
color: #a3a3a3;
margin-bottom: 10px;
}

.support-section a {
text-decoration: none;
color: #ffffff;
display: flex;
align-items: center;
justify-content: space-between;
}

.badge {
background-color: #3b82f6;
color: white;
border-radius: 50%;
padding: 5px 10px;
font-size: 0.8rem;
}

/* Dashboard styles */
.dashboard {
flex: 1;
padding: 20px;
background-color: #f4f4f4;
overflow-y: auto;
}

.table-container {
display: none;
background-color: white;
padding: 20px;
border-radius: 8px;
box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.table-container table {
width: 100%;
border-collapse: collapse;
margin-top: 10px;
}

.table-container table th, 
.table-container table td {
border: 1px solid #ddd;
padding: 10px;
text-align: left;
}

.table-container table th {
background-color: #3b82f6;
color: white;
}

.modify-btn {
background-color: #3b82f6;
color: white;
border: none;
padding: 5px 10px;
border-radius: 4px;
cursor: pointer;
}

.modify-btn:hover {
background-color: #2c6cd7;
}
</style>
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="sidebar-header">
      <h2>MyAcademicExams</h2>
    </div>

    <!-- Menu -->
    <p class="menu-section-title">MENU</p>
    <ul class="menu">
      <li><a href="<?= site_url('ProfDashboard') ?>" class="active"><span><i class="fa-solid fa-chart-line"></i></span> Dashboard</a></li>
      <li><a href="#"><span><i class="fa-regular fa-user"></i></span> Profile</a></li>
      <li><a href="<?= site_url('Modules') ?>" id=""><span><i class="fa-solid fa-book"></i></span> Modules</a></li>
      <li><a href="<?= site_url('logout') ?>" id=""><span><i class=""></i></span> Logout</a></li>
      <li>
        <ul class="submenu">
        <li><a href="#" id="show_table_btn">IL</a></li>
        <li><a href="#">ADIA</a></li>
        <li><a href="#">IISE</a></li>
        </ul>
      </li>
    </ul>
  </div>

   <!-- Dashboard -->
   <div class="dashboard" id="dashboard-content">
    <!-- Afficher la table des modules -->
    <?php if (!empty($modules)): ?>
      <table class="students-table">
        <thead>
          <tr>
            <th>Nom Module</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($modules as $module): ?>
            <tr>
              <td><?= esc($module['NomModule']) ?></td>
              <td><button class="modify-btn">Saisie de note</button></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <?php else: ?>
        <table class="students-table">
        <thead>
          <tr>
            <th>Nom Module</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            <tr>
              <td>No Module found</td>
              <td>-</td>
            </tr>
        </tbody>
      </table>

    <?php endif; ?>
    <div id="note-form" class="form-container" style="display: none;">
    <h3>Saisie de note</h3>
    <form>
        <div>
            <label for="student-name">Nom</label>
            <input type="text" id="student-name" name="student-name" required>
        </div>
        <div>
            <label for="student-firstname">Prénom</label>
            <input type="text" id="student-firstname" name="student-firstname" required>
        </div>
        <div>
            <label for="module-name">Module</label>
            <input type="text" id="module-name" name="module-name" readonly>
        </div>
        <div>
            <label for="final-grade">Note Finale</label>
            <input type="number" id="final-grade" name="final-grade" min="0" max="20" required>
        </div>
        <div>
            <button type="submit" class="submit-btn">Enregistrer</button>
            <button type="button" class="cancel-btn">Annuler</button>
        </div>
    </form>
</div>
  </div>
  

<script src="assets/js/showForm.js"></script>


</body>
</html>