/**
 * Created by THINHNV on 02-Mar-17.
 */
function draftAnswer(resultId, questionId, answerId) {
    var url = '/exam/draft-answer/' + resultId + '/' + questionId + '/' + answerId;
    $.get(url, function(response){
        $('.quiz-nav .q-' + questionId).addClass('u-selected');
    });
}

function scrollToQuestion(qId){
    $('html, body').animate({
        scrollTop: $("#qs-" + qId).offset().top - 65
    }, 800);
};