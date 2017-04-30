$(function () {

    //buttons permission
    var btns = $('.btn-restrict');

    btns.attr('disabled', true);

    var body = document.body;
    var popup = document.createElement("div");
    popup.textContent = "You are not allowed to perform this action!";
    popup.setAttribute('class', 'popup-style');

    btns.on('click', function(){

        $(this).attr('href', '#');

        $(popup).insertBefore($(this).parent());

    });

    //drop-down admin menu
    var menu = $('.menu-head');
    var ul = $('.menu-options');

    menu.on('click', function (e) {

        e.stopPropagation();

        ul.slideToggle();
    });

    //open users messages modal
    ul.find('>:first-child').on('click', function () {
        $('#modal').modal('show').find('#usersMessages');
    });

    $('#back-button').on('click', function () {
       $('#modal').modal('show').find('#usersMessages');
    });

    //Set hiddenInput flag for title or tag search
    $('input[name=search-type]').on('change', function () {

        var searchField = $('input[name=search-info]');
        var elem = $(this).val();

        if(elem == 'item1'){
            searchField.attr('placeholder', 'search by title..');
            $('input[name=search-type-check]').val('1');
        }else{
            searchField.attr('placeholder', 'PHP, JavaScript, CSharp, C++, AJAX, PJAX, Java, Framework, MySQL, C');
            $('input[name=search-type-check]').val('2');
        }
    });

    //DropDownList options
    var ddList = $('.dd-list');
    var tagList = $('.tag-container');

    ddList.on('change', function () {
        var tag = $('input[name=chosen-tag]');
        var tagHolder = document.createElement('div');
        tagHolder.setAttribute('class', 'tag-holder');
        var selected = $('.dd-list option:selected').text();
        tag.val(tag.val() + ' ' + selected);
        tagHolder.setAttribute('id', selected);

        if(tagList.find('div').length > 2){
            alert('You can have most 3 tags!');
            return false;
        }

        if(tagList.find('#'+selected).length){
            return false;
        }else{
            tagHolder.append(selected);
            tagList.append(tagHolder);
        }
    });

    //Show post by tags or tittle
    $('.search-form').on('click', function(event){
        event.preventDefault();
        var flag = $('input[name=search-type-check]').val();
        var input = $('input[name=search-info]').val();

        if( flag == '' ){
            alert('Please, choose your search type!');
            return false;
        }else if( flag == '1' ){
            $.ajax({
                type : 'GET',
                url : '../post/search-post?title='+input,
                dataType : 'json',
                success : function( data ){
                    if(data == 1){
                        alert('No such title!');
                    }else{
                        $('#posts').css('display', 'none');
                        $('.none').fadeIn(1500);
                        $('.title-post h3').html( data.title );
                        $('.content-post').html( data.content );
                        $('.foot-post div.text-left a').attr('href', 'view?id=' + data.post_id);
                    }
                }
            });
        }else if( flag == '2' ){
            $.ajax({
                type : 'GET',
                url : '../post/search-tag?tag='+input,
                dataType : 'json',
                success : function( data ){
                    if(data.length == 0){
                        alert('No posts found!');
                    }else{
                        $('#posts').css('display', 'none');
                        $('.list-view').css('display', 'initial');
                        var table = $('<table>')
                        var thead = $('<tr>')
                        table.append(thead);

                        var title = $('<td>', {
                            text : 'Title'
                        });

                        var content = $('<td>', {
                            text : 'Content'
                        });

                        var date = $('<td>', {
                            text : 'Create Date'
                        });

                        thead.append(title);
                        thead.append(content);
                        thead.append(date);

                        for(var i=0; i < data.length; i++){
                            var aTitle = $('<a>', {
                                value : data[i].title,
                                text : data[i].title,
                                href : '../post/view?id=' + data[i].post_id
                            });
                            var aContent = $('<a>', {
                                value : data[i].content,
                                text : data[i].content,
                                href : '../post/view?id=' + data[i].post_id
                            });
                            var aDateCreate = $('<a>', {
                                value : data[i].date_create,
                                text : data[i].date_create,
                                href : '../post/view?id=' + data[i].post_id
                            });

                            var tr = $('<tr>');

                            tr.append($('<td>', {}).append(aTitle));

                            tr.append($('<td>', {}).append(aContent));

                            tr.append($('<td>', {}).append(aDateCreate));

                            table.append(tr);
                        }

                        $('.list-view').prepend(table);
                        $('.list-view').find('table').addClass('table customize');
                    }
                }
            });
        }
    });

});