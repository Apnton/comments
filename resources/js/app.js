import './bootstrap';
import App from './App.vue';
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import components from "@/components/UI";

const app = createApp(App);
const pinia = createPinia()


components.forEach(component => {
    app.component(component.name, component.component)
})

app
    .use(pinia)
    .mount('#app')

