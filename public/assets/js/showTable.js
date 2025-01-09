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



