$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function upvote(e) {
    var linkId = (e.target.parentNode.parentNode.dataset['linkid']);

    /*
    var request = new XMLHttpRequest();
    // var data = { postId: postId };
    console.log(url);
    request.open('POST', url, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.send(data);
    */
    $.ajax({
        method: 'POST',
        url: url,
        data: { linkId: linkId  },
        success: function(r) {
            console.log('Success');
        },
        error: function(x,e) {
            if (x.status == 0) {
                console.log('You are offline');
            } else if (x.status == 404) {
                console.log('Requested URL not found.\n+url');
            } else if (x.status == 500) {
                console.log('Internal server error');
            } else if (e == 'parseerror') {
                console.log('Error.\nParsing JSON Request failed.');
            } else if (e == 'timeout') {
                console.log('Requested Time out.');
            } else {
                console.log('Unknown Error.\n'+x.responseText);
            }
        }
    });

    /*
    $.post(url, { postId: postId }, function(data) {
        console.log(data);
    });
    */

}

$(document).ready(function() {

    // --- UPVOTE EVENT LISTENER --- //
    /*
var el = document.querySelector('.links__upvote--btn');
el.addEventListener('click', upvote, false);
    */
    $('.links__upvote--btn').on('click', upvote); 


});
