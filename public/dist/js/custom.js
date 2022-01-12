// Custom JS

$(function () {
    // Datatable INit
    $('.data').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });

    // Foto click
    $("#avatar").click(function () {
        $("#file").click();
    });

    // Ketika file input change
    $("#file").change(function () {
        setImage(this, "#avatar");
    });

});

// Read Image
function setImage(input, target) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        // Mengganti src dari object img#avatar
        reader.onload = function (e) {
            $(target).attr('src', e.target.result);
            $("#foto").val(e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
