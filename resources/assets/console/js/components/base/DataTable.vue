<template>
    <div class="card">

        <template v-if="hasTitle">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4" v-text="title"></h3>
            </div>
        </template>

        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <slot name="UpperLeftCorner"/>
                </div>
                <div class="col-lg-6 d-flex flex-row-reverse">
                    <form @submit.prevent="handleSearch">
                        <div class="form-inline">
                            <div class="form-group mr-3">
                                <div class="input-group">
                                    <label for="inlineFormInputGroup" class="sr-only">Search</label>
                                    <input id="inlineFormInputGroup" v-model="searchText" type="text"
                                           placeholder="Enter keywords to search"
                                           class="form-control">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary" @click="onToggleSortedBy"><i
                                            :class="sortButtonClasses"></i><span v-if="isShowSortButtonText">&nbsp;{{ sortButtonText }}</span>
                                    </button>
                                    <dropdown :text="internalOrderByDisplayName" @command="onChangeOrderByField"
                                              auto-active-menu-item menu-item-active-icon>
                                        <dropdown-menu>
                                            <template v-for="orderableField in orderableFields">
                                                <dropdown-menu-item :label="orderableField.display"
                                                                    :value="orderableField"/>
                                            </template>
                                        </dropdown-menu>
                                    </dropdown>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="mt-3 mb-3">
                <el-table
                        v-loading="isLoading"
                        :data="tableData"
                        :size="size"
                        :width="width"
                        :height="height"
                        :max-height="maxHeight"
                        :fit="fit"
                        :stripe="stripe"
                        :border="border"
                        :row-key="rowKey"
                        :context="context"
                        :show-header="showHeader"
                        :show-summary="showSummary"
                        :sum-text="sumText"
                        :summary-method="summaryMethod"
                        :row-class-name="rowClassName"
                        :row-style="rowStyle"
                        :cell-class-name="cellClassName"
                        :cell-style="cellStyle"
                        :header-row-class-name="headerRowClassName"
                        :header-row-style="headerRowStyle"
                        :header-cell-class-name="headerCellClassName"
                        :header-cell-style="headerCellStyle"
                        :highlight-current-row="highlightCurrentRow"
                        :current-row-key="currentRowKey"
                        :empty-text="emptyText"
                        :expand-row-keys="expandRowKeys"
                        :default-expandA-all="defaultExpandAll"
                        :default-sort="defaultSort"
                        :tooltip-effect="tooltipEffect"
                        :span-method="spanMethod"
                        @selection-change="handleSelectionChange"
                        ref="multipleTable"
                >
                    <slot name="DataTableColumns"></slot>
                    <template v-if="hasEmptyTextSlot">
                        <template slot="empty">
                            <slot name="empty">暂无数据</slot>
                        </template>
                    </template>
                </el-table>
            </div>

            <template v-if="paginate">
                <div :class="paginationClasses">
                    <pagination :total="paginationTotal" :page-size="paginationPerPage" :current-page.sync="currentPage"
                                @currentPageChange="handleCurrentPageChange"></pagination>
                </div>
            </template>
        </div>

    </div>
</template>

