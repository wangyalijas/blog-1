// Custom components
import PageHeader from './components/PageHeader.vue'
import Pagination from './components/Pagination.vue'

Vue.component(PageHeader.name, PageHeader);
Vue.component(Pagination.name, Pagination);


// Third-party components
import {Table, TableColumn} from 'element-ui'

Vue.use(Table);
Vue.use(TableColumn);
