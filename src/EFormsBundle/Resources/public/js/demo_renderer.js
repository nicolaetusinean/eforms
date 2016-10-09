/**
 * Created by gorgan-andrei.
 * Date: 10/9/2016
 * Time: 10:20 AM
 */

jQuery(document).ready(function($) {
    var renderWrap = document.querySelector('.render-wrap'),
        renderWrapJqueryObj = $(renderWrap),
        formDataString = renderWrapJqueryObj.attr('data-form-builder'),
        _formSelector = "#render-form",
        _form = $(_formSelector),
        _errorsHandler = errorsHandler();

    var _formBuilderData = JSON.parse(formDataString);
    _formBuilderData = setColumnAsKey(_formBuilderData, 'name');


    renderWrapJqueryObj.formRender({
        dataType: 'json',
        formData: formDataString
    });

    addClassToFormElements($(_formSelector), _formBuilderData, 'form-control');
    $('#submitBtn').click(function() {
        _errorsHandler.removeErrors(_form);

        var _formData = $(_formSelector).serializeArray();
        var valid = validateFormData(_formData, _formBuilderData);
        if (valid === true) {
            _form.attr('action', '/callback');
            _form.submit();
        } else {
            _errorsHandler.handle(_form, valid);
        }
    });

    /**
     * Validate the form data
     *
     * @param formData
     * @param formBuilderData
     */
    function validateFormData(formData, formBuilderData)
    {
        var validation = new Validation(), fieldName;
        var _valuesToValidate = {};
        $.each(formData, function(index, field) {
            fieldName = field['name'];
            _valuesToValidate[fieldName] = field['value'];
            if (typeof formBuilderData[fieldName] !== "undefined") {
                if (formBuilderData[fieldName]['required']) {
                    validation.add(fieldName, new Validator.PresenceOf());
                }

                //if (typeof formBuilderData[fieldName]['min'] !== "undefined" || typeof formBuilderData[fieldName]['max'] !== "undefined") {
                //    validation.add(fieldName, new Validator.Between({
                //        'min': (formBuilderData[fieldName]['min'] ? formBuilderData[fieldName]['min'] : 0),
                //        'max': (formBuilderData[fieldName]['max'] ? formBuilderData[fieldName]['max'] : null)
                //    }))
                //}

                if (typeof formBuilderData[fieldName]['maxlength'] !== "undefined") {
                    validation.add(fieldName, new Validator.StringLength({
                        'min': 0,
                        'max': formBuilderData[fieldName]['maxlength']
                    }))
                }

                if (typeof formBuilderData[fieldName]['className'] === 'string') {

                    var classArr = formBuilderData[fieldName]['className'].split(/\s+/);

                    $.each(classArr, function(index, className) {
                        if (typeof Validator[className] !== "undefined") {
                            validation.add(fieldName, new Validator[formBuilderData[fieldName]['className']]());
                        }
                    });

                }
            }
        });

        if (validation.chain.length) {
            return validation.validate(_valuesToValidate);
        }

        return true;
    }

    function addClassToFormElements(form, formBuilderData, className)
    {
        $.each(formBuilderData, function(elementName) {

            var formElement = form.find("[name='" + elementName + "']");

            // Check for checkboxes also
            if (formElement.length === 0) {
                formElement = form.find("[name='" + elementName + "[]']");
            }

            if (formElement && formElement.length) {
                formElement.addClass(className);
            }
        });
    }
});
