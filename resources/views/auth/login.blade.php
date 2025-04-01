<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>GDC Recruitment Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="GDC Recruitment Portal" />
 <meta content="Canjetan Ngahu" name="author" />
 <meta content="Jacob Muimi,CISA" name="author" />
  <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}" />

  <!-- Bootstrap CSS -->
  <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" />

  <!-- Google Font - Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <style>
    :root {
      --primary: #057833;
      --secondary: #f1b21b;
      --accent: #a0b158;
      --dark-bg: #1c1c1c;
      --light-bg: #ffffff;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, var(--primary), var(--accent));
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      margin: 0;
      transition: background 0.3s ease;
    }

    .dark-mode {
      background: var(--dark-bg);
      color: #f0f0f0;
    }

    .login-container {
      background: rgba(255, 255, 255, 0.96);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      max-width: 980px;
      width: 100%;
      box-shadow: 0 16px 50px rgba(0, 0, 0, 0.15);
      display: flex;
      overflow: hidden;
      transition: background 0.3s ease;
    }

    .login-left {
      background: #f5f6fa;
      width: 40%;
      padding: 2.5rem 1.5rem;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    .login-left img {
      max-width: 160px;
      margin-bottom: 1rem;
    }

    .login-left p {
      color: #555;
      font-weight: 500;
      font-size: 1rem;
    }

    .login-right {
      width: 60%;
      padding: 3rem;
      position: relative;
      background-color: var(--light-bg);
      transition: background-color 0.3s ease;
    }

    .dark-mode .login-right {
      background-color: #2c2c2c;
    }

    .form-label {
      font-weight: 600;
      font-size: 0.95rem;
    }

    .form-control {
      border-radius: 8px;
      border: 1px solid var(--primary);
      transition: all 0.2s ease;
    }

    .form-control:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 0.2rem rgba(5, 120, 51, 0.15);
    }

    .btn-login {
      background-color: var(--primary);
      color: #fff;
      font-weight: 600;
      transition: background-color 0.3s ease;
    }

    .btn-login:hover {
      background-color: #046a2f;
    }

    .btn-secondary {
      background-color: var(--secondary);
      color: #000;
      font-weight: 600;
    }

    .btn-secondary:hover {
      background-color: #e0a80f;
    }

    .login-title {
      font-size: 2rem;
      font-weight: 700;
      background: linear-gradient(to right, var(--primary), var(--accent));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .form-footer a {
      color: var(--primary);
      font-weight: 500;
      text-decoration: none;
    }

    .form-footer a:hover {
      text-decoration: underline;
    }
/* Improve button focus */
.btn:focus,
.form-control:focus,
.form-check-input:focus {
  outline: none;
  box-shadow: 0 0 0 0.2rem rgba(5, 120, 51, 0.25);
}

/* Input hover effect */
.form-control:hover {
  border-color: var(--accent);
}

/* Better dark mode form contrast */
.dark-mode .form-control {
  background-color: #444;
  color: #fff;
  border-color: #666;
}

.dark-mode .form-control::placeholder {
  color: #ccc;
}

.dark-mode .input-group-text {
  background-color: #333;
  border-color: #666;
  color: #fff;
}

.dark-mode .form-check-label,
.dark-mode .form-label {
  color: #ddd;
}

/* Button focus state for keyboard navigation */
.btn:focus-visible {
  box-shadow: 0 0 0 0.25rem rgba(241, 178, 27, 0.5);
}

/* Checkbox style improvement */
.form-check-input {
  border-radius: 0.25rem;
  border: 1px solid #ccc;
  width: 1.1rem;
  height: 1.1rem;
  margin-top: 0.25rem;
}

.form-check-input:checked {
  background-color: var(--primary);
  border-color: var(--primary);
}

/* Smooth fade-in animation on load */
.login-container {
  animation: fadeIn 0.6s ease-in-out both;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }

  to {
    opacity: 1;
    transform: translateY(0);
  }
}

    .date-top {
      position: absolute;
      top: 1rem;
      right: 1.5rem;
      font-size: 0.9rem;
      color: #999;
    }

    .toggle-dark-mode {
      position: absolute;
      bottom: 1rem;
      right: 1.5rem;
      font-size: 0.85rem;
      cursor: pointer;
      color: #555;
    }

    .spinner-border-sm {
      margin-left: 0.5rem;
    }

    @media (max-width: 768px) {
      .login-container {
        flex-direction: column;
        border-radius: 0;
        box-shadow: none;
      }

      .login-left,
      .login-right {
        width: 100%;
      }

      .toggle-dark-mode {
        position: static;
        margin-top: 1rem;
        text-align: center;
      }
    }
  </style>
