<template>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li :class="{'page-item':true, disabled: isDisablePrevious}" @click="previousPage">
                <span class="page-link" v-text="previousText"></span>
            </li>

            <template v-if="!isSmall">
                <template v-if="isShowAll">
                    <template v-for="number in totalPages">
                        <li :class="{'page-item': true, active: number === currentPage}"
                            @click="updateCurrentPage(number)"
                        >
                            <span class="page-link" v-text="number"></span>
                        </li>
                    </template>
                </template>

                <template v-else>
                    <template v-if="isShowPreviousMore">
                        <li class="page-item" @click="quickBackward"><span class="page-link">...</span></li>
                    </template>

                    <template v-for="index in visiblePagination">
                        <li :class="{'page-item': true, active: getPageNumber(index) === currentPage}"
                            @click="updateCurrentPage(getPageNumber(index))"
                        >
                            <span class="page-link" v-text="getPageNumber(index)"></span>
                        </li>
                    </template>

                    <template v-if="isShowNextMore">
                        <li class="page-item" @click="quickForward"><span class="page-link">...</span></li>
                    </template>
                </template>
            </template>

            <li :class="{'page-item':true, disabled: isDisableNext}" @click="nextPage">
                <span class="page-link" v-text="nextText"></span>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        name: "pagination",
        props: {
            previousText: {
                type: String,
                required: false,
                default: 'Previous'
            },
            nextText: {
                type: String,
                required: false,
                default: 'Next'
            },
            small: {
                type: Boolean,
                required: false,
                default: false
            },
            pageSize: {
                type: Number,
                required: false,
                default: 15
            },
            total: {
                type: Number,
                required: true
            },
            currentPage: {
                type: Number,
                required: false,
                default: 1
            }
        },
        data: function () {
            return {
                visiblePagination: 5,
            }
        },
        computed: {
            isSmall() {
                return !!this.small;
            },
            totalPages() {
                return Math.ceil(this.total / this.pageSize);
            },
            isShowAll() {
                return this.totalPages <= this.visiblePagination;
            },
            isDisablePrevious() {
                return this.currentPage === 1;
            },
            isDisableNext() {
                return this.currentPage === this.totalPages;
            },
            isShowPreviousMore() {
                return this.currentPage >= this.visiblePaginationHalf + 1;
            },
            isShowNextMore() {
                return this.currentPage + Math.floor(this.visiblePagination / 2) < this.totalPages
            },
            visiblePaginationHalf() {
                return Math.ceil(this.visiblePagination / 2);
            }
        },
        methods: {
            getPageNumber(index) {
                if (this.currentPage <= this.visiblePaginationHalf) {
                    return index;
                } else if (this.currentPage > this.visiblePaginationHalf && this.currentPage <= this.totalPages - this.visiblePaginationHalf) {
                    return this.currentPage - this.visiblePaginationHalf + index;
                } else {
                    return this.totalPages - this.visiblePagination + index;
                }
            },
            updateCurrentPage(pageNumber) {
                this.$emit('update:currentPage', pageNumber);
                this.$emit('currentPageChange', pageNumber);
            },
            previousPage() {
                if (!this.isDisablePrevious) {
                    this.updateCurrentPage(this.currentPage - 1);
                }
            },
            nextPage() {
                if (!this.isDisableNext) {
                    this.updateCurrentPage(this.currentPage + 1);
                }
            },
            quickForward() {
                if (this.currentPage <= this.visiblePaginationHalf) {
                    this.updateCurrentPage(this.visiblePagination + 1);
                } else {
                    this.updateCurrentPage(this.currentPage + this.visiblePaginationHalf);
                }
            },
            quickBackward() {
                if (this.currentPage > this.totalPages - this.visiblePagination) {
                    this.updateCurrentPage(this.totalPages - this.visiblePagination);
                } else {
                    this.updateCurrentPage(this.currentPage - this.visiblePaginationHalf);
                }
            }
        }
    }
</script>

<style scoped>

</style>