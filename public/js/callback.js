export const callback_get = (response) => {
    const data = response.data;

    if (response.status == "success") {
        if (data.is_odd == 1) {
            const table = $(".output-ganjil tbody");

            if(data.list_telephone.length > 0) {
                data.list_telephone.forEach((telephone, index) => {
                    index++;
                    const row = `<tr>
                        <td>${index}</td>
                        <td>${telephone.phone}</td>
                        <td>${telephone.provider.name}</td>
                        <td>
                            <button onclick="editModal(this)" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary btn-sm btn-edit" data-id="${telephone.id}">Edit</button>
                            <button onclick="deleteList(this)" class="btn btn-danger btn-sm btn-delete" data-id="${telephone.id}">Delete</button>
                        </td>
                    </tr>`;
                    table.append(row);
                });
            } else {
                table.append(`<tr class="text-center"><td colspan="4">Data tidak ditemukan</td></tr>`);
            }
        } else {
            const table = $(".output-genap tbody");

            if(data.list_telephone.length > 0) {
                data.list_telephone.forEach((telephone, index) => {
                    index++;
                    const row = `<tr>
                        <td>${index}</td>
                        <td>${telephone.phone}</td>
                        <td>${telephone.provider.name}</td>
                        <td>
                            <button onclick="editModal(this)" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary btn-sm btn-edit" data-id="${telephone.id}">Edit</button>
                            <button onclick="deleteList(this)" class="btn btn-danger btn-sm btn-delete" data-id="${telephone.id}">Delete</button>
                        </td>
                    </tr>`;
                    table.append(row);
                });
            } else {
                table.append(`<tr class="text-center"><td colspan="4">Data tidak ditemukan</td></tr>`);
            }
        }
    }
}

export const callback_detail = (response) => {
    if (response.status == "success") {
        const data = response.data;
        $("#id").val(data.id);
        $("#phone").val(data.phone);
        $("#provider").val(data.provider.id);
    }
}

export const callback_post = (response) => {
    if (response.status == "success") {
        $("#input_form").trigger("reset");
        alert("Data berhasil ditambahkan");
    } else {
        alert("Data gagal ditambahkan");
    }
}

export const callback_put = (response) => {
    if (response.status == "success") {
        $(".output-ganjil tbody").empty();
        $(".output-genap tbody").empty();
        $("#exampleModal").modal("hide");
        alert("Data berhasil diubah");
    } else {
        $(".output-ganjil tbody").empty();
        $(".output-genap tbody").empty();
        $("#exampleModal").modal("hide");
        alert("Gagal merubah data");
    }
}

export const callback_delete = (response) => {
    if (response.status == "success") {
        $(".output-ganjil tbody").empty();
        $(".output-genap tbody").empty();
        alert("Data telah dihapus");
    } else {
        alert(response.message);
    }
}

export const callback_auto_generate = (response) => {
    if (response.status == "success") {
        const data = response.data;
        $("#phone").val(data.phone);
        $("#provider").val(data.id_tele_provider);
    } else {
        alert("Gagal generate nomor handphone");
    }
}