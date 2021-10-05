const searchInput = document.getElementById("InputSearch");
const searchButton = document.getElementById("SendBTN");
const containerResults = document.getElementById("Results");
const direction = "http://localhost/projects/QueryLanguagePHP/Server/main.php";

const getResponse = async () => {
  try {
    let Search = searchInput.value;
    const res = await fetch(`${direction}?q=${Search}`, {
      method: "GET",
    });
    let data = await res.json();
    console.log(data);
    containerResults.innerHTML = getTable(data);
  } catch (error) {
    console.log(error);
    containerResults.innerHTML = "ocurrio un error indesperado";
  }
};

const getTable = (data) => {
  const sizieArray = data.length;
  let HTMLTable = ``;
  if (sizieArray > 0) {
    
    HTMLTable += `<table border = "1">`;
    HTMLTable += `<tr>` ;
    
    for (const key in data[0]) {
      HTMLTable += ` <th> ${key} </th>`;
    }
    HTMLTable += `<tr>` ;

    for (let index = 0; index < sizieArray; index++) {
      HTMLTable += `<tr>` ;
      for (const key in data[index]) {
        HTMLTable += ` <td> ${data[index][key]} </td>`;
      }
      HTMLTable += `<tr>` ;
    }
    HTMLTable += `</table>` ;
  }

  return HTMLTable;
};

searchButton.addEventListener("click", () => {
  getResponse();
});
