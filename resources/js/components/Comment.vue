<template>

<div>
  <div class="d-flex py-4">
    <div class="" style="width: 10%;">
      <a :href="this.profileUrl" class="text-dark"><img :src="this.imgSrc" class="rounded-circle w-100"></a>
    </div>
    <div class="px-3">
      <i id="addComment" class="far fa-3x fa-comment-dots" style="cursor: pointer;"></i>
      <div class="d-flex align-items-center">
        <textarea class="comment mr-2" v-model="comment" rows="3" cols="80" style="display: none;"></textarea>
        <i class="comment fas fa-2x fa-plus-circle" @click="addComment" style="display: none; cursor: pointer;"></i>
      </div>
    </div>
  </div>
  <div>
    <p class="text-danger" v-text="errorText"></p>
    <p class="text-danger" v-text="errorText2"></p>
  </div>
  <ul class="list-unstyled m-o p-0">
    <li class="border-bottom pt-4 pb-2" v-for="content in reverseItems">
      <div class="d-flex">
        <div class="" style="width: 10%;">
          <a :href="content[1]" class="text-dark"><img :src="content[2]" class="rounded-circle w-100"></a>
        </div>
        <div class="px-3" style="width: 90%;">
          <div class="font-weight-bold" v-text="name"></div>
          <div class="">{{ content[0] }}</div>
          <div class="text-right pt-2" v-text="postedTime"></div>
        </div>
      </div>
    </li>
  </ul>
</div>

</template>

<script>
    export default {

        props: ['profileUrl', 'imgSrc', 'albumId', 'userName'],

        data: function(){
              return {
                comment: '',
                contents: [],
                error: false,
                error2: false,
                time: '',
              }
            },

        mounted() {
            console.log('Component mounted.')
        },

        methods: {
            addComment(){
            if(!this.comment){
                this.error = true;
                this.error2 = false;
                return;
            }
            if(this.comment.length > 200){
                this.error2 = true;
                this.error = false;
                return;
            }
            var request = {'content': this.comment};
            var now = new Date();
            var Year = now.getFullYear();
            var Month = now.getMonth()+1;
            var Day = now.getDate();
            axios.post('/comment/' + this.albumId, request).then(response => {
                  this.contents.push([this.comment, this.profileUrl, this.imgSrc]);
                  this.comment = '';
                  this.error = false;
                  this.error2 = false;
                  this.time = Year + '-' + Month + '-' + Day;
            }).catch(function (error) {
            if(error.response){
              if(errors.response.status == 401){
                  window.location = '/login';
               }
                }
              });
            },
        },

        computed: {
               name() {
                 return this.userName;
                },
               postedTime() {
                 return this.time;
                },
               reverseItems() {
                 return this.contents.slice().reverse();
                },
               errorText(){
                return (this.error) ? 'コメントを入力してください。' : '';
                },
               errorText2(){
                return (this.error2) ? '文字数がオーバーしています。' : '';
                },
            },





    }
</script>
