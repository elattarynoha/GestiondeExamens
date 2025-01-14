<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu Sidebar</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/table.css">
  <link rel="stylesheet" href="assets/css/dash-prof.css">
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
      <li><a href="<?= site_url('Modules') ?>"><span><i class="fa-solid fa-book"></i></span> Modules</a></li>
      <li><a href="<?= site_url('load_table_etu') ?>"><span><i class="fa-solid fa-book"></i></span> Liste des étudiants</a></li>
      <li><a href="<?= site_url('logout') ?>"><span><i class=""></i></span> Logout</a></li>
    </ul>
  </div>

  <!-- Dashboard -->
  <div class="dashboard" id="dashboard-content">
    <!-- Contenu dynamique sera injecté ici -->
  </div>

  <script src="assets/js/showTable.js"></script>
</body>
</html>
