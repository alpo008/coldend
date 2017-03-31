/**
 * Created by alpo on 22.03.17.
 */
(function($){

    var UsagesForm = function(){


    };
    

    $('.form-opener').on('click', function (event) {
       event.preventDefault();
        $formToOpen = $(this).next('.create-form')[0];
        $($formToOpen).toggleClass('display-block');
    });

    $('.usages-edit').on('click', function(event){
        event.preventDefault();
        console.log(parseInt(this.id));
    });
    $('.usages-delete').on('click', function(event){
        event.preventDefault();
        var confirmDeletion = confirm('Пожалуйста, подтвердите удаление.');
        console.log(parseInt(this.id));
    });

})(jQuery);
