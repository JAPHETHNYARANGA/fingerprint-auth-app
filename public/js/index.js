function checkAndScanFingerprint() {
    // Check if the checkbox is checked
    var checkbox = document.getElementById("fingerPrintScan");
   
    if (checkbox.checked) {
        // If checked, simulate fingerprint scanning
        simulateFingerprintScan();
    }
    
}
function loginClicked(){
    simulateFingerprintScan();
}

function simulateFingerprintScan() {
    const fpPromise = import('https://openfpcdn.io/fingerprintjs/v4')
        .then(FingerprintJS => FingerprintJS.load())

    // Get the visitor identifier when you need it.
    fpPromise
        .then(fp => fp.get())
        .then(result => {
            // This is the visitor identifier:
            const visitorId = result.visitorId;
            // Store the visitorId in the hidden input field
            document.getElementById("visitorId").value = visitorId;

            // Submit the form
            document.getElementById("loginForm").submit();
        });
}