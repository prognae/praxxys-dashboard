<template>
    <form @submit="submitForm" enctype="multipart/form-data">
        <h5 class="mb-3 ">Product ID: {{ productId }} - {{ formData.name }}</h5>

        <!-- only display if it is the correct step -->
        <div class="step-1" v-if="currentStep == 1">
            <h3>Step 1</h3>
                <label for="name">Name <span style="color: red;">*</span></label>
                <input class="form-control" type="text" value placeholder="Name" name="name" v-model="formData.name" required id="name">
                <label for="category">Category <span style="color: red;">*</span></label>
                <select class="form-control form-select" name="category" v-model="formData.category" id="category" required aria-label="Select">
                    <option>Category 1</option>
                    <option>Category 2</option>
                    <option>Category 3</option>
                </select><br>
                <label for="summernote">Description <span style="color: red;">*</span></label>
                <textarea class="form-control" placeholder="Product Description" name="description" v-model="formData.description" id="description" cols="30" rows="8"></textarea> <br>
                <p v-if="validateStep1()" class="text-muted">Please fill-up all required fields</p>
                <button @click.prevent="updateStep(2)" :hidden="validateStep1()" class="btn btn-primary">Next</button>
        </div>

        <div class="step-2" v-if="currentStep == 2">
                <h3>Step 2</h3>
                <div class="current-images">
                    <img v-for="image in currentImages"  :src="'/images/' + image.file_name" alt="" style="height: 200px;">
                </div>
                <label for="formFileMultiple" class="form-label">Image Input</label>
                <input class="form-control py-1" type="file" name="images[]" id="formFileMultiple" @change="handleImages" accept="image/*" multiple>
                <p v-if="formData.imageValidationError != null" class="" style="color: red;">{{ formData.imageValidationError }}</p>
                <button @click.prevent="updateStep(1)" class="btn btn-primary">Back</button>
                <button @click.prevent="updateStep(3)" class="btn btn-primary">Next</button>
        </div>

        <div class="step-3" v-if="currentStep == 3">
                <h3>Step 3</h3>
                <label for="datetime" class="form-label">Date Input</label>
                <input class="form-control" type="datetime-local" v-model="formData.date_time" required id="datetime">
                <button @click.prevent="updateStep(2)" class="btn btn-primary">Back</button>
                <button type="submit" :hidden="formData.date_time == ''" class="btn btn-primary">Submit</button>
        </div>
    </form>
</template>

<script>
import axios from 'axios';

export default {
    props: ['productId'],
    data() {
      return {
            currentStep: 1,
            // initialize form data needed using v-model. this is what is sent as a request in axios
            formData: {
                name: '',
                category: '',
                description: '',
                imageValidationError: null,
                images: [],
                date_time: ''
            },
            currentImages: [],
            productResponse: null
        }
    },
    async mounted() {
        this.getProduct(); // initialize the data needed to populate the edit forms
    },
    components: {

    },
    methods: {
        async getProduct() {
            try{
                const product = await axios.get(`/api/products/${this.productId}`); // get request to retrieve product of a specific ID

                // display and set all data
                this.productResponse = product;
                this.formData.name = this.productResponse.data.product[0].name;
                this.formData.category = this.productResponse.data.product[0].category;
                this.formData.description = this.productResponse.data.product[0].description;
                this.formData.date_time = this.productResponse.data.product[0].date_and_time.replace(' ', 'T');
                this.currentImages = this.productResponse.data.images
            }
            catch(error) {
                console.error('Error fetching products:', error);
            }
        },
        updateStep(step) {
            // update the displayed set
            this.currentStep = step
        },
        handleImages(event) {
            const files = event.target.files;

            // image validation
            const validImageTypes = ['image/jpeg', 'image/png', 'image/gif']; // only images are allowed
            const maxFileSize = 5 * 1024 * 1024; // 5 MB in bytes is the set maximum size

            // check if there are invalid files and return a message.
            const invalidFiles = Array.from(files).filter((file) => {
                if (!validImageTypes.includes(file.type)) {
                this.formData.imageValidationError = 'Invalid file type(s) selected.';
                return true;
                }

                if (file.size > maxFileSize) {
                this.formData.imageValidationError = 'File size exceeds the limit (5 MB).';
                return true;
                }

                return false;
            });

            if (invalidFiles.length > 0) {
                // empty the file picker if there are invalid files.
                event.target.value = ''; 
                this.formData.images = [];
            } else {
                // set the files to the image variable
                this.formData.imageValidationError = null;
                this.formData.images = event.target.files;
            }

        },
        async submitForm(e) {
            e.preventDefault();
            const config = {
                    headers: { // required to enable file uploads
                        'content-type': 'multipart/form-data'
                    }
                };
            try {
                // post request to edit data in the database
                const responseSubmit = await axios.post(`/products/edit/${this.productId}`, this.formData, config);
                Swal.fire(
                            'Success!',
                            responseSubmit.data.message,
                            responseSubmit.data.status
                        ).then(function() {
                            location.reload()
                        });
            }
            catch (error) {
                console.error('Error fetching products:', error);
            }
        },
        validateStep1() {
            // check if all fields are populated
            if(!this.formData.name || !this.formData.category || !this.formData.description){
                return true
            }
            else if(this.formData.name || this.formData.category || this.formData.description) {
                return false
            }
        }
    }
  };
  </script>