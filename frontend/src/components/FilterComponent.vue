<template>
  <div>
    <section class="filter py-5" id="filter" role="filter">
      <div class="container">
        <div class="title mb-5">
          <h2>
            <span class="fw-bold">Mentalome:</span>
            <span class="fw-normal">Heatmap statistics</span>
          </h2>
        </div>
        <div class="card p-3">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="gene_ids" class="form-label">Select gene ids:</label>
                <div class="badge-select">
                  <div
                    id="gene_ids"
                    class="form-control form-select d-flex input"
                    data-name="select-input"
                    @click="toggleListe($event)"
                  >
                    <div
                      class="badge bg-light shadow-sm d-inline-block"
                      v-for="id in filter.selectedGeneIds"
                    >
                      <span class="text content">{{ id }}</span>
                      <span class="close" @click="unSelectGeneId(id)">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          width="10"
                          height="10"
                          fill="currentColor"
                          class="bi bi-x-lg"
                          viewBox="0 0 16 16"
                        >
                          <path
                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"
                          />
                        </svg>
                      </span>
                    </div>
                  </div>
                  <div class="list card show" v-if="showList">
                    <input type="text" class="form-control search" v-model="geneIdsFilter" />
                    <div class="items">
                      <li class="nav-link" @click="selectGeneId(id)" v-for="id in filtredGenIds">
                        {{ id }}
                      </li>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="gene_ids" class="form-label">Select Disease:</label>
                <select id="gene_ids" v-model="filter.disease" class="form-control form-select">
                  <option v-bind:value="disease" v-for="disease in diseases">
                    {{ disease }}
                  </option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="gene_ids" class="form-label">Select Expriment:</label>
                <select id="gene_ids" class="form-control form-select" v-model="filter.expriment">
                  <option value="">All</option>
                  <option v-bind:value="expriment" v-for="expriment in expriments">
                    {{ expriment }}
                  </option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="gene_ids" class="form-label">Select SRA:</label>
                <select id="gene_ids" class="form-control form-select" v-model="filter.sra">
                  <option value="">All</option>
                  <option v-bind:value="sra" v-for="sra in sras">{{ sra }}</option>
                </select>
              </div>
            </div>
            <div class="col-md-12 text-center">
              <button @click="search()" class="btn btn-primary btn-lg px-5 shadow mb-3">
                Apply filter
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import apiClient from '../utils/api'
export default {
  data: () => {
    return {
      filter: {
        expriment: '',
        sra: '',
        disease: '',
        selectedGeneIds: ['A2ML1'],
        key: 1
      },
      geneIdsFilter: '',
      filtredGenIds: [],
      geneIds: '',
      expriments: '',
      sras: '',
      diseases: '',
      showList: false
    }
  },

  beforeCreate() {
    apiClient.get('/geneids').then((res) => {
      this.filtredGenIds = this.geneIds = [...new Set(res.data)]
      this.filter.selectedGeneIds = this.geneIds.slice(0, 10)
    })
    apiClient.get('/expriment').then((res) => {
      this.expriments = [...new Set(res.data)]
    })
    apiClient.get('/sra').then((res) => {
      this.sras = [...new Set(res.data)]
    })
    apiClient.get('/disease').then((res) => {
      this.diseases = [...new Set(res.data)]
      // display the first value in the input
      if (this.diseases.length > 0) {
        this.filter.disease = this.diseases[0]
      }
    })
  },

  mounted() {
    setTimeout(() => {
      this.search()
    }, 1500)
  },

  watch: {
    geneIdsFilter(keyword) {
      this.filterGeneIds(keyword)
    }
  },

  methods: {
    selectGeneId: function (id) {
      if (!this.filter.selectedGeneIds.includes(id)) {
        this.filter.selectedGeneIds.push(id)
      }
      this.showList = false
    },

    unSelectGeneId: function (id) {
      this.filter.selectedGeneIds = this.filter.selectedGeneIds.filter((e) => {
        return e != id
      })
    },
    toggleListe: function (e) {
      if (e.target.dataset.name == 'select-input') this.showList = !this.showList
    },
    search: function () {
      // define the SRA and expriment value to null if "All" option is selected
      if (this.filter.sra === 'All') {
        this.filter.sra = null
      }
      if (this.filter.expriment === 'All') {
        this.filter.expriment = null
      }
      this.$emit('filterData', {
        gene_ids: this.filter.selectedGeneIds.join(','),
        disease: this.filter.disease,
        expriment: this.filter.expriment,
        sra: this.filter.sra,
        key: ++this.filter.key
      })
    },
    // search about geneids
    filterGeneIds: function (keyword) {
      this.filtredGenIds = this.geneIds.filter((e) => {
        return e.toLowerCase().includes(keyword.toLowerCase())
      })
    }
  }
}
</script>
<style scoped>
.filter .title {
  color: #33cc75;
}

.filter .card label {
  color: #33cc75;
}

.filter .card .form-control {
  padding: 0.9rem 2.25rem 0.9rem 1rem;
}

.badge-select {
  position: relative;
}

.badge-select .input {
  padding: 0.9rem 2.25rem 0.9rem 1rem;
  flex-wrap: wrap;
}

.badge-select .badge {
  padding: 0.5rem;
  color: #000;
  font-size: 1rem;
  margin: 0.5rem;
}

.badge-select .badge .close {
  cursor: pointer;
  margin: 0.1rem;
  margin-left: 0.5rem;
}

.badge-select .list {
  height: 0;
  overflow: hidden;
  padding: 1rem;
  padding-top: 0;
  padding-bottom: 0;
  position: absolute;
  z-index: 1;
  top: calc(100% + 0.5rem);
  width: 100%;
  transition: 0.3s;
}

.badge-select .list.show {
  height: auto;
  padding: 1rem;
}

.badge-select .list li {
  padding: 0.3rem;
  cursor: pointer;
  border-bottom: 1px solid #33cc7538;
}

.badge-select .list li:last-child {
  border: none;
}

.badge-select .list .items {
  max-height: 150px;
  overflow-y: auto;
}
</style>
