$(document).ready(function () {
    sort();
});

function sort() {
    $("#machine-table").tablesorter();
}

$(function () {
    console.log("読み込み完了！");

    $("#search-btn").on("click", function (e) {
        console.log("検索押下");
        e.preventDefault();

        let searchFormData = $("#search-form").serialize();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "machines",
            type: "GET",
            data: searchFormData,
            dataType: "html",
        })
            .done(function (data) {
                console.log("成功！");
                let newTable = $(data).find("#machine-table");
                $("#machine-table").replaceWith(newTable);
                sort();
            })
            .fail(function () {
                alert("失敗...");
            });
    });
});

// 削除

$(".delete-btn").on("click", function (e) {
    e.preventDefault();
    let deleteConfirm = confirm("削除しますか？");

    if (deleteConfirm == true) {
        let deleteId = $(this).data("delete-id");
        console.log(deleteId);
        let click = $(this);

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "machines/" + deleteId,
            type: "POST",
            data: {
                _method: "DELETE",
            },
        })
            .done(function () {
                console.log("削除！");
                click.parents("tr").remove();

                $("#machine-table").trigger("update");
            })
            .fail(function () {
                console.log("削除失敗...");
            });
    } else {
        e.preventDefault();
    }
});
