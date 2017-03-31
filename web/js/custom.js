/**
 * Created by alpo on 22.03.17.
 */
(function($){

    var UsagesView = {
        newQuantity : function (object){
            return parseInt($(object).find('.usages-qty').val());
        },
        oldQuantity : function (object){
            return parseInt($(object).find('.old-qty').html());
        },
        sendForm : function (object, offset) {
            var $inputsGroup = $(object).parents('.panel-collapse').find('.create-form').find('input').parent().find('input');
            $($inputsGroup[3]).val(object.id);
            $($inputsGroup[4]).val(offset);
            $(object).parents('.panel-collapse').find('.create-form').find('button').click();
        }
    };

    $('.form-opener').on('click', function (event) {
       event.preventDefault();
        var $formToOpen = $(this).next('.create-form')[0];
        $($formToOpen).toggleClass('display-block');
    });

    $(document).on('click', '.usages-edit', function(){
        var $gridViewRow = $(this).parents('tr');
        var newQty = UsagesView.newQuantity($gridViewRow);
        var oldQty = UsagesView.oldQuantity($gridViewRow);
        var offsettQty = newQty - oldQty;
        if (newQty < 1 || offsettQty == 0 ){
            alert ('Такое изменение невозможно или бессмысленно!')
        }else{
            if (confirm('Количество будет установлено равным.' + ' ' + newQty + '.')){
                UsagesView.sendForm(this, offsettQty);
            }
        }
    });
    $(document).on('click', '.usages-delete', function(){
        var $gridViewRow = $(this).parents('tr');
        var offsettQty = - UsagesView.oldQuantity($gridViewRow);
        if (confirm('Пожалуйста, подтвердите удаление.')){
            UsagesView.sendForm(this, offsettQty);
        }
    });

})(jQuery);
