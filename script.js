const dropdown = document.querySelector(".dropdown");
const countLabel = dropdown.querySelector("#count-label");

dropdown.addEventListener("click", deleteContent);

function deleteContent() {
  setTimeout(function () {
    countLabel.innerHTML = "";
  }, 1000);
}

const originSelect = document.getElementById("origin");
const destinationSelect = document.getElementById("destination");

originSelect.addEventListener("change", function () {
  const selectedOrigin = this.value;

  Array.from(destinationSelect.options).forEach((option) => {
    option.disabled = option.value === selectedOrigin;
  });
});

destinationSelect.addEventListener("change", function () {
  const selectedDestination = this.value;

  Array.from(originSelect.options).forEach((option) => {
    option.disabled = option.value === selectedDestination;
  });
});

function keepSessionAlive() {
  fetch("keep_alive.php")
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "success") {
        console.log("Sesión renovada")
      }
    })
    .catch((error) => console.error("Error al renovar la sesión:", error))
}

setInterval(keepSessionAlive, 300000)
