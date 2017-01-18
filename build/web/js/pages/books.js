/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function updateCategory(tbl_update) {
    $('#cat-tbl').find("tr").css("background-color", "white");

    var item_tr = $(tbl_update).closest('tr');
    $(item_tr).css("background-color", "#ecebeb");

    var item_cat = item_tr.find("td").eq(0).html();
    var item_code = item_tr.find("td").eq(1).html();

    $('#c_name').val(item_cat);
    $('#c_code').val(item_code);

    $('#set-title').html("Update Category");

    $('#show-update-btn').css("display", "block");
    $('#show-create-btn').css("display", "none");

}


function deleteTblRow(span) {
    if (confirm("Do you want to remove this row?")) {
        $(span).closest('tr').remove();
    }
}


function updateBook(tbl_update) {
    $('#book-tbl').find("tr").css("background-color", "white");

    var item_tr = $(tbl_update).closest('tr');
    $(item_tr).css("background-color", "#ecebeb");

    var book_code = item_tr.find("td").eq(0).html();
    var book_name = item_tr.find("td").eq(1).html();
    var book_author = item_tr.find("td").eq(2).html();
    var book_qty = item_tr.find("td").eq(3).html();
    var book_language = item_tr.find("td").eq(4).html();
    var book_type = item_tr.find("td").eq(5).html();
    var book_cat = item_tr.find("td").eq(6).html();


    $('#b_code').val(book_code);
    $('#b_name').val(book_name);
//    $('#b_author').val(book_author);
    $('#b_qty').val(book_qty);
//    $('#b_language').val(book_language);
//    $('#book_type').val(book_type);
//    $('#b_cat').val(book_cat);

    $('#set-title').html("Update Book Details");

    $('#show-update-btn').css("display", "block");
    $('#show-create-btn').css("display", "none");

}


function updateAuthor(tbl_update) {
    $('#author-tbl').find("tr").css("background-color", "white");

    var item_tr = $(tbl_update).closest('tr');
    $(item_tr).css("background-color", "#ecebeb");

    var author_name = item_tr.find("td").eq(0).html();
    var author_cat = item_tr.find("td").eq(1).html();
    var author_des = item_tr.find("td").eq(2).html();
  

    $('#author_name').val(author_name);
//    $('#author_cat').val(author_cat);
  $('#author_des').val(author_des);


    $('#set-title').html("Update Author Details");

    $('#show-update-btn').css("display", "block");
    $('#show-create-btn').css("display", "none");

}
