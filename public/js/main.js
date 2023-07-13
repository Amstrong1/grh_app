// LIVEWIRE & SELECT2
$(document).ready(function () {
    $(".simple-select").select2();
    $(".multiple-select").select2();
    $(".parent-select").select2();
    $(".parent-select").on("change", function (e) {
        let $elt = $(".parent-select").select2("val");
        Livewire.emit("updateChildList", $elt);
    });
    document.addEventListener("modelsUpdated", (evt) => {
        $(".child-select").select2();
    });
});

// DELETE CONFIRMATION  MODAL CUSTOMIZING...

let deleteConfirmation = function (e) {
    if (typeof swal !== "undefined") {
        swal({
            title: "Suppression",
            text: "Cet element sera supprimé",
            dangerMode: true,
            icon: "warning",
            buttons: {
                cancel: true,
                confirm: "Oui, Supprimer",
            },
            cancel: true,
        }).then((value) => {
            if (value) {
                e.submit();
            } else {
                swal("Suppression annulée", {
                    timer: 2000,
                });
            }
        });
    } else {
        value = confirm("Voulez vous supprimer cet element ?");
        if (value) {
            e.submit();
        }
    }
    // e.submit();
};

var datasTable2 = $("#datas-table-buttons");
if (datasTable2.find("tbody tr").length > 0) {
    // Initialize DataTables or perform any operations
    const dataTableInstance2 = datasTable2
        .DataTable({
            // responsive: true,
            // dom: 'rlftbp',
            pageLength: 25,
            buttons: [{ extend: "", text: "" }],
            dom: '',
            language: {
                decimal: "",
                emptyTable: "Aucun élément disponible",
                info: "Affichage de _START_ à _END_ parmi _TOTAL_ élements",
                infoEmpty: "Aucun élément",
                infoFiltered: "(filtrés parmi _MAX_ éléments)",
                infoPostFix: "",
                thousands: ",",
                lengthMenu: "Affichage de _MENU_ éléments",
                loadingRecords: "Chargement",
                processing: "",
                search: "Rechercher:",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Suivant",
                    previous: "Précédent ",
                },
            },
        })
        .columns.adjust()
        .responsive.recalc();

    $("#custom-search-input").keyup(function () {
        dataTableInstance2.search($(this).val()).draw();
    });
} else {
    // Handle the case when the table is empty
    console.log("The table is empty.");
}

