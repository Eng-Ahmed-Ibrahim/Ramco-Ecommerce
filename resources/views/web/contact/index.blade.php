@extends('web.app')
@section('title', 'Ramco | Contact Us ')
@section('css')
    <style>
        .branch-name {
            color: var(--Colors-Primary-500, #1F1F1F);
            font-size: 22px;
            font-style: normal;
            font-weight: 700;
            line-height: 33px;
            /* 150% */
        }

        .branch-info {
            color: var(--Colors-Primary-400, #444);
            font-size: 18px;
            font-style: normal;
            font-weight: 600;
            line-height: 27px;
            /* 150% */
        }
    </style>
@endsection
@section('content')
    <section class="about my-5">
        <div class="container">
            <div class="mb-3">
                <span class="muted-color">Home</span> / <span class="text-black">Contact Us </span>
            </div>
            <h3 class="mb-5">Contact Us</h3>
            <div class="row mb-3">
                <div class="col-md-6 col-12 mb-3">
                    <div class="branches">
                        @foreach ($branches as $branch)
                            <div class="branch mb-5">
                                @if ($branch->name)
                                    <div class="branch-name mb-1">{{ $branch->name }}</div>
                                @endif

                                @if ($branch->office_address)
                                    <div class="mb-1 branch-info">Head Office: {{ $branch->office_address }}</div>
                                @endif

                                @if ($branch->office_tel)
                                    <div class="mb-1 branch-info">Tel: {{ $branch->office_tel }}</div>
                                @endif

                                @if ($branch->office_fax)
                                    <div class="mb-1 branch-info">Fax: {{ $branch->office_fax }}</div>
                                @endif

                                @if ($branch->mobile_whatsapp)
                                    <div class="mb-1 branch-info">Mobile/WhatsApp: {{ $branch->mobile_whatsapp }}</div>
                                @endif

                                @if ($branch->office_email)
                                    <div class="mb-3 branch-info">Email: {{ $branch->office_email }}</div>
                                @endif

                                @if ($branch->factory_address)
                                    <div class="mb-1 branch-info">Factory: {{ $branch->factory_address }}</div>
                                @endif

                                @if ($branch->factory_tel)
                                    <div class="mb-1 branch-info">Tel: {{ $branch->factory_tel }}</div>
                                @endif

                                @if ($branch->factory_email)
                                    <div class="mb-1 branch-info">Email: {{ $branch->factory_email }}</div>
                                @endif
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-md-6 col-12 mb-3">
                    <form method="POST" action="{{ route('web.messages.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="mb-2"> Name</label>
                            <div class="input-wrapper">
                                <i class="fa fa-user icon"></i>

                                <input type="text" id="name" name="name" placeholder="Name" />
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="mb-2"> Email</label>
                            <div class="input-wrapper">
                                <i class="fa fa-envelope icon"></i>
                                <input type="email" id="email" name="email" placeholder="e-mail address" />
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="country" class="mb-2"> Country</label>
                            <div class="input-wrapper">
                                <i class="fa fa-map-marker-alt icon"></i>
                                <input type="text" name="country" id="country" placeholder="Country" />
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="message" class="mb-2">Message</label>
                            <textarea name="message" id="message" placeholder="Write us" class="w-100"></textarea>
                        </div>
                        <button type="submit" class="main-btn w-100">Send</button>
                    </form>
                </div>

            </div>
        </div>
        </div>
    </section>
@endsection
@section('js')

@endsection
