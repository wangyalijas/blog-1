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
                            <div class="form-group-material">
                                <input id="article-title"
                                       type="text"
                                       name="title"
                                       class="input-material"
                                       v-model="formData.title"
                                       required
                                >
                                <label for="article-title" class="label-material">Title</label>
                            </div>

                            <div class="form-group-material">
                                <textarea id="article-summary"
                                          name="summary"
                                          class="textarea-material"
                                          v-model="formData.summary"
                                          required
                                >
                                </textarea>
                                <label for="article-summary" class="label-material">Summary</label>
                            </div>

                            <div class="form-group-material">
                                <textarea id="article-content"
                                          name="content"
                                          class="textarea-material"
                                          v-model="formData.content"
                                          required
                                >
                                </textarea>
                                <label for="article-content" class="label-material">Content</label>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-secondary">Cancel</button>
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
        data: function () {
            return {
                formData: {
                    title: null,
                    summary: null,
                    content: null,
                }
            };
        },
        methods: {
            handleSave() {
                this.$api.post('articles', this.formData)
                    .then(response => {
                        console.log(response)
                        this.$message({
                            message: '创建成功',
                            type: 'success',
                            onClose: this.redirectToArticlesModuleHome
                        });
                    })
                    .catch(this.simpleAPIRequestErrorHandler);
            },
            redirectToArticlesModuleHome() {
                this.redirectToUrlFromBaseUrl('console/articles');
            }
        }
    }
</script>

<style scoped>

</style>