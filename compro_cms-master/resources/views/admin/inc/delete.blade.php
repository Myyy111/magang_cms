    <!-- Delete modal -->
    <div class="modal fade" id="deleteModal-{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <form action="{{ route($route.'.destroy', [$row->id]) }}" method="post" class="delete-form">
          @csrf
          @method('DELETE')
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="modal-icon-container">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h3 class="font-weight-bold mb-2" style="letter-spacing: -0.02em;">{{ __('dashboard.are_you_sure') }}</h3>
                    <p class="text-muted mb-0">{{ __('dashboard.delete_warning') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">{{ __('dashboard.confirm') }}</button>
                    <button type="button" class="btn btn-light-premium" data-dismiss="modal">{{ __('dashboard.close') }}</button>
                </div>
            </div><!-- /.modal-content -->
          </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->