
function checkAndScanFingerprint() {
    // Check if the checkbox is checked
    var checkbox = document.getElementById("fingerPrintForm");
    if (checkbox.checked) {
        // If checked, simulate fingerprint scanning
        simulateFingerprintScan();
    } else {
        // If not checked, do nothing or provide feedback to the user
        alert("Please check the checkbox to get user fingerprint.");
    }
}


 function simulateFingerprintScan() {

    // Initialize the agent at application startup.
  // If you're using an ad blocker or Brave/Firefox, this import will not work.
  // Please use the NPM package instead: https://t.ly/ORyXk
  const fpPromise = import('https://openfpcdn.io/fingerprintjs/v4')
  .then(FingerprintJS => FingerprintJS.load())

// Get the visitor identifier when you need it.
fpPromise
  .then(fp => fp.get())
  .then(result => {
    // This is the visitor identifier:
    const visitorId = result.visitorId
    console.log(visitorId)
  })
 }

