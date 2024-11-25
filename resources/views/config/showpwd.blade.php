<script >
const showPwdBtn = document.getElementById('passwordeye');
const showPwd1Btn = document.getElementById('password1eye');
const passwordNoEye = document.getElementById('password_no_eye');
const passwordNoEye1 = document.getElementById('password_no_eye1');
showPwdBtn.addEventListener('click', () =>{
  const pwdInput = document.getElementById('password');
  // Toggle eye icon visibility
  if (pwdInput.type === 'text') {
    pwdInput.type = 'password';
    passwordNoEye.classList.add('hidden');
    showPwdBtn.classList.remove('hidden');
  } else {
    pwdInput.type = 'text';
    passwordNoEye.classList.remove('hidden');
    showPwdBtn.classList.add('hidden');
  }
});
passwordNoEye.addEventListener('click', () =>{

  const pwdInput = document.getElementById('password');
  // Toggle eye icon visibility
  if (pwdInput.type === 'text') {
    pwdInput.type = 'password';
    passwordNoEye.classList.add('hidden');
    showPwdBtn.classList.remove('hidden');
  } else {
    pwdInput.type = 'text';
    passwordNoEye.classList.remove('hidden');
    showPwdBtn.classList.add('hidden');
  }
});

// Toggle visibility for the second password input
showPwd1Btn.addEventListener('click', () =>{
  const pwdInput1 = document.getElementById('password1');
  // Correctly reference pwdInput1
  if (pwdInput1.type === 'text') {
    pwdInput1.type = 'password';
    passwordNoEye1.classList.add('hidden');
    showPwd1Btn.classList.remove('hidden');
  } else {
    pwdInput1.type = 'text';
    passwordNoEye1.classList.remove('hidden');
    showPwd1Btn.classList.add('hidden');
  }
});
passwordNoEye1.addEventListener('click', () =>{
  const pwdInput1 = document.getElementById('password1');
  // Correctly reference pwdInput1
  if (pwdInput1.type === 'text') {
    pwdInput1.type = 'password';
    passwordNoEye1.classList.add('hidden');
    showPwd1Btn.classList.remove('hidden');
  } else {
    pwdInput1.type = 'text';
    passwordNoEye1.classList.remove('hidden');
    showPwd1Btn.classList.add('hidden');
  }
});


</script>