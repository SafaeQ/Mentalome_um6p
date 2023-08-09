<template>
  <div class="card_0">
    <h3 class="card-title">Mentalome</h3>
    <div class="form">
      <div class="row">
        <div class="col-12 mb-md-3">
          <div class="form-input">
            <label for="name">Select gene ids:</label>
            <div class="select-with-tags">
              <div
                for="gender"
                data-name="select-input"
                class="form-control input"
                @click="toggleListe($event)"
              >
                <span class="tags" v-for="id in filter.selectedGeneIds">
                  <span class="content">{{ id }}</span>
                  <span class="close" @click="unSelectGeneId(id)">x</span>
                </span>
              </div>
              <div id="gender" class="liste" v-if="showList">
                <ul>
                  <li @click="selectGeneId(id)" v-for="id in geneIds">{{ id }}</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-md-3">
          <div class="form-input">
            <label for="name">Select Disease:</label>
            <select id="gender" v-model="filter.disease" class="form-control form-select">
              <option v-bind:value="disease" v-for="disease in diseases">{{ disease }}</option>
            </select>
          </div>
        </div>
        <div class="col-md-4 mb-md-3">
          <div class="form-input">
            <label for="name">Select Expriment:</label>
            <select id="gender" v-model="filter.expriment" class="form-control form-select">
              <option value="">All</option>
              <option v-bind:value="expriment" v-for="expriment in expriments">
                {{ expriment }}
              </option>
            </select>
          </div>
        </div>
        <div class="col-md-4 mb-md-3">
          <div class="form-input">
            <label for="name">Select SRA:</label>
            <select id="gender" v-model="filter.sra" class="form-control form-select">
              <option value="">All</option>
              <option v-bind:value="sra" v-for="sra in sras">{{ sra }}</option>
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="btn-select">
      <button class="btn btn-dark px-5" @click="search()">Select</button>
    </div>
  </div>
</template>

<script>
import apiClient from '../utils/api'
export default {
  props: {
    image: {
      type: String,
      required: true
    },
    title: {
      type: String,
      required: true
    },
    description: {
      type: String,
      required: true
    }
  },

  data: () => {
    return {
      filter: {
        expriment: '',
        sra: '',
        disease: '',
        selectedGeneIds: []
      },
      geneIds: '',
      expriments: '',
      sras: '',
      diseases: '',
      showList: false
    }
  },

  beforeCreate() {
    apiClient.get('/geneids').then((res) => {
      this.geneIds = [...new Set(res.data)]
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

      apiClient
        .post('/get-chart-data', {
          gene_ids: this.filter.selectedGeneIds.join(','),
          disease: this.filter.disease,
          expriment: this.filter.expriment,
          sra: this.filter.sra
        })
        .then((res) => {
          console.log('res', res)
        })
    }
  }
}
</script>

<style>
.card-title {
  color: #262626;
  font-size: 1.5em;
  line-height: normal;
  font-weight: 700;
  margin-bottom: 3em;
  justify-content: center;
  display: flex;
}

.card_0 {
  display: block;
  position: relative;
  max-width: auto;
  height: auto;
  background-color: #ffffff;
  border-radius: 10px;
  padding: 2em 1.2em;
  margin: 12px;
  text-decoration: none;
  z-index: 0;
  overflow: hidden;
  background: linear-gradient(to bottom, #fefefe, #ffffff);
  font-family: Arial, Helvetica, sans-serif;
  box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
  margin-left: 38px;
  margin-right: 38px;
  align-items: center;
}

.card_0:before {
  content: '';
  position: absolute;
  z-index: -1;
  top: -31px;
  right: -16px;
  background: linear-gradient(135deg, #364a60, #384c6c);
  height: 32px;
  width: 32px;
  border-radius: 32px;
  transform: scale(1);
  transform-origin: 50% 50%;
  transition: transform 0.35s ease-out;
}

.card_0:hover:before {
  transform: scale(28);
}

.card_0:hover .small-desc {
  transition: all 0.5s ease-out;
  color: rgba(255, 255, 255, 0.8);
}

.form {
  display: flex;
  flex-direction: column;
  justify-content: center;
  margin: 23px;
  /* min-height: 140px; */
  color: #615f5f;
}

.button {
  background-color: #ffffff00;
  color: #0b0b0b;
  width: 8.5em;
  height: 2.9em;
  border: #364a60 0.2em solid;
  border-radius: 11px;
  text-align: center;
  transition: all 0.6s ease;
  margin-top: 3em;
}

.button:hover {
  background-color: #364a60;
  cursor: pointer;
  color: #ffffff;
}
.btn-select {
  display: flex;
  justify-content: center;
  margin-top: 4%;
}

.form-control {
  width: 100%;
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: #fff;
  justify-content: center;
  display: flex;
  align-items: center;
  align-self: center;
}

.form select {
  width: 100%;
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: #fff;
  justify-content: center;
  display: flex;
  align-items: center;
  align-self: center;
}
.form select:focus {
  outline: none;
  border-color: #007bff;
  box-shadow: 0 0 0 2px #b3d4fc;
}

.form label {
  font-weight: bold;
}

.tags {
  background: #eee;
  border-radius: 8px;
  padding: 4px;
  font-size: 0.7rem;
  font-weight: bold;
  margin-left: 0;
  margin-right: 0.5rem;
  margin-bottom: 0.5rem;
  box-shadow: 0px 1px 3px #0000004a;
}
.tags .close {
  padding: 3px;
  font-size: 1rem;
  font-weight: bold;
}

.select-with-tags {
  position: relative;
}
.select-with-tags .liste {
  height: 200px;
  background: #fff;
  border: 1px solid;
  border-radius: 8px;
  position: absolute;
  width: 100%;
  top: 105%;
  overflow-x: hidden;
  overflow-y: auto;
}

.select-with-tags .input {
  justify-content: flex-start;
  flex-wrap: wrap;
  min-height: 45px;
}
.select-with-tags .liste ul {
  list-style: none;
  padding: 0;
}

.select-with-tags .liste ul li {
  padding: 0.2rem 0.5rem;
}
.select-with-tags .liste ul li:hover {
  background-color: #0d6efd;
  color: #fff;
}

/* Styles for smaller screens  mobile */
@media (max-width: 767px) {
  .form {
    margin: 10px;
    /* height: auto; */
  }

  .form-input {
    margin-bottom: 20px;
  }
}

@media (min-width: 768px) {
  .form {
    margin: 23px;
    /* height: 140px; */
  }
}
</style>
