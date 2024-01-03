$(function () {
  $("#table")
    .DataTable({
      responsive: true,
      lengthChange: false,
      autoWidth: false,
      buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
    })
    .buttons()
    .container()
    .appendTo("#table_wrapper .col-md-6:eq(0)");
});
$(function () {
  $("#table2")
    .DataTable({
      responsive: true,
      lengthChange: false,
      autoWidth: false,
      buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
    })
    .buttons()
    .container()
    .appendTo("#table2_wrapper .col-md-6:eq(0)");
});
$(function () {
  $(".select2").select2({
    theme: "bootstrap4",
  });
});
