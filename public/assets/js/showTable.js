document.addEventListener("DOMContentLoaded", function () {
  const showTableBtn = document.getElementById("show_table_btn");

  if (showTableBtn) {
    showTableBtn.addEventListener("click", function (e) {
      e.preventDefault(); // Empêche le comportement par défaut du lien

      // Envoyer une requête pour charger TableEtu.php
      fetch('/GestionDeExamens/public/ModuleController/load_table_etu') // Mettez l'URL correcte ici
        .then(response => {
          if (!response.ok) {
            throw new Error('Erreur réseau : ' + response.statusText);
          }
          return response.text(); // Récupère le contenu HTML
        })
        .then(html => {
          const dashboardContent = document.getElementById("dashboard-content");
          if (dashboardContent) {
            dashboardContent.innerHTML = html; // Injecte le contenu HTML
          } else {
            console.error("Élément #dashboard-content introuvable.");
          }
        })
        .catch(error => {
          console.error("Erreur lors du chargement de la table :", error);
        });
    });
  }
});
