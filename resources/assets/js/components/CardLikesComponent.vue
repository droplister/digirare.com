<template>
  <span class="pull-right">
    <i class="fa text-success" v-bind:class="up" v-on:click="$_like"></i> {{ likes }} &nbsp;
    <i class="fa text-danger" v-bind:class="down" v-on:click="$_dislike"></i> {{ dislikes }}
  </span>
</template>

<script>

export default {
  props: ['card', 'likes', 'dislikes'],
  data() {
    return {
      liked: false,
      disliked: false,
    }
  },
  computed: {
    up() {
      return this.liked ? 'fa-thumbs-up' : 'fa-thumbs-o-up'
    },
    down() {
      return this.disliked ? 'fa-thumbs-down' : 'fa-thumbs-o-down'
    },
  },
  mounted() {
    this.$_liked_update()
  },
  methods: {
    $_liked_update() {
      var api = '/api/cards/' + this.card + '/likes'
      axios.get(api)
        .then(function (response) {
          if(response === 'liked') {
            this.liked = true
            this.disliked = false
          } else if(response === 'disliked') {
            this.liked = false
            this.disliked = true
          } else {
            this.liked = false
            this.disliked = false
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    $_like() {
      var api = '/api/cards/' + this.card + '/likes'
      axios.post(api, {type: 'liked'})
        .then(function (response) {
          this.liked = true
          this.likes = this.likes++
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    $_dislike() {
      var api = '/api/cards/' + this.card + '/likes'
      axios.post(api, {type: 'disliked'})
        .then(function (response) {
          this.disliked = true
          this.dislikes = this.dislikes++
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
}
</script>