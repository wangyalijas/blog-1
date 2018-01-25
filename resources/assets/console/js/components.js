// Custom components
import PageHeader from './components/base/PageHeader.vue'
import Pagination from './components/base/Pagination.vue'
import Dropdown from './components/base/Dropdown/index.js'
import DataTable from './components/base/DataTable.vue'

Vue.component(PageHeader.name, PageHeader);
Vue.component(Pagination.name, Pagination);
Vue.use(Dropdown);
Vue.component(DataTable.name, DataTable);


// Third-party components
import {Table, TableColumn, Loading, Message} from 'element-ui';

Vue.use(Table);
Vue.use(TableColumn);
Vue.use(Loading);

Vue.prototype.$message = Message;
