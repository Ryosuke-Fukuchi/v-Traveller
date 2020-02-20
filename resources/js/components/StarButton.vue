<template>
    <div class="d-flex align-items-center">
      <i class="fas fa-lg fa-star pr-1" @click="giveStar" v-if='this.status'></i>
      <i class="far fa-lg fa-star pr-1" @click="giveStar" v-else></i>
      <p class="m-0" v-text="number"></p>
    </div>
</template>

<script>
    export default {

        props: ['postId', 'boolean', 'stars'],

        data: function(){
              return {
                 status: this.boolean,
              }
            },

        mounted() {
            console.log('Component mounted.')
        },

        methods: {
            giveStar(){
            axios.post('/star/' + this.postId).then(response => {
                  this.status = ! this.status;
                  if(this.status){
                    this.stars = Number(this.stars) + 1;
                  }else{
                    this.stars = Number(this.stars) - 1;
                  }
            }).catch(errors => {
                if(errors.response.status == 401){
                  window.location = '/login';
                }
            });
            }
        },

        computed: {
               number(){
                return this.stars;
              }
            },



    }
</script>
