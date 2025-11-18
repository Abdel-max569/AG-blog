const monChamp = document.getElementById('title');
const limite = 150;


monChamp.addEventListener('input', function() {
  if (monChamp.value.length > limite) {
    monChamp.value = monChamp.value.substring(0, limite);
  }
});


