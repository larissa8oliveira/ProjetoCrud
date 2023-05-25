import { createRouter, createWebHistory } from 'vue-router';
import UserList from '../components/UserList.vue';
import UserCreate from '../components/UserCreate.vue';
import ProfileCreate from '../components/ProfileCreate.vue';
import AddressCreate from '../components/AddressCreate.vue';
import EditUserComponent from '../components/EditUserComponent.vue';
import ShowUser from '../components/ShowUser.vue';


const routes = [
  {
    path: '/',
    name: 'Home',
    component: UserList, 
  },
  {
    path: '/users',
    name: 'UserList',
    component: UserList,
  },
  {
    path: '/users/create',
    name: 'UserCreate',
    component: UserCreate,
  },
  {
    path: '/profiles/create',
    name: 'ProfileCreate',
    component: ProfileCreate,
  },
  {
    path: '/addresses/create',
    name: 'AddressCreate',
    component: AddressCreate,
  },
  {
    path: '/users/edit/:id',
    name: 'editUser',
    component: EditUserComponent,
  },
  {
    path: '/users/:id',
    name: 'showUser',
    component: ShowUser,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
