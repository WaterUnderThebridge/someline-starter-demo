<style scoped>
</style>

<template>

    <div class="wrapper-md">

        <h1>{{ $t('post.posts')||'Post' }}</h1>
        <hr>
        <div class="row">
            <div class="list-group list-group-lg list-group-sp">
                <template v-for="item of items">
                    <div class="col-md-4 m-b-sm">
                        <sl-post-list-item :item="item"></sl-post-list-item>
                    </div>
                </template>
            </div>

        </div>

    </div>

</template>

<script>
    import slPostListItem from './PostListGroupItem.vue';
    export default{
        props: [],
        data(){
            return {
//                msg: 'hello vue',
                items: [],
            }
        },
        components:{
            slPostListItem
        },
        computed: {},
        mounted(){
            console.log('Component Ready.');

            this.fetchData();
        },
        watch: {},
        events: {},
        methods: {
            fetchData(){

                this.$api.get('/posts', {
                    params: {
//                        include: ''
                    }
                })
                    .then((response => {
                        console.log(response);
                        this.items = response.data.data;
                    }).bind(this))
                    .catch((error => {
                        console.error(error);
                    }).bind(this));

            }
        },
    }
</script>
