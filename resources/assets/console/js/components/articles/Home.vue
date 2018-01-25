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
                >
                    <template slot="UpperLeftCorner">
                        <button type="submit" class="btn btn-primary" @click="handleCreateArticle">Create</button>
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
            };
        },
        methods: {
            handleCreateArticle() {
                this.redirectToUrl('/console/articles/new');
            }
        }
    }
</script>

<style scoped>

</style>