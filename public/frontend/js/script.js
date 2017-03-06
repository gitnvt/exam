/**
 * Created by THINHNV on 02-Mar-17.
 */
function draftAnswer(resultId, questionId, answerId) {
    var url = '/exam/draft-answer/' + resultId + '/' + questionId + '/' + answerId;
    $.get(url, function(response){

    });
}