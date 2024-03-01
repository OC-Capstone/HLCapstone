// logout function
function logout() {

//set user token to an empty value to clear it, set DOC to past to remove it from browser history.
document.cookie = "userToken=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;"; 
//idk our user cookie name^
//after successful logout, this redirects the user to the login page
    window.location.href = 'login.html';
}
