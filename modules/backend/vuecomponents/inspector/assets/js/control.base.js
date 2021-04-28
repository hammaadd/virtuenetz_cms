+(function($) {
    'use strict';
    var ControlBase = {
        props: {
            control: {
                type: Object,
                required: true
            },
            obj: {
                type: Object,
                required: true
            },
            controlId: {
                type: String,
                required: true
            },
            inspectorPreferences: {
                type: Object
            }
        },
        computed: {
            value: function computeValue() {
                var utils = $.oc.vueComponentHelpers.inspector.utils,
                    result = utils.getProperty(this.obj, this.control.property);

                if (result !== undefined) {
                    return result;
                }

                if (this.control.default !== undefined) {
                    utils.setProperty(this.obj, this.control.property, this.control.default);
                }
                else {
                    var controlDefaultValue = this.getDefaultValue();
                    utils.setProperty(this.obj, this.control.property, controlDefaultValue);
                }

                return utils.getProperty(this.obj, this.control.property);
            }
        },
        methods: {
            validatePropertyValue: function validate() {
                var validatorSet = new $.oc.vueComponentHelpers.inspector.validatorSet(
                        this.control,
                        this.control.property
                    ),
                    result = validatorSet.validate(this.value);

                if (result !== null) {
                    this.$emit('invalid');
                }
                else {
                    this.$emit('valid');
                }

                return result;
            },

            getDefaultValue: function getDefaultValue() {
                return undefined;
            },

            setManagedValue: function setManagedValue(value) {
                var utils = $.oc.vueComponentHelpers.inspector.utils;

                utils.setProperty(this.obj, this.control.property, value);
            },

            focusControl: function focusControl() {}
        }
    };

    if ($.oc.vueComponentHelpers === undefined) {
        $.oc.vueComponentHelpers = {};
    }

    if ($.oc.vueComponentHelpers === undefined) {
        $.oc.vueComponentHelpers.inspector = {};
    }

    $.oc.vueComponentHelpers.inspector.controlBase = ControlBase;
})(window.jQuery);
