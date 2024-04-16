$(function () {
  const flashdata = $(".flash-data").data("flashdata");
  console.log(flashdata);
  if (flashdata) {
    Swal.fire({
      title: flashdata.title,
      text: flashdata.pesan,
      icon: flashdata.icon,
    });
  }

  $(".tombol-hapus").on("click", function (e) {
    e.preventDefault();
    const href = $(this).attr("href");
    const pesan = $(this).data("pesan");

    Swal.fire({
      title: "Apakah Anda Yakin ?",
      text: pesan,
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Delete",
    }).then((result) => {
      if (result.isConfirmed) {
        document.location.href = href;
      }
    });
  });
});
