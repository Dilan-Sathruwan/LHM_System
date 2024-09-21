function printForm() {
    // Get the form element
    const form = document.getElementById('myForm1');
    // Save the current page content
    const originalContent = document.body.innerHTML;
    // Replace the body content with just the form's HTML for printing
    document.body.innerHTML = form.outerHTML;
    // Trigger the print dialog for the form
    window.print();
    // Restore the original page content after printing
    document.body.innerHTML = originalContent;
    // Optionally, reload the JavaScript and events after restoring the content
    location.reload(); // Reload to re-initialize events or state (if needed)
}