document.addEventListener("DOMContentLoaded", () => {

    const popup = document.getElementById("popup");

    const popupTitle = document.getElementById("popup-title");
    const popupText = document.getElementById("popup-text");

    const confirmBtn = document.getElementById("popup-confirm");
    const cancelBtn = document.getElementById("popup-cancel");

    let confirmAction = null;

    window.showPopup = ({
        title = "",
        text = "",
        confirmText = "OK",
        cancelText = "Cancel",
        onConfirm = null,
        hideCancel = false
    }) => {

        popupTitle.innerHTML = title;
        popupText.innerHTML = text;

        confirmBtn.textContent = confirmText;
        cancelBtn.textContent = cancelText;

        confirmAction = onConfirm;

        cancelBtn.style.display = hideCancel ? "none" : "inline-block";

        popup.style.display = "flex";
    };

    confirmBtn.addEventListener("click", () => {

        popup.style.display = "none";

        if (confirmAction) {
            confirmAction();
        }

    });

    cancelBtn.addEventListener("click", () => {
        popup.style.display = "none";
    });

    window.addEventListener("click", (e) => {
        if (e.target === popup) {
            popup.style.display = "none";
        }
    });

});