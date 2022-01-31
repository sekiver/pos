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

// Alert Toast
function showMessage(type, mess) {
    switch (type) {
        case "success":
            toastr.success(mess);
            break;
        case "info":
            toastr.info(mess);
            break;
        case "error":
            toastr.error(mess);
            break;
        case "warning":
            toastr.warning(mess);
            break;
    }
}

// Fullscreen
var elem = document.getElementById("transaksi");

/* View in fullscreen */
function openFullscreen() {
    if (elem.requestFullscreen) {
        elem.requestFullscreen();
    } else if (elem.webkitRequestFullscreen) { /* Safari */
        elem.webkitRequestFullscreen();
    } else if (elem.msRequestFullscreen) { /* IE11 */
        elem.msRequestFullscreen();
    }
}

/* Close fullscreen */
function closeFullscreen() {
    if (document.exitFullscreen) {
        document.exitFullscreen();
    } else if (document.webkitExitFullscreen) { /* Safari */
        document.webkitExitFullscreen();
    } else if (document.msExitFullscreen) { /* IE11 */
        document.msExitFullscreen();
    }
}

// Pilih Member
function pilih_member(id_member, nama) {
    $("#nm_member").html(nama);
    $("#id_member").val(id_member);
    $("#diskon").html('<span>Rp</span> ' + number_format(15000));
    $("#txtDiskon").val(15000);

    // Hitung Ulang Grand TOtal
    grandtotal();

    // Menyembunyikan Modal Member
    $("#modal-member").modal("hide");
}

// Pilih Meja
function pilih_meja(id_member, nama) {
    $("#meja").html(nama);
    $("#id_meja").val(id_member);

    // Menyembunyikan Modal Member
    $("#modal-meja").modal("hide");
}

// Pilih Menu / Add Menu
function add_menu(id_menu, nm_menu, harga) {
    // Clone menu item
    var item = $("#tmp-menu").clone();

    // Set Informasi Menu
    item.attr("id", id_menu); // Mengganti nilai attribute id dari tmp-menu menjadi id_menu ( 1 )
    item.find(".delete").attr("data-id", id_menu);
    item.removeAttr("style"); // Menghilangkan attribute style , display: none
    item.find(".item").find("h4").html(nm_menu);
    item.find(".price").find("h4").html('<span>Rp</span> ' + number_format(harga));
    item.find(".jumlah").attr("data-harga", harga); // Set Harga pada attribute data-harga

    // Set Value Input
    item.find(".txtID").val(id_menu);
    item.find(".txtNama").val(nm_menu);
    item.find(".txtHarga").val(harga);

    // Tambahkan ke detail
    if ($("#" + id_menu).length == 0) {
        // Jika Belum ada
        item.appendTo(".detail");
    } else {
        // Jika sudah ada , jumlah bertambah
        var jumlah = parseInt($("#" + id_menu).find(".jumlah").val()) + 1;
        var subtotal = harga * jumlah;
        $("#" + id_menu).find(".jumlah").val(jumlah);
        // Ganti Harga
        $("#" + id_menu).find(".price").find("h4").html('<span>Rp</span> ' + number_format(subtotal));
    }

    // Hitung Ulang Grand TOtal
    grandtotal();

    // Set Trigger Tombol Hapus
    // $(".delete").click(function () {
    //     var id = "#" + $(this).attr("data-id"); // example : #1
    //     $(id).remove();
    // });
}

// Remove Menu from Detail
function del_menu(e) {
    var id = "#" + $(e).attr("data-id"); // example : #1
    $(id).remove();

    // Hitung Ulang Grand TOtal
    grandtotal();
}

//  Change Price Item
function ganti_harga(e) {
    var jumlah = parseInt($(e).val());
    var harga = parseInt($(e).attr("data-harga"));
    var subtotal = harga * jumlah;
    $(e).parent().parent().parent().find(".price").find("h4").html('<span>Rp</span> ' + number_format(subtotal));

    // Hitung Ulang Grand TOtal
    grandtotal();
}

// Hitung Grand Total
function grandtotal() {
    var total = 0;
    var ppn = 0;
    $(".detail > .detail-item").each(function (e) {
        var harga = parseInt($(this).find(".jumlah").attr("data-harga"));
        var jumlah = parseInt($(this).find(".jumlah").val());
        total += harga * jumlah;
    });

    // Hitung Total setelah dapat Diskon
    total = total - parseInt($("#txtDiskon").val());

    // PPN 10%
    ppn = (10 / 100) * total;
    $("#ppn").html('<span>Rp</span>' + number_format(ppn));
    $("#txtPPN").val(ppn);

    // Total Setelah PPN
    total = total + ppn;

    // Set Grand TOtal
    $("#amount").html(number_format(total));
}

// Format Number pakai .
function number_format(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

// Save Bill / Transaksi
function save_transaksi() {
    // Validasi
    if ($("#id_meja").val() == "") { showMessage("error", "Maaf Meja Belum dipilih !!!"); return; }
    if ($(".detail .detail-item").length == 0) { showMessage("error", "Maaf Menu Belum dipilih !!!"); return; }

    // Save
    $.ajax({
        url: $("#frmTransaksi").attr('action'),
        dataType: 'json',
        data: $("#frmTransaksi").serialize(),
        method: "POST",
        beforeSend: function () {
            $("#loading").fadeIn();
        },
        success: function (data) {
            console.log(data);
            $("#loading").hide();
        },
        error: function (data) {
            console.log(data);
            $("#loading").hide();
        }
    });
}