<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Register | GDC Recruitment Portal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="A fully featured recruitment system for GDC" name="description">
  <meta content="Jacob Muimi,CISA" name="author">
   <meta content="Canjetan Ngahu" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">

  <!-- Bootstrap CSS -->
  <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet" id="app-style">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- 
    1) Google Fonts link for Poppins
  -->
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet"
  >

  <style>
    /* 
      2) Use Poppins in the body 
    */
    body {
      font-family: 'Poppins', sans-serif !important;
      background: linear-gradient(135deg, #e0f7fa, #ffffff);
      margin: 0;
      padding: 0;
    }
    .wave-top {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: auto;
      z-index: -1;
    }
    .main-container {
      margin-top: 140px;
      padding: 20px;
    }
    .card {
      border-radius: 1rem;
      border: none;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    .btn-success {
      background-color: #27AE60;
      font-weight: 600;
    }
    .btn-success:hover {
      background-color: #219150;
    }
    .input-group-text {
      background-color: #27AE60;
      color: #fff;
      border: none;
    }
    .form-label {
      font-weight: 500;
    }
    .form-step {
      animation: fadeIn 0.4s ease;
    }
    .footer {
      text-align: center;
      margin-top: 3rem;
      color: #444;
    }
    .progress-bar {
      transition: width 0.4s ease-in-out;
    }
    .is-invalid {
      border-color: #dc3545;
    }
    .invalid-feedback {
      display: block;
      font-size: 0.875rem;
    }
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    @media (max-width: 576px) {
      .wave-top {
        height: 100px;
      }
      .auth-logo img {
        height: 60px;
      }
    }
  </style>
</head>
<body>

  <!-- SVG Background -->
  <svg class="wave-top" viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg">
    <path fill="#27AE60" d="M0,32L40,42.7C80,53,160,75,240,96C320,117,400,139,480,160C560,181,640,203,720,202.7C800,203,880,181,960,154.7C1040,128,1120,96,1200,85.3C1280,75,1360,85,1400,90.7L1440,96L1440,0L1400,0C1360,0,1280,0,1200,0C1120,0,1040,0,960,0C880,0,800,0,720,0C640,0,560,0,480,0C400,0,320,0,240,0C160,0,80,0,40,0L0,0Z"></path>
  </svg>

  <div class="main-container">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-5 mb-4 text-center text-lg-start">
          <div class="auth-logo mb-3">
            <a href="#" class="logo logo-dark">
              <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="Logo" height="80">
            </a>
          </div>
          <h2 style="color: #27AE60;">Welcome to GDC Recruitment</h2>
          <p style="color: #333;">Be a part of our mission to drive geothermal energy development. Create your account below and get started.</p>
        </div>

        <div class="col-lg-7">
          <div class="card">
            <div class="card-body p-4">
              <!-- Progress Bar -->
              <div id="progressbar" class="progress mb-4">
                <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
              </div>

              <!-- Form -->
              <form id="registrationForm" class="needs-validation" novalidate method="POST" action="{{ route('register') }}">
                @csrf
                <!-- Step 1 -->
                <div id="step-1" class="form-step">
                  <h4 class="text-center mb-4">Personal Information</h4>

                  <div class="mb-3">
                    <label class="form-label">Email Address <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                      <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">First Name <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                      <input type="text" name="first_name" class="form-control" required>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Other Names</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fa-solid fa-user-plus"></i></span>
                      <input type="text" name="other_name" class="form-control">
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Surname <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fa-solid fa-user-tag"></i></span>
                      <input type="text" name="last_name" class="form-control" required>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">National ID Number <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                      <input type="number" name="idnumber" class="form-control" required>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                      <input type="tel" name="phone" class="form-control" placeholder="e.g. 0712 345678" required>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">How did you hear about us?</label>
                    <select class="form-select" name="referral_source">
                      <option selected disabled>-- Select an option --</option>
                      <option value="website">GDC Website</option>
                      <option value="social_media">Social Media</option>
                      <option value="friend">Friend / Colleague</option>
                      <option value="advertisement">Advertisement</option>
                      <option value="other">Other</option>
                    </select>
                  </div>

                  <div class="text-end">
                    <button type="button" class="btn btn-primary next-step">Next</button>
                  </div>
                </div>

                <!-- Step 2 -->
                <div id="step-2" class="form-step d-none">
                  <h4 class="text-center mb-4">Account Information</h4>

                  <div class="mb-3">
                    <label class="form-label">Password <span class="text-danger">*</span></label>
                    <div class="input-group input-group-merge">
                      <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                      <input type="password" name="password" id="password" class="form-control" required>
                      <div class="input-group-text" data-password="false"><i class="fa-solid fa-eye"></i></div>
                    </div>
                    <div id="password-strength" class="mt-2"></div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                    <div class="input-group input-group-merge">
                      <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                      <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                  </div>

                  <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="termsCheckbox" required>
                    <label class="form-check-label" for="termsCheckbox">
                      I accept the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal" class="text-decoration-underline" style="color: #27AE60;">Terms and Conditions</a>
                    </label>
                  </div>

                  <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary prev-step">Back</button>
                    <button type="submit" class="btn btn-success">Sign Up</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer">
    &copy; <script>document.write(new Date().getFullYear())</script>
    <a href="https://www.gdc.co.ke/" class="fw-bold text-black-50" target="_blank">Geothermal Development Company</a>. All Rights Reserved.
  </footer>

  <!-- Terms Modal -->
  <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus...</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('backend/assets/js/vendor.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('backend/assets/js/app.min.js') }}"></script>

  <script>
    // Show/hide password
    document.querySelectorAll('.input-group-text[data-password]').forEach(function (element) {
      element.addEventListener('click', function () {
        var input = this.parentElement.querySelector('input');
        if (input.type === 'password') {
          input.type = 'text';
          this.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
        } else {
          input.type = 'password';
          this.innerHTML = '<i class="fa-solid fa-eye"></i>';
        }
      });
    });

    // Multi-step form logic
    document.querySelectorAll(".next-step").forEach(button => {
      button.addEventListener("click", function () {
        document.getElementById("step-1").classList.add("d-none");
        document.getElementById("step-2").classList.remove("d-none");
        updateProgressBar(2);
      });
    });

    document.querySelectorAll(".prev-step").forEach(button => {
      button.addEventListener("click", function () {
        document.getElementById("step-2").classList.add("d-none");
        document.getElementById("step-1").classList.remove("d-none");
        updateProgressBar(1);
      });
    });

    function updateProgressBar(step) {
      const progressBar = document.getElementById("progress-bar");
      let width = step === 1 ? 50 : 100;
      progressBar.style.width = width + "%";
      progressBar.setAttribute("aria-valuenow", width);
      progressBar.setAttribute("aria-label", `Progress ${width}%`);
    }

    // Password strength indicator
    const passwordInput = document.getElementById("password");
    const strengthDisplay = document.getElementById("password-strength");
    passwordInput.addEventListener("input", function () {
      const val = passwordInput.value;
      let strength = 0;
      if (val.length >= 8) strength++;
      if (/[A-Z]/.test(val)) strength++;
      if (/[a-z]/.test(val)) strength++;
      if (/\d/.test(val)) strength++;
      if (/[^A-Za-z0-9]/.test(val)) strength++;
      const strengthLevels = [
        { text: "Very Weak 😢", color: "red" },
        { text: "Weak 😕", color: "orangered" },
        { text: "Okay 🙂", color: "orange" },
        { text: "Good 😎", color: "#17a2b8" },
        { text: "Strong 💪", color: "green" },
      ];
      const level = strengthLevels[strength - 1] || strengthLevels[0];
      strengthDisplay.textContent = `Password Strength: ${level.text}`;
      strengthDisplay.style.color = level.color;
    });

    // Bootstrap form validation
    (() => {
      'use strict';
      const forms = document.querySelectorAll('.needs-validation');
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    })();
  </script>
</body>
</html>
