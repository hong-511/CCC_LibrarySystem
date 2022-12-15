function createInput(label, inputType, inputName) {
  let inputBlock =
    `<div class="row mb-3">
        <div class="col"></div>
        <div class="col-1">` +
          "<label for='" + inputName + "'>" + label + ":</label>" +
        `</div>
        <div class="col-3">` + 
          "<input type='" + inputType + "' name='" + inputName + "' id='" + inputName + "'/>" +
        `</div>
        <div class="col"></div>
      </div>`;
  return inputBlock;
}
function centerElement(elementHTML){
  let result =`
  <div class="row mb-3">
        <div class="col"></div>
        <div class="col">
            ` + elementHTML + `
        </div>
        <div class="col"></div>
  </div>`;
  return result;
}

function createSubmitButton(buttonName) {
  let submitTag =`
    <input type="submit" value="` + buttonName + `">
    `;
  let submitButton = centerElement(submitTag);
  return submitButton;
}

function create_Status_Dropdown() {
  let status_Dropdown = `
    <label>Status :</label>
    <select name="Status">
        <option value = unknown> unknown</option>
        <option value = "available">available</option>
        <option value = "issued">issued</option>
    </select>
    `;
  return centerElement(status_Dropdown);
}
function create_Year_Dropdown(startYear, endYear) {
  let yearOptions = "";
  for(i=startYear; i<endYear; i++){
    yearOptions += "<option value = "+i+">"+i+"</option>";
  }
  let year_Dropdown =
    `<label>Year :</label>
    <select name="Year">
        <option value = unknown> unknown</option>
        ` + yearOptions +
    `</select>`;
  return centerElement(year_Dropdown);
}