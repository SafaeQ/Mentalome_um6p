<template>
  <div>
    <HeaderComponent />
    <main>
      <FilterComponent @filterData="getHeatMapdata" />
      <HeatMapComponent :filterObj="filter" />
    </main>
      <FooterComponent />
  </div>
</template>
<script>
import HeaderComponent from '@/components/HeaderComponent.vue'
import FilterComponent from '@/components/FilterComponent.vue'
import HeatMapComponent from '@/components/HeatMapComponent.vue'
import FooterComponent from '@/components/FooterComponent.vue'
export default {
  components: {
    HeaderComponent,
    FilterComponent,
    HeatMapComponent,
    FooterComponent
  },
  data: () => {
    return {
      filter: {}
    }
  },
  methods: {
    getHeatMapdata: function (data) {
      this.filter = data
    }
  }
}
</script>
<style></style>
