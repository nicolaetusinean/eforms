/**
 * Created by gorgan-andrei.
 * Date: 10/9/2016
 * Time: 11:43 AM
 */

/**
 *
 * @returns {*|{}}
 * @param data
 * @param columnName
 * @param list
 */
function setColumnAsKey(data, columnName, list) {
    var sorted = list || {};
    if (typeof data === 'object' && data != null) {
        $.each(data, function (key, val) {
            sorted[val[columnName]] = val;
            if (typeof val.children != "undefined") {
                setColumnAsKey(val.children, columnName, sorted);
            }
        });
    }
    return sorted;
}

function errorsHandler() {
    /**
     * Handles incoming errors in a given form
     *
     * @param form              DOM element
     * @param errors            form_element_name: "Error" pairs
     * @param translationPrefix
     */
    this.handle = function (form, errors) {

        if (errors === null) {
            errors = {'generalError': 'A aparut o eroare interna'};
        }

        if (typeof (errors) === "undefined" || errors.length === 0) {
            return;
        }

        if (typeof errors === 'string') {
            errors = {'generalError': errors};
        }

        // Remove existing errors
        this.removeErrors(form);

        // Add errors to fields
        $.each(errors, function (key, error) {

            var formElement = form.find("[name='" + key + "']");

            // Check for checkboxes also
            if (formElement.length === 0) {
                formElement = form.find("[name='" + key + "[]']");
            }

            // create errors container
            var ul = $('<ul class="errors"></ul>');

            var text = function (prefix, value, isGeneral) {
                if (isGeneral) {
                    return value;
                }

                return prefix + value;
            };

            if (typeof error === 'object') {
                $.each(error, function (index, value) {
                    ul.append($('<li>' + value + '</li>'));
                });
            } else {
                ul.append($('<li>' + error + '</li>'));
            }

            // check if we have an element with the given name
            if (formElement.length) {

                var parent = formElement.closest('.form-group');

                if (parent && parent.length != 0) {
                    formElement.closest('.form-group').addClass('has-error').append(ul);
                } else {
                    formElement.after(ul);
                }
            }

            if (key === 'generalError') {
                form.prepend(ul);
            }

        });
    };

    /**
     * Remove errors from a given form
     *
     * @param form DOM element
     */
    this.removeErrors = function (form) {
        // remove all errors
        form.find('.has-error').removeClass('has-error');
        form.find('.errors').remove();
    };

    return this;
}