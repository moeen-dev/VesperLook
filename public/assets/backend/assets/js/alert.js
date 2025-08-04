document.addEventListener("DOMContentLoaded", function () {
    const messages = window.flashMessages;

    if (messages.success) {
        swal({
            title: "Success!",
            text: messages.success,
            icon: "success",
            button: "Okay!",
        });
    } else if (messages.error) {
        swal({
            title: "Oops!",
            text: messages.error,
            icon: "error",
            button: "Okay!",
        });
    } else if (messages.info) {
        swal({
            title: "Heads Up!",
            text: messages.info,
            icon: "info",
            button: "Okay!",
        });
    } else if (messages.warning) {
        swal({
            title: "Notice!",
            text: messages.warning,
            icon: "warning",
            button: "Okay!",
        });
    }
});
