<div class="modal fade" id="howToModal" tabindex="-1" role="dialog" aria-labelledby="howToModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Get Featured</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>We have a special address that we monitor: <br /> <b><a href="https://xcpfox.com/address/{{ config('digirare.feature_address') }}" target="_blank">{{ config('digirare.feature_address') }}</a></b></p>
                <p>To get featured, send XCP to this address. Indicate the name of the card you want featured in the memo field of the transaction. If your bid is higher than one of the current bids, it will appear on the homepage.</p>
                <p>The current high bids are as follows:</p>
                <p>
                @foreach($features as $featured)
                    <b>#{{ $loop->iteration }} Spot</b> &nbsp; <a href="https://xcpfox.com/tx/{{ $featured->xcp_core_tx_index }}" target="_blank">{{ $featured->bid_normalized }} XCP</a> @if(! $loop->last) <br /> @endif
                @endforeach
                </p>
                <p><em>Make sure to enter ONLY the card's name in the memo field or else we may not be able to recognize your selection. Our system requires two (2) confirmations before counting new bids.</em></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>