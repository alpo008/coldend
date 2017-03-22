/**
 * Created by alpo on 22.03.17.
 */
(function($){
    
    $('.form-opener').on('click', function (event) {
       event.preventDefault();
        $formToOpen = $(this).next('.create-form')[0];
        $($formToOpen).toggleClass('display-block');
    });

})(jQuery);
