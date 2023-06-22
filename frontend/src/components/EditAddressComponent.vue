<template>
  <div>
    <h1 class="page-title">Editar Endereço</h1>
    <div class="form-container">
      <form @submit.prevent="updateAddress">
        <div class="form-group">
          <label for="street">Rua:</label>
          <input type="text" id="street" v-model="address.street" required class="form-control">
        </div>
        <div class="form-group">
          <label for="city">Cidade:</label>
          <input type="text" id="city" v-model="address.city" required class="form-control">
        </div>
        <div class="form-group">
          <label for="state">Estado:</label>
          <input type="text" id="state" v-model="address.state" required class="form-control">
        </div>
        <div class="form-group">
          <label for="zip">CEP:</label>
          <input type="text" id="zip" v-model="address.zip" required class="form-control">
        </div>
        <button type="submit" class="submit-button">Atualizar</button>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      address: {
        street: '',
        city: '',
        state: '',
        zip: ''
      }
    };
  },
  created() {
    const addressId = this.$route.params.id;
    this.fetchAddress(addressId);
  },
  methods: {
    fetchAddress(addressId) {
      axios.get(`http://localhost:8000/api/addresses/${addressId}`)
        .then(response => {
          this.address = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    updateAddress() {
      const addressId = this.$route.params.id;
      axios.put(`http://localhost:8000/api/addresses/${addressId}`, this.address)
        .then(response => {
          console.log('Endereço atualizado:', response.data);
          this.$router.push('/addresses');
        })
        .catch(error => {
          console.error(error);
        });
    }
  }
};
</script>

<style scoped>
.page-title {
  text-align: center;
  margin-top: 100px;
  margin-bottom: 50px;
}

.form-container {
  max-width: 500px;
  margin: 0 auto;
}

.form-group {
  margin-bottom: 1rem;
}

.form-control {
  width: 100%;
  padding: 0.5rem;
  font-size: 1rem;
  border-radius: 4px;
  border: 1px solid #ced4da;
}

.submit-button {
  background-color: green; 
  color: white;
  font-size: 20px; 
  padding: 10px 20px; 
  border-radius: 4px;
  border: none;
  cursor: pointer;
  display: block;
  margin: 20px auto;
}
</style>
