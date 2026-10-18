document.querySelectorAll('.tab').forEach(function (btn) {
  btn.addEventListener('click', function () {
    document.querySelectorAll('.tab,.pane').forEach(function (el) { el.classList.remove('on'); });
    btn.classList.add('on');
    document.getElementById(btn.dataset.t).classList.add('on');
  });
});
