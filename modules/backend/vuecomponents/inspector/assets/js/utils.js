+(function($) {
    'use strict';
    var InspectorUtils = function() {
        var validator = null;

        function getValidator() {
            if (validator) {
                return validator;
            }

            var ajv = new Ajv({
                jsonPointers: true
            });
            validator = ajv.compile($.oc.vueComponentHelpers.inspector.dataSchema);

            return validator;
        }

        this.validateDataSchema = function validateDataSchema(obj) {
            var validator = getValidator(),
                result = validator(obj);

            if (result === true) {
                return result;
            }

            var error = validator.errors[0];

            return 'Inspector data schema error. ' + error.dataPath + ' ' + error.message;
        };

        this.groupControls = function groupControls(controls) {
            var result = {
                ungrouped: []
            };

            for (var index = 0; index < controls.length; index++) {
                var control = controls[index];

                if (!control.group) {
                    result.ungrouped.push(control);
                }
                else {
                    if (result[control.group] === undefined) {
                        result[control.group] = [];
                    }

                    result[control.group].push(control);
                }
            }

            return result;
        };

        this.validatePanelControls = function(component) {
            for (var index = 0; index < component.$children.length; index++) {
                var childComponent = component.$children[index];

                if (childComponent.validatePropertyValue) {
                    var result = childComponent.validatePropertyValue();
                    if (result !== null) {
                        return {
                            message: result,
                            component: childComponent
                        };
                    }
                }

                var childrenResult = this.validatePanelControls(childComponent);
                if (childrenResult !== null) {
                    return childrenResult;
                }
            }

            return null;
        };

        this.getProperty = function getProperty(obj, dotNotationPath) {
            function reducer(obj, i) {
                if (!obj) {
                    return undefined;
                }

                return obj[i];
            }

            return dotNotationPath.split('.').reduce(reducer, obj);
        };

        this.setProperty = function setProperty(obj, dotNotationPath, value) {
            var parts = dotNotationPath.split('.');

            function setPropertyAtPath(currentObj, pathParts) {
                var property = pathParts.shift();

                if (!pathParts.length) {
                    Vue.set(currentObj, property, value);
                    return;
                }

                if (currentObj[property] === undefined) {
                    Vue.set(currentObj, property, {});
                }

                setPropertyAtPath(currentObj[property], pathParts);
            }

            setPropertyAtPath(obj, parts);
        };

        this.getLocalStorageKey = function getLocalStorageKey(component, key) {
            return 'inspector-' + component.inspectorUniqueId + '-' + key;
        };

        this.deepCloneObject = function deepCloneObject(src, dst) {
            function deepCloneProperty(value) {
                if (typeof value !== 'object' || value === null || Array.isArray(value)) {
                    return value;
                }

                var result = {};
                for (key in value) {
                    result[key] = deepCloneProperty(value[key]);
                }

                return result;
            }

            for (var key in src) {
                var value = src[key];

                dst[key] = deepCloneProperty(value);
            }

            for (var key in dst) {
                if (src[key] === undefined) {
                    Vue.delete(dst, key);
                }
            }
        };
    };

    if ($.oc.vueComponentHelpers === undefined) {
        $.oc.vueComponentHelpers = {};
    }

    if ($.oc.vueComponentHelpers.inspector === undefined) {
        $.oc.vueComponentHelpers.inspector = {};
    }

    $.oc.vueComponentHelpers.inspector.utils = new InspectorUtils();
})(window.jQuery);
