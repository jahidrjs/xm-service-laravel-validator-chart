document.getElementById("myForm").addEventListener("submit", function (event) {
    event.preventDefault();
    if (validateForm()) {
        this.submit();
    }
});

function validateForm() {
    let companySymbol = document.getElementById("company_symbol").value;
    let startDate = document.getElementById("start_date").value;
    let endDate = document.getElementById("end_date").value;
    let email = document.getElementById("email").value;

    // Validate company symbol
    if (companySymbol.trim() === "") {
        alert("Please enter a valid company symbol.");
        return false;
    }

    // Validate start date
    if (startDate.trim() === "") {
        alert("Please enter a valid start date.");
        return false;
    }

    if (!isValidDate(startDate)) {
        alert("Start date should be in the format YYYY-MM-DD.");
        return false;
    }

    // Validate end date
    if (endDate.trim() === "") {
        alert("Please enter a valid end date.");
        return false;
    }

    if (!isValidDate(endDate)) {
        alert("End date should be in the format YYYY-MM-DD.");
        return false;
    }

    // Validate date range
    if (startDate > endDate) {
        alert("Start date must be less than or equal to end date.");
        return false;
    }

    // Validate current date
    var today = new Date().toISOString().split("T")[0];
    if (startDate > today || endDate > today) {
        alert("Start date and end date cannot be in the future.");
        return false;
    }

    // Validate email
    if (email.trim() === "") {
        alert("Please enter a valid email address.");
        return false;
    }

    if (!isValidEmail(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    return true;
}

function isValidDate(date) {
    var regex = /^\d{4}-\d{2}-\d{2}$/;
    return regex.test(date);
}

function isValidEmail(email) {
    var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}
