<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="icon" href="%PUBLIC_URL%/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <meta name="description" content="Web site created using create-react-app" />
  <link rel="apple-touch-icon" href="%PUBLIC_URL%/logo192.png" />
  <link rel="stylesheet" href="{{asset('css/index.css')}}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

  <title>Home</title>
</head>

<body>
  <noscript>You need to enable JavaScript to run this app.</noscript>


  <nav class="navbar navbar-expand-lg navbar-dark fixed-top py-4"
    style="background-image: linear-gradient(black, rgba(255, 255, 255, 0));">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span style="color: white;" class="fa-solid fa-bars fa-xl"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a href="index.html"><img class="logo" href="{{url('/')}}" src="{{asset('img/logo.png')}}" alt="logo"></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" style="color:white;" aria-current="page" href="#Home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" style="color:white;" aria-current="page" href="#Clients">Clients</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" style="color:white;" aria-current="page" href="#Contact">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <section id="Home" style="background-image: url('{{ asset('img/blur-coffee-cafe-shop-restaurant-with-bokeh-background-xd.jpg') }}');">

    <br><br><br><br><br>
    <div class="container">
      <div>
        <h1 style="color:white;">No Need Of</h1>
        <h1 class="mt-2" style="color:white;">Third Parties</h1>
        <p class="fs-3 mt-3" style="color:white;">Attract New Customers & Increase Direct Orders</p>
      </div>
      <a href="{{ url('/register') }}"><button class="Btn-try-it-now mt-3">Register</button></a>

      <div class="container Checks mt-4">
        <div class="Check-item">
          <i class="fa-solid fa-check fa-2xl Check"></i>
          <p>No hidden fees</p>
        </div>
        <div class="Check-item">
          <i class="fa-solid fa-check fa-2xl Check"></i>
          <p>Save your customers data</p>
        </div>
        <div class="Check-item">
          <i class="fa-solid fa-check fa-2xl Check"></i>
          <p>Increase your profits</p>
        </div>
      </div>
    </div>
  </section>

  <section id="Clients" class="Clients">
    <div class="container">
      <h1 class="mt-5 mb-5 d-flex justify-content-center">Clients:</h1>
    </div>
    <div class="container mt-5">
      <div class="image-container my-5">
        <img src="{{asset('img/company1.png')}}" class="img-fluid" alt="Image 1">
        <img src="{{asset('img/company2.png')}}" class="img-fluid" alt="Image 2">
        <img src="{{asset('img/company3.png')}}" class="img-fluid" alt="Image 3">
        <img src="{{asset('img/company1.png')}}" class="img-fluid" alt="Image 1">
        <img src="{{asset('img/company2.png')}}" class="img-fluid" alt="Image 2">
        <img src="{{asset('img/company3.png')}}" class="img-fluid" alt="Image 3">
        <img src="{{asset('img/company1.png')}}" class="img-fluid" alt="Image 1">

        <h3 class="See-more"><a href="clients.html">+ 300</a></h3>
      </div>
    </div>

    <h2 class="What-we-do d-flex justify-content-center mt-5">What we do</h2>
    <div class="container mt-5">

      <div class="card mt-5">
        <div class="row no-gutters">
          <div class="col-md-4">
            <img src="{{ asset('img/grow-your-restauruant.jpg') }}" class="card-img" alt="Image">
          </div>
          <div class="col-md-8 d-flex align-items-center">
            <div class="card-body">
              <h2 class="card-title">Grow your restaurant</h2>
              <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi, corporis aperiam.
                Incidunt exercitationem vero excepturi repudiandae ipsum rem, amet autem dolorem reprehenderit quas!
                Vitae dolorum obcaecati beatae quis, consequuntur veritatis incidunt maiores nesciunt possimus odio nemo
                alias nihil dolorem eius voluptate itaque sint facilis. Hic dolore iure ullam saepe nam.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="card mt-5">
        <div class="row no-gutters">
          <div class="col-md-8 d-flex align-items-center">
            <div class="card-body">
              <h2 class="card-title">Manage Delivery</h2>
              <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi, corporis aperiam.
                Incidunt exercitationem vero excepturi repudiandae ipsum rem, amet autem dolorem reprehenderit quas!
                Vitae dolorum obcaecati beatae quis, consequuntur veritatis incidunt maiores nesciunt possimus odio nemo
                alias nihil dolorem eius voluptate itaque sint facilis. Hic dolore iure ullam saepe nam.</p>
            </div>
          </div>
          <div class="col-md-4 order-first order-md-last">
            <img src="{{ asset('img/delivery.webp') }}" class="card-img" alt="Image">
          </div>
        </div>
      </div>


    </div>
    </div>

  </section>

  <section class="Sign-up">
    <div class="container">
      <div class="Steps">
        <div class="container mt-5">
          <div class="card mb-5 p-4">
            <div class="row no-gutters">
              <div class="col-md-4">
                <img class="Step-img" src="{{ asset('img/signup-2.png') }}" alt="Image 1" class="card-img">
              </div>
              <div class="col-md-8 d-flex align-items-center">
                <div class="card-body">
                  <h1 class="card-title">1.</h1>
                  <h2 class="card-text">Create an account</h2>
                </div>
              </div>
            </div>
          </div>
          <div class="card p-4">
            <div class="row no-gutters">
              <div class="col-md-8 d-flex align-items-center">
                <div class="card-body">
                  <h1 class="card-title">2.</h1>
                  <h2 class="card-text">Create your site</h2>
                </div>
              </div>
              <div class="col-md-4">
                <img class="Step-img" src="{{ asset('img/signup-1.png') }}" alt="Image 2" class="card-img">
              </div>
            </div>
          </div>
          <div class="card p-4">
            <div class="row no-gutters">
              <div class="col-md-4">
                <img class="Step-img" src="{{ asset('img/signup-3.png') }}" alt="Image 3" class="card-img">
              </div>
              <div class="col-md-8 d-flex align-items-center">
                <div class="card-body">
                  <h1 class="card-title">3.</h1>
                  <h2 class="card-text">Start Earning</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section id="Contact" class="Contact">
    <div class="container">
      <div class="row">
        <div class=" Contact-area col-md-6 order-md-2 d-flex justify-content-center align-items-center mb-5 mb-md-0">
          <img style="width: 80%;" class="img-fluid" src="{{ asset('img/contact.jpg') }}" alt="contact">
        </div>
        <div class="col-md-6 order-md-1 d-flex align-items-center">
          <div class="mx-auto mt-5">
            <h2 class="text-center mt-5">Contact us:</h2>
            <form class="mt-5 Contact-form">
              <div class="row g-3">
                <div class="col-12 my-1">
                  <label for="inputName" class="my-2">Name</label>
                  <input style="height:52px" type="text" placeholder="John" class="form-control" id="inputName"
                    required>
                </div>
                <div class="col-12 my-1">
                  <label for="inputLastName" class="my-2">Last name</label>
                  <input style="height:52px" type="text" placeholder="Doe" class="form-control"
                    id="inputLastName" required>
                </div>
                <div class="col-12 my-1">
                  <label for="inputEmail" class="my-2">Email</label>
                  <input style="height:52px" type="email" placeholder="johndoe@example.com" class="form-control" id="inputEmailName"
                    required>
                </div>
                <div class="col-12 mt-1 my-1">
                  <label for="inputMessage" class="my-2">Message</label>
                  <textarea placeholder="Message..." style="min-height: 160px; max-height: 300px;" type="text"
                    class="form-control md-textarea p-3" id="inputMessage"></textarea>
                </div>
                <div class="col-12 mt-4 mb-4 d-flex justify-content-center align-items-center">
                  <button style="width: 100%; height: 52px;" type="submit" class="btn btn-outline-dark">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>




  <section class="Footer">
    <footer style="background-color: rgba(0, 0, 0, 0.457);" class="text-center text-white">
      <div class="container">
        <div class="container p-4">
          <section class="mb-4">
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                class="fab fa-facebook-f"></i></a>

            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-twitter"></i></a>

            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                class="fab fa-instagram"></i></a>

            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                class="fab fa-whatsapp"></i></a>
          </section>
        </div>

        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
          © 2023 Copyright:
          <a class="text-white" href=#>This Site.com</a>
        </div>
      </div>
    </footer>
  </section>

  <!--Animation for cards-->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      var cards = document.querySelectorAll(".card");
      var imageContainers = document.querySelectorAll(".image-container");
      var contactImages = document.querySelectorAll(".Contact-area img");

      function handleIntersect(entries, observer) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add("animate");
            observer.unobserve(entry.target);
          }
        });
      }

      var options = {
        rootMargin: "0px",
        threshold: 0.5
      };

      var observer = new IntersectionObserver(handleIntersect, options);

      cards.forEach(function (card) {
        observer.observe(card);
      });

      imageContainers.forEach(function (container) {
        var images = container.querySelectorAll("img");
        images.forEach(function (image) {
          observer.observe(image);
        });
      });

      contactImages.forEach(function (image) {
        observer.observe(image);
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

  <script src="https://kit.fontawesome.com/d2d3f16619.js" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
</body>

</html>