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
    $('#myModal').modal('show');
    $.ajax({
      url: '/app_dev.php/admin/save',
      type: 'POST',
      data: {
        name: formName,
        description: formDescription,
        json: formBuilder.formData
      },
      dataType: 'json',
      success: function(data){
        if (data.valid == 1) {
          window.location.href = "/app_dev.php/admin/list?success=true";
        }
        $('#myModal').modal('show');
      },
      error: function(data){
        $('#myModal .modal-body').html('<div class="alert alert-danger" role="alert">There has been an error!</div>');
      }
    });

    window.sessionStorage.setItem('formData', JSON.stringify(formBuilder.formData));
  });

});
