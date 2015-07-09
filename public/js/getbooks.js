$(document).ready(function () {  // only begin once page has loaded
    $("#txtBookSearch").autocomplete({ // attach auto-complete functionality to textbox
        // define source of the data
        source: function (request, response) {
            // url link to google books, including text entered by user (request.term)
            var booksUrl = "https://www.googleapis.com/books/v1/volumes?printType=books&q=" + encodeURIComponent(request.term);
            $.ajax({
                url: booksUrl,
                dataType: "jsonp",
                success: function(data) {
                    response($.map(data.items, function (item) {
                        if (item.volumeInfo.authors && item.volumeInfo.title && item.volumeInfo.industryIdentifiers && item.volumeInfo.publishedDate)
                        {
                            return {
                                // label value will be shown in the suggestions
                                label: item.volumeInfo.title + ', ' + item.volumeInfo.authors[0] + ', ' + item.volumeInfo.publishedDate,
                                // value is what gets put in the textbox once an item selected
                                value: item.volumeInfo.title,
                                // other individual values to use later
                                title: item.volumeInfo.title,
                                author: item.volumeInfo.authors[0],
                                isbn: item.volumeInfo.industryIdentifiers,
                                publishedDate: item.volumeInfo.publishedDate,
                                publisher: item.volumeInfo.publisher,
                                image: (item.volumeInfo.imageLinks == null ? "" : item.volumeInfo.imageLinks.thumbnail),
                                description: item.volumeInfo.description,
                                //contentVersion: item.volumeInfo.contentVersion,
                            };
                        }
                    }));
                }
            });
        },
        select: function (event, ui) {
            // what to do when an item is selected
            // first clear anything that may already be in the description
        /*    $('#divDescription').empty();
            // we get the currently selected item using ui.item
            // show a pic if we have one
            if (ui.item.image != '')
            {
                $('#divDescription').append('<img src="' + ui.item.image + '" style="float: left; padding: 10px;">');
            }
            // and title, author, and year
            $('#divDescription').append('<p><b>Title:</b> ' + ui.item.title  + '</p>');
            $('#divDescription').append('<p><b>Author:</b> ' + ui.item.author  + '</p>');
            $('#divDescription').append('<p><b>First published year:</b> ' + ui.item.publishedDate  + '</p>');
            $('#divDescription').append('<p><b>Publisher:</b> ' + ui.item.publisher  + '</p>');          
            // and the usual description of the book
            $('#divDescription').append('<p><b>Description:</b> ' + ui.item.description  + '</p>');
            // and show the link to oclc (if we have an isbn number)
            if (ui.item.isbn && ui.item.isbn[0].identifier)
            {
                $('#divDescription').append('<P><b>ISBN:</b> ' + ui.item.isbn[0].identifier + '</p>');
                $('#isbn').val(ui.item.isbn[0].identifier);
               // $('#divDescription').append('<a href="http://www.worldcat.org/isbn/' + ui.item.isbn[0].identifier + '" target="_blank">View item on worldcat</a>');
            }
*/
            $('#title').val(ui.item.title);
            $('#author_name').val(ui.item.author);
            $('#publisher').val(ui.item.publisher);
            $('#book_description').html(ui.item.description);
            $('#print_year').val(ui.item.publishedDate);
           // $('#book_edition').val(ui.item.contentVersion);
            if (ui.item.isbn && ui.item.isbn[0].identifier)
            {
                $('#isbn').val(ui.item.isbn[0].identifier);
            }
            $('#bookCover').empty();
            if (ui.item.image != '')
            {
                $('#bookCover').append('<img src="' + ui.item.image + '" style="float: left; padding: 10px;">');
            }


        },
        minLength: 2 // set minimum length of text the user must enter
    });
});