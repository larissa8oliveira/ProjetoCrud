<template>
  <div class="user-details">
    <h1 class="page-title">Detalhes do Usuário</h1>

    <div v-if="user">
      <div class="user-info">
        <p><strong>Nome:</strong> {{ user.nome }}</p>
        <p><strong>Email:</strong> {{ user.email }}</p>
        <p><strong>CPF:</strong> {{ user.cpf }}</p>
        <p><strong>Data de Cadastro:</strong> {{ formatDate(user.created_at) }}</p>
        <p><strong>Perfil:</strong> {{ user.perfil ? user.perfil.name : 'N/A' }}</p>
      </div>
    </div>
    <div v-else>
      <p>Carregando...</p>
    </div>
    <router-link to="/users" class="btn btn-primary">Voltar</router-link>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      user: null
    };
  },
  mounted() {
    this.fetchUser();
  },
  methods: {
    fetchUser() {
      const userId = this.$route.params.id;
      axios.get(`http://localhost:8000/api/users/${userId}`)
        .then(response => {
          this.user = response.data;
          this.fetchPerfil();
        })
        .catch(error => {
          console.error(error);
        });
    },
    fetchPerfil() {
      const perfilId = this.user.perfil_id;
      axios.get(`http://localhost:8000/api/profiles/${perfilId}`)
        .then(response => {
          this.user.perfil = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    formatDate(dateTime) {
      const date = new Date(dateTime);
      const year = date.getFullYear();
      const month = String(date.getMonth() + 1).padStart(2, '0');
      const day = String(date.getDate()).padStart(2, '0');
      return `${day}/${month}/${year}`;
    }
  }
};
</script>

<style scoped>
.page-title {
  text-align: center;
  margin-top: 100px; 
  margin-bottom: 100px; 
}
.user-details {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f7f7f7;
  border-radius: 5px;
  margin-top: 150px;
}

.user-info {
  margin-bottom: 20px;
 
}

.btn {
  display: inline-block;
  padding: 10px 20px;
  font-size: 16px;
  font-weight: bold;
  text-decoration: none;
  background-color: #007bff;
  color: #fff;
  border-radius: 5px;
}

.btn:hover {
  background-color: #0056b3;
}
</style>
