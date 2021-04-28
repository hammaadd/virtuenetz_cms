/*
 * Vue Inspector control group implementation
 */
Vue.component('backend-component-inspector-group', {
    props: {
        controls: {
            type: Array,
            required: true
        },
        obj: {
            type: Object,
            required: true
        },
        splitterData: {
            type: Object,
            required: true
        },
        groupName: {
            type: String,
            required: true
        },
        inspectorUniqueId: {
            type: String,
            required: true
        },
        depth: {
            type: Number,
            required: true
        },
        panelUpdateData: {
            type: Object,
            required: true
        },
        layoutUpdateData: {
            type: Object
        },
        inspectorPreferences: {
            type: Object
        }
    },
    data: function () {
        return {
            expanded: true
        };
    },
    computed: {
        expandStatusStorageKey: function computeExpandStatusStorageKey() {
            return this.inspectorUniqueId + '-group-status-' + $.oc.vueUtils.stringHashCode(this.groupName);
        }
    },
    methods: {
        onToggleGroup: function onToggleGroup() {
            this.expanded = !this.expanded;

            if (this.expanded) {
                localStorage.setItem(this.expandStatusStorageKey, '1');
            }
            else {
                localStorage.removeItem(this.expandStatusStorageKey);
            }
        }
    },
    mounted: function onMounted() {
        this.expanded = localStorage.getItem(this.expandStatusStorageKey) == '1';
    },
    created: function created() {
    },
    template: '#backend_vuecomponents_inspector_group'
});