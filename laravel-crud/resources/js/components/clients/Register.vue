<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Register</div>
          <div class="card-body">
            <form @submit.prevent="registerUser">
              <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
                <div class="col-md-6">
                  <input id="name" type="text" class="form-control" v-model="name" required autofocus>
                  
                </div>
              </div>
              <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>
                <div class="col-md-6">
                  <input id="email" type="email" class="form-control" v-model="email" required>
                 
                </div>
              </div>
              <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
                <div class="col-md-6">
                  <input id="password" type="password" class="form-control" v-model="password" required>
                 
                </div>
              </div>
              <div class="row mb-3">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirm Password</label>
                <div class="col-md-6">
                  <input id="password-confirm" type="password" class="form-control" v-model="passwordConfirmation" required>
                </div>
              </div>
              <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">Register</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

export default {
  data() {
    return {
      name: '',
      email: '',
      password: '',
      passwordConfirmation: '',
      errors: {},
    }
  },
  methods: {
    registerUser() {
      axios.post('/api/register', {
        name: this.name,
        email: this.email,
        password: this.password,
        password_confirmation: this.passwordConfirmation,
      }).then(response => {
        // Handle success
        console.log(response.data);
      }).catch(error => {
        // Handle error
        this.errors = error.response.data.errors;
      });
    },
  },
}
</script>
