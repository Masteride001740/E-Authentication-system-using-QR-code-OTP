function showabout() {
    $("#about_container").fadeIn(800).addClass("animated slideInLeft");
    setTimeout(function () {
        $("#about_container").removeClass("animated slideInLeft");
    }, 800);
}

function closeabout() {
    $("#about_container").addClass("animated slideOutLeft");
    setTimeout(function () {
        $("#about_container").removeClass("animated slideOutLeft").fadeOut(800);
    }, 800);
}

function showwork() {
    $("#work_container").fadeIn(800).addClass("animated slideInRight");
    setTimeout(function () {
        $("#work_container").removeClass("animated slideInRight");
    }, 800);
}

function closework() {
    $("#work_container").addClass("animated slideOutRight");
    setTimeout(function () {
        $("#work_container").removeClass("animated slideOutRight").fadeOut(800);
    }, 800);
}

function showcontact() {
    $("#contact_container").fadeIn(800).addClass("animated slideInUp");
    setTimeout(function () {
        $("#contact_container").removeClass("animated slideInUp");
    }, 800);
}

function closecontact() {
    $("#contact_container").addClass("animated slideOutDown");
    setTimeout(function () {
        $("#contact_container").removeClass("animated slideOutDown").fadeOut(800);
    }, 800);
}

// Optimized loading screen handling
setTimeout(function () {
    $("#loading").fadeOut(1000); // Use fadeOut for smooth animation
    setTimeout(function () {
        $("#loading").css("display", "none");
        $("#box").fadeOut(1000); // Hide the bouncing box with a fadeOut animation
        // Remove animation classes for the nav items to allow fresh animations when needed
        $("#about, #work, #contact").removeClass("animated fadeIn");
    }, 1000);
}, 1500);
