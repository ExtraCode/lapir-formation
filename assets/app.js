import './stimulus_bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */

import 'bootstrap/dist/css/bootstrap.min.css';
import * as bootstrap from 'bootstrap';

import './librairies/font-awesome-7-0-1/css/all.min.css'

import './librairies/theme_de_base/plugins_theme_de_base.min.css'
import './librairies/theme_de_base/style_theme_de_base.css'
import './styles/app.scss';

/*
* Montre elementsToShow et cache elementsToHide au lancement de la fonction
 */
function showAndHideElements(elementsToShow = null, elementsToHide = null) {

    if (elementsToShow != null) {
        document.querySelectorAll('.' + elementsToShow).forEach((elementToShow) => {

            elementToShow.classList.remove('d-none');

        });
    }

    if (elementsToHide != null) {
        document.querySelectorAll('.' + elementsToHide).forEach((elementToHide) => {

            elementToHide.classList.add('d-none');

        });
    }

}
