<template>
  <footer class="py-5">
    <div class="bg-overlay d-md-none"></div>
    <img src="@/assets/imgs/footer-bg.png" class="footer-bg d-md-block d-none" alt="" />
    <div class="container mt-md-5 pt-md-5">
      <div class="row align-items-centerr">
        <div class="col-md-auto text-center pt-md-5">
          <img src="@/assets/imgs/agc.png" alt />
        </div>
        <div class="col-md pt-5 text-center text-white">
          <div class="footer-title">
            <a href="/"><img src="@/assets/imgs/logo.png" alt="logo" /></a>
          </div>
          <div class="footer-caption fw-light small">
            <span
              >{{ year }} © Mentalome is freely avaliable for non-commercial use with proper
              citations.</span
            >
          </div>
          <div class="fw-bold small">
            <a class="nav-link" href="https://bioinformatics.um6p.ma">bioinformatics.um6p.ma</a>
          </div>
        </div>
        <div class="col-md-auto pt-5 text-center">
          <img src="@/assets/imgs/um6p.png" alt />
        </div>
      </div>
    </div>
  </footer>
</template>
<script>
export default {
  data: () => {
    return { year: new Date().getFullYear() }
  }
}
</script>
<style scoped>
footer {
  width: 100%;
  position: relative;
}
footer .footer-bg {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  z-index: -1;
  height: 100%;
  width: 100%;
}
footer .bg-overlay {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  z-index: -1;
  height: 100%;
  width: 100%;
  background-color: #33cc75;
}
</style>
