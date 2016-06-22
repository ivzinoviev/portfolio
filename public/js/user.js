$(document).ready(function(){
    bindRobotCheck();
    $('.popup-image').magnificPopup({type:'image'});
});

 // Показать сообщение
 function showMessage(msg, err) {
     msg = msg + ' <span class="close-message">[x]</span>';
     if(!err) {
         $('#msg').addClass('alert-success').removeClass('alert-error').html(msg).show();
     } else {
         $('#msg').addClass('alert-error').removeClass('alert-success').html(msg).show();
     }
     $('.close-message').click(function() {
         $('#msg').hide();
     });
 }

//Проверка капчи, получение скрытых данных
function bindRobotCheck() {
    $('#robot-check').submit(false);
    var formData = new FormData($('#robot-check')[0]);
    $('.robot-check-btn').click(function() {
        $.ajax({
            url: '/info/secret',  //server script to process data
            type: 'POST',
            // Ajax events
            success: completeHandler = function(data) {
                if(data[0] != false) {
                   $('#robot-check').hide();
                   data.forEach(function(item) {
                       $('#info' + item.id + ' span').html(item.value);
                   });
                }
            },
            error: errorHandler = function() {
                var msg = 'Ошибка, попробуйте ещё раз';
                showMessage(msg, 1);
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-Token': $("#_token").data("token")
            }
        }, 'json');     
    });
};