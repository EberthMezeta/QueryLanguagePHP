const searchInput = document.getElementById("InputSearch");
const searchButton = document.getElementById("SendBTN");
const containerResults = document.getElementById("Results");
const direction  = "http://localhost/projects/QueryLanguagePHP/Server/main.php";

const getResponse = async () => {
  try {
    let Search = searchInput.value;
    const res = await fetch(
      `${direction}?q=${Search}`,
      {
        method: "GET",
      }
    );
    let data = await res.json();
    console.log(data);
    containerResults.innerHTML = JSON.stringify(data);
    
  } catch (error) {
    console.log(error);
    containerResults.innerHTML = "ocurrio un error indesperado";
  }
};

searchButton.addEventListener("click", () => {
    getResponse();
  }
);