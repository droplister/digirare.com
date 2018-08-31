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
                <p>Anyone can get their card featured. The way it works is simple... it's an auction! The highest four (4) bidders, in this ongoing auction, get the card of their choice displayed on our homepage until they are outbid.</p>
                <p>We have a special address that we monitor: <br /> <b><a href="https://xchain.io/address/{{ config('digirare.feature_address') }}" target="_blank">{{ config('digirare.feature_address') }}</a></b></p>
                <p>Send your bid to this address (XCP ONLY) and include the name of the card you want featured in the memo field. Enter just the token name, no other text, or it may not be recognized. No refunds for failed bids!</p>
                <p>The current high bids are as follows:</p>
                <p>
                @foreach($features as $featured)
                    <b>#{{ $loop->iteration }} Spot</b> &nbsp; {{ $featured->bid_normalized }} XCP @if(! $loop->last) <br /> @endif
                @endforeach
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>