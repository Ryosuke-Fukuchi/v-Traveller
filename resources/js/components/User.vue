<template>
<div>
  <div class="offset-4">
    <i class="fas fa-lg fa-search pr-2"></i><input type="text" v-model="keyword">
  </div>
  <div class="row my-5">
    <div class="offset-4">
      <ul class="list-unstyled">
        <li class="d-flex align-items-center py-2" v-for="user in filteredUsers">
          <div class="pr-3">
            <a class="" :href="'/profile/' + user.id"><img :src="'/storage/' + user.image" class="rounded-circle w-100" style="max-width: 60px;"></a>
          </div>
          <div class="">
            <a class="h4 font-weight-bold text-dark" :href="'/profile/' + user.id">{{ user.traveller_name }}</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
</template>

<script>
    export default {

        data(){
            return {
                keyword: '',
                users: []
            }
        },

        mounted() {
            axios.get('/users/search').then(response => this.users = response.data);
        },

        computed: {
            filteredUsers: function() {
              var filteredUsers = [];
              for(var i in this.users) {
                    var user = this.users[i];
                    if(user.traveller_name.indexOf(this.keyword) !== -1) {                      filteredUsers.push(user);
                  }
              }
              return filteredUsers;
            }
        },

    }
</script>
