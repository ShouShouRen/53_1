$(function () {
  $("#refresh").click(function () {
    location.reload();
  });
  function check() {
    const selectedCells = [];
    $("td").click(function () {
      const index = $(this).data("id") - 1;
      if (selectedCells.length < 2 && !selectedCells.includes(index)) {
        selectedCells.push(index);
        $(this).addClass("selected");
      } else if (selectedCells.includes(index)) {
        selectedCells.splice(selectedCells.indexOf(index), 1);
        $(this).removeClass("selected");
      }
    });

    $("#validate").click(function () {
      if (selectedCells.length === 2) {
        const row1 = Math.floor(selectedCells[0] / 2);
        const col1 = selectedCells[0] % 2;
        const row2 = Math.floor(selectedCells[1] / 2);
        const col2 = selectedCells[1] % 2;
        if (
          (row1 === row2 && Math.abs(col1 - col2) === 1) ||
          (col1 === col2 && Math.abs(row1 - row2) === 1)
        ) {
          $.ajax({
            url: "check_login.php",
            method: "POST",
            data: {
              status: "success",
            },
            success: function (response) {
              alert("登入成功！");
              location.href = "index.php";
            },
            error: function () {
              alert("發生錯誤！");
            },
          });
        } else {
          $.ajax({
            url: "check_login.php",
            method: "POST",
            data: {
              status: "fail",
            },
            success: function (response) {
              alert("二次驗證錯誤！");
              location.href = "login.php";
            },
            error: function () {
              alert("發生錯誤！");
            },
          });
        }
      }
    });
  }
  check();
});
