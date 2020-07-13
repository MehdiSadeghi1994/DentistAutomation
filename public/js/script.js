$(document).ready(function () {

    light_dark_switch();

    function light_dark_switch() {
        if (localStorage.getItem("light-dark-mode") != null) {
            if (localStorage.getItem("light-dark-mode") == 'light') {
                $('.bg-dark').toggleClass("bg-dark bg-white");
                $('.bg-black').toggleClass("bg-black bg-light");
                $('.btn-dark').toggleClass("btn-dark btn-white");
                $('.table').removeClass("table-dark");
                $('.text-white').toggleClass("text-white text-dark");

                $('#light-dark-switch').prop('checked', true);

            } else {
                $('.bg-light').toggleClass("bg-light bg-black");
                $('.bg-white').toggleClass("bg-white bg-dark");
                $('.btn-white').toggleClass("btn-white btn-dark");
                $('.table').addClass("table-dark");
                $('.text-dark').toggleClass("text-dark text-white");
            }
        }
    }

    $('#btn-toogle-sidebar').click(function () {
        $('#sidebar').toggle("slide");
    });

    $('#light-dark-switch').change(function () {

        if (this.checked) {
            localStorage.setItem("light-dark-mode", 'light');
        } else {
            localStorage.setItem("light-dark-mode", 'dark');
        }
        light_dark_switch();
    });
})