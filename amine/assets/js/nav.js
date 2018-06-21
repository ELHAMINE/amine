window.addEventListener('load', function () {
    var openNav = $('#openNav');
    var closeNav = $('#closeNav');
    var vertNavBar = $('#vertNavBar');

    openNav.addEventListener('click', function () {
        vertNavBar.style.width = '250px';
    });

    closeNav.addEventListener('click', function () {
        vertNavBar.style.width = '0px';
    });
});