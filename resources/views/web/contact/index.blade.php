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
                <span class="muted-color">Home</span> / <span>Contact Us </span>
            </div>
            <h3 class="mb-5">Contact Us</h3>
            <div class="row mb-3">
                <div class="col-md-6 col-12 mb-3">
                    <div class="branches">
                        @for ($i = 0; $i < 2; $i++)
                            <div class="branch mb-5">
                                <div class="branch-name mb-1">Syria Branch</div>
                                <div class="mb-1 branch-info">Hear Office: Adnan Al-Malki St., Jasmin Bld., Damascus</div>
                                <div class="mb-1 branch-info">Tel: +963 11 3740 200/1</div>
                                <div class="mb-1 branch-info">Fax: +963 11 3719860</div>
                                <div class="mb-1 branch-info">Mobile/WhatsApp: +963 987 298 951</div>
                                <div class="mb-3 branch-info">Email: info@kasemgroup-sy.com</div>

                                <div class="mb-1 branch-info">Factory: Adra Industrial City, Damascus Suburb.</div>
                                <div class="mb-1 branch-info">Tel: +963 11 585 0622</div>
                                <div class="mb-1 branch-info">Email: r.barmo@kasemgroup-sy.com</div>
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="col-md-6 col-12 mb-3">
                    <form>
                        <div class="mb-4">
                            <label for="name" class="mb-2"> Name</label>
                            <div class="input-wrapper">
                                <i class="fa fa-user icon"></i>

                                <input type="text" id="name" placeholder="Name" />
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="mb-2"> Email</label>
                            <div class="input-wrapper">
                                <i class="fa fa-envelope icon"></i>
                                <input type="email" id="email" placeholder="e-mail address" />
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="country" class="mb-2"> Country</label>
                            <div class="input-wrapper">
                                <i class="fa fa-map-marker-alt icon"></i>
                                <input type="text" id="country" placeholder="Country" />
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="message" class="mb-2">Message</label>
                            <textarea name="message" id="message" placeholder="Write us" class="w-100"></textarea>
                        </div>
                        <div class="main-btn w-100">Send</div>
                    </form>
                </div>

            </div>
        </div>
        </div>
    </section>
@endsection
@section('js')

@endsection
