import Dropdown from './Dropdown.vue'
import DropdownMenu from './DropdownMenu.vue'
import DropdownMenuItem from './DropdownMenuItem.vue'

export default {
    install: function (Vue) {
        Vue.component(Dropdown.name, Dropdown);
        Vue.component(DropdownMenu.name, DropdownMenu);
        Vue.component(DropdownMenuItem.name, DropdownMenuItem);
    }
}