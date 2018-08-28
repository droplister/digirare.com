<div class="modal fade" id="lastMatchModal" tabindex="-1" role="dialog" aria-labelledby="lastMatchModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Last Trade</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">{{ $last_match->forwardAssetModel->display_name }}/{{ $last_match->backwardAssetModel->display_name }}</th>
                            <th scope="col">{{ $last_match->backwardAssetModel->display_name }}/{{ $last_match->forwardAssetModel->display_name }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                {{ $last_match->forward_quantity_normalized / $last_match->backward_quantity_normalized }}
                                {{ $last_match->backwardAssetModel->display_name }}
                            </td>
                            <td>
                                {{ $last_match->backward_quantity_normalized / $last_match->forward_quantity_normalized }}
                                {{ $last_match->forwardAssetModel->display_name }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>