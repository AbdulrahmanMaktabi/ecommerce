@extends('vendor.layouts.master')

@section('content')
    <h3><i class="far fa-user"></i>Products Variant Table</h3>
    <div class="wsus__dashboard_profile">
        <div class="wsus__dash_pro_area">
            <div class="row">
                <div class="create-btn">
                    <a href="{{ route('vendor.product-variant.create', ['product' => $product->id]) }}"
                        class="btn btn-primary">Create Variant
                        <i class="fas fa-pluc"></i>
                    </a>
                </div>
                <div class="col-md-12 mt-5">
                    {{ $dataTable->table() }}
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Listen for changes on custom-switch-checkbox
                $('body').on('change', '.custom-switch-input', function() {
                    let id = $(this).data('id'); // Get the id from data-id attribute
                    let status = $(this).is(':checked') ? 1 :
                    0; // Determine the status based on checkbox                    
                    // Send AJAX request
                    $.ajax({
                        url: "{{ route('vendor.product.variant.update.status') }}", // Define your route for updating status
                        type: "POST",
                        data: {
                            id: id,
                            status: status,
                            _token: "{{ csrf_token() }}" // Pass CSRF token
                        },
                        success: function(response) {
                            console.log('success');
                            Swal.fire({
                                title: "Success!",
                                text: response.message,
                                icon: "success"
                            });
                        },
                        error: function(xhr) {
                            console.log('error');

                            Swal.fire({
                                title: "Error!",
                                text: xhr.responseJSON?.message || "Something went wrong!",
                                icon: "error"
                            });
                        }
                    });
                });
            });
        </script>

        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
@endsection
