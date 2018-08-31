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
                <p>Send your bid (XCP ONLY) to this address and enter the name of the card you want featured in the memo field. The current high bids are as follows:</p>
                @foreach($features as $featured)
                    <p>{{ $loop->iteration }}. {{ $featured->bid_normalized }} XCP</p>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>