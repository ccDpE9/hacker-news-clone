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
