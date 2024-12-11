<!-- General JS Scripts -->
<script src="{{ asset('backend/assets') }}/modules/jquery.min.js"></script>
<script src="{{ asset('backend/assets') }}/modules/popper.js"></script>
<script src="{{ asset('backend/assets') }}/modules/tooltip.js"></script>
<script src="{{ asset('backend/assets') }}/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="{{ asset('backend/assets') }}/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="{{ asset('backend/assets') }}/modules/moment.min.js"></script>
<script src="{{ asset('backend/assets') }}/js/stisla.js"></script>

<!-- JS Libraies -->
<script src="{{ asset('backend/assets') }}/modules/simple-weather/jquery.simpleWeather.min.js"></script>
<script src="{{ asset('backend/assets') }}/modules/chart.min.js"></script>
<script src="{{ asset('backend/assets') }}/modules/jqvmap/dist/jquery.vmap.min.js"></script>
<script src="{{ asset('backend/assets') }}/modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="{{ asset('backend/assets') }}/modules/summernote/summernote-bs4.js"></script>
<script src="{{ asset('backend/assets') }}/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('backend/assets') }}/js/page/index-0.js"></script>

<!-- Template JS File -->
<script src="{{ asset('backend/assets') }}/js/scripts.js"></script>
<script src="{{ asset('backend/assets') }}/js/custom.js"></script>

<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Dynamic delete --}}
<script>
    $(document).ready(function() {
        $('body').on('click', '.delete-item', function(event) {
            event.preventDefault();

            let deleteUrl = $(this).attr('href');
            let token = $('meta[name="csrf-token"]').attr('content');

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: deleteUrl,
                        type: 'DELETE',
                        data: {
                            _token: token
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Deleted!",
                                text: response.message,
                                icon: "success"
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function() {
                            Swal.fire({
                                title: "Error!",
                                text: "Something went wrong!",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });
    });
</script>


@stack('scripts')

<script>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            @php
                toastr()->error($error);
            @endphp
        @endforeach
    @endif
</script>
