<template>
    <b-container>
        <div class="text-center" v-if="loader">
            <b-spinner variant="primary" label="Text Centered"></b-spinner>
        </div>
        <div v-else>
            <b-button variant="primary" class="my-2" router-link :to="{name:'addProduct'}">
                <b-icon icon="bag-check-fill" aria-hidden="true"></b-icon>
                Add product
            </b-button>
            <b-row>
                <b-col cols="5" class="my-1">
                    <b-form-group
                        label="Per page"
                        label-for="per-page-select"
                        label-cols-sm="6"
                        label-cols-md="4"
                        label-cols-lg="3"
                        label-align-sm="center"
                        label-size="sm"
                        class="mb-0"
                    >
                        <b-form-select
                            id="per-page-select"
                            v-model="perPage"
                            :options="pageOptions"
                            size="sm"
                        ></b-form-select>
                    </b-form-group>
                </b-col>
                <b-col cols="6" class="my-1">
                    <b-form-group
                        label="Filter"
                        label-for="filter-input"
                        label-cols-sm="3"
                        label-align-sm="right"
                        label-size="sm"
                        class="mb-0"
                    >
                        <b-input-group size="sm">
                            <b-form-input
                                id="filter-input"
                                v-model="filter"
                                type="search"
                                placeholder="Type to Search"
                            ></b-form-input>

                            <b-input-group-append>
                                <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
                            </b-input-group-append>
                        </b-input-group>
                    </b-form-group>
                </b-col>
            </b-row>
            <b-table class="text-center" striped hover
                     :items="posts"
                     :fields="fields"
                     :current-page="currentPage"
                     :per-page="perPage"
                     :filter="filter">
                <template #cell(action)="data">
                    <b-button variant="primary" router-link :to="{name:'editProduct',params:{id:data.item.id}}">
                        <b-icon icon="pencil-square" aria-hidden="true"></b-icon>
                        Edit
                    </b-button>
                    <b-button variant="danger" @click="del(data.item.id)">
                        <b-icon icon="trash-fill" aria-hidden="true"></b-icon>
                        Delete
                    </b-button>
                </template>

            </b-table>
            <b-pagination
                v-model="currentPage"
                :total-rows="totalRows"
                :per-page="perPage"
                align="fill"
                size="sm"
                class="my-5"
            ></b-pagination>
        </div>
    </b-container>
</template>
<script>
export default {
    data: () => ({
        totalRows: 1,
        currentPage: 1,
        perPage: 5,
        pageOptions: [5, 10, 15, {value: 100, text: "Show a lot"}],
        filter: null,
        fields: [
            {key: 'id', sortable: true, variant: 'secondary'},
            {key: 'author_name', sortable: true},
            {key: 'product_name', sortable: true},
            {key: 'created_at', sortable: true},
            {key: 'action', sortable: false}

        ],
        posts: [],
        loader: true,

    }),
    mounted() {
        this.loadPost()
    },
    methods: {
        loadPost() {
            axios
                .get('/api/crud')
                .then(res => {
                    this.posts = res.data;
                    this.loader = false;
                    this.totalRows = this.posts.length;
                })
        },
        del(id) {
            axios
                .delete(`/api/crud/${id}`)
                .then(res => {
                    this.loadPost();
                    this.$alert(res.data.message);
                });

        },
    }
}
</script>
