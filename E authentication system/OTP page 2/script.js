const codes = document.querySelectorAll('.code');

// Focus on the first input field on load
codes[0].focus();

codes.forEach((code, idx) => {
    code.addEventListener('input', (e) => {
        // If the input is a valid number between 0-9
        if (e.target.value >= '0' && e.target.value <= '9') {
            // Move to the next input field
            if (idx < codes.length - 1) {
                codes[idx + 1].focus();
            }
        }
    });

    // Handle backspace to move focus to the previous input
    code.addEventListener('keydown', (e) => {
        if (e.key === 'Backspace' && idx > 0 && !code.value) {
            setTimeout(() => {
                codes[idx - 1].focus();
            }, 10);
        }
    });
});
