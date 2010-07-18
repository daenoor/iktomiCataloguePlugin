<script type="text/javascript">
  function adjustPropertyValueField(elemType){
    //alert(elemType);
    switch(elemType){
      case 'n':
      case 's':
      case 'l':
        $('.sf_admin_form_field_property_value').hide();
        break;
      case 'm':
        $('.sf_admin_form_field_property_value').show().effect('highlight', {}, 3000);
        $('.sf_admin_form_field_property_value div label').html('Единица измерения');
        break;
      case 'e':
        $('.sf_admin_form_field_property_value div label').html('Варианты');
        $('.sf_admin_form_field_property_value').show().effect('highlight', {}, 3000);
        $('#catalogue_property_property_value').attr({
          name: 'catalogue_property[property_value][]',
          id: 'catalogue_property_property_value_1',
          'class': 'list_variant'
        }).wrap('<div>').parent().append($('<input>').attr({
          type: 'button',
          value: 'Удалить',
          'class': 'catalogue_property_value_remove'
        })).after($('<input>').attr({
          type: 'button',
          value: 'Добавить',
          'class': 'catalogue_property_value_add'
        }));

        //TODO: Add list initialisation from passed value (string with ;)
    }
  }

  $(document).ready(function(){
    var valueItemCount = 1;

    // first we need to adjust value box depending on property type
    // n, s, l - hide it
    // m - show & set appropriate label
    // e - set appropriate label & make a wonderful thing
    adjustPropertyValueField($('#catalogue_property_property_type').attr('value'));

    $('#catalogue_property_property_type').change(function(){
      adjustPropertyValueField(this.value);
    })

    // Add button handler in list
    $('.catalogue_property_value_add').live('click', function(){
      $(this).before($('<div>').append($('<input>').attr({
        type: 'text',
        name: 'catalogue_property[property_value][]',
        id: 'catalogue_property_property_value_'+(++valueItemCount),
        'class': 'list_variant'
      })).append($('<input>').attr({
        type: 'button',
        value: 'Удалить',
        'class': 'catalogue_property_value_remove'
      })));
    });

    // Remove button handler in list
    $('.catalogue_property_value_remove').live('click', function(){
      $(this).parent().fadeOut().remove();
      valueItemCount--;
    });

    // Just before submit we'll join list items to one string
    $('.sf_admin_form form').submit(function(){
      var resultValue = '';
      $('.list_variant').each(function(){
        resultValue += this.value+';';
      });
      resultValue = resultValue.slice(0,-1);
      $('.sf_admin_form_field_property_value div div').remove();
      $('.sf_admin_form_field_property_value div').append('<div>');
      $('.sf_admin_form_field_property_value div div').append($('<input>').attr({
        type: 'text',
        name: 'catalogue_property[property_value]',
        id: 'catalogue_property_property_value',
        'value': resultValue
      }));
      //alert(resultValue);

      return true;
    })
  })

</script>