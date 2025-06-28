const logoutTimer = document.querySelector(".timer");

function updateDateTime() {
  const dateEl = document.querySelector(".balance__date .date");
  if (!dateEl) return;

  const now = new Date();
  const formattedDate = now.toLocaleDateString("en-GB");
  const formattedTime = now.toLocaleTimeString("en-GB", {
    hour: "2-digit",
    minute: "2-digit",
  });

  dateEl.innerText = `${formattedDate}, ${formattedTime}`;
}
updateDateTime();
setInterval(updateDateTime, 60000);

document
  .getElementById("transferForm")
  .addEventListener("submit", function (e) {
    const transferTo = document
      .querySelector('input[name="transferTo"]')
      .value.trim();
    const amount = document.querySelector('input[name="amount"]').value.trim();

    if (!transferTo || !amount || isNaN(amount) || amount <= 0) {
      alert("Please enter a valid recipient and amount.");
      e.preventDefault();
      return;
    }

    const confirmMsg = `Are you sure you want to transfer ${amount} to the account "${transferTo}"?`;
    if (!confirm(confirmMsg)) {
      e.preventDefault(); // Cancel the form submission if user clicks "Cancel"
    }
  });

  