export function createModal(
  title,
  info,
  buttons = ["Confirmar", "Cancelar"],
  colors = ["#28a745", "#dc3545"]
) {
  const modal = document.createElement("dialog");
  const id = title.toLowerCase().replace(/\s+/g, "-");
  modal.id = `alert-modal-${id}`;
  modal.className = "alert-modal";
  modal.style.display = "none";

  const modalHeader = document.createElement("div");
  modalHeader.className = "modal-header";
  const modalTitle = document.createElement("h5");
  modalTitle.className = "modal-title";
  modalTitle.textContent = title;
  const closeBtn = document.createElement("button");
  closeBtn.className = "close-btn";
  closeBtn.innerHTML = "&times;";
  closeBtn.onclick = () => {
    closeModal(modal);
  };
  modalHeader.appendChild(modalTitle);
  modalHeader.appendChild(closeBtn);

  const modalBody = document.createElement("div");
  modalBody.className = "modal-body";
  modalBody.innerHTML = info;

  const modalFooter = document.createElement("div");
  modalFooter.className = "modal-footer";
  const confirmBtn = document.createElement("button");
  confirmBtn.className = "modal-btn confirm-btn";
  confirmBtn.textContent = buttons[0];
  confirmBtn.onclick = () => {
    closeModal(modal);
  };
  const cancelBtn = document.createElement("button");
  cancelBtn.className = "modal-btn cancel-btn";
  cancelBtn.textContent = buttons[1];
  cancelBtn.onclick = () => {
    closeModal(modal);
  };

  if (colors.length > 0) {
    confirmBtn.style.backgroundColor = colors[0];
    cancelBtn.style.backgroundColor = colors[1];
  }

  modalFooter.appendChild(cancelBtn);
  modalFooter.appendChild(confirmBtn);

  modal.appendChild(modalHeader);
  modal.appendChild(modalBody);
  modal.appendChild(modalFooter);

  document.body.appendChild(modal);
  return [modal, confirmBtn, cancelBtn];
}

export function closeModal(modal, callback = () => {}) {
  modal.style.display = "none";
  callback();
}

export function showModal(modal) {
  modal.style.display = "flex";
}
