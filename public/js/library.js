$(document).ready(function() {
  $('[id^="deleteBook-"]').click(function() {
    var bookId = $(this).data("book-id");
    var userId = $(this).data("user-id");

    $.ajax({
      url: "/addBookToLibrary/" + bookId + "/" + userId,
      type: "POST",
      success: function(response) {
        // Procesar la respuesta si es necesario
        console.log(response);
        // Remover la fila del libro eliminado
        var bookRow = $(".book-row-" + bookId);
        bookRow.remove();
      },
      error: function(xhr, status, error) {
        // Manejar el error si ocurre
        console.log(xhr.responseText);
      }
    });
  });
});
