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
    $(document).ready(function() {
        $('#exampleModalCenter').modal('show');

        // Close (×) button sets 5-min cookie and hides modal
        $('#popupCloseBtn').click(function() {
            $.post("{{ route('newsletter.hidePopup') }}", {
                _token: '{{ csrf_token() }}'
            }).done(function() {
                $('#exampleModalCenter').modal('hide');
            });
        });

        // If "Don't show this again" is checked, also set cookie
        $('#dontShowPopup').change(function() {
            if ($(this).is(':checked')) {
                $.post("{{ route('newsletter.hidePopup') }}", {
                    _token: '{{ csrf_token() }}'
                }).done(function() {
                    $('#exampleModalCenter').modal('hide');
                });
            }
        });
    });
</script>
