
$(document).ready(function () {
    $('.js-delete-user').on('click', function (e) {
        e.preventDefault();

        var url = $(this).attr('href');
        delUser(url);
        $(this).closest('tr').remove()
        function delUser(url) {
            $.ajax({
                type: "POST",
                url: url
            }).done(function (data) {
                console.log((data).id + " törölve");

            }).fail(function () {
                alert("Nem lehetett törölni");
            });
        }
    });
});