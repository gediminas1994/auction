<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        I'm an example component!
                    </div>

                    <div v-if="isEmpty">
                        <table class="table">
                            <tr v-for="item in table">
                                <td>{{ item.id }}</td>
                                <td>{{ item.name }}</td>
                            </tr>
                        </table>
                    </div>
                    <input type="text" v-model="item" />
                    <button class="btn" @click="addNew">Add new</button>
                    <div v-if="isLoading">
                        Loading ...
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/ecmascript-6">
    export default {
        data() {
            return {
                table: {},
                item: '',
                loading: false
            }
        },
        mounted() {
            console.log('Component mounted.');
            this.fetchData();
        },
        computed: {
            isEmpty() {
                return this.table.length
            },
            isLoading() {
                return this.loading
            }
        },
        methods: {
            fetchData() {
                axios.get('/vueJson').then((response) => {
                    this.table = response.data;
                }).catch((error) => {
                    console.log(error);
                });
            },
            postData(data) {
                return axios.post('/vueJson', data).then((response) => {
                    console.log(response);
                    return response.data;
                }).catch((error) => {
                    console.log(error);
                });
            },
            addNew() {
                this.loading = true;
                let params = {
                    'name': this.item
                };
                this.postData(params).then((data) => {
                    this.item = '';
                    this.table.push(data);
                    this.loading = false;
                });
            }
        }
    }
</script>
