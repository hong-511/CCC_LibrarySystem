function createModal(
  title,
  content,
  closeButtonText,
  additionalButton,
  modalID
) {
  let Modal = `
    <div class="modal fade" id="${modalID}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">${title}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">${content}</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">${closeButtonText}</button>
                ${additionalButton}
            </div>
        </div>
    </div>
    `;
  return Modal;
}
let nthModal = 0;
function triggerModal(title, content) {
  nthModal++;
  let modalHTML = createModal(title, content, "Close", "", nthModal);
  let modalBlock = document.getElementById("modalBlock");
  modalBlock.innerHTML = modalHTML;

  let modalElement = $("#" + nthModal);
  modalElement.modal("show");
}
