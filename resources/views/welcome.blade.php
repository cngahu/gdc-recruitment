@php
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Auth;
    use App\Models\User;

    // Example query pulling external vacancies only
    $vacancies = DB::table('vacancies')
        ->join('recruitments', 'vacancies.Recruitmentid', '=', 'recruitments.id')
        ->where('vacancies.job_type', 'External')
        ->where('recruitments.closeDate', '>=', today())
        ->select('vacancies.*', 'recruitments.closeDate as closedate')
        ->get();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>GDC Recruitment System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="Jacob Muimi,CISA" name="author" />
    <!-- Fonts & Libraries -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<!-- Poppins Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/app.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">

    <!-- Accessibility widget -->
    <script src="https://cdn.userway.org/widget.js" data-account="mz58FyckjC"></script>

    <!-- Custom Styles -->
    <style>
        
        * {
  font-family: 'Poppins', sans-serif !important;
}

        body {
            background: linear-gradient(45deg, #007A33, #A7A8AA);
            font-family: 'Poppins', sans-serif;
        }
        /* Button & Radius Styles */
        .custom-color-btn {
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .custom-color-btn:hover {
            opacity: 0.85;
        }
        .radius-30 { border-radius: 30px; }
        .radius-50 { border-radius: 50px; }

        /* Card & Container Styles */
        .card.bg-pattern {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }
        .card-soft {
            background-color: #fff;
            border: none;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        .card-soft:hover { transform: translateY(-4px); }
        .card-rounded { border-radius: 50px; }
        .card-rectangle { border-radius: 12px; }
        .table-container {
            overflow-x: auto;
            margin: 20px 0;
        }
        hr { border: 1px solid #057833; }

        /* Header Styles */
        .header img {
            width: 100%;
        }
        .header h4 {
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
            font-size: 2.2rem;
            font-weight: bold;
            background: linear-gradient(135deg, #057833, #EE4049);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .text-justify { text-align: justify; }

        /* Instruction Cards */
        .card-soft .card-header {
            background-color: #2ecc71;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            text-align: center;
            padding: 1rem 1.5rem;
        }
        .card-soft .card-body {
            padding: 1.5rem;
            font-size: 0.95rem;
            color: #444;
        }
        .card-soft ul {
            list-style: none;
            padding-left: 0;
        }
        .card-soft ul li {
            display: flex;
            align-items: start;
            gap: 8px;
            margin-bottom: 10px;
        }
        .card-soft ul li i {
            color: #2ecc71;
            font-size: 1rem;
            margin-top: 3px;
        }

        /* Clearance Certificate Card */
        .card-custom {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            background-color: #fff;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.07);
            transition: transform 0.3s ease;
        }
        .card-custom:hover { transform: translateY(-3px); }
        .card-header-custom {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
            padding: 1.75rem 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .card-header-custom .icon-circle {
            background-color: #ffffff;
            color: #27ae60;
            width: 52px;
            height: 52px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.4rem;
        }
        .card-body-custom {
            padding: 2rem;
        }
        .card-body-custom ul {
            list-style: none;
            padding: 0;
        }
        .card-body-custom ul li {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1rem;
            font-size: 1rem;
            opacity: 0;
            animation: fadeInUp 0.6s ease forwards;
        }
        .card-body-custom ul li:nth-child(1) { animation-delay: 0.1s; }
        .card-body-custom ul li:nth-child(2) { animation-delay: 0.2s; }
        .card-body-custom ul li:nth-child(3) { animation-delay: 0.3s; }
        .card-body-custom ul li:nth-child(4) { animation-delay: 0.4s; }
        .card-body-custom ul li:nth-child(5) { animation-delay: 0.5s; }
        .card-body-custom ul li i { color: #2ecc71; font-size: 1.2rem; }
        @keyframes fadeInUp {
            from { transform: translateY(15px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* Data Disclaimer */
        .data-disclaimer {
            font-style: italic;
            text-align: center;
            margin-top: 40px;
            font-size: 0.95rem;
        }
        .data-disclaimer::before {
            content: '';
            width: 60px;
            height: 2px;
            background: #2ecc71;
            display: block;
            margin: 0 auto 10px;
            border-radius: 2px;
        }

        /* Footer */
        .footer-modern {
            background: #2ecc71;
            color: white;
            font-size: 0.95rem;
            padding: 16px 0;
            text-align: center;
        }
        .footer-modern a {
            color: #fff;
            font-weight: 600;
            text-decoration: none;
        }
        .footer-modern a:hover {
            text-decoration: underline;
            color: #d4f5e4;
        }
    </style>
</head>

<body>
    <!-- Main Content -->
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card bg-pattern">
                        <div class="card-body p-4">

                            <!-- Header Row -->
                            <div class="row align-items-center header">
                                <div class="col-md-3">
                                    <a href="https://www.gdc.co.ke/" target="_blank">
                                        <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="GDC Logo">
                                    </a>
                                </div>
                                <div class="col-md-5"></div>
                                <div class="col-md-4 text-end">
                                    @auth
                                        @php $user = Auth::user(); @endphp
                                        <a href="{{ route($user->role . '.dashboard') }}" class="btn btn-info custom-color-btn px-3 radius-30">Dashboard</a>
                                    @else
                                        <a href="{{ route('login') }}" class="btn custom-color-btn px-3 radius-50" style="background-color: #057833; color: white;">Login</a>
                                        <a href="{{ route('register') }}" class="btn custom-color-btn px-3 radius-50" style="background-color: #057833; color: white;">Register</a>
                                    @endauth
                                </div>
                            </div>

                            <hr>

                            <!-- Welcome Message -->
                            <div class="text-center">
                                             <h4 style="text-align: center; font-family: 'Poppins', sans-serif; font-size: 1.8rem; font-weight: bold; color: #ffffff; background: linear-gradient(135deg, #057833, #EE4049); padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    Welcome To Geothermal Development Company (GDC) Recruitment Portal
</h4>
                            </div>
                            <p class="mt-3 text-justify">
                                The Geothermal Development Company (GDC) was established by the Government of Kenya as a Special Purpose Vehicle (SPV) to accelerate the development of geothermal resources. Its formation followed the unbundling of the energy sector under the Energy Act No. 12 of 2006. GDC plays a key role in exploring, drilling, and developing steam fields for electricity generation and direct use.
                            </p>

<!-- Instruction Cards: GDC Themed -->
<div class="container my-5">
  <div class="row g-4 justify-content-center">

    <!-- Card 1: Login (Green) -->
    <div class="col-md-6 col-lg-4">
      <div class="card card-custom card-gdc-green h-100">
        <div class="card-body text-justify p-4">
          <div class="icon-wrap mb-3">
            <i class="bi bi-person-lock-fill fs-2"></i>
          </div>
          <h5 class="fw-bold mb-3">Login Credentials</h5>
          <p>
            Use your email and password to log in to the GDC recruitment portal. This grants you access to your dashboard, where you can manage and track your job applications securely.
          </p>
        </div>
      </div>
    </div>

    <!-- Card 2: Profile (Orange) -->
    <div class="col-md-6 col-lg-4">
      <div class="card card-custom card-gdc-orange h-100">
        <div class="card-body text-justify p-4">
          <div class="icon-wrap mb-3">
            <i class="bi bi-person-vcard-fill fs-2"></i>
          </div>
          <h5 class="fw-bold mb-3">Create Your Profile</h5>
          <ul class="list-unstyled">
            <li><i class="bi bi-check-circle-fill me-2"></i> Add personal and academic info</li>
            <li><i class="bi bi-check-circle-fill me-2"></i> Upload work experience & ID</li>
            <li><i class="bi bi-check-circle-fill me-2"></i> Enter certifications</li>
            <li><i class="bi bi-check-circle-fill me-2"></i> List memberships</li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Card 3: Apply (White) -->
    <div class="col-md-6 col-lg-4">
      <div class="card card-custom card-gdc-white h-100">
        <div class="card-body text-justify p-4">
          <div class="icon-wrap mb-3 text-success">
            <i class="bi bi-clipboard-check-fill fs-2"></i>
          </div>
          <h5 class="fw-bold mb-3">Submit Application</h5>
          <p>
            Once your profile is complete and verified, browse open vacancies and apply. You can track application progress through your personalized dashboard anytime.
          </p>
        </div>
      </div>
    </div>

  </div>
</div>
<style>
 .card-custom {
  border-radius: 20px;
  border: none;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  animation: fadeInUp 0.6s ease forwards;
  opacity: 0;
}

.card-custom:hover {
  transform: translateY(-8px);
  box-shadow: 0 16px 35px rgba(0, 0, 0, 0.1);
}

/* Icon Circle Wrapper */
.icon-wrap {
  width: 60px;
  height: 60px;
  background: rgba(255, 255, 255, 0.2);
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
}

.card-gdc-green {
  background: linear-gradient(135deg, #057833, #00a859);
  color: white;
  box-shadow: 0 10px 25px rgba(0, 122, 51, 0.3);
}

.card-gdc-orange {
  background: linear-gradient(135deg, #f7941e, #f15a29);
  color: white;
  box-shadow: 0 10px 25px rgba(247, 148, 30, 0.3);
}

.card-gdc-white {
  background-color: #ffffff;
  color: #333;
  box-shadow: 0 10px 25px rgba(5, 120, 51, 0.15);
}

ul li {
  margin-bottom: 10px;
}

/* Text justify */
.text-justify {
  text-align: justify;
}

/* Fade-in Animation */
@keyframes fadeInUp {
  from {
    transform: translateY(30px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}
    
</style>

                            <!-- Alert for Recruitment Agents -->
                            <div class="alert alert-danger mt-4">
                                <strong>Important:</strong> GDC does NOT use recruitment agents or charge any fees. Report any fraudulent requests to PSASB or the police.
                            </div>
                            <br>
                            <!-- Job Openings Button -->
                            @auth
                                <a href="{{ route($user->role . '.dashboard') }}" class="btn custom-color-btn radius-30" style="background-color: #EE4049; color: white;">View Job Openings</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-lg custom-color-btn" style="background-color: #D52E2F; color: white;">Login to View Jobs</a>
                            @endauth
                            <br>
                            <!-- Job Vacancies Table -->
                            @if($vacancies->count() > 0)
                                <div class="table-container mt-5">
                                    <table class="table table-hover table-bordered align-middle">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Job Title</th>
                                                <th>Terms</th>
                                                <th>Min Salary</th>
                                                <th>Max Salary</th>
                                                <th>Positions</th>
                                                <th>Ref</th>
                                                <th>Details</th>
                                                <th>Apply</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($vacancies as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td class="text-uppercase">{{ $item->jobTitle }}</td>
                                                    <td class="text-uppercase">{{ $item->jobtype }}</td>
                                                    <td>Ksh {{ number_format($item->min_salary) }}</td>
                                                    <td>Ksh {{ number_format($item->max_salary) }}</td>
                                                    <td>{{ $item->Positions }}</td>
                                                    <td class="text-uppercase">{{ $item->VacancyReference }}</td>
                                                    <td>
                                                        <!-- Modal Trigger -->
                                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $item->id }}">Details</button>
                                                        <!-- Modal Content -->
                                                        <div class="modal fade" id="modal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">{{ $item->jobTitle }} Details</h5>
                                                                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p><strong>Job Reference:</strong> {{ $item->VacancyReference }}</p>
                                                                        <p><strong>Terms Of Service:</strong> {{ $item->jobtype }}</p>
                                                                        <p><strong>Salary Range:</strong> Ksh {{ number_format($item->min_salary) }} - Ksh {{ number_format($item->max_salary) }}</p>
                                                                        <p><strong>No. of Positions:</strong> {{ $item->Positions }}</p>
                                                                        <p><strong>Closing Date:</strong> {{ \Carbon\Carbon::parse($item->closedate)->format('d M Y') }}</p>
                                                                        <hr>
                                                                        <p>{{ $item->jobDescription ?? 'Detailed job description goes here.' }}</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('login') }}" class="btn btn-danger btn-sm">Apply</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                      </div>
                                </div>
                       
                             @else
                             <table class="table table-bordered align-middle mt-4">
                           
                                <thead class="table-dark">
                                    <tr>
                                        <th>SN</th>
                                        <th>Job Title</th>
                                        <th>Grade</th>
                                        <th>No. Sought</th>
                                        <th>Ref</th>
                                        <th>Details</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="7">
                                            <div class="alert alert-danger mt-2" role="alert">
                                                <strong>Note:</strong> There are currently no available job positions.
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                              
                        @endif

                            <!-- Clearance Certificate Requirements Card -->
                            <div class="container d-flex justify-content-center align-items-center my-5">
                                <div class="card-custom w-100 w-md-75 w-lg-50">
                                    <div class="card-header-custom">
                                        <div class="icon-circle" aria-hidden="true">
                                            <i class="bi bi-shield-check"></i>
                                        </div>
                                        <div>
                                            <h4 class="mb-0 fw-semibold">Clearance Certificate Requirements</h4>
                                            <small class="text-white">Documents required from successful candidates</small>
                                        </div>
                                    </div>
                                    <div class="card-body-custom">
                                        <p><strong>Only successful candidates</strong> are required to submit clearance certificates from the following bodies:</p>
                                        <ul>
                                            <li><i class="bi bi-check-circle-fill"></i> Kenya Revenue Authority (Valid Tax compliance certificate).</li>
                                            <li><i class="bi bi-check-circle-fill"></i> Directorate of Criminal Investigations (Certificate of good conduct).</li>
                                            <li><i class="bi bi-check-circle-fill"></i> Higher Education Loans Board (Compliance certificate, where applicable).</li>
                                            <li><i class="bi bi-check-circle-fill"></i> Ethics and Anti–Corruption Commission (Self-Declaration form).</li>
                                            <li><i class="bi bi-check-circle-fill"></i> Credit Reference Bureau (Certificate of clearance or credit report).</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Disclaimer -->
                            <p class="data-disclaimer">
                                <i class="bi bi-shield-lock"></i>
                                GDC is committed to protecting your personal data in line with the <strong>Data Protection Act, 2019</strong>.
                            </p>

                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- end container -->
    </div> <!-- end account-pages -->

    <!-- Footer -->
    <footer class="footer-modern">
        &copy; <script>document.write(new Date().getFullYear())</script>
        <a href="https://www.gdc.co.ke" target="_blank">All Rights Reserved. Geothermal Development Company</a>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('backend/assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/app.min.js') }}"></script>
    <script>
        document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
            new bootstrap.Tooltip(el);
        });
    </script>
</body>
</html>
