// Custom components
import PageHeader from './components/PageHeader.vue'
import Pagination from './components/Pagination.vue'
import Dropdown from './components/Dropdown/index.js'
import DataTable from './components/DataTable.vue'

Vue.component(PageHeader.name, PageHeader);
Vue.component(Pagination.name, Pagination);
Vue.use(Dropdown);
Vue.component(DataTable.name, DataTable);


// Third-party components
import {Table, TableColumn} from 'element-ui';

Vue.use(Table);
Vue.use(TableColumn);
