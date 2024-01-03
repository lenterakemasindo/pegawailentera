function onScanSuccess(decodedText, decodedResult) {
  // Handle on success condition with the decoded text or result.
  html5QrcodeScanner.clear();
  document.getElementById("qrPopup").innerHTML = "Akun Ditemukan !";
  document.getElementById("qrPopup").hidden = false;
  document.getElementById(
    "qrLinkup"
  ).innerHTML = `<a href="qrcode/${decodedText}" class="btn btn-outline-success text-center btn-block">Masuk Sekarang</a>`;
}

function onScanError(errorMessage) {
  // handle on error condition, with error message
}

var html5QrcodeScanner = new Html5QrcodeScanner("qrsec", {
  fps: 10,
  qrbox: 250,
});
html5QrcodeScanner.render(onScanSuccess, onScanError);
