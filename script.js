const API_BASE = "http://localhost:8000/laptops";

console.log("betölt");

function fetchAllLaptops() {
  fetch(API_BASE)
    .then((res) => {
      res.json();
    })
    .then(displayLaptops)
    .catch(showError);
}

function fetchLaptopById() {
  const id = document.getElementById("idInput").value;
  if (!id) return alert("Adj meg egy ID-t!");
  fetch(`${API_BASE}/${id}`)
    .then((res) => {
      if (!res.ok) throw new Error("Nincs ilyen ID");
      return res.json();
    })
    .then((data) => {
      displayLaptops([data]);
    })
    .catch(showError);
}

function fetchByManufacturer() {
  const manu = document.getElementById("manufacturerInput").value;
  if (!manu) return alert("Adj meg egy gyártót!");
  fetch(`${API_BASE}/manufacturer/${encodeURIComponent(manu)}`)
    .then((res) => {
      if (!res.ok) throw new Error("Nincs ilyen gyártó");
      return res.json();
    })
    .then(displayLaptops)
    .catch(showError);
}

function displayLaptops(laptops) {
  const container = document.getElementById("results");
  container.innerHTML = "";
  laptops.forEach((lap) => {
    const card = document.createElement("div");
    card.className = "card";
    card.innerHTML = `
      <h3>${lap.name}</h3>
      <p><strong>Gyártó:</strong> ${lap.manufacturer}</p>
      <p><strong>CPU:</strong> ${lap.cpu}</p>
      <p><strong>RAM:</strong> ${lap.ram}</p>
      <p><strong>Tárhely:</strong> ${lap.storage}</p>
      <p><strong>Ár:</strong> ${lap.price} Ft</p>
    `;
    container.appendChild(card);
  });
}

function showError(err) {
  document.getElementById(
    "results"
  ).innerHTML = `<p class="error">${err.message}</p>`;
}
