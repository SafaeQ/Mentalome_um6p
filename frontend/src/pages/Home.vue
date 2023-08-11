<template>
  <NavBar />
  <Card @filterData="getHeatMapdata" />
  <CardHeatmap :filterObj="filter" />
  <Footer />
</template>
<script>
import Card from '@/components/Card.vue'
import NavBar from '@/components/NavBar.vue'
import Footer from '@/components/Footer.vue'
import CardHeatmap from '@/components/CardHeatmap.vue'
export default {
  components: {
    NavBar,
    Card,
    CardHeatmap,
    Footer
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
