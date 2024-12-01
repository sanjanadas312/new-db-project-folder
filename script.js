document.getElementById('registrationForm').addEventListener('submit', function(event) {
    // Get form values and trim spaces
    const email = document.querySelector('input[name="email"]').value.trim();
    const password = document.querySelector('input[name="password"]').value;
    const name = document.querySelector('input[name="name"]').value.trim();
    const rollNumber = document.querySelector('input[name="rollNumber"]').value.trim();

    // Email validation patterns
    const emailPattern = /^[a-zA-Z0-9._%+-]+@sycet\.org$/; // Only @sycet.org emails
    const basicEmailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // General email pattern
    const startsWithSpace = /^\s/;
    const invalidCharacters = /[^\w@.-]/; // Invalid characters
    const multipleAtSymbols = /@.*@/; // Multiple @ symbols
    const consecutiveDots = /\.{2,}/; // Consecutive dots
    const trailingSpace = /\s$/;

    // Name validation: should only contain letters and spaces
    const namePattern = /^[a-zA-Z\s]+$/;

    // Roll number validation: should only contain numbers
    const rollNumberPattern = /^\d+$/;

    // Email validation
    if (!email) {
        alert('Email is required.');
        event.preventDefault();
        return;
    }
    if (startsWithSpace.test(email)) {
        alert('Email should not start with a space.');
        event.preventDefault();
        return;
    }
    if (multipleAtSymbols.test(email)) {
        alert('Email should not contain multiple @ symbols.');
        event.preventDefault();
        return;
    }
    if (invalidCharacters.test(email)) {
        alert('Email contains invalid characters.');
        event.preventDefault();
        return;
    }
    if (consecutiveDots.test(email)) {
        alert('Email should not contain consecutive dots.');
        event.preventDefault();
        return;
    }
    if (!emailPattern.test(email)) {
        alert('Only @sycet.org emails are allowed.');
        event.preventDefault();
        return;
    }
    if (trailingSpace.test(email)) {
        alert('Email should not have trailing spaces.');
        event.preventDefault();
        return;
    }

    // Name validation
    if (!name) {
        alert('Name is required.');
        event.preventDefault();
        return;
    }
    if (!namePattern.test(name)) {
        alert('Name should only contain letters and spaces.');
        event.preventDefault();
        return;
    }

    // Roll number validation
    if (!rollNumber) {
        alert('Roll number is required.');
        event.preventDefault();
        return;
    }
    if (!rollNumberPattern.test(rollNumber)) {
        alert('Roll number should only contain numbers.');
        event.preventDefault();
        return;
    }

    // Password validation
    if (password.length < 6) {
        alert('Password must be at least 6 characters long.');
        event.preventDefault();
        return;
    }

    // If all validations pass
    alert('Registration successful!');
});