</head>

<body>

  <div class="login-container">
    <!-- Left Panel -->
    <div class="login-left">
      <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="GDC Logo" />
      <p>Geothermal Development Company</p>
    </div>

    <!-- Right Panel -->
    <div class="login-right" role="main">
      <div class="date-top" aria-label="Current date">{{ now()->format('d/m/Y') }}</div>

      <h2 class="login-title mb-1">GDC Recruitment Login</h2>
      <p class="text-muted mb-4">Please fill out the fields below to login:</p>

      <form method="POST" action="{{ route('login') }}" onsubmit="return handleLogin(event)">
        @csrf

        <div class="mb-3">
          <label for="email" class="form-label">Username or Email</label>
          <input type="text" id="email" name="email"
            class="form-control @error('email') is-invalid @enderror" placeholder="Enter your username or email"
            required autocomplete="username" />
          @error('email')
          <span class="text-danger small">{{ $message }}</span>
          @enderror
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <div class="input-group">
            <input type="password" id="password" name="password"
              class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" required
              autocomplete="current-password" />
            <span class="input-group-text" onclick="togglePassword()" role="button" aria-label="Toggle password visibility">
              <i class="bi bi-eye-slash" id="togglePasswordIcon"></i>
            </span>
          </div>
          @error('password')
          <span class="text-danger small">{{ $message }}</span>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Security Stamp</label>
          <div class="d-flex align-items-center mb-2">
            <span id="captcha-question">7 + 6 =</span>
            <i class="bi bi-arrow-clockwise ms-2" role="button" onclick="generateCaptcha()" title="Refresh CAPTCHA"></i>
          </div>
          <input type="text" name="captcha" class="form-control" id="captcha-answer" placeholder="Answer" required />
        </div>

        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" id="remember" name="remember" checked />
          <label class="form-check-label" for="remember">Remember Me</label>
        </div>

        <div class="d-grid mb-3">
          <button type="submit" id="loginBtn" class="btn btn-login">
            <span>Login</span>
            <span class="spinner-border spinner-border-sm d-none" id="loginSpinner" role="status"
              aria-hidden="true"></span>
          </button>
        </div>

        <div class="d-grid">
          <a href="{{ route('password.request') }}" class="btn btn-secondary">
            <i class="bi bi-key me-1"></i> Reset Password
          </a>
        </div>

        <div class="form-footer mt-3">
          <a href="{{ route('password.request') }}">Forgot Password?</a>
        </div>
      </form>

      <div class="toggle-dark-mode" onclick="toggleDarkMode()" aria-label="Toggle Dark Mode">
        <i class="bi bi-moon-stars"></i> Toggle Dark Mode
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
  <script>
    console.log("Developed by Jacob Muimi, CISA & Canjetan Ngahu");

    function togglePassword() {
      const input = document.getElementById("password");
      const icon = document.getElementById("togglePasswordIcon");
      input.type = input.type === "password" ? "text" : "password";
      icon.classList.toggle("bi-eye");
      icon.classList.toggle("bi-eye-slash");
    }

    let correctAnswer = 13;

    function generateCaptcha() {
      const a = Math.floor(Math.random() * 10 + 1);
      const b = Math.floor(Math.random() * 10 + 1);
      correctAnswer = a + b;
      document.getElementById("captcha-question").textContent = `${a} + ${b} =`;
    }

    function handleLogin(event) {
      const answer = document.getElementById("captcha-answer").value;
      if (parseInt(answer) !== correctAnswer) {
        alert("Incorrect security stamp. Please try again.");
        generateCaptcha();
        return false;
      }

      const btn = document.getElementById("loginBtn");
      const spinner = document.getElementById("loginSpinner");
      btn.disabled = true;
      spinner.classList.remove("d-none");
      return true;
    }

    function toggleDarkMode() {
      document.body.classList.toggle('dark-mode');
      localStorage.setItem('dark-mode', document.body.classList.contains('dark-mode'));
    }

    if (localStorage.getItem('dark-mode') === 'true') {
      document.body.classList.add('dark-mode');
    }

    window.onload = generateCaptcha;
  </script>
</body>

</html>
