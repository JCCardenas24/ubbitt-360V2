function updatePaginator(paginatorId, page, totalPages, callback) {
    // Calcula la página más pequeña para el paginador
    let minLowerPage = page - 2 <= 0 ? 1 : page - 2;
    // Calcula la página más grande para el paginador
    let maxLowerPage = page + 5 - (page - minLowerPage);
    // Corrige la página más grande si esta es más grande que el total de páginas
    maxLowerPage = maxLowerPage > totalPages ? totalPages : maxLowerPage;
    // Corrige la página más grande si por alguna razón después de la operación anterior esta termina siendo 0
    maxLowerPage = maxLowerPage == 0 ? 1 : maxLowerPage;
    if (totalPages > 0 && totalPages - maxLowerPage < 1) {
        minLowerPage = page - 5 > 0 ? page - (5 - (totalPages - page)) : 1;
    }

    let previousButton = `
    <li class="page-item">
        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
    </li>`;
    previousButton = $(previousButton).on('click', () => {
        callback(page - 1);
    });
    let nextButton = `
    <li class="page-item">
        <a class="page-link " href="#">Siguiente</a>
    </li>`;
    nextButton = $(nextButton).on('click', () => {
        callback(page + 1);
    });

    let paginator = $(paginatorId);
    paginator.html(null);
    paginator.append(previousButton);
    createPageItems(paginator, minLowerPage, maxLowerPage, page, callback);
    // if (totalPages > 0) {
    //     let minUpperPage = totalPages - page < 4 ? page + 1 : totalPages - page;
    //     minUpperPage = minUpperPage > totalPages ? page : minUpperPage;
    //     paginator.append(createPageItem('...', '...', () => {}));
    //     if (page + 1 != minUpperPage) {
    //         createPageItems(
    //             paginator,
    //             minUpperPage,
    //             totalPages,
    //             page,
    //             callback
    //         );
    //     }
    // }
    paginator.append(nextButton);
}

function createPageItem(pageNumber, currentPage, callback) {
    let pageItem =
        `
    <li class="page-item ` +
        getPageButtonDisableClass(pageNumber, currentPage) +
        `">
        <a class="page-link" href="#">` +
        pageNumber +
        `</a>
    </li>
    `;
    pageItem = $(pageItem);
    if (callback != undefined) {
        pageItem.on('click', () => {
            callback(pageNumber);
        });
    }
    return pageItem;
}

function getPageButtonDisableClass(currentPage, referencePage) {
    return currentPage == referencePage ? 'active' : '';
}

function createPageItems(paginator, minPage, maxPage, currentPage, callback) {
    for (index = minPage; index <= maxPage; index++) {
        paginator.append(createPageItem(index, currentPage, callback));
    }
}
