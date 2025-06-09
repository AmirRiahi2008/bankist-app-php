 function updateDateTime() {
    const dateEl = document.querySelector('.balance__date .date');
    if (!dateEl) return;

    const now = new Date();
    const formattedDate = now.toLocaleDateString('en-GB');
    const formattedTime = now.toLocaleTimeString('en-GB', { hour: '2-digit', minute: '2-digit' });

    dateEl.innerText = `${formattedDate}, ${formattedTime}`;
  }
  updateDateTime();
  setInterval(updateDateTime, 60000);