<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Table des Étudiants</title>
  <link rel="stylesheet" href="assets/css/table.css">
</head>
<body>
  <table class="students-table">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Module</th>
        <th>Note Finale</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Doe</td>
        <td>John</td>
        <td>john.doe@example.com</td>
        <td>Design Thinking</td>
        <td>16</td>
        <td><button class="edit-btn" data-id="1">Modifier</button></td>
      </tr>
      <tr>
        <td>Smith</td>
        <td>Jane</td>
        <td>jane.smith@example.com</td>
        <td>Design Thinking</td>
        <td>16</td>
        <td><button onclick="editStudent(this)">Modifier</button></td>
      </tr>
    </tbody>
  </table>

</body>
</html>
