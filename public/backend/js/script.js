/*
 By Osvaldas Valutis, www.osvaldas.info
 Available for use under the MIT License
 */

'use strict';

;( function ( document, window, index )
{
    var inputs = document.querySelectorAll( '.inputfile' );
    Array.prototype.forEach.call( inputs, function( input )
    {
        var label	 = input.nextElementSibling,
            labelVal = label.innerHTML;

        input.addEventListener( 'change', function( e )
        {
            var fileName = '';
            if( this.files && this.files.length > 1 )
                fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
            else
                fileName = e.target.value.split( '\\' ).pop();

            if( fileName )
                label.querySelector( 'span' ).innerHTML = fileName;
            else
                label.innerHTML = labelVal;
        });

        // Firefox bug fix
        input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
        input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
    });
}( document, window, 0 ));

function totalQuestions() {
    var total = 0;
    $('.exam-matrix-item').each(function () {
        total += parseInt($(this).val());
    })
    $('#total-questions').text(total);
}

function manualGetQuestions(examMatrixId, bankId) {
    var url = '/exam/questions/' + examMatrixId + '/' + bankId;
    $.get(url, function(response){
        var data = $.parseJSON(response);
        var html = '';
        $.each(data, function(k, v){
           // console.log(k);
            console.log(v.answers);
            html += '<tr>';
            html += '<td>';
            html += '<div class="checkbox" style="margin: 0;">';
            html += '<label style="font-size: 1.1em; padding-left: 0;">';
            html += '<input value="' + v.id + '" name="Manual[]" type="checkbox">';
            html += '<span class="cr"><i class="cr-icon fa fa-check"></i></span>';
            html += '</label>';
            html += '</div>';
            html += '</td>';
            html += '<td>';
            html += '<div class="panel panel-primary">';
            html += '<div class="panel-heading">';
            html += '<h3 class="panel-title">';
            html += v.content;
            html += '</h3>';
            html += '</div>';
            html += '<div class="panel-body">';
            html += '<div class="row">';
            var i = 1;
            $.each(v.answers, function (ak, av) {
                html += '<div class="col-md-6">';
                html += '<div class="radio" style="margin: 5px 0;">';
                html += '<label>';
                html += i + '. ' + av.content;
                html += '</label>';
                html += '</div>';
                html += '</div>';
                i++;
            });
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</td>';
            html += '</tr>';
        });
        var tbId = '#manual_' + data[0].term_id + '_' + data[0].level;
        $(tbId + ' table tbody').empty();
        $(tbId + ' table tbody').append(html);
    });
}