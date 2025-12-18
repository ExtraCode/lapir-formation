document.addEventListener("turbo:load", function () {
    const tables = document.querySelectorAll('[data-table]');

    tables.forEach(table => {
        if (!$.fn.DataTable.isDataTable(table)) {

            // Lecture de data-default-length uniquement
            const attr = table.getAttribute('data-default-length');
            let defaultLength = parseInt(attr, 10);

            if (Number.isNaN(defaultLength)) defaultLength = 10;

            const lengthMenu = [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ];

            // Si la valeur n'est pas déjà dans les options du menu, on l'ajoute
            if (!lengthMenu[0].includes(defaultLength)) {
                lengthMenu[0].unshift(defaultLength);
                lengthMenu[1].unshift(defaultLength);
            }

            const options = {
                language: {url: window.datatableLangUrl},
                info: true,
                responsive: true,
                lengthMenu,
                pageLength: defaultLength,
                ordering: !table.hasAttribute('data-table-no-sort')
            };

            $(table).DataTable(options);
        }
    });
});

// Détruit DataTables avant cache Turbo
document.addEventListener("turbo:before-cache", function () {
    const tables = document.querySelectorAll('[data-table]');
    tables.forEach(table => {
        if ($.fn.DataTable.isDataTable(table)) {
            $(table).DataTable().destroy();
        }
    });
});
