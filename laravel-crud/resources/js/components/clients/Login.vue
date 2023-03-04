<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Login</div>

          <div class="card-body">
            <form @submit.prevent="login">
              <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>

                <div class="col-md-6">
                  <input id="email" type="email" class="form-control" v-model="email" required autofocus>

                  <span v-if="errors.email" class="invalid-feedback" role="alert">
                    <strong>{{ errors.email[0] }}</strong>
                  </span>
                </div>
              </div>

              <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                <div class="col-md-6">
                  <input id="password" type="password" class="form-control" v-model="password" required>

                  <span v-if="errors.password" class="invalid-feedback" role="alert">
                    <strong>{{ errors.password[0] }}</strong>
                  </span>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-6 offset-md-4">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember" v-model="remember">

                    <label class="form-check-label" for="remember">
                      Remember Me
                    </label>
                  </div>
                </div>
              </div>

              <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    Login
                  </button>

                  <a v-if="forgotPassword" class="btn btn-link" href="{{ route('password.request') }}">
                    Forgot Your Password?
                  </a>
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

export default {
  data() {
    return {
      email: '',
      password: '',
      remember: false,
      errors: {},
      forgotPassword: false,
    };
  },

  methods: {
    login() {
      axios.post('/api/login', {
        email: this.email,
        password: this.password,
        remember: this.remember,
      })
      .then(response => {
        console.log(response);
        this.$router.push({name:"clientList"})
      })
      .catch(error => {
        if (error.response.status === 422) {
          this.errors = error.response.data.errors;
        } else if (error.response.status === 401) {
          // Handle incorrect login credentials
        } else if (error.response.status === 419) {
          // Handle expired CSRF token
        } else {
          // Handle other errors
        }
      });
    },
  },
};
</script>