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
      var api = '/cards/' + this.card + '/likes'
      var self = this
      axios.get(api)
        .then(function (response) {
          if(response.data === 'liked') {
            self.liked = true
            self.disliked = false
          } else if(response.data === 'disliked') {
            self.liked = false
            self.disliked = true
          } else {
            self.liked = false
            self.disliked = false
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    $_like() {
      var api = '/cards/' + this.card + '/likes'
      var self = this
      axios.post(api, {type: 'liked'})
        .then(function (response) {
          self.liked = true
          self.likes = self.likes++
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    $_dislike() {
      var api = '/cards/' + this.card + '/likes'
      var self = this
      axios.post(api, {type: 'disliked'})
        .then(function (response) {
          self.disliked = true
          self.dislikes = self.dislikes++
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
}
</script>