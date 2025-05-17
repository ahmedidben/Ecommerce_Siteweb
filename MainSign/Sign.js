
document.addEventListener("DOMContentLoaded", () => {
    const signContainer = document.querySelector(".Sign");
    const signInForm = document.querySelector(".Sign_IN");
    const signUpForm = document.querySelector(".Sign_UP");

    const signInLink = signInForm.querySelector("a");
    const signUpLink = signUpForm.querySelector("a");

    // Switch to Sign Up
    signInLink.addEventListener("click", (e) => {
        e.preventDefault();
        signInForm.classList.remove("active");
        signUpForm.classList.add("active");
    });

    // Switch to Sign In
    signUpLink.addEventListener("click", (e) => {
        e.preventDefault();
        signUpForm.classList.remove("active");
        signInForm.classList.add("active");
    });
});
