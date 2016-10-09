/**
 * Created by gorgan-andrei.
 * Date: 10/9/2016
 * Time: 10:20 AM
 */

jQuery(document).ready(function($) {
    var renderWrap = document.querySelector('.render-wrap'),
        formData = window.sessionStorage.getItem('formData');

    $(renderWrap).formRender({
        dataType: 'json',
        formData: formBuilder.formData
    });

});
