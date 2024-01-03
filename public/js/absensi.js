function onScanSuccess(decodedText, decodedResult) {
  // Handle on success condition with the decoded text or result.
  html5QrcodeScanner.clear();
  window.location.replace(
    document.getElementById("qrlink").innerHTML + decodedText
  );
}

function onScanError(errorMessage) {
  // handle on error condition, with error message
}

var html5QrcodeScanner = new Html5QrcodeScanner("qrsec", {
  fps: 10,
  qrbox: 250,
});
html5QrcodeScanner.render(onScanSuccess, onScanError);

window.setTimeout("waktu()", 500);

function waktu() {
  var waktu = new Date();
  setTimeout("waktu()", 500);
  document.getElementById("jam").innerHTML = waktu.getHours();
  document.getElementById("menit").innerHTML = waktu.getMinutes();
  document.getElementById("detik").innerHTML = waktu.getSeconds();
}
