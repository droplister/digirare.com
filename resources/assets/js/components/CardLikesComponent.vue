<template>
  <span class="pull-right">
    <i class="fa text-success" v-bind:class="up" v-on:click="$_like"></i> {{ likes }}
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
      var self = this
      $.get(api, function(data) {
        if(data === 'liked') {
            self.liked = true
            self.disliked = false
        } else if(data === 'disliked') {
            self.liked = false
            self.disliked = true
        } else {
            self.liked = false
            self.disliked = false
        }
      });
    },
    $_like() {
      // Local
      this.liked = true
      this.likes = this.likes++
      // Global
      var api = '/api/cards/' + this.card + '/likes'
      $.post(api,{'type': 'like'})
    },
    $_dislike() {
      // Local
      this.disliked = true
      this.dislikes = this.dislikes++
      // Global
      var api = '/api/cards/' + this.card + '/likes'
      $.post(api, {'type': 'dislike'})
    },
  },
}
</script>