<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reset Password | GDC</title>
  <meta content="Jacob Muimi,CISA" name="author" />
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <!-- Google Font: Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #e0f8e9 0%, #ffffff 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0;
      padding: 1rem;
      position: relative;
    }
    .auth-card {
      background: #fff;
      border-radius: 1rem;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
      padding: 4rem 3rem;
      width: 100%;
      max-width: 600px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .auth-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
    }
    .auth-logo img {
      height: 80px;
      margin-bottom: 1.5rem;
    }
    h3 {
      font-weight: 600;
      font-size: 2rem;
    }
    p {
      font-size: 1.1rem;
    }
    .form-label {
      font-weight: 500;
      margin-bottom: 0.5rem;
    }
    .input-group-text {
      background-color: #27AE60;
      border: none;
      color: #fff;
      border-top-left-radius: 0.5rem;
      border-bottom-left-radius: 0.5rem;
      font-size: 1.2rem;
      padding: 0.75rem 1rem;
    }
    .form-control {
      border-left: none;
      font-size: 1.1rem;
      padding: 0.75rem 1rem;
      transition: box-shadow 0.3s ease, border-color 0.3s ease;
    }
    .form-control:focus {
      border-color: #27AE60;
      box-shadow: 0 0 8px rgba(39, 174, 96, 0.4);
    }
    .btn-success {
      background-color: #27AE60;
      border: none;
      font-weight: 600;
      font-size: 1.1rem;
      padding: 0.75rem;
      transition: background-color 0.3s ease;
    }
    .btn-success:hover {
      background-color: #219150;
    }
    .back-link {
      text-align: center;
      margin-top: 2rem;
      display: block;
      font-size: 1.1rem;
    }
    /* Extra Feature: Help Button */
    .help-btn {
      position: absolute;
      top: 1rem;
      right: 1rem;
      background: none;
      border: none;
      font-size: 1.5rem;
      color: #27AE60;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <!-- Help Button triggers modal -->
  <button class="help-btn" data-bs-toggle="modal" data-bs-target="#helpModal">
    <i class="fa-solid fa-circle-info"></i>
  </button>

  <div class="auth-card">
    <!-- GDC Logo -->
    <div class="text-center auth-logo">
      <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="GDC Logo" />
    </div>

    <h3 class="text-center text-success fw-bold mb-3">Reset Password</h3>
    <p class="text-center text-muted mb-4">
      We'll email you a link to reset your password. Please enter your registered email below.
    </p>

    <!-- Session Status -->
    @if (session('status'))
      <div class="alert alert-success text-center mb-3" role="alert">
        {{ session('status') }}
      </div>
    @endif

    <!-- Reset Form -->
    <form method="POST" action="{{ route('password.email') }}" class="needs-validation" novalidate>
      @csrf

      <!-- Email Address -->
      <div class="mb-4">
        <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="fa-solid fa-envelope"></i>
          </span>
          <input
            type="email"
            class="form-control @error('email') is-invalid @enderror"
            id="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="Enter your email"
            required
            autofocus
          />
        </div>
        @error('email')
          <div class="invalid-feedback d-block">
            {{ $message }}
          </div>
        @enderror
      </div>

      <!-- Submit Button -->
      <div class="d-grid mb-3">
        <button type="submit" class="btn btn-success">
          <i class="fa-solid fa-paper-plane me-1"></i> Email Reset Link
        </button>
      </div>

      <!-- Back to Login -->
      <a href="{{ route('login') }}" class="back-link text-success text-decoration-none fw-medium">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to Login
      </a>
    </form>
  </div>

  <!-- Help Modal -->
  <div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="helpModalLabel">Reset Password Help</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>
            Please enter your registered email address. If it matches our records, you'll receive an email with instructions to reset your password.
          </p>
          <p>
            If you don't receive the email, check your spam folder or try again later. For further assistance, please contact our support.
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
