(function( $ ){
    var _templateForm = '<form action="{action}" method="{method}" name="{name}"><div class="box-errors"></div>{elements}</form>',
        _templateReplace = {
            'action' : '',
            'method': '',
            'name': '',
            'elements': []
        },
        _templateItem = {
            'hidden': "<input type='hidden' name='{name}' value='{value}' class='{attrClass}' />",
            'integer': "<input type='text' name='{name}' value='{value}' class='{attrClass}' />"
        },
        rowItem = '<div class="row {attrRowClass}"><div class="col-lg-2"><label>{label}</label></div><div class="col-lg-10">{element}</div></div>',
        defaultValues = {}
        ;

    var methods = {
        init : function( data ) {

            if (data) {
                _templateReplace.action = data.vars.action;
                _templateReplace.name = data.vars.name;
                _templateReplace.method = data.vars.method;

                if (data.vars.value) {
                    defaultValues = data.vars.value;
                }

                $.each(data.children, function(key, value) {
                    var element = methods.elements(key, value);
                    if ($.type(element) === "string") {
                        _templateReplace.elements.push(element);
                    }
                });
            }

            $.each(_templateReplace, function(key, value){
                if (Array.isArray(value)) {
                    value = value.join('');
                }
                _templateForm = methods.replace(_templateForm, key, value);
            });

            $(this).html( _templateForm );
        },

        convertCamelCase: function(str) {
            return str.replace(/([a-zA-Z])(?=[A-Z])/g, '$1_').toLowerCase();
        },

        getDefaultValue: function(id) {
            var result = null;
            $.each(defaultValues, function(key, value) {
                if (key == id) result = value;
            });

            return result;
        },

        replace: function(str, from, to) {
            return str.replace("{"+from+"}", to);
        },

        replaceAll: function(str, params) {
            $.each(params, function(key, value) {
                str = methods.replace(str, key, value);
            });

            return str;
        },

        elements: function (key, element) {
            var itemTemplate = '',
                item = {'label': '', 'element': '', 'attrRowClass': ''};

            $.each(element, function(key, value) {
                if (key == "vars") {
                    if (itemTemplate = methods.getTemplateElement(value.block_prefixes[1])) {
                        var defaultValue = methods.getDefaultValue(methods.convertCamelCase(value.name));
                        item.attrRowClass = (value.attr.rowClass) ? value.attr.rowClass : value.block_prefixes[1];
                        item.label = (value.attr.translateLabel) ? value.attr.translateLabel : '';
                        item.element = methods.replaceAll(
                            itemTemplate,
                            {
                                'name': value.full_name,
                                'value': (value.value !== "")?value.value:(defaultValue)?defaultValue:'',
                                'attrClass': (value.attr.class)?value.attr.class:''
                            }
                        );
                    }
                }
            });

            return methods.replaceAll(rowItem, item);
        },

        getTemplateElement: function(id) {
            var template = false;
            $.each(_templateItem, function(key, value) {
                if (key == id) template = value;
            });

            return template;
        },

        onSubmit: function(callback) {
            if (typeof callback == "undefined") {
                callback = {
                    'onSuccess': function (data) {
                        return data;
                    },
                    'onError': function (data) {
                        return data;
                    }
                };
            }

            $("#button-save").off().on("click", function(event) {
                var modalBody = $(this).parents('.modal-dialog'),
                    form = modalBody.find('form');

                $.ajax({
                    cash: false,
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serializeObject(),
                    success: function (data) {
                        methods.onSuccess(data, callback);
                        $("#popUp").modal("hide");
                    },
                    error: function (data) {
                        data = methods.onError(data, callback);
                        data = data.responseJSON;
                        if (data.errors && $.type(data.errors) === "string") {
                            modalBody.find('.modal-body .box-errors').html(data.errors);
                        }
                    }
                });

                return false;
            });
        },

        onSuccess: function (data, callback) {
            data = callback.onSuccess(data);

            return data;
        },

        onError: function (data, callback) {
            data = callback.onError(data);

            return data;
        }
    };

    $.fn.generateForm = function( method ) {
        if ( methods[method] ) {
            return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return methods.init.apply( this, arguments );
        } else {
            $.error( 'Метод с именем ' +  method + ' не существует для jQuery.generateForm' );
        }
    };

})( jQuery );

$.fn.serializeObject = function() {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};