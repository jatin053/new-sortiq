@extends('layouts.frontend')

@section('title', 'Certificate Authentication | Sortiq Solutions')
@section('body_attributes') data-route="/certificate-authenticate" @endsection

@push('head')
<style>
.cert-auth-main {
  min-height: calc(100vh - 440px);
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 100px 20px 90px;
  background: #ffffff;
  font-family: "Nunito", "Segoe UI", Arial, sans-serif;
}

.cert-auth-card {
  width: 100%;
  max-width: 1020px;
  margin: 0 auto;
  text-align: center;
}

.cert-auth-card h1 {
  color: #00173e;
  font-size: 32px;
  font-weight: 700;
  text-transform: uppercase;
  margin: 0 0 10px;
  letter-spacing: 0.6px;
  line-height: 1.25;
}

.cert-auth-card h2 {
  color: #00173e;
  font-size: 19px;
  font-weight: 700;
  text-transform: uppercase;
  margin: 0 0 35px;
  letter-spacing: 0.5px;
  line-height: 1.3;
}

.cert-form {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 12px;
  max-width: 660px;
  width: 100%;
  margin: 0 auto;
}

.cert-input {
  flex: 1;
  width: 100%;
  max-width: 500px;
  padding: 13px 18px;
  font-size: 16px;
  font-style: italic;
  border: 1px solid #cbd5e1;
  border-radius: 4px;
  background: #ffffff;
  color: #00173e;
  outline: none;
  transition: border-color 0.2s, box-shadow 0.2s;
  box-sizing: border-box;
}

.cert-input::placeholder {
  color: #94a3b8;
  font-style: italic;
}

.cert-input:focus {
  border-color: #00173e;
  box-shadow: 0 0 0 3px rgba(0, 23, 62, 0.08);
}

.cert-btn {
  background-color: #ff6600;
  color: #ffffff !important;
  border: none;
  padding: 13px 36px;
  font-weight: 600;
  font-size: 16px;
  border-radius: 999px;
  cursor: pointer;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  box-shadow: 0 4px 14px rgba(255, 102, 0, 0.25);
  transition: all 0.25s ease;
  white-space: nowrap;
}

.cert-btn:hover {
  background-color: #001b43;
  color: #ffffff !important;
  transform: translateY(-2px);
  box-shadow: 0 6px 18px rgba(0, 27, 67, 0.3);
}

.cert-btn:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

/* Result Feedback Message */
.cert-result-message {
  margin-top: 30px;
  font-size: 20px;
  font-weight: 700;
  display: none;
  text-align: center;
  padding: 10px;
}

.cert-result-message.success {
  color: #0a8a00;
  display: block;
}

.cert-result-message.error {
  color: #d40000;
  display: block;
}

/* Results Table */
.cert-table-wrapper {
  margin-top: 35px;
  max-width: 960px;
  width: 100%;
  display: none;
  overflow-x: auto;
  box-shadow: 0 4px 20px rgba(0, 23, 62, 0.08);
  border-radius: 6px;
  background: #00173e;
}

.cert-table {
  width: 100%;
  border-collapse: collapse;
  background: #00173e;
  color: #ffffff;
}

.cert-table th,
.cert-table td {
  padding: 14px 18px;
  border: 1px solid rgba(255, 255, 255, 0.18);
  text-align: center;
  font-size: 15px;
}

.cert-table th {
  background: #00102b;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  font-size: 14px;
  color: #ffffff;
}

.cert-table tbody tr:hover {
  background: rgba(255, 255, 255, 0.04);
}

@media (max-width: 640px) {
  .cert-auth-main {
    padding: 60px 16px 50px;
  }
  .cert-auth-card h1 {
    font-size: 24px;
  }
  .cert-auth-card h2 {
    font-size: 16px;
    margin-bottom: 25px;
  }
  .cert-form {
    flex-direction: column;
    gap: 12px;
  }
  .cert-input {
    width: 100%;
  }
  .cert-btn {
    width: 100%;
    padding: 14px 20px;
  }
  .cert-table th,
  .cert-table td {
    padding: 10px 12px;
    font-size: 13px;
  }
}
</style>
@endpush

