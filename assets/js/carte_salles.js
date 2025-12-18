document.addEventListener('click', function (event) {

    // Vérifier si le parent de l'élément cliqué a la classe "salles__carte__pin"
    // (parce que le clic sur le pin clic un sous élément)

    const pinElement = event.target.closest('.salles__carte__pin');
    if (pinElement.classList.contains('salles__carte__pin')) {

        // Récupérer le nom de la ville après les deux tirets dans la classe du parent
        let cityName = null;

        for (let className of pinElement.classList) {
            if (className.startsWith('salles__carte__pin--')) {
                cityName = className.replace('salles__carte__pin--', '');
                break;
            }
        }

        if (cityName) {
            // Supprimer la classe "active" de tous les éléments avec la classe "salles__carte__pin"
            const allPinElements = document.querySelectorAll('.salles__carte__pin');
            allPinElements.forEach(function (pinElement) {
                pinElement.classList.remove('active');
            });

            // Ajouter la classe "active" à l'élément sur lequel on a cliqué
            pinElement.classList.add('active');

            // Cacher tous les éléments avec la classe "salles__informations"
            const allInfoElements = document.querySelectorAll('.salles__informations.active');
            allInfoElements.forEach(function (infoElement) {
                infoElement.classList.remove('active');
            });

            // Ajouter la classe "active" à l'élément avec la classe correspondant au nom de la ville
            const cityInfoElement = document.querySelector('.salles__informations.' + cityName);
            if (cityInfoElement) {
                cityInfoElement.classList.add('active');
            }
        }

    }
});
