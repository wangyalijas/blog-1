// Custom components
import PageHeader from './components/base/PageHeader.vue'
import Pagination from './components/base/Pagination.vue'
import Dropdown from './components/base/Dropdown/index.js'
import DataTable from './components/base/DataTable.vue'
import MaterialInput from './components/base/MaterialInput.vue'
import MaterialTextarea from './components/base/MaterialTextarea.vue'

Vue.component(PageHeader.name, PageHeader);
Vue.component(Pagination.name, Pagination);
Vue.use(Dropdown);
Vue.component(DataTable.name, DataTable);
Vue.component(MaterialInput.name, MaterialInput);
Vue.component(MaterialTextarea.name, MaterialTextarea);


// Third-party components
import {Table, TableColumn, Loading, Message, MessageBox} from 'element-ui';

Vue.use(Table);
Vue.use(TableColumn);
Vue.use(Loading);

Vue.prototype.$message = Message;
Vue.prototype.$messageBox = MessageBox;
Vue.prototype.$alert = MessageBox.alert;
Vue.prototype.$confirm = MessageBox.confirm;
Vue.prototype.$prompt = MessageBox.prompt;
