  const form = document.forms['submit-to-google-sheet'];
  const msgSpan = document.getElementById('msg');
  form.addEventListener('submit', e => {
    e.preventDefault();
    form.timestamp.value = new Date().toISOString();
    const formData = new FormData(form);
    fetch(form.action, {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.result === 'success') {
        msgSpan.textContent = 'Thank you! Your form was submitted successfully.';
        msgSpan.style.color = 'green';
        form.reset();
      } else {
        msgSpan.textContent = 'Error: ' + (data.error || 'Unknown error');
        msgSpan.style.color = 'red';
      }
    })
    .catch(error => {
      msgSpan.textContent = 'Error submitting form: ' + error.message;
      msgSpan.style.color = 'red';
    });
  });

  const openBtn = document.getElementById('openModalBtn');
  const closeBtn = document.querySelector('.closeButton');
  const modal = document.getElementById('modal');
  openBtn.addEventListener('click', () => {
    modal.classList.add('active');
  });
  closeBtn.addEventListener('click', () => {
    modal.classList.remove('active');
  });
  // Close modal when clicking outside the modal content
  modal.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.classList.remove('active');
    }
  });

  // Optional: close modal on Escape key press
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && modal.classList.contains('active')) {
      modal.classList.remove('active');
    }
  });

    function togglePassword(inputId, icon) {
        const passwordInput = document.getElementById(inputId);
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            passwordInput.type = "password";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    }

     const loginText = document.querySelector(".title-text .login");
      const loginForm = document.querySelector("form.visitorLogin");
      const loginBtn = document.querySelector("label.login");
      const signupBtn = document.querySelector("label.signup");
      const signupLink = document.querySelector("form .signup-link a");
      signupBtn.onclick = (()=>{
        loginForm.style.marginLeft = "-50%";
        loginText.style.marginLeft = "-50%";
      });
      loginBtn.onclick = (()=>{
        loginForm.style.marginLeft = "0%";
        loginText.style.marginLeft = "0%";
      });
      signupLink.onclick = (()=>{
        signupBtn.click();
        return false;
      });

