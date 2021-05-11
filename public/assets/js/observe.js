$(document).ready(function () {
    loadDatasets();
});

async function loadDatasets() {
    const response = await fetch('/api/get-all-datasets', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        }
    });

    const result = await response.json();
    const datasetsTbody = $('#datasets-table tbody');
    datasetsTbody.empty();
    result.dataset_collection.forEach(function (elem, index) {
        datasetsTbody.append(`<tr data-external_id="${elem}">
                                <td>${index + 1}</td>
                                <td>${elem.country_code}</td>
                                <td>${elem.description_en || 'N/A'}</td>
                                <td>${elem.description_de || 'N/A'}</td>
                                <td>${elem.description_fr || 'N/A'}</td>
                                <td>${getDistributionsString(elem.distributions)}</td>
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