function ajaxRequest(data, id) {
    console.log(data);
    return $.ajax({
        type: 'GET',
        url: '/profile/' + id,
        data: data
    }).done(function (response) {
        return response;
    });

}
$(document).ready(function(){
    $('#showAll').on('click', function () {
        console.log('click');
        let data = {
            all: true,
        };
        let id = $(this).attr('data-id');
        ajaxRequest(data, id).then(function (response) {
            if (response.success && response.page) {
               let comment_section = $('#comments_section');
               comment_section.html(response.page);
               $('#showAll').prop('disabled',true);
            }
        });
    })
});
