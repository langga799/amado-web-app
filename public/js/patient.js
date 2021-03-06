$(function() {
    const table = $("table").DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: ajaxUrl,
            type: "post",
            data: {
                _token: csrf
            }
        },
        columns: [
            { data: "DT_RowIndex" },
            {
                data: "name",
                searchable: false
            },
            {
                data: "jenis_kelamin",
                searchable: false
            },
            {
                data: "phone",
                searchable: false
            },
            {
                data: "alamat",
                searchable: false
            },
            {
                data: "detail",
                orderable: false,
                searchable: false
            }
        ]
    });

    const remove = id => {
        const url = deleteUrl.replace(":id", id);

        $.ajax({
            url: url,
            type: "post",
            data: {
                _token: csrf,
                _method: "DELETE"
            },
            success: res => {
                $("#alert").html(`
					<div class="alert alert-success alert-dismissible">
					  <span>${res}</span>
					  <button class="close" data-dismiss="alert">&times;</button>
					</div>
				`);

                table.ajax.reload();
            }
        });
    };

    $("tbody").on("click", ".delete", function() {
        if (confirm("Yakin hapus data pasien ini ?")) {
            const id = table.row($(this).parents("tr")).data().id;

            remove(id);
        }
    });
});
