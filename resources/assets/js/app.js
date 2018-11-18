var replyBtn = document.querySelectorAll('.btn--reply');

function toggleReplyForm(e) {
  var elem = e.currentTarget.parentNode.parentNode.parentNode.children[4];
  elem.classList.toggle('active');
  if (elem.classList[1] == 'active') {
    elem.style.display = 'none';
  } else {
    elem.style.display = 'block';
  }
}

for (var i=0; i<replyBtn.length; i++) {
  replyBtn[i].addEventListener('click', toggleReplyForm);
}

$('.login--btn').on('click', function() {
  $('.login-modal-overlay').fadeIn(200);
});

/*
$('.login-modal-overlay').click(function() {
  $('.login-modal-overlay').fadeOut(200);
});
*/


$('.login-form').on('submit', function(e) {
  e.preventDefault();

  $.ajax({
    headers: { 
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: 'POST',
    url: $(this).attr('action'),
    data: {
      'email': $('input[name=email]').val(),
      'password': $('input[name=password').val()
    },
    success: function (data) {
      console.log('Test');
    },
    error: function (x,e) {
      if (x.status == 0) {
        console.log('You are offline');
      } else if (x.status == 404) {
        console.log('Requested URL not found\n'+$(this).attr('action'));
      } else if (x.status == 500) {
        console.log('Internal Server Error');
      } else if (e == 'parseerror') {
        console.log('Error.\nParsing JSON Request failed');
      } else if (e == 'timeout') {
        console.log('Request Time out');
      } else {
        console.log('Unknown Error.\n'+x.responseText);
      }
    }

  });

});
