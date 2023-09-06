    @if (Auth::user()->role === 'superadmin')
        @include('layouts.partials.mobile.superadmin')
    @elseif (Auth::user()->role === 'admin')
        @include('layouts.partials.mobile.admin')
    @elseif (Auth::user()->role === 'supervisor')
        @include('layouts.partials.mobile.supervisor')
    @else
        @include('layouts.partials.mobile.user')
    @endif

    {{-- <script src="https://unpkg.com/@popperjs/core@2.9.1/dist/umd/popper.min.js" charset="utf-8"></script>
    <script>
        function openDropdown(event, dropdownID) {
            // let dropups = document.getElementsByClassName('dropup');
            let element = event.target;
            while (element.nodeName !== "BUTTON") {
                element = element.parentNode;
            }
            var popper = Popper.createPopper(element, document.getElementById(dropdownID), {
                placement: 'top-end'
            });
            document.getElementById(dropdownID).classList.toggle("hidden");
            document.getElementById(dropdownID).classList.toggle("block");
        }
    </script> --}}
