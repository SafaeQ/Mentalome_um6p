<template>
  <div></div>
  <footer class="footer">
    <div class="footer-content">
      <div class="footer-image">
        <img src="@/assets/agc_logo.png" alt="Footer Logo" />
      </div>

      <div class="footer-text">
        <img
          style="height: auto; max-width: 100px; align-self: center"
          src="@/assets/Heatmap.bae7c276.svg"
          alt="Footer Logo"
        />
        <p>2023 © Mentalome is freely avaliable for non-commercial use with proper citations.</p>
        <div>
          <a href="https://bioinformatics.um6p.ma/" target="_parent">bioinformatics.um6p.ma</a>
        </div>
      </div>

      <div class="footer-image ump">
        <img src="@/assets/um6p_logo.png" alt="Footer Logo" />
      </div>
    </div>
  </footer>
</template>

<style scoped>
.footer {
  background-color: #0e0e0e;
  color: #fff;
  padding: 2rem;
  position: relative;
}

.footer-content {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  justify-content: space-between;
  align-items: center;
}

.footer-text {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  width: auto;
}

.footer-text p {
  font-size: 0.9rem;
}

.footer-image img {
  max-width: 100px;
  height: auto;
  margin: auto;
  display: flex;
}

/* Media Queries for Responsiveness */

/* Smaller screens (e.g., mobile) */
@media (max-width: 767px) {
  .footer-content {
    grid-template-columns: 1fr;
    grid-template-rows: 1fr 1fr 1fr;
    text-align: center;
    gap: 30px;
  }

  .footer-text {
    order: 2;
  }

  .footer-image {
    order: 1;
  }
  .footer-image.ump {
    order: 3;
  }
}

/* Medium-sized screens (e.g., tablets) */
@media (min-width: 768px) and (max-width: 1023px) {
  .footer-content {
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    text-align: center;
  }

  .footer-text {
    order: 2;
  }

  .footer-image {
    order: 1;
  }
}
</style>
