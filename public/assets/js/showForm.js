document.addEventListener('DOMContentLoaded', function () {
    const modifyButtons = document.querySelectorAll('.modify-btn');
    const formContainer = document.getElementById('note-form');
    const cancelBtn = document.querySelector('.cancel-btn');
    const moduleNameInput = document.getElementById('module-name');

    modifyButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Récupérer le nom du module
            const moduleName = this.getAttribute('data-module');
            
            // Afficher le formulaire
            formContainer.style.display = 'block';
            
            // Remplir le champ "Module" avec le nom du module
            moduleNameInput.value = moduleName;
        });
    });

    // Masquer le formulaire si "Annuler" est cliqué
    cancelBtn.addEventListener('click', function () {
        formContainer.style.display = 'none';
    });

});

