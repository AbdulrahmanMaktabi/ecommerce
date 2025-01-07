 <!--jquery library js-->
 <script src="{{ asset('frontend/assets') }}/js/jquery-3.6.0.min.js"></script>
 <!--bootstrap js-->
 <script src="{{ asset('frontend/assets') }}/js/bootstrap.bundle.min.js"></script>
 <!--font-awesome js-->
 <script src="{{ asset('frontend/assets') }}/js/Font-Awesome.js"></script>
 <!--select2 js-->
 <script src="{{ asset('frontend/assets') }}/js/select2.min.js"></script>
 <!--slick slider js-->
 <script src="{{ asset('frontend/assets') }}/js/slick.min.js"></script>
 <!--simplyCountdown js-->
 <script src="{{ asset('frontend/assets') }}/js/simplyCountdown.js"></script>
 <!--product zoomer js-->
 <script src="{{ asset('frontend/assets') }}/js/jquery.exzoom.js"></script>
 <!--nice-number js-->
 <script src="{{ asset('frontend/assets') }}/js/jquery.nice-number.min.js"></script>
 <!--counter js-->
 <script src="{{ asset('frontend/assets') }}/js/jquery.waypoints.min.js"></script>
 <script src="{{ asset('frontend/assets') }}/js/jquery.countup.min.js"></script>
 <!--add row js-->
 <script src="{{ asset('frontend/assets') }}/js/add_row_custon.js"></script>
 <!--multiple-image-video js-->
 <script src="{{ asset('frontend/assets') }}/js/multiple-image-video.js"></script>
 <!--sticky sidebar js-->
 <script src="{{ asset('frontend/assets') }}/js/sticky_sidebar.js"></script>
 <!--price ranger js-->
 <script src="{{ asset('frontend/assets') }}/js/ranger_jquery-ui.min.js"></script>
 <script src="{{ asset('frontend/assets') }}/js/ranger_slider.js"></script>
 <!--isotope js-->
 <script src="{{ asset('frontend/assets') }}/js/isotope.pkgd.min.js"></script>
 <!--venobox js-->
 <script src="{{ asset('frontend/assets') }}/js/venobox.min.js"></script>
 <!--classycountdown js-->
 <script src="{{ asset('frontend/assets') }}/js/jquery.classycountdown.js"></script>

 {{-- Sweetalert --}}
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <!--main/custom js-->
 <script src="{{ asset('frontend/assets') }}/js/main.js"></script>
 <script>
     @if ($errors->any())
         @foreach ($errors->all() as $error)
             @php
                 toastr()->error($error);
             @endphp
         @endforeach
     @endif
 </script>

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
                                 title: response.title,
                                 text: response.message,
                                 icon: response.status
                             }).then(() => {
                                 location.reload();
                             });
                         },
                         error: function(xhr) {
                             // Extract error details
                             let errorMessage = "Something went wrong!";
                             if (xhr.responseJSON && xhr.responseJSON.message) {
                                 errorMessage = xhr.responseJSON.message;
                             }

                             Swal.fire({
                                 title: "Error!",
                                 text: errorMessage,
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
