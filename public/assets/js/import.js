const perPage = 15;
let page = 1;
let query = null;

$(document).ready(function () {
    $('#search-button').click(function () {
        query = $('#search-input').val();
        loadDatasets();
    });

    $(document).on('click', '.dataset-import-button', function () {
        const externalId = $(this).closest('tr').data('external_id');

        fetch('/api/import-dataset', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify({
                'external_id': externalId
            })
        }).then(function (response) {
            if (response.status === 200) {
                alert('Successfully imported')
            }
        })
    });

    $('#next-button').click(() => changePage(1));
    $('#prev-button').click(() => changePage(-1));
});

async function loadDatasets() {
    const response = await fetch('/api/search', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify({
            'query': query,
            'page': page,
            'per_page': perPage
        })
    });

    const result = await response.json();
    const datasetsTbody = $('#datasets-table tbody');
    datasetsTbody.empty();
    result.dataset_collection.forEach(function (elem, index) {
        datasetsTbody.append(`<tr data-external_id="${elem.external_id}">
                                <td>${index + 1}</td>
                                <td>${elem.country_code}</td>
                                <td>${elem.description_en || 'N/A'}</td>
                                <td>${elem.description_de || 'N/A'}</td>
                                <td>${elem.description_fr || 'N/A'}</td>
                                <td>${getDistributionsString(elem.distributions)}</td>
                                <td><button class="dataset-import-button">Імпорт</button></button></td>
                              </tr>`);
    });

    $('#page-number').html(page);
}

function getDistributionsString(distributions) {
    let result = [];

    distributions.forEach(function (elem) {
        result.push(`<a href="${elem.download_url}" target="_blank">${elem.format}</a>`);
    })

    return result.join(', ');
}

function changePage(pageIncrement) {
    page += pageIncrement;
    loadDatasets();
}