<template>
  <div>
    <h1 class="text-center">Users</h1>
    <section class="content">

      <div class="row margin-bottom-20">
        <div class="col-xs-12">
          <a href="#" class="btn btn-default" v-on:click="createUserFormVisible = true">Add user</a>
        </div>
      </div>

      <modal v-if="createUserFormVisible" v-on:close="createUserFormVisible = false">

        <h3 slot="header">Add new user</h3>

        <div slot="body" class="row">

          <div class="col-xs-12">
            <form v-on:submit.prevent="onSubmit" role="form">
              <div class="box-body">

                <div class="col-xs-6">
                  <div class="form-group row">
                    <label class="col-sm-4 control-label">Email address</label>
                    <div class="col-sm-8">
                      <input type="email" class="form-control input-sm" v-model="newUser.email" placeholder="Enter email">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 control-label">First name</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control input-sm" v-model="newUser.first_name" placeholder="Enter first name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 control-label">Last name</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control input-sm" v-model="newUser.last_name" placeholder="Enter last name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 control-label">Password</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control input-sm" v-model="newUser.password" placeholder="Enter password">
                    </div>
                  </div>
                </div>

                <div class="col-xs-6">
                  <div class="form-group row">
                    <label class="col-sm-4 control-label">Telephone</label>
                    <div class="col-sm-8">
                      <input type="tel" class="form-control input-sm" v-model="newUser.telephone" placeholder="Enter telephone">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 control-label">Private telephone</label>
                    <div class="col-sm-8">
                      <input type="tel" class="form-control input-sm" v-model="newUser.private_phone_number" placeholder="Enter private telephone">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 control-label">Job title</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control input-sm" v-model="newUser.job_title" placeholder="Enter job title">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 control-label">Key skill</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control input-sm" v-model="newUser.key_skill" placeholder="Enter key skill">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 control-label">Public key</label>
                    <div class="col-sm-8">
                      <textarea class="form-control input-sm" v-model="newUser.public_key" placeholder="Enter public key"></textarea>
                    </div>
                  </div>
                </div>

                <div class="col-xs-6">
                  <div class="form-group row">
                    <label class="col-sm-4 control-label">Photo</label>
                    <div class="col-sm-8">
                      <div v-if="!newUser.image">
                        <input type="file" class="form-control input-sm" @change="onFileChange">
                      </div>
                      <div v-else>
                        <img :src="newUser.image" class="img img-responsive" width="100" height="85"/>
                        <button v-on:click="removeImage">Remove image</button>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-xs-6">
                  <div class="form-group row">
                    <div class="col-xs-12">
                      <button class="btn btn-success pull-right">Submit</button>
                    </div>
                  </div>
                </div>
              </div>

            </form>
          </div>

        </div>
      </modal>

      <div class="row" v-if="users">
        <div class="col-md-4" v-for="user in users">
          <div v-bind:class="'box box-' + user.name">
            <div class="box-header with-border">
              <h3 class="box-title">{{user.email}}</h3>
            </div>
            <div class="box-body">
              <span>{{user.description}}</span>
            </div>
          </div>
        </div>
      </div>

    </section>
  </div>
</template>

<script>
  import {users} from '../../demo'
  import Modal from '../Modal.vue'

  export default {
    name: 'Users',
    components: {
      Modal
    },
    data () {
      return {
        users,
        createUserFormVisible: false,
        showModal: false,
        newUser: {
          first_name: '',
          last_name: '',
          email: '',
          password: '',
          image: '',
          phone_number: '',
          private_phone_number: '',
          job_title: '',
          key_skill: ''
        }
      }
    },
    created () {
      api.request('get', '/api/users').then(response => {
        this.users = response.data.users
      }).catch(error => {
        console.log(error)
        this.$notify({
          title: 'Error',
          type: 'error',
          text: error,
          duration: 10000
        })
      })
    },

    methods: {

      submitForm () {
        this.validationErrors = {}
        api.request('post', '/api/users/create', this.newUser).then(response => {
          if (response.data.errors) {
            let err = response.data.errors
            for (var i = 0; i < response.data.errors.length; i++) {
              this.validationErrors[err[i].field] = err[i].message
            }
            this.$forceUpdate()
          } else {
            if (response.data.status) {
              this.users.push(this.newUser)
              this.createUserFormVisible = false
              this.$notify({
                title: 'Info',
                type: 'success',
                text: 'User successfully added',
                duration: 10000
              })
            }
          }
        }).catch(error => {
          console.log(error)
          this.$notify({
            title: 'Error',
            type: 'error',
            text: 'An error occured',
            duration: 10000
          })
        })
      },
      onFileChange (e) {
        var files = e.target.files || e.dataTransfer.files
        if (!files.length) {
          return
        }
        this.createImage(files[0])
      },
      createImage (file) {
        // var image = new Image()
        var reader = new FileReader()
        var vm = this
        reader.onload = (e) => {
          vm.newUser.image = e.target.result
        }
        reader.readAsDataURL(file)
      },
      removeImage: function (e) {
        this.newUser.image = ''
      },

      closeModal () {
        this.createUserFormVisible = false
        this.newUser = {
          first_name: '',
          last_name: '',
          email: '',
          password: '',
          image: '',
          phone_number: '',
          private_phone_number: '',
          job_title: '',
          key_skill: ''
        }
      }
    }
  }
</script>

<style lang="scss">
  .margin-bottom-20 {
    margin-bottom: 20px;
  }
  .fade-enter-active, .fade-leave-active {
    transition: opacity .5s
  }
  .fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
    opacity: 0
  }
</style>
