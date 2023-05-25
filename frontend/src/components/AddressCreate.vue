<template>
    <div>
      <h1 class="page-title">Cadastrar Endereço</h1>
      <div class="form-container">
      <form @submit.prevent="createAddress">
     
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
          <button type="submit"  class="submit-button">Cadastrar</button>
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
    methods: {
      createAddress() {
        // Faz a requisição HTTP para criar o endereço
        axios.post('http://localhost:8000/api/addresses', this.address)
          .then(response => {
            // Emite um evento para notificar o componente pai sobre a criação do endereço
            this.$emit('address-created', response.data);
  
            // Limpa o formulário
            this.address = {
              street: '',
              city: '',
              state: '',
              zip: ''
            };
          })
          .catch(error => {
            // Lida com erros de requisição
            console.error(error);
          });
      }
    }
  };
  </script>
  
  <style scoped>
  /* Estilos do componente */
  .form-group {
    margin-bottom: 1rem;
  }
  
  .form-control {
    width: 500px;
    padding: 0.5rem;
    font-size: 1rem;
    border-radius: 4px;
    border: 1px solid #ced4da;
  }
  .page-title {
  text-align: center;
  margin-top: 100px; 
  margin-bottom: 100px;
}

  .form-container {
  max-width: 500px; 
  margin: 0 auto; 
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
  