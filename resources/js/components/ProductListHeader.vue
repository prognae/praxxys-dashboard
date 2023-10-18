<template>
    <div class="filters">
      <a href="/products">
        <button class="btn btn-primary">Reset</button>
      </a>
      <form @submit.prevent="searchProducts">
        <input v-model="searchQuery" type="text" name="search" id="search" class="form-control mb-4 mx-0" autocomplete="on" placeholder="Search">
        <button type="submit">Search</button>
      </form>
  
      <div class="dropdown">
    <button @click="toggleDropdown" class="btn btn-primary">
      {{ isOpen ? 'Close Dropdown' : 'Open Dropdown' }}
    </button>
    <ul v-if="isOpen" class="dropdown-menu">
      <li><a href="#">Option 1</a></li>
      <li><a href="#">Option 2</a></li>
      <li><a href="#">Option 3</a></li>
    </ul>
  </div>
    </div>
  </template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      isOpen: false,
      searchQuery: '',
      searchedProducts: ''
    };
  },
  methods: {
    toggleDropdown() {
      this.isOpen = !this.isOpen;
    },
    async searchProducts() {
      try {
            const response = await axios.get(`/products?search=${this.searchQuery}`);
            this.searchedProducts = response.data
            this.$root.$emit('search_product', this.searchProducts);
        } catch (error) {
            console.error('Error fetching products:', error);
        }
    }
  },
};
</script>
  
  