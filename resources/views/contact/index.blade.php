@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Blog Single - Company Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('img/favicon.png') }}" rel="icon">
  <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('vendor/animate.css/animate.min.css') }} " rel="stylesheet">
  <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }} " rel="stylesheet">
  <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Company
  * Template URL: https://bootstrapmade.com/company-free-html-bootstrap-template/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>


  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Contact</h2>
          <ol>
            <li><a href="{{ route('dashboard') }}">Accueil</a></li>
            <li>Contact</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <div class="map-section">
     <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2637.8172180018146!2d2.425937076953174!3d48.613341917919435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e5ddfd884c0b07%3A0x2453553624c7650c!2sLaboratoire%20de%20Recherche%20%22IBISC%22%20site%20Pelvoux!5e0!3m2!1sfr!2sus!4v1714485723563!5m2!1sfr!2sus" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

   
 <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">
        <div class="row justify-content-center" data-aos="fade-up">
          <div class="col-lg-10">
            <div class="info-wrap">
              <div class="row">
                <div class="col-lg-4 info">
                  <i class="bi bi-geo-alt"></i>
                  <h4>Localisation:</h4>
                  <p>36 rue du Pelvoux<br>Évry-Courcouronnes, 91080</p>
                </div>
                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="bi bi-envelope"></i>
                  <h4>Email:</h4>
                  <p>siam.univ.evry@gmail.com</p>
                </div>
                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="bi bi-phone"></i>
                  <h4>Téléphone:</h4>
                  <p>01 69 47 75 41</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row justify-content-center mt-5" data-aos="fade-up">
          <div class="col-lg-10">
          
              <form id="contact-form" action="mailto:siam.univ.evry@gmail.com" method="post" class="php-email-form">
                <div class="row">
                  <div class="col-md-6 form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Nom et Prénom" required>
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Votre Email" required>
                  </div>
                </div>
                <div class="form-group mt-3">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Objet" required>
                </div>
                <div class="form-group mt-3">
                  <textarea class="form-control" name="message" id="message" rows="5" placeholder="Message" required></textarea>
                </div>
                <div class="text-center">
                  <button type="button" onclick="sendMail();" class="btn" style="color:white; background-color: #17a2b8;">Envoyer</button>
                </div>
              </form>
           
          </div>
        </div>
      </div>
    </section><!-- End Contact Section -->
  </main><!-- End #main -->

  <!-- Vendor JS Files -->
  <script src="{{ asset('vendor/aos/aos.js') }} "></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
  <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }} "></script>
  <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js') }} "></script>
  <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }} "></script>
  <script src="{{ asset('vendor/waypoints/noframework.waypoints.js') }} "></script>
  <script src="{{ asset('vendor/php-email-form/validate.js') }} "></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('js/main.js') }} "></script>
 <script>
    function sendMail() {
      var name = document.getElementById('name').value;
      var email = document.getElementById('email').value;
      var subject = document.getElementById('subject').value;
      var message = document.getElementById('message').value + '\n\n' + name; // Add the signature
      
      var mailto_link = 'mailto:siam.univ.evry@gmail.com?cc=' + encodeURIComponent(email)
                        + '&subject=' + encodeURIComponent(subject)
                        + '&body=' + encodeURIComponent(message);

      window.location.href = mailto_link; // Open the default email client
    }
  </script>

</body>

</html>
@endsection