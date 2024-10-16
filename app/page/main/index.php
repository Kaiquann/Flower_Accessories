<body>
  <main id="main" class="vh-100">
    <section class="section">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="d-block col-8 col-lg-5 col-xl-6 col-xxl-5 all_content">
            <h1 class="my-xxl-4 tittle">Flower shop</h1>
            <p class="my-xxl-4 content">Flowers provide an incredibly nuanced form of communication. Some
              plants, including roses, poppies, and lilies, could express a wide range of emotions based on their
              color alone.</p>
            <p class="my-xxl-4 content" style="font-size: 15px; color: rgb(133, 123, 120);"><strong>"Flowers are like friends,
                they bring color to your world"<br>Our shop now have envent and promotion now!</strong></p>
            <a href="/menu"><button class="m-3 px-4 py-2 button" style="animation:pulse 1s infinite;"><strong>Shop now</strong></button></a>
          </div>
        </div>
      </div>
    </section>
  </main>
</body>

<style>
  main {
    background-image: url(../images/leonardo-wong-7pGehyH7o64-unsplash-2-1200x600.jpg);
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
  }

  .all_content {
    position: relative;
    left: 10%;
  }

  .tittle {
    font-size: 80px;
    color: rgb(58, 57, 55);
    font-family: Cursive;
  }

  .content {
    font-size: 20px;
  }

  @media screen and (max-width:767px) {
    .button {
      width: 40%;
    }
    .tittle {
      font-size: 50px;
    }
    .content {
      font-size: 10px;
    }
    .all_content {
      left: 1%;
    }
  }
</style>