<!-- resources/js/components/ProductTable.vue -->
<template>
    <div class="filters">
        <div class="dropdown">
            <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ category ? category: 'Category' }}
            </button>

            <!-- selection for category -->
            <ul class="dropdown-menu">
                <li><a @click.prevent="changeCategory('Category 1')" class="dropdown-item" href="#">Category 1</a></li>
                <li><a @click.prevent="changeCategory('Category 2')" class="dropdown-item" href="#">Category 2</a></li>
                <li><a @click.prevent="changeCategory('Category 3')" class="dropdown-item" href="#">Category 3</a></li>
            </ul>
        </div>      
        <a href="/products">
            <button class="reset-btn btn btn-primary">Reset</button>
        </a>  
        <form class="search-input" @submit.prevent="searchProducts">
            <input v-model="searchQuery" type="text" name="search" id="search" class="form-control  mx-0" autocomplete="on" placeholder="Search">
            <button class="btn btn-info" type="submit">Search</button>
        </form>        
        
    </div>
    <div>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Category</th>
                <th>Description</th>
                <th>Date and Time</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <!-- display all products -->
                <tr v-for="product in products1.data" :key="product.id">
                    <td>{{ product.id }}</td>
                    <td>{{ product.name }}</td>
                    <td>{{ product.category }}</td>
                    <td>{{ product.description }}</td>
                    <td>{{ product.date_and_time }}</td>
                    <td class="text-center">
                        <button class="btn btn-danger" @click.prevent="confirmDelete(product.id)" style="margin-right: 10px;"><i class='bx bx-trash'></i></button>
                        <a :href="'/products/edit/' + product.id"><button class="btn btn-info"><i class='bx bx-pencil'></i></button></a>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="card-list-footer">
            <Bootstrap5Pagination
                :data="products1"
                @pagination-change-page="list"
            />
            <a href="/products/create">
                <button class="btn btn-primary">Create Product</button>
            </a>
        </div>
        
    </div>
  </template>
  


  <script>
  import axios from 'axios';
  import { Bootstrap5Pagination } from 'laravel-vue-pagination';
  import { ref } from 'vue';
  

  export default {
    data() {
      return {
        isOpen: false,
        searchQuery: '',
        products1: {
            type: Object,
            default: null
        },
        category: '',
        products: [],
        pageNumber: 1
      };
    },
    async mounted() {
        this.list(); // initialize items
    },
    components: {
        Bootstrap5Pagination
    },
    methods: {
        toggleDropdown() {
            this.isOpen = !this.isOpen;
        },
        async searchProducts() {
            try {
                    // search api request
                    const response = await axios.get(`/api/products?category=${this.category}&search=${this.searchQuery}`);
                    this.products1 = response.data
                } catch (error) {
                    console.error('Error fetching products:', error);
                }
        },
        async list(page = 1) { // function to update the page
            this.pageNumber = page
            try {
                    const responsePage = await axios.get(`/api/products?category=${this.category}&search=${this.searchQuery}&page=${page}`);
                    this.products1 = responsePage.data
                } catch (error) {
                    console.error('Error fetching products:', error);
                }
        },
        confirmDelete(id) { // function to delete products

            // sweet alerts is used as alert handler
            Swal.fire({
                title: 'Are you sure?',
                text: 'Once deleted, this record cannot be recovered!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        const deletedResponse = await axios.delete(`/api/products/${id}`);
                        this.list(this.pageNumber)
                        Swal.fire(
                            'Success!',
                            deletedResponse.data.message,
                            'success'
                        );
                    } catch (error) {
                        console.error('Error fetching products:', error);
                    }
                }
            });
        },
        async changeCategory(category) { // function for filtering using category
            try {
                    const responseCategory = await axios.get(`/api/products?category=${category}&search=${this.searchQuery}`);
                    this.products1 = responseCategory.data
                    this.category = category;
                } catch (error) {
                    console.error('Error fetching products:', error);
                }
        }
        

            
    }
  };
  </script>

  