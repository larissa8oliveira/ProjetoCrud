import { createRouter, createWebHistory } from 'vue-router';
import UserList from '../components/UserList.vue';
import UserCreate from '../components/UserCreate.vue';
import ProfileCreate from '../components/ProfileCreate.vue';
import AddressCreate from '../components/AddressCreate.vue';
import EditUserComponent from '../components/EditUserComponent.vue';
import ShowUser from '../components/ShowUser.vue';
import AddressList from '../components/AddressList.vue';
import EditAddressComponent from '../components/EditAddressComponent.vue'


const routes = [
  {
    path: '/addresses',
    name: 'AddressList',
    component: AddressList, 
  },
  {
    path: '/edit-address/:id',
    name: 'editAddress',
    component: EditAddressComponent
  },
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
  {
    path: '/users/search',
    name: 'UserLists',
    component:UserList ,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
