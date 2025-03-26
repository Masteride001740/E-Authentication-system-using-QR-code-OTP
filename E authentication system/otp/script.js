const codes = document.querySelectorAll('.code');

codes[0].focus();

codes.forEach((code, idx) => {
    code.addEventListener('input', (e) => {
        // Check if the input is a valid number (only digits 0-9)
        if (e.target.value.match(/\d/)) {
            // Focus on the next input
            if (idx < codes.length - 1) {
                setTimeout(() => codes[idx + 1].focus(), 10);
            }
        }
    });

    code.addEventListener('keydown', (e) => {
        // If Backspace is pressed, focus on the previous input
        if (e.key === 'Backspace' && idx > 0 && codes[idx].value === '') {
            setTimeout(() => codes[idx - 1].focus(), 10);
        }
    });
});
