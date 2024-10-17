
// formprint function
function printForm(formId) {
    const form = document.getElementById(formId);
    if (form) {
        // Clone the form structure
        const clonedForm = form.cloneNode(true);

        // Copy form values into the cloned form
        const originalInputs = form.querySelectorAll('input, textarea, select');
        const clonedInputs = clonedForm.querySelectorAll('input, textarea, select');

        originalInputs.forEach((input, index) => {
            if (input.type === 'checkbox' || input.type === 'radio') {
                clonedInputs[index].checked = input.checked;
            } else {
                clonedInputs[index].value = input.value;
            }
        });

        // Open a new print window
        const printWindow = window.open('', '_blank', 'width=800,height=600');
        
        // Get all stylesheets from the original document
        const stylesheets = Array.from(document.styleSheets).map((styleSheet) => {
            return styleSheet.href ? `<link rel="stylesheet" href="${styleSheet.href}">` : '';
        }).join('');

        // Build HTML for the new print window
        printWindow.document.write('<html><head><title>Print Form</title>');
        
        // Inject the styles from the current document
        printWindow.document.write(stylesheets);
        
        // Add any inline styles you need
        printWindow.document.write('<style>body { font-family: Arial, sans-serif; padding: 20px; }</style>');
        
        printWindow.document.write('</head><body>');
        
        // Append the cloned form content
        printWindow.document.body.appendChild(clonedForm);
        
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        
        // Wait for the window to finish loading the content
        printWindow.onload = function() {
            printWindow.print();  // Trigger the print dialog
            printWindow.close();  // Close the print window after printing
        };
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