@section('content')
<main class="cert-auth-main">
  <div class="cert-auth-card">

    <h1>CHECK CERTIFICATE AUTHENTICITY</h1>
    <h2>ENTER YOUR SERIAL NUMBER</h2>

    <form id="certAuthForm" class="cert-form" method="POST" action="{{ route('frontend.certificate-authenticate.check') }}">
      @csrf
      <input
        type="text"
        id="certificateId"
        name="certificateId"
        class="cert-input"
        placeholder="Serial Number"
        maxlength="255"
        autocomplete="off"
        required
      >
      <button type="submit" id="certSubmitBtn" class="cert-btn">SUBMIT</button>
    </form>

    <div id="certResultMessage" class="cert-result-message"></div>

    <div id="certTableWrapper" class="cert-table-wrapper">
      <table class="cert-table" id="certTable">
        <thead>
          <tr>
            <th>Student Name</th>
            <th>College</th>
            <th>Duration</th>
            <th>Technology</th>
            <th>Start date</th>
            <th>End date</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>

  </div>
</main>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
  const form = document.getElementById("certAuthForm");
  const input = document.getElementById("certificateId");
  const submitBtn = document.getElementById("certSubmitBtn");
  const msgBox = document.getElementById("certResultMessage");
  const tableWrap = document.getElementById("certTableWrapper");
  const tableBody = document.querySelector("#certTable tbody");

  if (!form) return;

  form.addEventListener("submit", function(e) {
    e.preventDefault();

    const certId = input.value.trim();
    msgBox.style.display = "none";
    msgBox.className = "cert-result-message";
    msgBox.innerHTML = "";
    tableWrap.style.display = "none";
    tableBody.innerHTML = "";

    if (!certId) {
      msgBox.className = "cert-result-message error";
      msgBox.innerHTML = "❌ Serial number is required.";
      msgBox.style.display = "block";
      return;
    }

    submitBtn.disabled = true;
    submitBtn.textContent = "VERIFYING...";

    const formData = new FormData(form);

    fetch(form.action, {
      method: "POST",
      body: formData,
      headers: {
        "X-Requested-With": "XMLHttpRequest",
        "Accept": "application/json"
      }
    })
    .then(async response => {
      const data = await response.json();

      if (data.success === true) {
        msgBox.className = "cert-result-message success";
        msgBox.innerHTML = "✅ Certificate Verified.";
        msgBox.style.display = "block";

        const items = Array.isArray(data.data) ? data.data : [data.data];
        let rowsHtml = "";

        items.forEach(item => {
          if (!item) return;
          const studentName = item.student_name || ((item.first_name || '') + ' ' + (item.last_name || '')).trim() || 'N/A';
          const college = item.college || item.colleage || 'N/A';
          const duration = item.duration || 'N/A';
          const technology = item.technology || 'N/A';
          const startDate = item.start_date || 'N/A';
          const endDate = item.end_date || 'N/A';

          rowsHtml += `<tr>
            <td>${studentName}</td>
            <td>${college}</td>
            <td>${duration}</td>
            <td>${technology}</td>
            <td>${startDate}</td>
            <td>${endDate}</td>
          </tr>`;
        });

        tableBody.innerHTML = rowsHtml;
        tableWrap.style.display = "block";
      } else {
        msgBox.className = "cert-result-message error";
        msgBox.innerHTML = "❌ " + (data.message || "Unverified certificate. No record found.");
        msgBox.style.display = "block";
      }
    })
    .catch(error => {
      msgBox.className = "cert-result-message error";
      msgBox.innerHTML = "❌ Server error. Please check your network or try again later.";
      msgBox.style.display = "block";
    })
    .finally(() => {
      submitBtn.disabled = false;
      submitBtn.textContent = "SUBMIT";
    });
  });
});
</script>
@endpush

