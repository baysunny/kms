<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="images/favicon.ico" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/css/datepicker.min.css'>   
        <script src='https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/js/datepicker-full.min.js'></script>
        <!-- <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://cdn.tailwindcss.com"></script> -->
        <title>KMS TEST</title>
        <style>
            
            .clone-data-table{
                border-collapse: collapse;
                border: none;
                width: 100%;
            }

            .clone-data-table th, td{
                border: none;
            }

            .clone-data-table th{
                width: 25%;
            }

            @media (min-width: 120px) {
                .appointment-table th:nth-last-child(3),
                .appointment-table td:nth-last-child(3),
                .appointment-table th:nth-last-child(2),
                .appointment-table td:nth-last-child(2){
                    display: none;
                }
            }

            /*@media (min-width: 480px) {
                .appointment-table th:nth-last-child(4),
                .appointment-table td:nth-last-child(6) {
                    display: table-cell;
                
                }
            }*/


            @media (min-width: 720px) {
                .appointment-table th:nth-last-child(3),
                .appointment-table td:nth-last-child(3){
                    display: table-cell;
                }
                

                .appointment-table th:last-child {
                    width: 10%;
                }
                .appointment-table td:last-child {
                    width: 10%;
                }

                .clone-data-table th{
                    width: 15%;
                }
            }

            @media (min-width: 1080px) {
                .appointment-table th:nth-last-child(2),
                .appointment-table td:nth-last-child(2){
                    display: table-cell;
                }
                
            }

            .appointment-table{

            }

            .appointment-table{
                
            }
        </style>
    </head>
    <body class="mb-48">
        @auth
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">
            <a class="navbar-brand" href="#">@ {{auth()->user()->name}} </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link{{ Request::is('dashboard') ? ' active text-primary' : '' }}" href="/dashboard"><i class="fa fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ Request::is('dashboard/patients*') ? ' active text-primary' : '' }}" href="/dashboard/patients"><i class="fa fa-users"></i> Patients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ Request::is('dashboard/appointments*') ? ' active text-primary' : '' }}" href="/dashboard/appointments"><i class="fa fa-calendar"></i> Appointments</a>
                </li>
              </ul>
              <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form class="nav-link inline" method="POST" action="/logout">
                        @csrf
                        <button type="submit" class="btn btn-link text-danger text-decoration-none"><i class="fa fa-sign-out"></i> Logout</button>
                    </form>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        @else
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
          <div class="container">
            <a class="navbar-brand" href="#">KMS Test</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
              <ul class="navbar-nav ml-auto">
                @if(\Illuminate\Support\Facades\Route::is('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="/register">
                            <i class="fa fa-sign-in"></i> Register
                        </a>
                    </li>
                @endif
                @if(\Illuminate\Support\Facades\Route::is('register'))
                    {{-- Show the "Register" link only on the login page --}}
                    <li class="nav-item">
                        <a class="nav-link" href="/login">
                            <i class="fa fa-sign-in"></i> Login
                        </a>
                    </li>
                @endif

              </ul>
            </div>
          </div>
        </nav>
        
        @endauth
        
        <main>
            <div class="p-4">
                {{$slot}}        
            </div>
		
		</main>
        
        <x-notification/>

        
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                let toastElement = document.getElementById('liveToast');
                if (toastElement) {
                    let toast = new bootstrap.Toast(toastElement);
                    toast.show();
                }
            });
            const getDatePickerTitle = elem => {
          
            const label = elem.nextElementSibling;
            let titleText = '';
            if (label && label.tagName === 'LABEL') {
                titleText = label.textContent;
            } else {
                titleText = elem.getAttribute('aria-label') || '';
            }
                return titleText;
            }

            const elems = document.querySelectorAll('#floatingDateOfBirth');
            for (const elem of elems) {
                const datepicker = new Datepicker(elem, {
                    'format': 'yyyy-mm-dd', // UK format
                    title: getDatePickerTitle(elem)
                });
            }
            function submitForm(btn) {
                // disable the button
                btn.disabled = true;
                // submit the form    
                btn.form.submit();
            }

        </script>
    </body>
    
</html>
