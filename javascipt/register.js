// Wait until the DOM is fully loaded
document.addEventListener("DOMContentLoaded", function () {
    // Select the registration form element
    var bgRegist = document.querySelector('.bg_regist');
    
    // Add the 'show' class after a small delay to trigger the CSS transition
    setTimeout(function () {
        bgRegist.classList.add('show');
    }, 500); // Delay in milliseconds (500ms = 0.5s)
});
