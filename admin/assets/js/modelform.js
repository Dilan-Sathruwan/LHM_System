
function printForm(formId) {
    const form = document.getElementById(formId);  // Get the form by ID
    if (form) {
        const originalContent = document.body.innerHTML;
        document.body.innerHTML = form.outerHTML;   // Replace body with form's HTML content
        window.print();                             // Open print dialog
        document.body.innerHTML = originalContent;  // Restore original content
        location.reload();                          // Reload page to reset state
    } else {
        console.error('Form not found!');
    }
}





// ##################Erro massage show function ########################


function getQueryParam(param) {
    let params = new URLSearchParams(window.location.search);
    return params.get(param);
}
// Function to remove the message parameter from the URL
function removeQueryParam(param) {
    let url = new URL(window.location);
    url.searchParams.delete(param);
    window.history.replaceState({}, document.title, url.pathname); // Update the URL without reloading
}
// Function to show the message after the page has loaded
window.onload = function () {
    let message = getQueryParam('message');
    if (message) {
        let messagePopup = document.getElementById('messagePopup');
        let messageText = document.getElementById('messageText');
        messageText.textContent = decodeURIComponent(message); // Show the message text


        messagePopup.classList.add('show-message'); // Add class to trigger fade-in

        // Remove the message parameter from the URL
        removeQueryParam('message');

        setTimeout(() => {
            messagePopup.classList.remove('show-message'); // Remove class to trigger fade-out
        }, 5000);
    }
};
