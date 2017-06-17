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

    var RelationsView = {
        hideShowInput : function (n, m, v) {
            var $formGroup = $('#relations-form');
            var $inputsGroup = $($formGroup).find('input');
            var $labelsGroup = $($formGroup).find('label');
            $($inputsGroup[n]).hide();
            $($inputsGroup[n]).val(v);
            $($labelsGroup[n-1]).hide();
            $($inputsGroup[m]).show();
            $($inputsGroup[m]).val(null);
            $($labelsGroup[m-1]).show();
        },
        unitId : function () {
            return $('#relations-form').find('.unit-id').html();
        },
        sendDelete : function (object, row, primaryId){
            var $inputsGroup = $('#relations-form').find('input');
            var $dataGroup =($(row).children('td'));
            var secondaryId = parseInt($($dataGroup[1]).find('a').html());
            $($inputsGroup[2]).val('del');
            $($inputsGroup[3]).val('del');
            $($inputsGroup[4]).val(primaryId);
            $($inputsGroup[5]).val(secondaryId);
            $(object).parents('.panel-collapse').find('.create-form').find('button').click();
        }
    };

    var ListsForm = {
        newQuantity : function (object){
            return parseInt($(object).find('.lists-qty').val());
        },
        oldQuantity : function (object){
            return parseInt($(object).find('.old-qty').html());
        },
        sendForm : function (object, offset) {
            var $listsForm = $('.clists-form');
            var $inputsGroup = $listsForm.find('input');
            $($inputsGroup[2]).val(parseInt(object.id));
            $($inputsGroup[3]).val(offset);
            $listsForm.find('button').click();
        },
        setQty : function (object, qty){
            $(object).find('.lists-qty').val(qty);
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

    $(document).on('click', 'form input:radio', function(){
        var partKind = $(this).val();
        if (partKind == 'parent'){
            RelationsView.hideShowInput(5, 4, RelationsView.unitId());
        }
        if (partKind == 'child'){
            RelationsView.hideShowInput(4, 5, RelationsView.unitId());
        }
    });

    $(document).on('click', '.relations-delete', function(){
        var $gridViewRow = $(this).parents('tr');

        if (confirm('Пожалуйста, подтвердите удаление.')){
            RelationsView.sendDelete(this, $gridViewRow, RelationsView.unitId());
        }
    });

    $(document).on('click', '.lists-edit', function(){
        var $gridViewRow = $(this).parents('tr');
        var newQty = ListsForm.newQuantity($gridViewRow);
        var oldQty = ListsForm.oldQuantity($gridViewRow);
        var offsettQty = newQty - oldQty;
        if (newQty < 1 || offsettQty == 0 ){
            ListsForm.setQty($gridViewRow, oldQty.toFixed(2));
            alert ('Такое изменение невозможно или бессмысленно!')
        }else{
            if (confirm('Количество будет установлено равным.' + ' ' + newQty + '.')){
                ListsForm.sendForm(this, offsettQty);
            }
        }
    });

    $(document).on('click', '.lists-delete', function(){
        var $gridViewRow = $(this).parents('tr');
        var offsettQty = - ListsForm.oldQuantity($gridViewRow);
        if (confirm('Пожалуйста, подтвердите удаление.')){
            ListsForm.sendForm(this, offsettQty);
        }
    });

    $(document).on('change', '.field-orders-status', function () {
        var selectedOption = $(this).find('select option:selected').val();
            if (selectedOption == 4){
                $('.incoms-switch').show();
            }else{
                $('.incoms-switch').find('input:checkbox').attr('checked', false);
                $('.incoms-switch').hide();
                $('.field-orders-incometo').hide();
            }
    });

    $(document).on('change', '.incoms-switch > input', function () {
        $('.field-orders-incometo').show();
    })

})(jQuery);
