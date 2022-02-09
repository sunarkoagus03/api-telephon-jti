const api_request = (url, method, data, callback) => {
    $.ajax({
        url: url,
        method: method,
        data: data,
        dataType: 'json',
        success: callback
    });
}

export const api_get = (url, callback) => {
    api_request(url, 'GET', null, callback);
}

export const api_post = (url, data, callback) => {
    api_request(url, 'POST', data, callback);
}

export const api_put = (url, data, callback) => {
    api_request(url, 'PUT', data, callback);
}

export const api_delete = (url, callback) => {
    api_request(url, 'DELETE', null, callback);
}