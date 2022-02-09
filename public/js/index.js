import * as api from './api.js';
import * as callback from './callback.js';


let host = "http://127.0.0.1:8000/api/";

const init = () => {
    get(0);
    get(1);
}

const get = (is_odd) => {
    const data = {
        "is_odd": is_odd
    };
    const url = host + "read?" + $.param(data);
    api.api_get(url, callback.callback_get);
}

const auto_generate = () => {
    const url = host + "generate";
    api.api_get(url, callback.callback_auto_generate);
}

const delete_list = (element) => {
    const is_confirm = confirm("Apakah anda yakin ingin menghapus data ini?");

    if (is_confirm) {
        const id = $(element).data("id");
        const url = host + "delete/" + id;
        api.api_delete(url, callback.callback_delete);
        init();
    }
}

const post = () => {
    const form = $("#input_form");
    const data = form.serializeArray();
    const url = host + "create";

    const encrypted_data = {
        "phone": encryption(data[0].value),
        "id_tele_provider": encryption(data[1].value)
    }

    console.log(encrypted_data);

    api.api_post(url, encrypted_data, callback.callback_post);
}

const put = () => {
    const form = $("#input_form");
    const data = form.serializeArray();
    const id = $("#id").val();
    const url = host + "update/" + id;

    const encrypted_data = {
        "phone": encryption(data[0].value),
        "id_tele_provider": encryption(data[1].value)
    }

    api.api_put(url, encrypted_data, callback.callback_put);
    init();
}

const encryption = (string) => {
    const key = CryptoJS.enc.Utf8.parse('ds8am3wys3pd75nf0ggtvajw2k3uny92');
    const iv = CryptoJS.enc.Utf8.parse('jm8lgqa3j1d0ajus');
    
    const cipher = CryptoJS.AES.encrypt(string, key, {
        iv: iv,
        padding: CryptoJS.pad.Pkcs7,
        mode: CryptoJS.mode.CBC,
        format: CryptoJS.format.OpenSSL
    })
    
    return cipher.toString();
}

const show_toast = (response) => {
    const message = response.message;
    const toastLiveExample = document.getElementById('liveToast');
    const toast = new bootstrap.Toast(toastLiveExample);

    $(".toast-body").html(message);
    $("#ringtone").get(0).play();
    toast.show();
    $(".output-ganjil tbody").empty();
    $(".output-genap tbody").empty();
    init();
}

const edit_modal = (element) => {
    const id = $(element).data("id");
    const url = host + "read/" + id;
    api.api_get(url, callback.callback_detail);
}

window.init = init;
window.get = get;
window.deleteList = delete_list;
window.post = post;
window.showToast = show_toast;
window.autoGenerate = auto_generate;
window.editModal = edit_modal;
window.put = put;