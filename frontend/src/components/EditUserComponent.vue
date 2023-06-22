<template>
  <div>
    <h1 class="page-title">Editar Usuário</h1>
    <div class="form-container">
      <form @submit.prevent="updateUser">
        <div class="form-group">
          <label for="name">Nome:</label>
          <input type="text" v-model="user.nome" id="name" class="form-control">
          <span v-if="errors.nome" class="error-message">{{ errors.nome[0] }}</span>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" v-model="user.email" id="email" class="form-control">
          <span v-if="errors.email" class="error-message">{{ errors.email[0] }}</span>
        </div>
        <div class="form-group">
          <label for="cpf">CPF:</label>
          <input type="text" v-model="user.cpf" id="cpf" class="form-control">
          <span v-if="errors.cpf" class="error-message">{{ errors.cpf[0] }}</span>
        </div>
        <div class="form-group">
          <label for="perfil">Perfil:</label>
          <select v-model="user.perfil_id" id="perfil" class="form-control">
            <option v-for="perfil in perfis" :key="perfil.id" :value="perfil.id">{{ perfil.name }}</option>
          </select>
          <span v-if="errors.perfil_id" class="error-message">{{ errors.perfil_id[0] }}</span>
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
      user: {
        nome: '',
        email: '',
        cpf: '',
        perfil_id: '',
      },
      perfis: [], 
      errors: {}, 
    };
  },
  mounted() {
    this.fetchPerfis();
    this.fetchUser();
  },
  methods: {
    fetchPerfis() {
      axios.get('http://localhost:8000/api/profiles')
        .then(response => {
          this.perfis = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    fetchUser() {
      const userId = this.$route.params.id;
      axios.get(`http://localhost:8000/api/users/${userId}`)
        .then(response => {
          this.user = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    updateUser() {
      const userId = this.$route.params.id;
      axios.put(`http://localhost:8000/api/users/${userId}`, this.user)
        .then(response => {          
          this.user = response.data;

          this.$router.push({ name: 'Home' });
        })
        .catch(error => {
          if (error.response && error.response.status === 422) {
            this.errors = error.response.data.errors;
          } else {
            console.error(error);
          }
        });
    },
  },
};
</script>
  
  <style scoped>
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

  
  .btn {
    display: inline-block;
    padding: 0.5rem 1rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    cursor: pointer;
    border: 1px solid transparent;
    border-radius: 4px;
    background-color: #007bff;
    color: #fff;
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
.error-message {
  color: red;
  font-size: 0.8rem;
  margin-top: 0.2rem;
}
  </style>
  