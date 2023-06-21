<template>
  <div>
    <h1 class="page-title">Cadastro de Usuário</h1>
    <div class="form-container">
      <form @submit.prevent="createUser">
        <div class="form-group">
          <label for="name">Nome:</label>
          <input type="text" v-model="userData.nome" id="name" required class="form-control">
          <div v-if="errors['nome']" class="error-message">{{ errors['nome'][0] }}</div>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" v-model="userData.email" id="email" required class="form-control">
          <div v-if="errors['email']" class="error-message">{{ errors['email'][0] }}</div>
        </div>
        <div class="form-group">
          <label for="cpf">CPF:</label>
          <input type="text" v-model="userData.cpf" id="cpf" required class="form-control">
          <div v-if="errors['cpf']" class="error-message">{{ errors['cpf'][0] }}</div>
        </div>
        <div class="form-group">
          <label for="perfil">Perfil:</label>
          <select v-model="userData.perfil_id" id="perfil" required>
            <option v-for="perfil in perfis" :value="perfil.id" :key="perfil.id">{{ perfil.name }}</option>
          </select>
          <div v-if="errors['perfil_id']" class="error-message">{{ errors['perfil_id'][0] }}</div>
        </div>
        <button type="submit" class="submit-button">Cadastrar</button>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      userData: {
        nome: '',
        email: '',
        cpf: '',
        perfil_id: null,
      },
      perfis: [],
      errors: {},
    };
  },
  mounted() {
    this.fetchPerfis();
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
    createUser() {
      axios.post('http://localhost:8000/api/users', this.userData)
        .then(response => {
          console.log(response);
          this.$router.push(`/users/${response.data.id}`);
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
.page-title {
  text-align: center;
  margin-top: 100px;
  margin-bottom: 100px;
}

.form-group {
  margin-bottom: 1rem;
  width: 500px;
}

.form-container {
  max-width: 500px;
  margin: 0 auto;
}

.form-control {
  width: 500px;
  padding: 0.5rem;
  font-size: 1rem;
  border-radius: 4px;
  border: 1px solid #ced4da;
}

select {
  width: 500px;
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

.error-message {
  color: red;
  font-size: 0.8rem;
  margin-top: 0.2rem;
}
</style>
