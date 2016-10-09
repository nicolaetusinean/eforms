jQuery(document).ready(function($) {
  var buildWrap = document.querySelector('.build-wrap'),
      renderWrap = document.querySelector('.render-wrap'),
      formData = window.sessionStorage.getItem('formData'),
      editing = true,
      fbOptions = {
        dataType: 'json',
        typeUserAttrs: {
          text: {
            className: {
              label: 'Add validation',
              options: {
                "": "None",
                'Email': 'E-mail validation'
              }
            }
          },
          number: {
            min: {
              label: 'Min',
              maxlength: '10',
              description: 'Minimum'
            },
            max: {
              label: 'Max',
              maxlength: '10',
              description: 'Maximum'
            },
            className: {
              label: 'Add validation',
              options: {
                "": "None",
                'Cnp': 'CNP validation'
              }
            }
          }
        }
      };

  if (formData) {
    fbOptions.formData = JSON.parse(formData);
  }

  var toggleEdit = function() {
    document.body.classList.toggle('form-rendered', editing);
    editing = !editing;
  };

  var formBuilder = $(buildWrap).formBuilder(fbOptions).data('formBuilder');

  $('.form-builder-save').click(function(e) {
    var formName = $("#formName").val();
    if (formName == "") {
      alert("alegeti numele formularului");
      return;
    }
    var formDescription = $("#formDescription").val();

    toggleEdit();
    $(renderWrap).formRender({
      dataType: 'json',
      formData: formBuilder.formData
    });

    $.ajax({
      url: '/app_dev.php/admin/save',
      type: 'POST',
      data: {
        name: formName,
        description: formDescription,
        json: formBuilder.formData
      },
      dataType: 'json'
    });

    window.sessionStorage.setItem('formData', JSON.stringify(formBuilder.formData));
  });
});
