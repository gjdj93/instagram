<template>
  <a href="#" id="like-btn" class="btn-reset" @click="likePost"><i class="fa-heart fa-lg" :class="likeIcon"></i></a>
</template>

<script>
export default {
    props: [
        'postId',
        'liked'
    ],
    data() {
        return {
            status: this.liked,
        }
    },
    methods: {
        likePost() {
            axios.post(`/posts/${this.postId}/like`)
                .then(response => {
                    this.status = !!response.data;
                })
                .catch(errors => {
                    console.error(errors.response.data);
                });
        }
    },
    computed: {
        likeIcon() {
            return (this.status) ? 'fas text-danger' : 'far text-dark';
        }
    }
}
</script>

<style>

</style>
