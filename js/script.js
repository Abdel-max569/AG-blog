const title = document.getElementById('title');
const resume = document.getElementById('excerpt');
const limite = 50;
let erreorCaracter=document.getElementById("error-caracter");
let erreorCaracterResume=document.getElementById("error-caracter-resume");

title.addEventListener('input', function() {
  if (title.value.length > limite) {
    erreorCaracter.textContent="Vous avez depasser la limite de caractere!"
    title.maxlength=50;
  }else{
    erreorCaracter.textContent=""
  }
});

resume.addEventListener('input', function() {
  if (resume.value.length > limite) {
    erreorCaracterResume.textContent="Vous avez depasser la limite de caractere!"
  }else{
    erreorCaracterResume.textContent=""
  }
});








