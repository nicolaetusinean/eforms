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
        _form = $(_formSelector);

    var _formBuilderData = JSON.parse(formDataString);
    _formBuilderData = setColumnAsKey(_formBuilderData, 'name');

    renderWrapJqueryObj.formRender({
        dataType: 'json',
        formData: formDataString
    });

    $('.submitBtn').click(function() {
        var _formData = $(_formSelector).serializeArray();
        if (validateFormData(_formData, _formBuilderData, _form)) {

        }
    });

    function validateFormData(formData, formBuilderData, form)
    {
        var validation = new Validation();

        validation.add('username', new Validator.PresenceOf());

        $.each(formData, function(fieldName, fieldValue) {
            if (typeof formBuilderData(fieldName) !== "undefined") {
                if (formBuilderData(fieldName)['required']) {
                    validation.add(fieldName, new Validator.PresenceOf());
                }

                if (typeof formBuilderData(fieldName)['min'] !== "undefined" || typeof formBuilderData(fieldName)['max'] !== "undefined") {
                    validation.add(fieldName, new Validator.Between({
                        'min': (formBuilderData(fieldName)['min'] ? formBuilderData(fieldName)['min'] : null),
                        'max': (formBuilderData(fieldName)['max'] ? formBuilderData(fieldName)['max'] : null)
                    }))
                }

                if (typeof formBuilderData(fieldName)['maxlength'] !== "undefined") {
                    validation.add(fieldName, new Validator.StringLength({
                        'min': 0,
                        'max': formBuilderData(fieldName)['maxlength']
                    }))
                }
            }
        });
    }
});