<script>
    export default {
        name: "data-table",
        props: {
            title: {
                type: String,
                required: false
            },
            paginationPosition: {
                type: String,
                required: false,
                default: 'right',
                validate: function (value) {
                    return ~['right', 'center', 'left'].indexOf(value)
                }
            },

            size: String,

            width: [String, Number],

            height: [String, Number],

            maxHeight: [String, Number],

            fit: {
                type: Boolean,
                default: true
            },

            stripe: Boolean,

            border: {
                type: Boolean,
                default: true
            },

            rowKey: [String, Function],

            context: {},

            showHeader: {
                type: Boolean,
                default: true
            },

            showSummary: Boolean,

            sumText: String,

            summaryMethod: Function,

            rowClassName: [String, Function],

            rowStyle: [Object, Function],

            cellClassName: [String, Function],

            cellStyle: [Object, Function],

            headerRowClassName: [String, Function],

            headerRowStyle: [Object, Function],

            headerCellClassName: [String, Function],

            headerCellStyle: [Object, Function],

            highlightCurrentRow: Boolean,

            currentRowKey: [String, Number],

            emptyText: String,

            expandRowKeys: Array,

            defaultExpandAll: Boolean,

            defaultSort: Object,

            tooltipEffect: String,

            spanMethod: Function,

            orderBy: {
                type: String,
                required: true
            },

            sortedBy: {
                type: String,
                required: false,
                default: 'asc',
                validation: function (value) {
                    return ~['asc', 'desc'].indexOf(value.toLowerCase());
                }
            },

            orderableFields: {
                type: Array,
                required: true,
                validation: function (value) {
                    return !!value.length;
                }
            },

            resourcePath: {
                type: String,
                required: true
            },

            urlParameters: {
                type: Object,
                required: false,
                default: function () {
                    return {};
                }
            },

            getSearchValue: {
                type: Function,
                required: false,
                default: function (value) {
                    if (value && value.length > 0) {
                        return value;
                    } else {
                        return '';
                    }
                }
            },

            paginate: {
                type: Boolean,
                required: false,
                default: function () {
                    return true;
                }
            },

            requestErrorHandler: {
                type: Function,
                required: false,
            },

            isShowSortButtonText: {
                type: Boolean,
                default: false
            }
        },
        data: function () {
            return {
                isLoading: false,
                internalOrderBy: null,
                internalSortedBy: null,
                searchedText: null,
                searchText: null,
                currentPage: 1,

                paginationPerPage: 0,
                paginationTotal: 0,

                items: [],
            };
        },
        computed: {
            hasTitle() {
                return !!this.title;
            },
            paginationClasses() {
                let positionClassName;
                switch (this.paginationPosition) {
                    case 'left':
                        positionClassName = 'justify-content-start';
                        break;
                    case 'center':
                        positionClassName = 'justify-content-center';
                        break;
                    case 'right':
                        positionClassName = 'justify-content-end';
                        break;
                }
                return ["mt-3", "d-flex", positionClassName];
            },
            tableData() {
                return this.items;
            },
            hasEmptyTextSlot() {
                return !!this.$slots['empty'];
            },
            sortButtonClasses() {
                return ['fa', `fa-sort-alpha-${this.internalSortedBy.toLowerCase()}`];
            },
            sortButtonText() {
                return this.internalSortedBy.toLowerCase() === 'asc' ? '正序' : '倒序'
            }
        },
        methods: {
            fetchData() {
                if (this.isLoading) {
                    return;
                }

                let searchText = this.getSearchValue(this.searchText);

                this.searchedText = this.searchText;
                this.isLoading = true;

                this.$api.get(this.resourcePath, {
                    params: Object.assign(this.urlParameters, {
                        page: this.currentPage,
                        search: searchText,
                        orderBy: this.internalOrderBy,
                        sortedBy: this.internalSortedBy,
//                    include: ''
                    })
                })
                    .then((response) => {
                        this.$emit('resource-response', response);
                        this.items = response.data.data;
                        if (this.paginate) {
                            let pagination = response.data.meta.pagination;
                            this.currentPage = pagination.current_page;
                            this.paginationPerPage = pagination.per_page;
                            this.paginationTotal = pagination.total;
                        }
                    })
                    .catch(this.getRequestErrorHandler())
                    .finally(() => {
                        this.isLoading = false;
                    });
            },
            getRequestErrorHandler() {
                return this.requestErrorHandler ? this.requestErrorHandler : () => {
                    this.$message.error('Request failed.');
                }
            },
            onToggleSortedBy() {
                this.internalSortedBy = this.internalSortedBy === 'asc' ? 'desc' : 'asc';
                this.fetchData();
            },
            onChangeOrderByField(displayName, orderableField) {
                if (this.internalOrderBy !== orderableField.name) {
                    this.internalOrderBy = orderableField.name;
                    this.internalOrderByDisplayName = displayName;
                    this.fetchData();
                }
            },
            handleSearch() {
                if (this.searchedText === this.searchText) {
                    return;
                }
                this.fetchData();
            },
            handleCurrentPageChange(pageNumber) {
                this.currentPage = pageNumber;
                this.fetchData();
            },
            handleSelectionChange(val) {
                this.$emit('selection-change', val);
            },
            toggleRowSelection(...parameters) {
                this.$refs.multipleTable.toggleRowSelection(...parameters);
            },
            reload() {
                this.fetchData();
            }
        },
        created() {
            this.internalOrderBy = this.orderBy;
            this.internalSortedBy = this.sortedBy;
            this.internalOrderByDisplayName = this.orderableFields[0].display;

            this.fetchData();
        },
    }
</script>

<style scoped>

</style>