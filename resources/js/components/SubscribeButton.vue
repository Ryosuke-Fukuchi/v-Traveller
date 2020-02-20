<template>
    <div class="d-flex align-items-center justify-content-center">
      <i class="pr-2 fas fa-2x fa-hand-holding-heart" @click="subscribe" v-if="this.status" style="cursor: pointer;"></i>
      <i class="pr-2 far fa-2x fa-heart" @click="subscribe" v-else style="cursor: pointer;"></i>
      <p class="m-0 d-inline-block" @click="subscribe" :class="{subscribed: this.status}" v-text="buttonText" style="cursor: pointer;"></p>
    </div>
</template>

<script>
    export default {

        props: ['albumId', 'boolean'],

        data: function(){
              return {
                 status: this.boolean,
              }
            },

        mounted() {
            console.log('Component mounted.')
        },

        methods: {
            subscribe(){
            axios.post('/subscribe/' + this.albumId).then(response => {
                  this.status = ! this.status;
            }).catch(errors => {
                if(errors.response.status == 401){
                  window.location = '/login';
                }
            });
            }
        },

        computed: {
               buttonText(){
                return (this.status) ? '登録済み' : 'お気に入り登録';
              }
            },




    }
</script>
