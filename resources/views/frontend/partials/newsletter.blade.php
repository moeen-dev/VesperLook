<div class="modal popup-1" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-body popup-banner">
            <button type="button" class="close" aria-label="Close" id="popupCloseBtn" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
            </button>
            <h3>Newsletter <span>Subscribe</span></h3>
            <form method="POST" action="{{ route('newsletter.subscribe') }}">
                @csrf
                <div class="popup-subscribe">
                    <div class="subscribe-wrapper">
                        <input placeholder="Enter Your Email" type="email" name="email" required>
                        <button type="submit">SUBSCRIBE</button>
                    </div>
                </div>
                <label>
                    <input type="checkbox" id="dontShowPopup" name="dont_show_again" value="1">
                    Don't show this popup again
                </label>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("exampleModalCenter");
    const closeBtn = document.getElementById("popupCloseBtn");
    const checkbox = document.getElementById("dontShowPopup");

    if (!document.cookie.includes("hide_newsletter_popup")) {
        $(modal).modal("show");
    }

    closeBtn.addEventListener("click", () => {
        if (checkbox.checked) {
            fetch("{{ route('newsletter.hidePopup') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: "{}"
            });
        }
        $(modal).modal("hide");
    });
});
</script>