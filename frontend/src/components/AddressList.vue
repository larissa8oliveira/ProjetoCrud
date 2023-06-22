<template>
  <div class="address-list">
    <h1 class="page-title">Lista de Endereços</h1>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Rua</th>
          <th>Cidade</th>
          <th>Estado</th>
          <th>CEP</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="address in addresses" :key="address.id">
          <td>{{ address.id }}</td>
          <td>{{ address.street }}</td>
          <td>{{ address.city }}</td>
          <td>{{ address.state }}</td>
          <td>{{ address.zip }}</td>
          <td>
            <router-link :to="{ name: 'editAddress', params: { id: address.id } }" class="btn btn-edit">Editar</router-link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      addresses: []
    };
  },
  mounted() {
    this.fetchAddresses();
  },
  methods: {
    fetchAddresses() {
      axios.get('http://localhost:8000/api/addresses')
        .then(response => {
          this.addresses = response.data;
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

.address-list table {
  width: 100%;
  border-collapse: collapse;
}

.address-list th,
.address-list td {
  padding: 10px;
  border: 1px solid #ddd;
}

.address-list th {
  background-color: #f5f5f5;
  text-align: left;
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
  margin-right: 5px;
}

.btn:hover {
  background-color: #0056b3;
}

.btn-edit {
  background-color: #007bff;
    color: #fff;
}
</style>
