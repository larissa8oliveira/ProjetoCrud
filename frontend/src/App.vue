<template>
  <div id="app">
    <nav class="navbar">
      <div class="navbar-links">
        <router-link to="/users">Usuários</router-link>
        <span class="navbar-space"></span> <!-- Espaço entre os itens -->
        <router-link to="/users/create">Cadastrar Usuário</router-link>
        <span class="navbar-space"></span> <!-- Espaço entre os itens -->
        <router-link to="/profiles/create">Cadastrar Perfil</router-link>
        <span class="navbar-space"></span> <!-- Espaço entre os itens -->
        <router-link to="/addresses/create">Cadastrar Endereço</router-link>
      </div>
    </nav>
    <router-view />
  </div>
</template>

<style>
#app {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
  padding: 0;
  background-color: white;
  color: #333;
}

.navbar {
  background-color: #e8f4e5;
  padding: 20px;
  width: 100%;
  position: fixed;
  top: 0;
  left: 0;
}

.navbar-links {
  display: flex;
  justify-content: center;
}

.navbar-links router-link {
  text-decoration: none;
  color: #333;
  padding: 5px 10px;
  border-radius: 3px;
  background-color: #c4dfc1;
}

.navbar-space {
  margin-right: 10px; /* Espaçamento entre os itens */
}

.router-view {
  margin-top: 60px;
}
</style>
