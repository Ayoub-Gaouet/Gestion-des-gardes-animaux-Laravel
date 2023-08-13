<!DOCTYPE html>
<html lang="fr">
<!--begin::Head-->
<x-head :title="$title" :css-slot="$cssSlot" />


<body id="kt_body"
      class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

<x-header-mobile></x-header-mobile>
<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-row flex-column-fluid page">
        <x-aside></x-aside>

        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            <x-header></x-header>
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <x-subheader>
                    <x-slot name="subHeaderTitle">
                        {{$subHeaderTitle}}
                    </x-slot>
                </x-subheader>
                <div class="content-wrapper">
                    <section class="content">
                        <div class="d-flex flex-column-fluid">
                            <div class="container-fluid">
                                {{ $bodyContent }}
                            </div>
                        </div>
                    </section>

                </div>

            </div>
            <x-footer></x-footer>

        </div>
    </div>

</div>
<x-scrolltop></x-scrolltop>
<x-quick-user></x-quick-user>
<x-js>
    <x-slot name="jsSlot">

        {{$jsSlot}}
    </x-slot>
</x-js>

</body>
<!--end::Body-->
</html>
