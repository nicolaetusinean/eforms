/**
 * Created by andrei_gorgan on 3/26/2015.
 */

/**
 * Validation object
 *
 * Usage:
 * var validation = new Validation();
 *
 * validation.add('username', new Validator.PresenceOf({message: 'This field must be present'}));
 *
 * var valid = validation.validate(params);
 * if (valid === true) {
 *      // all parameters are valid
 * } else {
 *      valid is an object with the messages, for each field
 *      {
 *          'username': 'This field must be present'
 *      }
 * }
 *
 *
 */
var Validation = function () {

    this.chain = []; // Validators needed
    this.messages = {};// Messages populated after populate

    /**
     * Add a validator to validation object
     *
     * @param fieldName
     * @param validator
     */
    this.add = function(fieldName, validator) {
        // set the fieldname to the validator
        validator.fieldName = fieldName;

        // Add the validator to the chain
        this.chain.push(validator);
    };

    /**
     * Validates the parameters
     *
     * @param params
     * @returns {*}
     */
    this.validate = function(params) {
        var tmpValid = '';
        var key;
        var chainLength = this.chain.length;

        // Loop through validators
        for(key=0; key < chainLength; key++) {

            // Check the validator to have validate function implemented
            if (typeof this.chain[key].validate !== 'function') {
                var name = /(\w+)\(/.exec(this.chain[key].constructor.toString())[1];
                throw new Exception('Internal: The validator ' + name + ' must have validate function');
            }

            // Validate the fields against this validator
            tmpValid = this.chain[key].validate(params);

            // If not valid and we do not already have a message for this field
            if (tmpValid !== true && !this.messages[this.chain[key].fieldName]) {
                this.messages[this.chain[key].fieldName] = tmpValid;

                if (this.chain[key].cancelOnFail) {
                    break;
                }
            }
        }

        // Check if there are any messages
        for(var i in this.messages) {
            return this.messages;
        }

        return true;
    }
};

var Validator = {
    assignNotRequiredOptions: function(options, object) {
        object.fieldName = '';

        if (typeof options === 'object' && typeof options.message === 'string') {
            object.message = options.message;
        } else {
            if (typeof object.message !== 'string') {
                object.message = 'fieldInvalid';
            }
        }

        if (typeof options === 'object' && typeof options.cancelOnFail === 'boolean') {
            object.cancelOnFail = options.cancelOnFail;
        } else {
            object.cancelOnFail = false;
        }

        return object;
    }
};

/**
 * Validates that the value of a field matches a regular expression
 * Options list
 *
 * pattern (object) Required, Regex pattern
 * message (string) Optional, Message returned if not valid value
 *
 * @param options
 * @constructor
 */
Validator.Regex = function(options) {

    var self = Validator.assignNotRequiredOptions(options, this);

    self.pattern = null;

    if (typeof options === 'object' && typeof options.pattern === 'object') {
        self.pattern = options.pattern;
    } else {
        throw new Exception("Please provide a pattern when creating a regexp validator");
    }

    self.validate = function(params) {
        if (typeof params === 'object' && typeof params[self.fieldName] !== 'undefined' && self.pattern.test(params[self.fieldName])) {
            return true;
        }

        return self.message;
    }
};

/**
 * Validates that field contains a valid email format
 * Options list
 *
 * message (string) Optional, Message returned if not valid value
 *
 * @param options
 * @constructor
 */
Validator.Email = function(options) {

    var pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (typeof options === 'object') {
        options.pattern = pattern;
    } else {
        options = {pattern: pattern};
    }

    return new Validator.Regex(options);
};

/**
 * Validates that field contains a valid email format
 * Options list
 *
 * message (string) Optional, Message returned if not valid value
 *
 * @param options
 * @constructor
 */
Validator.Cnp = function(options) {

    var pattern = /^([0-9]{13})$/;

    if (typeof options === 'object') {
        options.pattern = pattern;
    } else {
        options = {pattern: pattern};
    }

    return new Validator.Regex(options);
};

/**
 * Validates that field contains a valid numeric value
 * Options list
 *
 * message (string) Optional, Message returned if not valid value
 *
 * @param options
 * @constructor
 */
Validator.IsNumeric = function(options) {
    var pattern = /^\d+$/;
    var message = 'fieldNotNumeric';

    if (typeof options === 'object' && typeof options.message === 'string') {
        message = options.message;
    }

    return new Validator.Regex({pattern: pattern, message: message});
};

/**
 * Validates that a field’s value exists, is not null or empty string.
 * Options list
 *
 * message (string) Optional, Message returned if not valid value
 *
 * @param options
 * @constructor
 */
Validator.PresenceOf = function(options) {
    this.message = 'fieldRequired';
    var self = Validator.assignNotRequiredOptions(options, this);

    this.validate = function(params) {

        if (typeof params === 'object' && typeof params[self.fieldName] !== 'undefined' && typeof params[self.fieldName] !== null && params[self.fieldName] !== '') {
            return true;
        }

        return self.message;
    }
};

/**
 * StringLength validator
 * Options list
 *
 * min            (int)    Required, The minimum string length allowed
 * max            (int)    Optional, The maximum string length allowed
 * messageMinimum (string) Optional, Message returned if value lower than minimum
 * messageMaximum (string) Optional, Message returned if value bigger than maximum
 * message        (string) Optional, Message returned if not valid value and messageMinimum/messageMaximum
 *
 * @param options
 * @constructor
 */
Validator.StringLength = function(options) {
    var self = Validator.assignNotRequiredOptions(options, this);

    self.min = null;
    self.max = null;

    self.messageMinimum = null;
    self.messageMaximum = null;

    var numericPattern = /^\d+$/;

    if (typeof options === 'object' && typeof options.min !== 'undefined' && numericPattern.test(options.min)) {
        self.min = parseInt(options.min);
    } else {
        throw new Exception("Please provide the minimum string length (min option)");
    }

    if (typeof options === 'object') {
        if (typeof options.max !== 'undefined' && numericPattern.test(options.max)) {
            self.max = parseInt(options.max);
        }

        if (typeof options.message === 'string') {
            self.message = options.message;
        }

        if (typeof options.messageMinimum === 'string') {
            self.messageMinimum = options.messageMinimum;
        }

        if (typeof options.messageMaximum === 'string') {
            self.messageMaximum = options.messageMaximum;
        }
    }

    this.validate = function(params) {

        if (typeof params === 'object' && typeof params[self.fieldName] === 'string') {

            var length = params[self.fieldName].length;
            if (length >= self.min) {
                if (numericPattern.test(options.max)) {
                    if (length <= self.max) {
                        return true;
                    }
                } else {
                    return true;
                }
            }

            // If message minimum set return this
            if (length < self.min && self.messageMinimum) {
                return self.messageMinimum;
            }

            // If message maximum set return this
            if (length < self.max && self.messageMaximum) {
                return self.messageMaximum;
            }
        }

        return self.message;
    }
};

/**
 * Validates that a field’s value is the same as a specified value
 * Options list
 *
 * accepted (mixed) Required, The value to compare to
 * message (string) Optional, Message returned if not valid value
 *
 * @param options
 * @constructor
 */
Validator.Identical = function(options) {
    this.message = 'fieldNotIdentical';

    var self = Validator.assignNotRequiredOptions(options, this);

    if (typeof options === 'object' && typeof options.accepted !== 'undefined') {
        self.accepted = options.accepted;
    } else {
        throw new Exception('You need to provide the accepted value');
    }

    this.validate = function(params) {
        if (
            typeof params === 'object' &&
            typeof params[self.fieldName] !== 'undefined' &&
            params[self.fieldName] === self.accepted
        ) {
            return true;
        }

        return self.message;
    }
};

/**
 * Between validator
 * Options list
 *
 * min            (int)    Required, The minimum number allowed
 * max            (int)    Optional, The maximum number allowed
 * messageMinimum (string) Optional, Message returned if value lower than minimum
 * messageMaximum (string) Optional, Message returned if value bigger than maximum
 * message        (string) Optional, Message returned if not valid value and messageMinimum/messageMaximum
 *
 * @param options
 * @constructor
 */
Validator.Between = function(options) {
    var self = Validator.assignNotRequiredOptions(options, this);

    self.min = null;
    self.max = null;

    self.messageMinimum = null;
    self.messageMaximum = null;

    if (typeof options === 'object' && typeof options.min === 'number') {
        self.min = parseFloat(options.min);
    } else {
        throw new Exception("Please provide the minimum value (min option)");
    }

    if (typeof options === 'object' && typeof options.max === 'number') {
        self.max = parseFloat(options.max);
    }

    if (typeof options === 'object' && typeof options.message === 'string') {
        self.message = options.message;
    }

    if (typeof options === 'object' && typeof options.messageMinimum === 'string') {
        self.messageMinimum = options.messageMinimum;
    }

    if (typeof options === 'object' && typeof options.messageMaximum === 'string') {
        self.messageMaximum = options.messageMaximum;
    }

    this.validate = function(params) {

        if (typeof params === 'object' && typeof params[self.fieldName] === 'number') {

            var length = parseFloat(params[self.fieldName]);
            if (length >= self.min) {
                if (typeof self.max === 'number') {
                    if (length <= self.max) {
                        return true;
                    }
                } else {
                    return true;
                }
            }

            // If message minimum set return this
            if (length < self.min && self.messageMinimum) {
                return self.messageMinimum;
            }

            // If message maximum set return this
            if (length < self.max && self.messageMaximum) {
                return self.messageMaximum;
            }
        }

        return self.message;
    }
};