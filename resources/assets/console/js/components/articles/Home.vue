<template>
    <div>
        <page-header title="Article List"></page-header>

        <!-- Dashboard Counts Section-->
        <section class="article-list no-padding-bottom">
            <div class="container-fluid">
                <data-table pagination-position="right"
                            :order-by="orderBy"
                            :sorted-by="sortedBy"
                            :orderable-fields="orderableFields"
                            :resource-path="resourcePath"
                            @selection-change="handleTableSelectionChange"
                >
                    <template slot="UpperLeftCorner">
                        <button type="button" class="btn btn-primary" @click="handleCreateArticle">Create</button>
                        <button type="button" class="btn btn-primary" @click="handleEditArticle">Edit</button>
                    </template>

                    <template slot="DataTableColumns">
                        <el-table-column type="selection" width="34"></el-table-column>
                        <el-table-column
                                label="Title"
                        >
                            <template slot-scope="scope">
                                {{ scope.row.title }}
                            </template>
                        </el-table-column>
                        <el-table-column
                                label="Summary"
                        >
                            <template slot-scope="scope">
                                {{ scope.row.summary }}
                            </template>
                        </el-table-column>
                        <el-table-column
                                label="Views"
                                width="100"
                                align="center"
                        >
                            <template slot-scope="scope">
                                {{ scope.row.views }}
                            </template>
                        </el-table-column>
                        <el-table-column
                                label="Published at"
                                width="140"
                        >
                            <template slot-scope="scope">
                                {{ scope.row.published_at }}
                            </template>
                        </el-table-column>
                        <el-table-column
                                label="Created at"
                                width="140"
                        >
                            <template slot-scope="scope">
                                {{ scope.row.created_at }}
                            </template>
                        </el-table-column>
                        <el-table-column
                                label="Updated at"
                                width="140"
                        >
                            <template slot-scope="scope">
                                {{ scope.row.updated_at }}
                            </template>
                        </el-table-column>
                    </template>
                </data-table>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        name: "articles-home",
        data: function () {
            return {
                resourcePath: 'articles',
                orderBy: 'created_at',
                sortedBy: 'asc',
                orderableFields: [
                    {
                        name: 'created_at',
                        display: '创建时间',
                    },
                    {
                        name: 'title',
                        display: '标题',
                    },
                ],
                multipleSelection: []
            };
        },
        computed: {
            isNotArticleSelected() {
                return this.multipleSelection.length === 0;
            },
            isOneArticleSelected() {
                return this.multipleSelection.length === 1;
            },
            isOneOrMoreArticleSelected() {
                return !this.isNotArticleSelected;
            }
        },
        methods: {
            handleCreateArticle() {
                this.redirectToUrl('/console/articles/new');
            },
            handleEditArticle() {
                if (this.isNotArticleSelected) {
                    this.$message.error('Please select an article to be edit first.');
                    return;
                }
                if (!this.isOneArticleSelected) {
                    this.$message.error('Only one article can be selected for edit');
                    return;
                }
                this.redirectToUrl(`/console/articles/${this.getSelectedArticleIds().shift()}/edit`);
            },
            handleTableSelectionChange(value) {
                this.multipleSelection = value;
            },
            getSelectedArticleIds() {
                return this.multipleSelection.map(article => {
                    return article.id;
                });
            },
        }
    }
</script>

<style scoped>

</style>