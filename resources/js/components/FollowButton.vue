<template>
    <div class="px-2">
        <button id="follow-btn" class="btn" @click="followUser" v-text="buttonText" v-bind:class="{'btn-outline-primary' : status, 'btn-primary' : !status}"></button>
    </div>
</template>

<script>
    export default {
        props: [
            'userId',
            'follows'
        ],
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                status: this.follows,
            }
        },
        methods: {
            followUser() {
                axios.post(`/${this.userId}/follow`)
                    .then(response => {
                        this.status = !this.status;
                    })
                    .catch(errors => {
                        $('#follow-btn').after(`<div class="alert alert-danger">${errors.response.data.message}</div>`);
                        if (errors.response.status == 401) {
                            window.location = '/login';
                        }
                    });
            }
        },
        computed: {
            buttonText() {
                return (this.status) ? 'Unfollow' : 'Follow'
            }
        }
    }
</script>
