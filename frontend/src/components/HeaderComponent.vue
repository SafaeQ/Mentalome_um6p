<template>
  <header class="w-100 mb-3">
    <div class="container content">
      <nav class="nav-bar d-flex align-items-center justify-content-between">
        <div class="logo my-3">
          <a href="/"><img src="@/assets/imgs/logo.png" alt="logo" /></a>
        </div>
        <div class="nav-links">
          <ul class="d-flex p-0 m-0">
            <li class="d-inline-block me-3">
              <a href="#" class="nav-link d-inline-block py-1 px-2 text-white active">Home</a>
            </li>
            <li class="d-inline-block me-3">
              <a href="#" class="nav-link d-inline-block py-1 px-2 text-white">About</a>
            </li>
            <li class="d-inline-block">
              <a href="#" class="nav-link d-inline-block py-1 px-2 text-white">Contact</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <div class="get-started d-none d-md-block">
      <a href="#filter"><img src="@/assets/imgs/getstarted.svg" /></a>
    </div>
    <div class="overlay"></div>
    <section class="hero-header mt-5 mt-md-0 text-center text-md-start">
      <div class="container">
        <div class="row align-items-center" style="min-height: 75vh">
          <div class="context col-md-6">
            <div class="big-title">
              <h1>Mentalome</h1>
            </div>
            <div class="title-caption">
              <span
                >Unveiling the Complex Landscape of Psychiatric Disorders through Comprehensive
                Transcriptome Analysis</span
              >
            </div>
            <div class="title-descrption">
              <p>
                Illuminating the Intricacies of Psychiatric Disorders: A Profound Exploration
                through Comprehensive Transcriptome Analysis. This study delves into the intricate
                molecular landscape of psychiatric disorders using an all-encompassing transcriptome
                analysis approach. By scrutinizing the vast network of gene expressions, it sheds
                light on the multifaceted mechanisms underlying these conditions.
              </p>
            </div>
            <a href="#filter" class="bouce-down d-md-none"
              ><svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="#ffffff" class="bi bi-arrow-up" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
    </svg>
            </a>
          </div>
          <div class="art col-md-6">
            <img
              src="@/assets/imgs/art.png"
              alt="Unveiling the Complex Landscape of
                                    Psychiatric
                                    Disorders through Comprehensive
                                    Transcriptome
                                    Analysis"
            />
          </div>
        </div>
      </div>
    </section>
  </header>
</template>
<script>
export default {}
</script>
<style scoped>
header {
  background-color: #33cc75;
  min-height: 100vh;
  position: relative;
  overflow: hidden;
}

header nav.nav-bar {
  position: relative;
  z-index: 1;
}

header .context {
  position: relative;
  z-index: 1;
}

header .get-started img {
  z-index: 2;
  position: absolute;
  bottom: -3px;
  left: 0;
  right: 0;
  width: 100vw;
  transition: 0.3s;
  transform-origin: bottom;
  transform: scaleY(0.5);
}

header .get-started:hover img {
  transform: scaleY(1.1);
  transform-origin: bottom;
}

header .get-started ~ .overlay {
  z-index: 1;
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  top: 0;
  width: 100vw;
  transition: 0.3s;
  opacity: 0;
  transform: scaleY(0);
  transform-origin: bottom;
  background: rgba(3, 24, 12, 0.357);
  backdrop-filter: blur(0.1rem);
  filter: blur(2px);
}

header .get-started:hover ~ .overlay {
  display: block;
  opacity: 1;
  transform: scaleY(1);
}

header .context .title-caption {
  color: #fff;
  font-weight: 100;
  margin-bottom: 2rem;
}

header .context .big-title h1 {
  color: #fff;
  font-size: 4rem;
  margin-bottom: 2rem;
  line-height: 2rem;
}

header .context .title-descrption {
  color: #fff;
  font-weight: 100;
  font-size: 1.2rem;
  margin-bottom: 2rem;
}

.art img {
  position: absolute;
  right: 0;
  bottom: 0;
  max-height: 95vh;
  max-width: 45vw;
}
.bouce-down {
  display: block;
  animation: bouceDown 3s infinite ease-in-out;
}

@keyframes bouceDown {
  from {
    transform: translateY(0px);
    opacity: 0;
  }
  to {
    transform: translateY(-25px);
    opacity: 1;
  }
}
</style>
