/*
 * Vue Inspector dropdown control implementation
 */
Vue.component('backend-component-inspector-control-dropdown', {
    extends: $.oc.vueComponentHelpers.inspector.controlBase,
    props: {},
    data: function() {
        return {
            loadingDynamicOptions: false,
            dynamicOptions: {},
            selectedValue: null,
            editorFocused: false
        };
    },
    computed: {
        options: function computeOptions() {
            var options = this.control.options ? this.control.options : this.dynamicOptions,
                optionKeys = Object.keys(options),
                result = [];

            optionKeys.forEach(function(key) {
                result.push({
                    label: options[key],
                    code: key
                });
            });

            return result;
        },

        containerTabIndex: function computeContainerTabIndex() {
            return this.editorFocused ? -1 : 0;
        }
    },
    methods: {
        focusControl: function focusControl() {
            this.$refs.input.activate();
            this.editorFocused = true;
        },

        updateValue: function updateValue(option) {
            var value = option ? option.code : null;
            this.setManagedValue(value);
        },

        setInitialValue: function() {
            var value = this.value;

            // TODO - make this conversion configurable.
            // It works for CMS page layouts where we get null
            // as an input value but want to return an empty string
            // if the empty value is selected.
            if (value === null) {
                value = '';
            }

            if (value !== undefined) {
                this.selectedValue = {
                    code: value,
                    label: this.control.options[value]
                };
            }
        },

        onFocus: function onFocus() {
            this.$emit('focus', { target: this.$refs.input.$el });
            this.editorFocused = true;
        },

        onBlur: function onBlur() {
            this.$emit('blur', { target: this.$refs.input.$el });
            this.editorFocused = false;
        },

        onInspectorLabelClick: function onInspectorLabelClick() {
            this.$refs.input.activate();
        },

        onContainerFocus: function onContainerFocus() {
            this.$refs.input.activate();
        }
    },
    mounted: function() {
        $(this.$el).find('.multiselect__select').addClass('backend-icon-background-pseudo');

        if (this.loadingDynamicOptions) {
            // TODO - load options and call setInitialValue()
        }
        else {
            this.setInitialValue();
        }
    },
    created: function created() {
        if (!this.control.options) {
            this.loadingDynamicOptions = true;
        }
    },
    template: '#backend_vuecomponents_inspector_control_dropdown'
});
