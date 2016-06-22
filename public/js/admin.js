$(document).ready(function(){
    //Инициализация
    bindGroupDelete();
    bindSkillDelete();
    bindAddSkill();
    bindXEditable();
    bindGroupAdd();
    bindImageUpload();
    bindImageDelete();
    bindAddInfo();
    bindInfoDelete();
    bindAddWork();
    bindWorkDelete();
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

//AJAX удаления группы
function bindGroupDelete() {
    $('.delete_group').unbind();
    $('.delete_group').click(function() {
        var group_id = $(this).attr('data-pk');
        $.get( "/skillgroup/destroy/" + group_id)
        .done(function() {
            var msg = 'Группа навыков удалена!';
            showMessage(msg, 0);
            $('#group' + group_id).fadeOut(500);
            setTimeout(function() {
                $('#group' + group_id).remove();
            }, 600);
        })
        .fail(function() {
            var msg = 'Ошибка при удалении группы навыков!';
            showMessage(msg, 1);
        });
    });
}

//Показать форму добавления навыка
function bindAddSkill() {
    $('.add_skill').unbind();
    $('.add_skill').click(function() {
        $('.hide_skill_form').click();
        
        $(this).parent('li').append('\
                <div class="skill_add"> \
                <input class="new_skill_name" type="text" placeholder="Введите имя навыка">\
                <button class="add_new_skill btn btn-primary btn-xs btn-success">Добавить навык</button>\
                <button class="hide_skill_form btn btn-primary btn-xs btn-danger">Закрыть форму</button>\
                </div>');
        $(this).hide();
        
        var group_id = $(this).attr('data-pk');
        
        $('.hide_skill_form').click(function() {
            $('#group' + group_id +' .add_skill').show();
            $(this).parent('div').remove();
        });
        
        $('.add_new_skill').click(function() {
            addSkill(this, group_id);
        }); 
    });
}

     //Ajax формы добавления навыка 
    function addSkill(button, group_id) {
        $.post( "/skill/store", {name: $('.new_skill_name').val(), group: group_id, _token: $("#_token").data("token")})
        .done(function(data) {
            var msg = 'Навык добавлен!';
            showMessage(msg, 0);
            
            var skill = '<li id="skill' + data.id + '"><span data-pk="' + data.id + '">' + data.name + '</span>';
            skill += '<button class="delete_skill btn btn-primary btn-xs btn-danger" title="Удалить навык" data-pk="' + data.id + '">X</button></li>';

            $('#group' + group_id + ' ul').append(skill);
            $('.hide_skill_form').click();
            bindSkillDelete();
            bindXEditable()
        })
        .fail(function() {
            var msg = 'Ошибка при добавлении навыка!';
            showMessage(msg, 1);
        });
    };
    
//X-editable bind
function bindXEditable() {
    //turn to inline mode
    $.fn.editable.defaults.mode = 'inline';

    // Skills groups
    $('#skills_list>li>span').editable({
                validate: function(value) {
                    if($.trim(value) == '') {
                        var msg = 'Название не должно быть пустым!';
                        showMessage(msg, 1);
                        return false;
                    }
            },
            type: 'text',
            url:'skillgroup/update/',  
            title: 'Редактирование',
            placement: 'top', 
            send:'always',
            ajaxOptions: {
                dataType: 'json',
                headers: {
                   'X-CSRF-Token': $("#_token").data("token")
                }
            },
            success: function() {
                var msg = 'Группа навыков отредактированна!';
                showMessage(msg, 0);
            }
     });
     
     // Skills
    $('#skills_list ul span').editable({
                validate: function(value) {
                    if($.trim(value) == '') {
                        var msg = 'Название не должно быть пустым!';
                        showMessage(msg, 1);
                        return false;
                    }
            },
            type: 'text',
            url:'skill/update/',  
            title: 'Редактирование',
            placement: 'top', 
            send:'always',
            ajaxOptions: {
                dataType: 'json',
                headers: {
                   'X-CSRF-Token': $("#_token").data("token")
                }
            },
            success: function() {
                var msg = 'Навык отредактирован!';
                showMessage(msg, 0);
            }
     });
     
    // Info
    $('.info-contacts li h3, .info-contacts li span').editable({
            validate: function(value) {},
            type: 'text',
            url:'info/update/',  
            title: 'Редактирование',
            placement: 'top', 
            send:'always',
            ajaxOptions: {
                dataType: 'json',
                headers: {
                   'X-CSRF-Token': $("#_token").data("token")
                }
            },
            success: function() {
                var msg = 'Информация отредактирована!';
                showMessage(msg, 0);
            }
     });
     
    // Work
    $('.work-item>span').editable({
            validate: function(value) {},
            type: 'text',
            url:'work/update/',  
            title: 'Редактирование',
            placement: 'top', 
            send:'always',
            ajaxOptions: {
                dataType: 'json',
                headers: {
                   'X-CSRF-Token': $("#_token").data("token")
                }
            },
            success: function() {
                var msg = 'Работа отредактирована!';
                showMessage(msg, 0);
            }
     });
 }
 
//AJAX удаления навыка
function bindSkillDelete() {
    $('.delete_skill').unbind();
    $('.delete_skill').click(function() {
        var skill_id = $(this).attr('data-pk');
        $.get( "/skill/destroy/" + skill_id)
        .done(function() {
            var msg = 'Группа навыков удалена!';
            showMessage(msg, 0);
            $('#skill' + skill_id).fadeOut(500);
            setTimeout(function() {
                $('#skill' + skill_id).remove();
            }, 600);
        })
        .fail(function() {
            var msg = 'Ошибка при удалении группы навыков!';
            showMessage(msg, 1);
        });
    });
}

//AJAX добавления новой группы
function bindGroupAdd() {
    $('#add_new_group').click(function() {
        $.post( "/skillgroup/store", {name: $('#new_group_name').val(), _token: $("#_token").data("token")})
        .done(function(data) {
            var msg = 'Группа навыков добавлена!';
            showMessage(msg, 0);
            
            var skillGroup = '<li id="group' + data.id + '"><span data-pk="' + data.id + '">' + data.name + '</span>';
            skillGroup +=  '<button class="add_skill btn btn-primary btn-xs btn-success" title="Добавить навык" data-pk="' + data.id + '">+</button>';
            skillGroup +=  '<button class="delete_group btn btn-primary btn-xs btn-danger" title="Удалить группу" data-pk="' + data.id + '">X</button>';
            skillGroup +=  '<ul></ul></li>';
            
            $('#skills_list').append(skillGroup);
            $('#new_group_name').val('');
            
            bindGroupDelete();
            bindAddSkill();
            bindXEditable();
        })
        .fail(function() {
            var msg = 'Ошибка при добавлении группы навыков!';
            showMessage(msg, 1);
        });
    });
}

// Profile image upload
function preValidateImage() {
    if($('#image-upload input')[0].files[0] === undefined) {
        var msg = "Файл не задан";
        showMessage(msg, 1);
        return false;
    }
    
    var file =  $('#image-upload input')[0].files[0];
    name = file.name;
    size = file.size;
    type = file.type;

    if(file.size > 5000000) {
        var msg = "Файл слишком большой";
        showMessage(msg, 1);
        return false;
    }
    else if(file.type != 'image/png' && file.type != 'image/jpg' && file.type != 'image/gif' && file.type != 'image/jpeg' ) {
        var msg = "Файл должен быть в формате png, jpg или gif";
        showMessage(msg, 1);
        return false;
     }
     return true;
}

function bindImageUpload() {
    $('#image-upload').submit(false);
    $('#image-upload input').change(function(){
        preValidateImage();
    });
    
    $('.image-add').click(function(){
        if(preValidateImage()) {
                var formData = new FormData($('#image-upload')[0]);
                $.ajax({
                    url: '/info/image',  //server script to process data
                    type: 'POST',
                    // Ajax events
                    success: completeHandler = function(data) {
                        if(data.success) {
                            $("#profile-image").attr('src', data.image);
                            var msg = 'Изображение было успешно загружено!';
                            showMessage(msg, 0);
                        } else {
                            var msg = 'Изображение не было загружено!';
                            showMessage(msg, 1);
                        }
                    },
                    error: errorHandler = function() {
                        var msg = 'Изображение не было загружено!';
                        showMessage(msg, 1);
                    },
                    // Form data
                    data: formData,
                    // Options to tell jQuery not to process data or worry about the content-type
                    cache: false,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-Token': $("#_token").data("token")
                     }
                }, 'json');
            }
        });
    };
    
    function bindImageDelete() {
    $('.image-delete').click(function() {
        $.get( "/info/destroyimage/")
        .done(function() {
            var msg = 'Изображение удалено!';
            $("#profile-image").attr('src', 'img/default.png');
        })
        .fail(function() {
            var msg = 'Ошибка при удалении изображения!';
            showMessage(msg, 1);
        });
        });
    };
    
    //Ajax формы добавления информации 
    function bindAddInfo() {
        $('.add_info').unbind();
        $('.add_info').click(function() {
            $.post( "/info/store", {name: $('#info-add input[name=name]').val(), value: $('#info-add input[name=value]').val(), protect: $('#info-add input[name=protect]').is(':checked'), _token: $("#_token").data("token")})
            .done(function(data) {
                var msg = 'Информация добавлена!';
                showMessage(msg, 0);

                var item = '<li id="info' + data.id + '"><h3 data-name="name" data-pk="' + data.id + '">' + data.name + '</h3><span data-pk="' + data.id + '" data-name="value">' + data.value + '</span>';
                item += '<button class="delete_info btn btn-primary btn-xs btn-danger" title="Удалить информацию" data-pk="' + data.id + '">X</button></li>';

                $('.info-contacts').append(item);

                bindInfoDelete();
                bindXEditable()
            })
            .fail(function() {
                var msg = 'Ошибка при добавлении информации!';
                showMessage(msg, 1);
            });
        });
    };

//AJAX удаления информации
function bindInfoDelete() {
    $('.delete_info').unbind();
    $('.delete_info').click(function() {
        var info_id = $(this).attr('data-pk');
        $.get( "/info/destroy/" + info_id)
        .done(function() {
            var msg = 'Информация удалена!';
            showMessage(msg, 0);
            $('#info' + info_id).fadeOut(500);
            setTimeout(function() {
                $('#info' + info_id).remove();
            }, 600);
        })
        .fail(function() {
            var msg = 'Ошибка при удалении информации!';
            showMessage(msg, 1);
        });
    });
}

//Ajax формы добавления работы
function bindAddWork() {
    $('#work-add').submit(false);
    $('.add-work').unbind();
    $('.add-work').click(function() {
        
    var formData = new FormData($('#work-add')[0]);
    $.ajax({
        url: '/work/store',  //server script to process data
        type: 'POST',
        // Ajax events
        success: completeHandler = function(data) {
            if(data.id) {
                var msg = 'Работа добавлена!';
                showMessage(msg, 0);
                var item =  '<div class="col-md-4"><div id="work' + data.id + '">';
                item += '<h3 data-name="name" data-pk="' + data.id + '">' + data.name + '</h3>';
                item += '<div class="col-md-4"><img src="img/' + data.image + '"></div><div class="col-md-8">';
                item += '<h4>Описание</h4><span data-pk="' + data.id + '" data-name="description">' + data.description + '</span>';
                item += '<h4>Технологии</h4><span data-pk="' + data.id + '" data-name="technology">' + data.technology + '</span>';
                item += '<h4>Роль в проекте</h4><span data-pk="' + data.id + '" data-name="role">' + data.role + '</span></div></div>';
                $('.work-wrap').append(item);

                bindInfoDelete();
                bindXEditable()
            } else {
                var msg = 'Ошибка при добавлении работы!';
                showMessage(msg, 1);
            }
        },
        error: errorHandler = function() {
            var msg = 'Ошибка при добавлении работы!';
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

        
//AJAX удаления работы
function bindWorkDelete() {
    $('.delete_work').unbind();
    $('.delete_work').click(function() {
        var id = $(this).attr('data-pk');
        $.get( "/work/destroy/" + id)
        .done(function() {
            var msg = 'Работа удалена!';
            showMessage(msg, 0);
            $('#work' + id).fadeOut(500);
            setTimeout(function() {
                $('#work' + id).remove();
            }, 600);
        })
        .fail(function() {
            var msg = 'Ошибка при удалении работы!';
            showMessage(msg, 1);
        });
    });
}

