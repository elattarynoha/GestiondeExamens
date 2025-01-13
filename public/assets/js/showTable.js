// Ajouter un gestionnaire d'événement pour le clic sur le lien "IL"
document.getElementById('show_table_btn').addEventListener('click', function(event) {
   event.preventDefault(); // Empêcher l'action par défaut du lien

    // Afficher le tableau en modifiant le style du container
    var tableContainer = document.getElementById('table-container');
    tableContainer.style.display = 'block'; // Affiche le tableau
});


document.getElementById('show_tableM_btn').addEventListener('click', function(event) {
    event.preventDefault(); // Empêcher l'action par défaut du lien

    // Afficher le tableau en modifiant le style du container
    var tableContainer = document.getElementById('table-containerM');
    tableContainer.style.display = 'block'; // Affiche le tableau
});


  document.addEventListener("DOMContentLoaded", function () {
    const showTableMBtn = document.getElementById("show_tableM_btn");
    const showTableBtn = document.getElementById("show_table_btn");
    const tableContainerM = document.getElementById("table-containerM");
    const tableContainer = document.getElementById("table-container");

    showTableMBtn.addEventListener("click", function (e) {
      e.preventDefault();
      tableContainerM.style.display = "block";
      tableContainer.style.display = "none";
    });

    showTableBtn.addEventListener("click", function (e) {
      e.preventDefault();
      tableContainer.style.display = "block";
      tableContainerM.style.display = "none";
    });
  });





