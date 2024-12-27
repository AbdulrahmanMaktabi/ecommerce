@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Table</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Products</a></div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header" style="justify-content: space-between">
                        <h4>Product Variant Table</h4>
                        <a href="{{ route('admin.product.variant.create', ['product' => $prodcut->id]) }}"
                            class="btn btn-primary">create new</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            $(document).ready(function() {
                // Listen for changes on custom-switch-checkbox
                $('body').on('change', '.custom-switch-input', function() {
                    let id = $(this).data('name'); // Get the slug from data-name attribute
                    let status = $(this).is(':checked') ? 1 : 0; // Determine the status based on checkbox

                    // Send AJAX request
                    $.ajax({
                        url: "{{ route('admin.product.variant.update.status') }}", // Define your route for updating status
                        type: "POST",
                        data: {
                            id: id,
                            status: status,
                            _token: "{{ csrf_token() }}" // Pass CSRF token
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Success!",
                                text: response.message,
                                icon: "success"
                            });
                        },
                        error: function(xhr) {
                            console.log(id);
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
