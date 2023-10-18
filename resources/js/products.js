import { createApp, VueElement, ref } from 'vue/dist/vue.esm-bundler';
import ProductList from './components/ProductList.vue';
import ProductForm from './components/ProductForm.vue';
import ProductEditForm from './components/ProductEditForm.vue';


// createApp(ProductList).mount('#app');

createApp({
    components: {
        ProductList,
        ProductForm,
        ProductEditForm
    },
    props: ['products', 'test'],
    setup() {
      return {

      }
    }
  }).mount('#app')

