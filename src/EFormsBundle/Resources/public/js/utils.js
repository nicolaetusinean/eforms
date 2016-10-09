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