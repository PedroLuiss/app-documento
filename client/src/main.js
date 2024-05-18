import { createApp,provide  } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import './assets/tailwind.css'
const globalVariable = 'Global Value';
createApp(App).provide('globalVariable', globalVariable).use(store).use(router).mount('#app')
