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
        inputGroups : function (object) {
            return $(object).parents('.panel-collapse').find('.create-form').find('input').parent().find('input');
        }
    };

    $('.form-opener').on('click', function (event) {
       event.preventDefault();
        var $formToOpen = $(this).next('.create-form')[0];
        $($formToOpen).toggleClass('display-block');
    });

    $(document).on('click', '.usages-edit', function(){
        var partId = parseInt(this.id);
        var $gridViewRow = $(this).parents('tr');
        var newQty = UsagesView.newQuantity($gridViewRow);
        var oldQty = UsagesView.oldQuantity($gridViewRow);
        var offsettQty = newQty - oldQty;
        if (newQty < 1 ){
            alert ('Такое изменение невозможно или бессмысленно!')
        }else{
            if (confirm('Количество будет установлено равным.' + ' ' + newQty + '.')){
                var $inputsGroup = UsagesView.inputGroups(this);
                $($inputsGroup[3]).val(partId);
                $($inputsGroup[4]).val(offsettQty);
                $(this).parents('.panel-collapse').find('.create-form').find('button').click();
            }
        }
    });
    $(document).on('click', '.usages-delete', function(){
        var partId = parseInt(this.id);
        var $gridViewRow = $(this).parents('tr');
        var offsettQty = - UsagesView.oldQuantity($gridViewRow);
        var $inputsGroup = UsagesView.inputGroups(this);
        $($inputsGroup[3]).val(partId);
        $($inputsGroup[4]).val(offsettQty);
        if (confirm('Пожалуйста, подтвердите удаление.')){
            $(this).parents('.panel-collapse').find('.create-form').find('button').click();
        }
    });

})(jQuery);
