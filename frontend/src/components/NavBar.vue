<script>
import { RouterLink } from 'vue-router'
export default {
  methods: {
    navigateTo(route) {
      this.$router.push(route)
    }
  }
}
</script>

<template>
  <div>
    <header class="navbar">
      <div class="inner">
        <img alt="Vue logo" class="logo" src="@/assets/Heatmap.bae7c276.svg" />
        <nav>
          <RouterLink to="/" exact class="nav-link" active-class="active">Home</RouterLink>
        </nav>
      </div>
    </header>
    <div class="main">
      <div class="title">
        <h2>Mentalome</h2>
        <p>
          Unveiling the Complex Landscape of Psychiatric Disorders through Comprehensive
          Transcriptome Analysis
        </p>
      </div>
    </div>
  </div>
</template>

<style scoped>
.navbar {
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #364a60;
  box-shadow: rgba(100, 100, 111, 0.338) 0px 7px 29px 0px;
  color: #fff;
  padding: 1rem;
}

.inner {
  width: 50%;
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  margin: auto;
}
nav {
  height: auto;
  color: #fff;
}

.nav-link {
  text-decoration: none;
  color: #f5f5f5;
  font-weight: bold;
  margin-right: 20px;
}
.logo {
  width: 100px;
  margin-right: auto;
}
.main {
  background-color: #fff;
  margin: auto;
  height: 245px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  width: auto;
}

.title {
  color: #0b0101;
  font-weight: bold;
  font-size: larger;
  padding: 1rem;
  text-align: center;
  align-self: center;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

@media (min-width: 768px) {
  .navbar {
    display: flex;
    justify-content: space-between;
  }

  .logo {
    width: 100px;
  }
}

@media (max-width: 767px) {
  .logo {
    width: 80px;
    margin: 0 auto;
    display: block;
    margin-bottom: 1rem;
  }
}
</style>
