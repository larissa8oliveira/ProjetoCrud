<template>
  <div>
    <h1 class="page-title">Cadastrar Perfil</h1>
  <div class="form-container">
    <form @submit.prevent="createProfile">
      <div class="form-group">
        <label for="name">Nome:</label>
        <input type="text" id="name" v-model="profile.name" required class="form-control">
      </div>
      <button class="submit-button" type="submit">Cadastrar</button>
    </form>
  </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      profile: {
        name: ''
      }
    };
  },
  methods: {
    createProfile() {
      axios.post('http://localhost:8000/api/profiles', this.profile)
        .then(response => {
          // Emite um evento para notificar que o perfil foi criado
          this.$emit('profile-created', response.data);
          this.profile = {
            name: ''
          };
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
  margin-bottom: 100px; 
}

/* Estilos do componente */
.form-group {
  margin-bottom: 1rem;
  width:500px;
  
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
</style>
