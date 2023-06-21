<template>
    <div>
        <h1 class="page-title">Lista de Usuários</h1>
  <div class="form-container">
    <form @submit.prevent="fetchUsers">
      <div class="form-group">
        <label for="name_search">Nome:</label>
        <input class="form-control" type="text" v-model="searchTerm" id="search">
      </div>
      <div class="form-group">
        <label for="cpf">CPF:</label>
        <input class="form-control" type="text" v-model="cpfSearchTerm" id="cpf">
      </div>
      <div class="form-group">
        <label  for="created"> Data de Cadastro:</label>
        <input class="form-control" type="date" v-model="createdSearchTerm" id="created">
      </div>
      <button type="submit" class="submit-button">Buscar</button>
    </form>
 </div>
      <div class="table-container">
        <table class="table table-striped table-lg">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Email</th>
              <th>CPF</th>
              <th>Data de Cadastro</th>
              <th>Perfil</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in users" :key="user.id">
              <td>{{ user.nome }}</td>
              <td>{{ user.email }}</td>
              <td>{{ user.cpf }}</td>
              <td>{{ formatDate(user.created_at) }}</td>
              <td>{{ getProfileName(user.perfil_id) }}</td>
              <td>
                <div class="action-buttons">
                  <router-link :to="{ name: 'showUser', params: { id: user.id } }" class="btn btn-details">Detalhar</router-link>
                  <router-link :to="{ name: 'editUser', params: { id: user.id } }" class="btn btn-edit">Editar</router-link>
                  <button @click="deleteUser(user)" class="btn btn-delete">Excluir</button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div v-if="users.length === 0">
        <p>Nenhum usuário cadastrado.</p>
        <button @click="goToCreateUser" class="btn btn-success">Cadastrar Usuário</button>
      </div>
      <div v-if="errorMessage" class="alert alert-danger">
        {{ errorMessage }}
      </div>
      <div v-if="successMessage" class="alert alert-success">
        {{ successMessage }}
      </div>
  </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        users: [],
        searchTerm: '',
        errorMessage: '',
        successMessage: '',
        profiles: {},
      };
    },
    mounted() {
      this.fetchUsers();
    },
    methods: {
      fetchUsers() {
    const params = {};

    if (this.searchTerm) {
      params.nome = this.searchTerm;
    }

    if (this.cpfSearchTerm) {
      params.cpf = this.cpfSearchTerm;
    }

    if (this.createdSearchTerm) {
      params.periodo = {
        start: this.createdSearchTerm,
        end: this.createdSearchTerm
      };
    }

    axios.get('http://localhost:8000/api/users/', {
      params: params
    })
      .then(response => {
        this.users = response.data;
        this.fetchProfiles();
      })
      .catch(error => {
        this.errorMessage = 'Ocorreu um erro ao buscar os usuários.';
        console.error(error);
      })
      .catch(error => {
        console.error(error);
      });
  },
      fetchProfiles() {
        axios.get('http://localhost:8000/api/profiles')
          .then(response => {
            const profiles = response.data;
            profiles.forEach(profile => {
              this.profiles[profile.id] = profile.name;
            });
          })
          .catch(error => {
            console.error(error);
          });
      },
      deleteUser(user) {
        axios.delete(`http://localhost:8000/api/users/${user.id}`)
          .then(response => {
            // Remova o usuário excluído da lista
            this.users = this.users.filter(u => u.id !== user.id);
            this.successMessage = 'Usuário excluído com sucesso.';
          })
          .catch(error => {
            this.errorMessage = 'Ocorreu um erro ao excluir o usuário.';
            console.error(error);
          });
      },
      goToCreateUser() {
        // Redirecionar para a página de cadastro de usuário
        this.$router.push('/users/create');
      },
      formatDate(dateTime) {
        const date = new Date(dateTime);
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${day}/${month}/${year}`;
      },
      getProfileName(profileId) {
        return this.profiles[profileId] || 'Perfil desconhecido';
      },
    },
  };
  </script>
  <style>
 .page-title {
  text-align: center;
  margin-top: 100px;
  margin-bottom: 20px;
}
.form-container {
  display: flex;
  flex-direction: row;
  justify-content: center;
  width: 1000px;
  margin: 0 auto;
}

.form-group {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  margin-right: 10px;
}

.form-control {
  width: 200px;
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
 
  .table {
    width: 100%;
    border-collapse: collapse;
  }
  
  .table th,
  .table td {
    padding: 0.75rem;
    border-top: 1px solid #dee2e6;
  }
  
  .table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
  }
  
  .table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0, 0, 0, 0.05);
  }
  
  .table-striped tbody tr:nth-of-type(even) {
    background-color: rgba(0, 0, 0, 0);
  }
  
  
  .table-container {
    width: 100%;
    overflow-x: auto;
  }
  
  .btn {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    text-decoration: none;
    border-radius: 5px;
    cursor: pointer;
  }
  
  .btn-edit {
    background-color: #007bff;
    color: #fff;
  }
  
  .btn-details {
    background-color: #35dc59;
    color: #fff;
  }
  
  .btn-delete {
    background-color: #dc3545;
    color: #fff;
  }
  
  .btn-success {
    background-color: #28a745;
    color: #fff;
  }
  
  .alert {
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
  }
  
  .alert-danger {
    background-color: #f8d7da;
    color: #721c24;
  }
  
  .alert-success {
    background-color: #d4edda;
    color: #155724;
  }
  
  .action-buttons {
    display: flex;
    gap: 10px;
  }
  </style>
  