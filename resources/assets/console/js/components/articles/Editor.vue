<template>
    <div>
        <page-header title="Article List"></page-header>

        <!-- Dashboard Counts Section-->
        <section class="article-editor no-padding-bottom forms">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="h4">Article Editor</h3>
                    </div>

                    <div class="card-body">
                        <form class="form-horizontal" @submit.prevent="handleSave">

                            <material-input v-model="formData.title" label="Title" required/>

                            <material-textarea v-model="formData.summary" label="Summary" required/>

                            <material-textarea v-model="formData.content" label="Content" required/>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" :disable="isLoading">Save</button>
                                <button type="button" class="btn btn-secondary" @click="redirectToArticlesModuleHome">Cancel</button>
                            </div>

                            <div class="line"></div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        name: "articles-editor",
        props: {
            id: {
                type: Number,
                required: false
            }
        },
        data: function () {
            return {
                isLoading: false,
                formData: {
                    title: null,
                    summary: null,
                    content: null,
                }
            };
        },
        computed: {
            isEditing() {
                return !!this.id;
            },
            isCreating() {
                return !this.isEditing;
            },
        },
        watch: {
            id: function () {
                if (value) {
                    this.fetchEditingArticle();
                }
            }
        },
        methods: {
            handleSave() {
                if (this.isLoading) {
                    this.$message.warning('Please wait...');
                    return;
                }

                if (this.isCreating) {
                    this.createArticle();
                }
                if (this.isEditing) {
                    this.updateArticle();
                }
            },
            createArticle() {
                this.startLoadingStatus();
                this.$api.post('articles', this.formData)
                    .then(response => {
                        this.$message({
                            message: 'Created successfully.',
                            type: 'success',
                            onClose: this.redirectToArticlesModuleHome
                        });
                    })
                    .catch(this.simpleAPIRequestErrorHandler);
            },
            updateArticle() {
                this.startLoadingStatus();
                this.$api.put(`articles/${this.id}`, this.formData)
                    .then(response => {
                        this.$message({
                            message: 'Updated successfully.',
                            type: 'success',
                            onClose: this.redirectToArticlesModuleHome
                        });
                    })
                    .catch(this.simpleAPIRequestErrorHandler);
            },
            fetchEditingArticle() {
                this.$api.get(`articles/${this.id}`)
                    .then(({data}) => {
                        this.appendArticleDataToFormData(data.data);
                    })
                    .catch(this.simpleAPIRequestErrorHandler);
            },
            appendArticleDataToFormData(article) {
                this.formData.title = article.title;
                this.formData.summary = article.summary;
                this.formData.content = article.content;
            },
            redirectToArticlesModuleHome() {
                this.redirectToUrlFromBaseUrl('console/articles');
            },
            startLoadingStatus() {
                this.isLoading = true;
            }
        },
        created() {
            if (this.isEditing) {
                this.fetchEditingArticle();
            }
        }
    }
</script>

<style scoped>

</style>