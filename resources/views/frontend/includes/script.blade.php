<!-- JS Global -->
<script src="{{ asset('assets/plugins/jquery/jquery-1.11.1.min.js') }}" defer></script>
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}" defer></script>
<script src="{{ asset('assets/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" defer></script>
<script src="{{ asset('assets/plugins/superfish/js/superfish.min.js') }}" defer></script>
<script src="{{ asset('assets/plugins/prettyphoto/js/jquery.prettyPhoto.js') }}" defer></script>
<script src="{{ asset('assets/plugins/owl-carousel2/owl.carousel.min.js') }}" defer></script>
<script src="{{ asset('assets/plugins/jquery.sticky.min.js') }}" defer></script>
<script src="{{ asset('assets/plugins/jquery.easing.min.js') }}" defer></script>
<script src="{{ asset('assets/plugins/jquery.smoothscroll.min.js') }}" defer></script>
<!--<script src="assets/plugins/smooth-scrollbar.min.js"></script>-->
<!--<script src="assets/plugins/wow/wow.min.js"></script>-->
<script>
  // WOW - animated content
    //new WOW().init();
</script>
<script src="{{ asset('assets/plugins/swiper/js/swiper.jquery.min.js') }}" defer></script>
<script src="{{ asset('assets/plugins/datetimepicker/js/moment-with-locales.min.js') }}" defer></script>
<script src="{{ asset('assets/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" defer></script>

<!-- JS Page Level -->
{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7ZNZjYA0dBQRKvUdDGiMptZSYEbdlMgs&libraries=places">
  --}}
</script>

{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="{{ asset('assets/plugins/jquery.cookie.js') }}" defer></script>
<script src="{{ asset('assets/js/theme-config.js') }}" defer></script>
<script src="{{ asset('assets/js/theme.js') }}" defer></script>
<script src="{{ asset('assets/js/theme-ajax-mail.js') }}" defer></script>

<script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7ZNZjYA0dBQRKvUdDGiMptZSYEbdlMgs&libraries=places&callback=initMap"
  async defer></script>
{{-- <script>
  function initMap() {
        var location = { lat: 25.276987, lng: 55.296249 }; // Example: Dubai
        var map = new google.maps.Map(document.getElementById("map"), {
          zoom: 12,
          center: location,
        });
        var marker = new google.maps.Marker({
          position: location,
          map: map,
        });
      }
</script> --}}

@php
use App\Models\Car;
$car = Car::latest()->first();
@endphp


<script>
  function initMap() {
    var location = { lat: 25.2577994, lng: 55.3335871 };

    var map = new google.maps.Map(document.getElementById("map-canvas"), {
      center: location,
      zoom: 17,
    });

    var marker = new google.maps.Marker({
      position: location,
      map: map,
      title: "{{ trans_field($car->name) }}",
    });

    var contentString = `
      <div class="map-info-window">
        <div class="thumbnail no-border no-padding thumbnail-car-card">
          <div class="media">
            <a class="media-link" href="#">
              <img src="{{ asset('storage/' . $car->thumbnail_image) }}" alt="{{ trans_field($car->name) }}" style="width:100%; height:auto;" />
            </a>
          </div>
          <div class="caption text-center">
            <h4 class="caption-title"><a href="#">{{ trans_field($car->name) }}</a></h4>
            <div class="caption-text">Start from ${{ $car->current_price_per_day }}/per day</div>
            <div class="buttons">
              <a class="btn btn-theme" href="{{ route('checkout-form', $car->id) }}">Rent It</a>
            </div>
            <table class="table">
              <tr>
                <td><i class="fa fa-car"></i> {{ $car->model_year }}</td>
                <td><i class="fa fa-dashboard"></i> {{ $car->fuel }}</td>
                <td><i class="fa fa-cog"></i> {{ $car->gear }}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    `;

    var infoWindow = new google.maps.InfoWindow({
      content: contentString,
    });

    marker.addListener("click", function () {
      infoWindow.open(map, marker);
    });

    // Show by default
    infoWindow.open(map, marker);
  }
</script>



<script>
  document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('carSearchInput');
    const resultsBox = document.getElementById('carSearchResults');

    input.addEventListener('keyup', function () {
      const query = this.value.trim();

      if (query.length < 2) {
        resultsBox.style.display = 'none';
        resultsBox.innerHTML = '';
        return;
      }

      fetch(`/api/car-search?q=${encodeURIComponent(query)}`)
        .then(res => res.json())
        .then(data => {
            
          resultsBox.innerHTML = '';

          if (data.length === 0) {
            resultsBox.style.display = 'none';
            return;
          }

            data.forEach(car => {
            const name = car.name?.en || Object.values(car.name)[0]; // fallback
            const li = document.createElement('li');
            li.className = 'list-group-item list-group-item-action';
            li.innerHTML = `
                <a href="/checkout/${car.slug}" class="text-decoration-none text-dark d-block">
                <strong>${name}</strong><br/>
                <small>${car.category}</small>
                </a>
            `;
            resultsBox.appendChild(li);
            });

          resultsBox.style.display = 'block';
        });
    });

    // Hide search results on outside click
    document.addEventListener('click', function (e) {
      if (!document.getElementById('searchWrapper').contains(e.target)) {
        resultsBox.style.display = 'none';
      }
    });
  });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
  toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-bottom-right", // or toast-top-right
        "timeOut": "10000"
    };
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif

    @if(session('warning'))
        toastr.warning("{{ session('warning') }}");
    @endif

    @if(session('info'))
        toastr.info("{{ session('info') }}");
    @endif
</script>

@stack('script')