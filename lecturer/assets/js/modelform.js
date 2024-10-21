

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
