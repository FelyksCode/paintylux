import "./bootstrap";

$(document).ready(() => {
    // Dynamic navbar styling
    $(window).scroll(() => {
        // Utilities
        const whiteText = "text-[rgb(var(--white-rgb))]";

        // Navbar
        const plainNavbar =
            "fixed top-0 left-0 z-[1] w-screen h-[var(--navbar-height) smooth backdrop-blur-md";
        const coloredNavbar = `${plainNavbar} bg-[rgba(var(--acc-rgb),0.8)]`;

        // Navlinks
        const coloredNavlink = "text-[rgba(var(--white-rgb),0.9)]";

        // Hamburger
        const hamburger = `
            inline-flex items-center justify-center p-2 rounded-md 
            text-[rgba(var(--fg-rgb),0.7)] hover:text-[rgb(var(--fg-rgb))] 
            focus:outline-none focus:text-[rgba(var(--fg-rgb),0.7)] 
            smooth`;
        const coloredHamburger = `
            ${hamburger}
            text-[rgba(var(--bg-rgb),0.7)] hover:text-[rgb(var(--bg-rgb))] 
            focus:text-[rgba(var(--bg-rgb),0.7)] 
        `;

        // Distance
        const threshold = 10;
        const distance = $(window).scrollTop();

        // Dynamic styling
        // distance > threshold
        //     ? $("#navbar").addClass("border-b border-b-[rgb(var(--gray-rgb))]")
        //     : $("#navbar").removeClass(
        //           "border-b border-b-[rgb(var(--gray-rgb))]"
        //       );
        if (distance > threshold) {
            $("#navbar").attr("class", coloredNavbar);
            $("#navlogo").attr("src", "/assets/logo-white.png");
            $(".navlink").each(function () {
                $(this).addClass(coloredNavlink);
            });
            $("#hamburger").attr("class", coloredHamburger);
        } else {
            $("#navbar").attr("class", plainNavbar);
            $("#navlogo").attr("src", "/assets/logo-red.png");
            $(".navlink").each(function () {
                $(this).removeClass(coloredNavlink);
            });
            $("#hamburger").attr("class", hamburger);
        }
    });
});
