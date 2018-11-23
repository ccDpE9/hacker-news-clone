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

$('.login-modal').click(function (event) {
  event.stopPropagation();
});

$('.login-modal-overlay').click(function() {
  $('.login-modal-overlay').fadeOut(200);
});


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
      $('.login-modal-overlay').fadeOut();
    },
    error: function (response) {
      console.log(response);
      if (response.responseJSON.errors.email[0]) {
        $('.login-form__error').text(response.responseJSON.message);
        $('.login-form__error').fadeIn();
      } else {
        console.log('Internal server error. Try again.');
      }
    }

  });

});

$('.logout--btn').on('click', function(e) {
  e.preventDefault();
  $('#logout-form').submit();
})


// --- PAGINATION --- //
$(document).ready(function() {

  $(document).on('click', '.pagination a', function(e) {
    e.preventDefault();

    var url = $(this).attr('href');
    fetchData(url);
    /*
    $.get(url, function(data) {
      $('.links').html(data);
    });
    */
  });

  function fetchData(url) {
    $.ajax({
      url: url,
      success: function(data) {
        $('.links').html(data);
      },
      error: function() {
        console.log('Error');
      }
    });
  }
    

});

